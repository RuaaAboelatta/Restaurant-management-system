<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'name',
        'price',
        'image',
        'description',
        'category'
    ];
}