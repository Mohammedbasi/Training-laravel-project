<?php

namespace App\Repositories\Cart;

class CartModelRepository implements CartRepository
{

    public function get()
    {
        return session()->get('cart', []);
    }

    public function add($id, $quantity)
    {
        $cart = $this->get();
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
    }

    public function delete($id)
    {
        $cart = $this->get();
        unset($cart[$id]);
        session()->put('cart', $cart);
    }

    public function empty()
    {
        session()->forget('cart');
    }
}
