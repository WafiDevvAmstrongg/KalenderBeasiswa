<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\kalender_beasiswa;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with('kalenderBeasiswa')->get();
        
        // Optional: Check for empty or invalid date fields
        foreach ($wishlists as $wishlist) {
            if ($wishlist->kalenderBeasiswa) {
                // Check if dates are valid
                try {
                    \Carbon\Carbon::parse($wishlist->kalenderBeasiswa->tanggal_registrasi);
                    \Carbon\Carbon::parse($wishlist->kalenderBeasiswa->deadline);
                } catch (\Exception $l) {
                    // Handle invalid date format
                    return redirect()->back()->with('error', 'Invalid date format found.');
                }
            }
        }

        return view('frontend.wishlist', compact('wishlists'));
    }

  public function store(Request $request)
{
    $request->validate([
        'id_kbeasiswa' => 'required|exists:kalender_beasiswas,id',
    ]);

    Wishlist::create([
        'id_kbeasiswa' => $request->id_kbeasiswa,
    ]);

    return redirect()->back()->with('success', 'Added to wishlist!');
}

    public function destroy($id)
    {
        $wishlist = Wishlist::where('id_kbeasiswa', $id)->first();

        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Removed from wishlist!');
        }
            return redirect()->back()->with('error', 'Item not found in wishlist.');
    }

    public function add(Request $request)
    {
        $request->validate([
            'id_kbeasiswa' => 'required|exists:kalender_beasiswa,id',
        ]);

        $existingWishlist = Wishlist::where('id_kbeasiswa', $request->id_kbeasiswa)->first();

        if ($existingWishlist) {
            return redirect()->back()->with('info', 'Beasiswa sudah ada di wishlist.');
        }

        Wishlist::create([
            'id_kbeasiswa' => $request->id_kbeasiswa,
        ]);

        return redirect()->back()->with('success', 'Beasiswa berhasil ditambahkan ke wishlist!');
    }
}
