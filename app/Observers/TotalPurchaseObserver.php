<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\VendorItem;

class TotalPurchaseObserver
{
    /**
     * Handle the VendorItem "created" event.
     */
    public function created(VendorItem $vendorItem): void
    {
        //
    }

    /**
     * Handle the VendorItem "updated" event.
     */

    public function updated(VendorItem $vendorItem): void
    {
        if ($vendorItem->isDirty('purchase_flag')) {
            $request = request();
            $quantity = $request->post('quantity');
            $item_id = $vendorItem->item_id;
            $item = Item::findOrFail($item_id);
            $old_purchases = $item->total_purchases;
            $new_purchases = $old_purchases + $quantity;
            $item->update([
                'total_purchases' => $new_purchases
            ]);
        }
    }

    /**
     * Handle the VendorItem "deleted" event.
     */
    public function deleted(VendorItem $vendorItem): void
    {
        //
    }

    /**
     * Handle the VendorItem "restored" event.
     */
    public function restored(VendorItem $vendorItem): void
    {
        //
    }

    /**
     * Handle the VendorItem "force deleted" event.
     */
    public function forceDeleted(VendorItem $vendorItem): void
    {
        //
    }
}
