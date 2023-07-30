<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index()
    {
        $items = Item::with('brand')
            ->active()
            ->paginate(5);
        return view('front.items.index', compact('items'));
    }
}
