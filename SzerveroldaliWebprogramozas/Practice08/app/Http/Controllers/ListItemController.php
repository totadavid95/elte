<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingList;
use App\ListItem;

class ListItemController extends Controller
{
    public function indexAdd($shoppingListId) {
        $shoppinglist = ShoppingList::find($shoppingListId);
        return view('list-items.add-list-item')->with('shoppinglist', $shoppinglist);
    }

    public function store(Request $request) {

    }
}
