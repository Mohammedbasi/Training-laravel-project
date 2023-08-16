<?php

namespace App\Http\Controllers\Front;

use App\Exceptions\InvalidPurchaseException;
use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\PurchaseOrder;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index()
    {
        $orders = PurchaseOrder::with('item')
            ->where('user_id', Auth::id())->paginate(5);
        return view('front.orders.index', compact('orders'));
    }

    public function purchaseSingle(string $id)
    {
        $cart = session()->get('cart', []);
        $item_id = $id;
        $quantity = $cart[$item_id]['quantity'];
        $inventory_id = $this->inventoryWithLargestQuantity($item_id);
        if (!$inventory_id) {
            return redirect()->route('front.cart.index')
                ->with('info', 'Item is not available');
        }
        $user_id = Auth::id();
        if ($this->checkQuantity($item_id, $inventory_id, $quantity)) {
            return redirect()->route('front.cart.index')
                ->with('info', 'The required quantity does not available');
        }
        $order = PurchaseOrder::create([
            'user_id' => $user_id,
            'inventory_id' => $inventory_id,
            'item_id' => $item_id,
            'quantity' => $quantity
        ]);
        unset($cart[$id]);
        session()->put('cart', $cart);
//        $this->decreaseQuantity($item_id, $inventory_id, $quantity);
        return redirect()->route('front.cart.index')
            ->with('success', 'Order in-progress, please wait for delivered');
    }

    public function purchaseAll()
    {

        $cart = session()->get('cart', []);
        if (count($cart) == 0) {
            throw new InvalidPurchaseException('Cart is empty');
        }
        foreach ($cart as $item_id => $attributes) {
            $inventory_id = $this->inventoryWithLargestQuantity($item_id);
            if (!$inventory_id) {
                return redirect()->route('front.cart.index')
                    ->with('info', 'Item is not available');
            }
            $user_id = Auth::id();
            if ($this->checkQuantity($item_id, $inventory_id, $attributes['quantity'])) {
                return redirect()->route('front.cart.index')
                    ->with('info', 'The required quantity does not available');
            }
            $order = PurchaseOrder::create([
                'user_id' => $user_id,
                'inventory_id' => $inventory_id,
                'item_id' => $item_id,
                'quantity' => $attributes['quantity']
            ]);
            //$this->decreaseQuantity($item_id, $inventory_id, $attributes['quantity']);
        }
        session()->forget('cart');
        return redirect()->route('front.cart.index')
            ->with('success', 'Order in-progress, please wait for delivered');
    }

    public function inventoryWithLargestQuantity($item_id)
    {
        return Item::findOrFail($item_id)
            ->inventories()
            ->orderByDesc('inventory_items.quantity')
            ->pluck('inventories.id')
            ->first();
    }

//    public function decreaseQuantity($item_id, $inventory_id, $quantity)
//    {
    // update the total sales of item
//        $item = Item::findOrFail($item_id);
//        $old_sales = $item->total_sales;
//        $new_sales = $old_sales + $quantity;
//        $item->update([
//            'total_sales' => $new_sales
//        ]);

    // decrease the quantity of the inventory
//        $inventory = Inventory::findOrFail($inventory_id);
//        $inventory->items()->where('item_id', $item_id)->decrement('quantity', $quantity);
//
//        $inventory->items()->updateExistingPivot($item_id, ['quantity' => $new_quantity]);
//        $inventory->refresh();

//    }

    public function checkQuantity($item_id, $inventory_id, $quantity)
    {
        $inventory = Inventory::findOrFail($inventory_id);
        $stored_quantity = $inventory->items()->where('item_id', $item_id)->first()->pivot->quantity;

        return $quantity > $stored_quantity;
    }
}
