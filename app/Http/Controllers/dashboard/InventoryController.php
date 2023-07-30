<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\InventoryRequest;
use App\Models\City;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Exception;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $request = request();
        $inventories = Inventory::with('city')
            ->filter($request->all())
            ->paginate(5);

        $cities = City::all();
        return view('dashboard.inventories.index', compact('inventories', 'cities'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = City::all();
//        $vendors = Vendor::all();
        return view('dashboard.inventories.create', compact('cities'/*, 'vendors'*/));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request)
    {
//        $vendors = $request->input('vendors', []);
//        $count = array_count_values($vendors);
//        $data = $request->except('vendors');

//        $vendor_id = [];
//        if ($count != 0) {
//            foreach ($vendors as $vendorId) {
//                $vendor_id[] = $vendorId;
//            }
//        }
//        $inventory->vendors()->sync($vendor_id);
        $inventory = Inventory::create($request->all());
        return redirect()->route('inventories.index')->with('success', 'Inventory Created');
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
            $inventory = Inventory::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('inventories.index')->with('info', 'Page Not Found!');
        }
        $cities = City::all();
//        $vendors = Vendor::all();
//        $selectedVendors = $inventory->vendors->pluck('id')->toArray();
        return view('dashboard.inventories.edit',
            compact('inventory', 'cities'/*, 'vendors', 'selectedVendors'*/));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(InventoryRequest $request, string $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());

//        $vendors = $request->input('vendors', []);
//        $count = array_count_values($vendors);
//        $vendor_id = [];
//        if ($count != 0) {
//            foreach ($vendors as $vendorId) {
//                $vendor_id[] = $vendorId;
//            }
//        }
//        $inventory->vendors()->sync($vendor_id);

        return redirect()->route('inventories.index')->with('success', 'Inventory Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->delete();

        return redirect()->route('inventories.index')->with('success', 'Inventory Deleted');
    }

    public function trash()
    {
        $inventories = Inventory::onlyTrashed()->paginate(10);
        return view('dashboard.inventories.softDelete', compact('inventories'));
    }

    public function restore(string $id)
    {
        $inventory = Inventory::onlyTrashed()->findOrFail($id);
        $inventory->restore();
        return redirect()->route('inventories.trash')->with('success', 'Inventory restored!');
    }

    public function forceDelete(string $id)
    {
        $inventory = Inventory::onlyTrashed()->findOrFail($id);
        $inventory->forceDelete();
        $inventory->items()->detach();
        return redirect()->route('inventories.trash')->with('success', 'Inventory deleted forever!');
    }

    public function items(string $id)
    {
        $inventory = Inventory::findOrFail($id);
        $items = $inventory->items()->paginate(3);

        return view('dashboard.inventories.items',compact('items'));
    }

//    public function addItems(string $id)
//    {
//        try {
//            $inventory = Inventory::findOrFail($id);
//        } catch (Exception $e) {
//            return redirect()->route('inventories.index')->with('info', 'Page Not Found!');
//        }
//        $items = Item::all();
//        $selectedItems = [];
//        $itemQuantities = [];
//        if ($inventory) {
//            $selectedItems = $inventory->items->pluck('id')->toArray();
//            $itemQuantities = $inventory->items->pluck('pivot.quantity', 'id')->toArray();
//        }
//        return view('dashboard.inventories.addItems',
//            compact('items', 'inventory', 'selectedItems', 'itemQuantities'));
//    }

//    public function storeItems(Request $request, string $id)
//    {
//        $inventory = Inventory::findOrFail($id);
//        $quantities = $request->input('quantities', []);
//
//        $inventory->items()->detach();
//
//        foreach ($request->input('item_ids', []) as $itemId) {
//            $item = Item::findOrFail($itemId);
//
//            if ($item && is_numeric($quantities[$itemId])) {
//                $inventory->items()->attach($item, ['quantity' => $quantities[$itemId]]);
//            }
//        }
//
//        return redirect()->route('inventories.index')->with('success', 'Items Add To Inventory Successfully');
//    }
}
