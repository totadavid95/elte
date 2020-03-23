<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ShoppingList;

class HomeController extends Controller
{
    public function index() {
        $lists = ShoppingList::all();
        return view('home')->with('lists', $lists);
    }
}

