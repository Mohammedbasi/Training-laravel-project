<?php

namespace App\Providers;

use App\Models\InventoryItem;
use App\Models\Item;
use App\Models\PurchaseOrder;
use App\Models\Vendor;
use App\Models\VendorItem;
use App\Observers\DecreaseQuantityObserver;
use App\Observers\LowQuantityObserver;
use App\Observers\TotalPurchaseObserver;
use App\Observers\TotalSalesObserver;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        JsonResource::withoutWrapping();
        Paginator::useBootstrapFour();
        Item::observe(LowQuantityObserver::class);
        PurchaseOrder::observe([
            TotalSalesObserver::class,
            DecreaseQuantityObserver::class,
        ]);
        VendorItem::observe(TotalPurchaseObserver::class);
    }
}
