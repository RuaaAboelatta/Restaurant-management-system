<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Table;
use App\Models\Reservation;

class ReservationController extends Controller
{
    public function showTables(){
        $tables = Table::all(); 
        return view('layout.reservation', compact('tables'));
    }
    
    public function store(Request $request){
        $request->validate([
            'table_id' => 'required|exists:tables,id',
            'reservation_date' => 'required|date|after_or_equal:today',
            'reservation_time' => 'required'
        ]);
        
        // Check availability
        $available = $this->checkAvailability(
            $request->table_id,
            $request->reservation_date,
            $request->reservation_time
        );
        
        if (!$available) {
            return redirect()->back()
                             ->with('error', 'Table is not available for this time!')
                             ->withInput();
        }
        
        // Create reservation
        $reservation = Reservation::create([
            'user_id' => auth()->id(),
            'table_id' => $request->table_id,
            'reservation_date' => $request->reservation_date,
            'reservation_time' => $request->reservation_time,
            'status' => 'confirmed'
        ]);
        
        // Update table status
        Table::where('id', $request->table_id)->update(['status' => 'reserved']);
        
        return redirect()->route('reservations.index')
                         ->with('success', 'Reservation done successfully!');
    }

   
    
    private function checkAvailability($tableId, $date, $time)
    {
        // Check if table already has a reservation at this time
        $existingReservation = Reservation::where('table_id', $tableId)
                                         ->where('reservation_date', $date)
                                         ->where('reservation_time', $time)
                                         ->whereIn('status', ['confirmed', 'pending'])
                                         ->exists();
        
        if ($existingReservation) {
            return false;
        }
        
        // Check if table exists and is available
        $table = Table::where('id', $tableId)
                     ->where('status', 'available')
                     ->first();
        
        return $table ? true : false;
    }
}