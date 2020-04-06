<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingList extends Model
{
    // Tábla neve
    protected $table = 'shoppinglists';

    // Feltölthető mezők
    protected $fillable = ['name'];

    public function items() {
        return $this->hasMany(ListItem::class, 'shoppinglist_id');
    }

}
