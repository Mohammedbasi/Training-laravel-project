<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Trait\ImageUpload;
use Illuminate\Support\Facades\Storage;
use Exception;
class BrandController extends Controller
{
    use ImageUpload;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $brands = Brand::filter($request->query())->paginate(5);
        return view('dashboard.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        $data = $request->except('icon');
        $data['icon'] = $this->uploadImage($request,'icon','brands');

        $brand = Brand::create($data);
        return redirect()->route('brands.index')->with('success', 'Brands Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $brand = Brand::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('brands.index')->with('info', 'Page Not Found!');
        }
        return view('dashboard.brands.edit',compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BrandRequest $request, string $id)
    {

        $brand = Brand::findOrFail($id);

        $old_image = $brand->icon;
        $data = $request->except('icon');
        $new_image = $this->uploadImage($request,'icon','brands');

        if ($new_image) {
            $data['icon'] = $new_image;
        }

        $brand->update($data);

        if ($old_image && $new_image) {
            Storage::disk('public')->delete($old_image);
        }

        return redirect()->route('brands.index')->with('success', 'Brand Updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand Deleted');
    }

    public function trash()
    {
        $brands = Brand::onlyTrashed()->paginate(10);
        return view('dashboard.brands.softDelete', compact('brands'));
    }

    public function restore(string $id)
    {
        $brand = Brand::onlyTrashed()->findOrFail($id);
        $brand->restore();
        return redirect()->route('brands.trash')->with('success', 'Brand restored!');
    }

    public function forceDelete(string $id)
    {
        $brand = Brand::onlyTrashed()->findOrFail($id);
        $brand->forceDelete();

        if ($brand->icon) {
            Storage::disk('public')->delete($brand->icon);
        }
        return redirect()->route('brands.trash')->with('success', 'Brand deleted forever!');
    }
}
