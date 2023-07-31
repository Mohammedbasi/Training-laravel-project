<?php

namespace App\Observers;

use App\Mail\LowQuantityNotification;
use App\Models\InventoryItem;
use App\Models\Item;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LowQuantityObserver
{
    /**
     * Handle the InventoryItem "created" event.
     */
    public function created(Item $item): void
    {
        //
    }

    /**
     * Handle the InventoryItem "updated" event.
     */
    public function updated(Item $item): void
    {

    }

    /**
     * Handle the InventoryItem "deleted" event.
     */
    public function deleted(Item $item): void
    {
        //
    }

    /**
     * Handle the InventoryItem "restored" event.
     */
    public function restored(Item $item): void
    {
        //
    }

    /**
     * Handle the InventoryItem "force deleted" event.
     */
    public function forceDeleted(Item $item): void
    {
        //
    }

    public function updating(Item $item): void
    {
        if ($item->isDirty('total_sales')) {
            $totalQuantity = $item->inventories->sum(function ($inventory) {
                return $inventory->pivot->quantity;
            });

            foreach ($item->vendors as $vendor) {
                if ($totalQuantity < 50) {
                    $vendorEmail = $vendor->email; // Assuming you have a 'vendor' relationship in your Item model

                    // Send the email notification to the vendor
                    //Mail::to($vendorEmail)->send(new LowQuantityNotification($item));
                }
            }
        }
    }
}