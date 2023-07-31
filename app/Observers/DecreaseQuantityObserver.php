<?php

namespace App\Observers;

use App\Models\Inventory;
use App\Models\PurchaseOrder;

class DecreaseQuantityObserver
{
    /**
     * Handle the PurchaseOrder "created" event.
     */
    public function created(PurchaseOrder $purchaseOrder): void
    {
        $item_id = $purchaseOrder->item_id;
        $quantity = $purchaseOrder->quantity;
        $inventory = Inventory::findOrFail($purchaseOrder->inventory_id);
        $inventory->items()->where('item_id', $item_id)->decrement('quantity', $quantity);

        $inventory->refresh();
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
