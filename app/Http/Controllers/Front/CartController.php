<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $cart = $this->cart->get();
        $items = Item::with('brand')
            ->active()
            ->paginate();

        return view('front.cart.index', compact('cart', 'items'));
    }


    public function addToCart(Request $request, string $id)
    {
        $item = Item::findOrFail($id);
        $quantity = $request->post('quantity', 1);

        if ($quantity < 1) {
            return redirect()->route('front.items.index')
                ->with('info', 'Quantity can not be less than 1');
        }
        if (!$item->purchasable) {
            return redirect()->route('front.items.index')
                ->with('info', 'Item Is Not Purchasable');
        }
        $this->cart->add($id, $quantity);

        return redirect()->route('front.items.index')
            ->with('success', 'Item Added To Cart Successfully');
    }

    public function remove(string $id)
    {
        $this->cart->delete($id);

        return redirect()->route('front.cart.index')
            ->with('success', 'Item Removed From Cart');
    }

    public function clear()
    {
        $this->cart->empty();

        return redirect()->route('front.cart.index')
            ->with('success', 'Cart cleared.');
    }
}
