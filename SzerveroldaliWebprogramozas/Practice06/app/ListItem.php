<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListItem extends Model
{
    // Tábla neve
    protected $table = 'listitems';

    public function list() {
        return $this->belongsTo(ShoppingList::class);
    }

}
