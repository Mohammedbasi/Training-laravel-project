<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function index()
    {
        $cart = session()->get('cart', []);
        $items = Item::with('brand')
            ->active()
            ->paginate();

        return view('front.cart.index', compact('cart', 'items'));
    }


    public function addToCart(Request $request, string $id)
    {
        $item  = Item::findOrFail($id);
        $quantity = $request->post('quantity', 1);

        if ($quantity < 1) {
            return redirect()->route('front.items.index')
                ->with('info', 'Quantity can not be less than 1');
        }
        if(!$item->purchasable){
            return redirect()->route('front.items.index')
                ->with('info', 'Item Is Not Purchasable');
        }
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'quantity' => $quantity,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        session()->put('cart', $cart);

        return redirect()->route('front.items.index')
            ->with('success', 'Item Added To Cart Successfully');
    }

    public function remove(string $id)
    {
        $cart = session()->get('cart',[]);
        unset($cart[$id]);
        session()->put('cart',$cart);

        return redirect()->route('front.cart.index')
            ->with('success','Item Removed From Cart');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('front.cart.index')
            ->with('success', 'Cart cleared.');
    }
}
