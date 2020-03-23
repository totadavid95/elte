<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewItemController extends Controller
{
    public function index() {
        return view('new-item');
    }
}
