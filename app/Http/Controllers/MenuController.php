<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;

class MenuController extends Controller
{
    public function showItems() {
        $items = Items::all();
        return view('layout.menu', compact('items'));
    }
    public function filterItems($category){
        $categoryMap = [
            'all' => null,
            'appetizers' => 'appetizers',
            'mains' => 'mains',
            'desserts' => 'desserts',
            'drinks' => 'beverages'  
        ];

        if ($category === 'all') {
            $items = Items::all();
        } else {
            $items = Items::where('category', $categoryMap[$category])->get();
        }

        return view('layout.menu', compact('items'));

    }
}
