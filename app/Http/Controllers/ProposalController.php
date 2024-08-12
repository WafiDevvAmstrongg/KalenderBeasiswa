<?php

namespace App\Http\Controllers;

use App\Models\kalender_beasiswa;
use App\Models\negara;
use App\Models\tingkat_studi;
use Illuminate\Http\Request;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = kalender_beasiswa::with('negara', 'tingkat_studi')->get();
        $negara = negara::all();
        $tingkat_studi = tingkat_studi::all();
        return view('frontend.proposal', ['data' => $data, 'negara' => $negara, 'tingkat_studi' => $tingkat_studi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // Validation rules for incoming request data
        $validatedData = $request->validate([
            'tanggal_registrasi' => 'nullable',
            'deadline' => 'nullable',
            'judul' => 'nullable',
            'nama' => 'nullable',
            'deskripsi' => 'nullable',
            'jurusan' => 'nullable',
            'jenis_beasiswa' => 'nullable',
            'keuntungan' => 'nullable',
            'umur' => 'nullable',
            'gpa' => 'nullable',
            'tes_english' => 'nullable',
            'tes_bahasa_lain' => 'nullable',
            'tes_standard' => 'nullable',
            'dokumen' => 'nullable',
            'lainnya' => 'nullable',
            'status_tampil' => 'nullable'
        ]);

        // Create a new kalender_beasiswa record with validated data
        $kalenderBeasiswa = kalender_beasiswa::create($validatedData);

        // Attach related Negara models if specified
        if ($request->has('id_negara')) {
            $kalenderBeasiswa->negara()->attach($request->id_negara);
        }

        // Attach related Tingkat Studi models if specified
        if ($request->has('id_tingkat_studi')) {
            $kalenderBeasiswa->tingkat_studi()->attach($request->id_tingkat_studi);
        }

        return redirect()->route('frontend.proposal')->with('success', 'Proposal created successfully.');
    }



    /**
     * Store a newly created resource in storage.
     */
   

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
