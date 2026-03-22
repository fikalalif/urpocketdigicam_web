<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Product;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::with('product')->latest()->paginate(10);
        return view('rentals.index', compact('rentals'));
    }

    public function create()
    {
        $products = Product::where('type', '!=', 'sale')->where('is_available', true)->get();
        return view('rentals.create', compact('products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string',
        ]);

        $product = Product::findOrFail($validated['product_id']);
        
        // Hitung total harga
        $start = Carbon::parse($validated['start_date']);
        $end = Carbon::parse($validated['end_date']);
        $days = $start->diffInDays($end);
        if ($days == 0) $days = 1;

        $validated['total_price'] = $product->rental_price * $days;
        $validated['status'] = 'pending';

        Rental::create($validated);

        return redirect()->route('rentals.index')->with('success', '✅ Rental berhasil dicatat.');
    }

    public function updateStatus(Request $request, Rental $rental)
    {
        $request->validate([
            'status' => 'required|in:pending,ongoing,completed,cancelled'
        ]);

        $rental->update(['status' => $request->status]);

        // Jika mulai disewa (ongoing), tandai produk tidak tersedia
        if ($request->status == 'ongoing') {
            $rental->product->update(['is_available' => false]);
        }
        
        // Jika selesai atau batal, tandai produk tersedia kembali
        if (in_array($request->status, ['completed', 'cancelled'])) {
            $rental->product->update(['is_available' => true]);
        }

        return back()->with('success', '✅ Status rental diperbarui.');
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();
        return redirect()->route('rentals.index')->with('success', '✅ Data rental dihapus.');
    }
}
