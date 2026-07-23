<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Items;
use App\Models\Reservation;
use App\Models\Order;

class AdminController extends Controller
{
    public function showDashboard()
    {
        $menuItems = Items::all();
        return view('admin.dashboard', compact('menuItems'));
    }

    public function createItem()
    {
        return view('admin.createItem');
    }

    public function storeItem(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        Items::create($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Menu item created successfully!');
    }

    public function editItem($id)
    {
        $menuItem = Items::findOrFail($id);
        return view('admin.edit', compact('menuItem'));
    }

    public function updateItem(Request $request, $id)
    {
        $menuItem = Items::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'category' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menuItem->image && file_exists(public_path($menuItem->image))) {
                unlink(public_path($menuItem->image));
            }

            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = 'images/' . $imageName;
        }

        $menuItem->update($validated);

        return redirect()->route('admin.dashboard')->with('success', 'Menu item updated successfully!');
    }

    public function deleteItem($id)
    {
        $menuItem = Items::findOrFail($id);

        // Delete image if exists
        if ($menuItem->image && file_exists(public_path($menuItem->image))) {
            unlink(public_path($menuItem->image));
        }

        $menuItem->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Menu item deleted successfully!');
    }

    public function showBookings()
    {
        $bookings = Reservation::all();
        return view('admin.bookings', compact('bookings'));
    }

    public function showOrders()
    {
        $orders = Order::with(['user', 'items.menuItem'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.orders', compact('orders'));
    }
}