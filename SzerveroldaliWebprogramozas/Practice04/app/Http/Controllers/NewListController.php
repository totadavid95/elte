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

        return view('new-list')->with('data', $request->all());
    }

    public function delete(Request $request, $listId) {
        ShoppingList::where('id', $listId)->delete();
    }
}

