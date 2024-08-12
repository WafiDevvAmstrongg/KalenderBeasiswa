<?php

namespace App\Http\Controllers;

use App\Models\kalender_beasiswa;
use App\Models\Negara;
use App\Models\tingkat_studi;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        return view('frontend.home');
    }

    public function kalender(Request $request)
    {
        $sort = $request->query('sort', 'desc'); // Default sort is descending (newest first)
        $data = kalender_beasiswa::with('negara', 'tingkat_studi')
        ->where('status_tampil', 1)
        ->orderBy('tanggal_registrasi', $sort)
        ->get();
        $negara = Negara::all();
        $tingkat_studi = tingkat_studi::all();

        // Adding #Kalender to the URL via frontend handling
        return view('frontend.kalender', [
            'data' => $data,
            'negara' => $negara,
            'tingkat_studi' => $tingkat_studi,
            'sort' => $sort
        ]);
    }

    public function detail($id)
    {
        $data = kalender_beasiswa::with('negara', 'tingkat_studi')->findOrFail($id);
        $negara = Negara::all();
        $tingkat_studi = tingkat_studi::all();

        return view('frontend.detail', [
            'data' => $data,
            'negara' => $negara,
            'tingkat_studi' => $tingkat_studi
        ]);
    }

    public function filter(Request $request)
{
    $query = kalender_beasiswa::query();

    // Track if the filter is applied
    $isJenisBeasiswaFiltered = $request->has('jenis_beasiswa');
    $sort = $request->query('sort', 'desc'); // Default sort is descending (newest first)

    // Filter by Tingkat Studi
    if ($request->has('id_tingkat_studi')) {
        $query->whereHas('tingkat_studi', function ($q) use ($request) {
            $q->whereIn('tingkat_studis.id', $request->id_tingkat_studi);
        });
    }

    // Filter by Jenis Beasiswa
    if ($isJenisBeasiswaFiltered) {
        $query->whereIn('jenis_beasiswa', $request->jenis_beasiswa);
    }

    // Filter by Negara
    if ($request->has('id_negara')) {
        $query->whereHas('negara', function ($q) use ($request) {
            $q->whereIn('negaras.id', $request->id_negara);
        });
    }

    $data = $query->with('negara', 'tingkat_studi')->orderBy('tanggal_registrasi', $sort)->get();
    $negara = Negara::all();
    $tingkat_studi = tingkat_studi::all();

    // Redirect to kalender view with a not found message if no articles are found
    if ($data->isEmpty()) {
        $message = $isJenisBeasiswaFiltered ? 'No articles found for the selected "Jenis Beasiswa"' : 'No articles found';

        return view('frontend.kalender', [
            'data' => collect(), // Passing an empty collection
            'negara' => $negara,
            'tingkat_studi' => $tingkat_studi,
            'message' => $message,
            'sort' => $sort // Pass sort parameter to view
        ]);
    }

    return view('frontend.kalender', [
        'data' => $data,
        'negara' => $negara,
        'tingkat_studi' => $tingkat_studi,
        'sort' => $sort // Pass sort parameter to view
    ]);
}

public function daftarBeasiswa($id)
    {
        $beasiswa = kalender_beasiswa::findOrFail($id);

        return view('frontend.daftar', [
            'beasiswa' => $beasiswa
        ]);
    }

    public function wishlist()
    {
        return view('frontend.wishlist');
    }
}