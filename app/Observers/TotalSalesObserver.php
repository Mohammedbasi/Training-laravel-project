<?php

namespace App\Observers;

use App\Models\Item;
use App\Models\PurchaseOrder;

class TotalSalesObserver
{
    /**
     * Handle the PurchaseOrder "created" event.
     */
    public function created(PurchaseOrder $purchaseOrder): void
    {
        $item_id = $purchaseOrder->item_id;
        $item = Item::findOrFail($item_id);
        $old_sales = $item->total_sales;
        $new_sales = $old_sales + $purchaseOrder->quantity;
        $item->update([
            'total_sales' => $new_sales
        ]);
    }

    /**
     * Handle the PurchaseOrder "updated" event.
     */
    public function updated(PurchaseOrder $purchaseOrder): void
    {
        //
    }

    /**
     * Handle the PurchaseOrder "deleted" event.
     */
    public function deleted(PurchaseOrder $purchaseOrder): void
    {
        //
    }

    /**
     * Handle the PurchaseOrder "restored" event.
     */
    public function restored(PurchaseOrder $purchaseOrder): void
    {
        //
    }

    /**
     * Handle the PurchaseOrder "force deleted" event.
     */
    public function forceDeleted(PurchaseOrder $purchaseOrder): void
    {
        //
    }
}
