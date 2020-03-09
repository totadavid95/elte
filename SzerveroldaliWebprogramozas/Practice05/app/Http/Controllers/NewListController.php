<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingList;

class NewListController extends Controller
{
    public function index() {
        return view('new-list');
    }

    public function store(Request $request) {

        // Validáció
        $validated = $request->validate([
            'name' => 'required|min:3',
        ]);

        // Órai feladat, a lista tárolása

        // Lista objektum létrehozása, adatokkal való feltöltése és eltárolása
        $list = new ShoppingList;
        $list->name = $request->input('name');
        $result = $list->save();

        // Oldal megjelenítése, jelezve, hogy sikerült-e a tárolás
        return redirect()->route('new-list-index')
                                ->with('result', $result)
                                ->with('list', $list);
    }
}
