<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingList;

class ItemController extends Controller
{
    public function __invoke($id) {
        $shoppinglist = ShoppingList::where('id', $id)->first();

        return view('item')
                    ->with('id', $id)
                    ->with('shoppinglist', $shoppinglist);

                    /*->with(
                        'items', [
                            ['name' => 'Kakaó',     'quantity' => 3],
                            ['name' => 'Tej',       'quantity' => 2],
                            ['name' => 'Kenyér',    'quantity' => 1],
                        ]
                    );*/
    }
}
