<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingList;

class ShoppingListController extends Controller
{
    public function indexAll() {
        $lists = ShoppingList::all();
        return view('shopping-lists.shopping-lists')->with('lists', $lists);
    }

    public function indexItem($id) {
        $shoppinglist = ShoppingList::find($id);

        return view('shopping-lists.shopping-list')
                ->with('id', $id)
                ->with('shoppinglist', $shoppinglist);
    }

    public function indexAdd() {
        return view('shopping-lists.add-shopping-list');
    }

    public function store(Request $request) {

        // Validáció (szabályok: https://laravel.com/docs/7.x/validation)
        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);

        // Lista objektum létrehozása, adatokkal való feltöltése és eltárolása
        $list = new ShoppingList;
        $list->name = $request->input('name');
        $result = $list->save();

        // Oldal megjelenítése, jelezve, hogy sikerült-e a tárolás
        return redirect()->route('add-shopping-list')
                            ->with('result', $result)
                            ->with('list', $list);
    }

    public function indexEdit($id) {
        $list = ShoppingList::find($id);
        return view('shopping-lists.edit-shopping-list')->with('list', $list);
    }

    public function update(Request $request, $id) {
        $validated_data = $request->validate([
            'name' => 'required|min:3',
        ]);

        $list = ShoppingList::find($id);
        $list->update($validated_data);

        return redirect()->route('edit-shopping-list', ['id' => $list->id])
                            ->with('list', $list);
    }

}

