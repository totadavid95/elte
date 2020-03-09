<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function __invoke($id) {
        return view('item')
                    ->with('id', $id)
                    ->with(
                        'items', [
                            ['name' => 'Kakaó',     'quantity' => 3],
                            ['name' => 'Tej',       'quantity' => 2],
                            ['name' => 'Kenyér',    'quantity' => 1],
                        ]
                    );
    }
}
