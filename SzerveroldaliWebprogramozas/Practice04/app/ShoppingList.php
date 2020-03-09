<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    protected $table = 'shoppinglists';
    public $primaryKey = 'id';
    public $timestamps = true;
}
