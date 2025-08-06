<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Excursion;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request, Excursion $excursion)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'people_count' => 'required|integer|min:1|max:' . $excursion->max_people,
        ]);

        Booking::create([
            'excursion_id' => $excursion->id,
            'client_id' => auth()->id(),
            'date' => $request->date,
            'people_count' => $request->people_count,
            'status' => 'pending',
        ]);

        return redirect()->route('excursion.show', $excursion->slug);
    }
}
