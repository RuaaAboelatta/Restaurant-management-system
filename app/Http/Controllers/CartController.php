<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Items;

class CartController extends Controller
{
    public function showCart()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        foreach ($cart as $id => $item) {
            $cart[$id]['total'] = $item['price'] * $item['quantity'];
            $total += $cart[$id]['total'];
        }
        return view('layout.cart', compact('cart', 'total'));
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'menu_item_id' => 'required|exists:menu_items,id'
        ]);

        $menuItem = Items::findOrFail($request->menu_item_id);

        $cart = session()->get('cart', []);

        if (isset($cart[$menuItem->id])) {
            $cart[$menuItem->id]['quantity']++;
        } else {
            $cart[$menuItem->id] = [
                'id' => $menuItem->id,
                'name' => $menuItem->name,
                'price' => $menuItem->price,
                'quantity' => 1,
                'image' => $menuItem->image
            ];
        }

        session()->put('cart', $cart);

        $totalItems = array_sum(array_column($cart, 'quantity'));
        session()->put('cart_count', $totalItems);

        return redirect()->back()->with('success', 'Added to cart!');
    }

    public function updateQuantity(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;

            if ($cart[$id]['quantity'] <= 0) {
                unset($cart[$id]);
            }

            session()->put('cart', $cart);

            $totalItems = array_sum(array_column($cart, 'quantity'));
            session()->put('cart_count', $totalItems);
        }

        return redirect()->route('cart.index');
    }

    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);

            $totalItems = array_sum(array_column($cart, 'quantity'));
            session()->put('cart_count', $totalItems);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed!');
    }

    public function clearCart()
    {
        session()->forget('cart');
        session()->forget('cart_count');

        return redirect()->route('menu.index')->with('success', 'Cart cleared!');
    }
}