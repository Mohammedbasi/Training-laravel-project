<?php

namespace App\Repositories\Cart;

interface CartRepository
{
    public function get();

    public function add($id, $quantity);


    public function delete($id);

    public function empty();
}
