<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Models\Brand;
use App\Models\Item;
use App\Trait\ImageUpload;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $items =Item::with('brand')->filter($request->all())->paginate(5);
        $brands  =Brand::all();
        return view('dashboard.items.index',compact('items','brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::all();
        return view('dashboard.items.create',compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemRequest $request)
    {
        $data = $request->except('image');
        $data['image'] = $this->uploadImage($request,'image','items');


        $item = Item::create($data);
        return redirect()->route('items.index')->with('success','Item Created !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $item = Item::findOrFail($id);
        }catch (Exception $e){
            return redirect()->route('items.index')->with('info','Page Not Found!');
        }
        $brands = Brand::all();
        return view('dashboard.items.edit',compact('item','brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemRequest $request, string $id)
    {
        $item = Item::findOrFail($id);

        $old_image = $item->image;
        $data = $request->except('image');
        $new_image = $this->uploadImage($request,'image','items');

        if ($new_image) {
            $data['image'] = $new_image;
        }

        $item->update($data);
        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('items.index')->with('success', 'Item Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = Item::findOrFail($id);
        $item->delete();

        return redirect()->route('items.index')->with('success', 'Item Deleted');
    }

    public function trash()
    {
        $items = Item::onlyTrashed()->paginate(10);
        return view('dashboard.items.softDelete', compact('items'));
    }

    public function restore(string $id)
    {
        $item = Item::onlyTrashed()->findOrFail($id);
        $item->restore();
        return redirect()->route('items.trash')->with('success', 'Item restored!');
    }

    public function forceDelete(string $id)
    {
        $item = Item::onlyTrashed()->findOrFail($id);
        $item->forceDelete();

        if ($item->image) {
            Storage::disk('public')->delete($item->image);
        }
        return redirect()->route('items.trash')->with('success', 'Item deleted forever!');
    }
}
