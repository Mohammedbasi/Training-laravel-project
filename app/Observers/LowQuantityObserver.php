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
            if ($totalQuantity < 50) {
                foreach ($item->vendors as $vendor) {
                    if ($vendor->is_active) {
                        $vendorEmail = $vendor->email;
                        $message = (new LowQuantityNotification($item))
                            ->onQueue('emails');
                        // Send the email notification to the vendor
                        Mail::to($vendorEmail)->queue($message);
                    }
                }
            }
        }
    }
}
