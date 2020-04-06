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

    public function store(Request $request, $id) {
        // Validáció (szabályok: https://laravel.com/docs/7.x/validation)
        $request_data = $validated = $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif'
        ]);

        $list_item = new ListItem;

        if (isset($request_data['file'])) {
            $filename = $request->file('file')->store('public/thumbnails');
            $list_item->thumbnail = $filename;
        }

        $list_item->name = $request->input('name');
        $list_item->quantity = $request->input('quantity');
        $list_item->price = $request->input('price');
        $list_item->shoppinglist_id = $id;
        $result = $list_item->save();

        // Oldal megjelenítése, jelezve, hogy sikerült-e a tárolás
        return redirect()->route('add-list-item', ['id' => $id])
                            ->with('result', $result)
                            ->with('list_item', $list_item);
    }
}
