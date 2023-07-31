<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Vendor;
use App\Models\VendorItem;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class ItemInventoryStore extends Controller
{
    public function index(string $id)
    {
        try {
            $item = Item::findOrFail($id);
        } catch (Exception $e) {
            return redirect()->route('items.index')
                ->with('info', 'Page Not Found');
        }
        $vendors = Vendor::all();
        $inventories = Inventory::all();
        return view('dashboard.itemInventory.index', compact('vendors', 'inventories', 'item'));
    }

    public function store(Request $request, string $id)
    {
        $quantity = $request->post('quantity');
        $vendor_id = $request->post('vendor_id');
        $inventory_id = $request->post('inventory_id');

        $vendor = Vendor::findOrfail($vendor_id);
        $vendor_items = $vendor->items()->pluck('items.id')->toArray();
        if (!in_array($id, $vendor_items)) {
            $vendor->items()->attach($id, ['quantity' => $quantity]);
            $this->changePurchaseFlag($vendor_id, $id);
            $this->itemToInventory($id, $inventory_id, $quantity);
        } else {
            foreach ($vendor->items as $item) {
                if ($item->id == $id) {
                    $old_quantity = $item->pivot->quantity;
                    $new_quantity = $old_quantity + $quantity;
                    $vendor->items()->updateExistingPivot($id, ['quantity' => $new_quantity]);
                    $this->changePurchaseFlag($vendor_id, $id);
                    $this->itemToInventory($id, $inventory_id, $quantity);
                }
            }
        }
        return redirect()->route('items.index')
            ->with('success', 'Items Stored Successfully');
    }

    public function itemToInventory($item_id, $inventory_id, $quantity)
    {
        // this performed by observer
//        $item = Item::findOrFail($item_id);
//        $old_purchases = $item->total_purchases;
//        $new_purchases = $old_purchases + $quantity;
//        $item->update([
//            'total_purchases' => $new_purchases
//        ]);

        $inventory = Inventory::findOrFail($inventory_id);
        $inventory_items = $inventory->items()->pluck('id')->toArray();
        if (!in_array($item_id, $inventory_items)) {
            $inventory->items()->attach($item_id, ['quantity' => $quantity]);
        } else {
            foreach ($inventory->items as $item) {
                if ($item->id == $item_id) {
                    $old_quantity = $item->pivot->quantity;
                    $new_quantity = $old_quantity + $quantity;
                    $inventory->items()->updateExistingPivot($item_id, ['quantity' => $new_quantity]);
                }
            }
        }
    }

    public function changePurchaseFlag($vendor_id, $item_id)
    {
        VendorItem::updateOrCreate(
            ['vendor_id' => $vendor_id, 'item_id' => $item_id],
            ['purchase_flag' => DB::raw('IF(purchase_flag = 0, 1, 0)')]
        );
    }
}
