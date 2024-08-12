<?php

namespace App\Http\Controllers;

use App\Models\kalender_beasiswa;
use App\Models\negara;
use App\Models\tingkat_studi;
use Illuminate\Http\Request;

class KalenderBeasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     * Retrieves all scholarship calendars with related countries and study levels.
     */
    public function index()
    {
        $data = kalender_beasiswa::with('negara', 'tingkat_studi')->get();
        $negara = negara::all();
        $tingkat_studi = tingkat_studi::all();
        return view('kalender_beasiswa.index', ['data' => $data, 'negara' => $negara, 'tingkat_studi' => $tingkat_studi]);
    }

    /**
     * Store a newly created resource in storage.
     * Validates and stores a new scholarship calendar entry.
     */
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

        return redirect()->route('kalender_beasiswa.index')->with('success', 'Kalender Beasiswa created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     * Retrieves data for editing a specific scholarship calendar entry.
     */
    public function edit($id)
    {
        $data = kalender_beasiswa::with('negara', 'tingkat_studi')->findOrFail($id);
        $negara = negara::all();
        $tingkat_studi = tingkat_studi::all();

        return view('kalender_beasiswa.edit', compact('data', 'negara', 'tingkat_studi'));
    }

    /**
     * Update the specified resource in storage.
     * Validates and updates an existing scholarship calendar entry.
     */
    public function update(Request $request, $id)
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

        // Find the specific Kalender Beasiswa record by ID
        $kalenderBeasiswa = kalender_beasiswa::findOrFail($id);

        // Update the Kalender Beasiswa record with validated data
        $kalenderBeasiswa->update($validatedData);

        // Sync the pivot tables for negara and tingkat_studi based on request data
        if ($request->has('id_negara')) {
            $kalenderBeasiswa->negara()->sync($request->id_negara);
        } else {
            $kalenderBeasiswa->negara()->detach();
        }

        if ($request->has('id_tingkat_studi')) {
            $kalenderBeasiswa->tingkat_studi()->sync($request->id_tingkat_studi);
        } else {
            $kalenderBeasiswa->tingkat_studi()->detach();
        }

        return redirect()->route('kalender_beasiswa.index')->with('success', 'Kalender Beasiswa updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     * Deletes a scholarship calendar entry and detaches related records.
     */
    public function destroy($id)
    {
        try {
            $kalenderBeasiswa = kalender_beasiswa::findOrFail($id);

            // Soft delete the main kalender_beasiswa record
            $kalenderBeasiswa->delete();

            return redirect()->route('kalender_beasiswa.index')->with('success', 'Kalender Beasiswa deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('kalender_beasiswa.index')->with('error', 'Failed to delete Kalender Beasiswa.');
        }
    }

    /**
     * Display a listing of soft deleted resources.
     * Retrieves all soft deleted scholarship calendars.
     */
    public function soft_delete()
    {
        $trash = kalender_beasiswa::onlyTrashed()->get();

        return view('kalender_beasiswa.soft_delete', compact('trash'));
    }

    public function restore($id)
    {
        try {
            $kalenderBeasiswa = kalender_beasiswa::withTrashed()->findOrFail($id);

            // Restore the main kalender_beasiswa record
            $kalenderBeasiswa->restore();

            return redirect()->route('kalender_beasiswa.index')->with('success', 'Kalender Beasiswa restored successfully.');
        } catch (\Exception $e) {
            return redirect()->route('kalender_beasiswa.index')->with('error', 'Failed to restore Kalender Beasiswa.');
        }
    }

    public function force_delete($id)
    {
        // Find the Kalender Beasiswa with the given ID, including soft-deleted records
        $kalender = kalender_beasiswa::withTrashed()->findOrFail($id);

        // Perform force delete
        $kalender->forceDelete();

        // Redirect back with success message
        return redirect()->route('kbeasiswa_soft_delete')->with('success', 'Kalender Beasiswa permanently deleted.');
    }

    public function pending_kalender()
    {
        // Mendapatkan entri dengan status 'pending' dalam tabel kalender_beasiswa beserta hubungannya dengan negara dan tingkat_studi
        $data = kalender_beasiswa::with('negara', 'tingkat_studi')->where('status_tampil', 0)->get();        
        $negara = negara::all();
        $tingkat_studi = tingkat_studi::all();
    
        return view('pending_kalender.index', ['data' => $data, 'negara' => $negara, 'tingkat_studi' => $tingkat_studi]);
    }

    public function accept($id)
    {
        try {
            $kalenderBeasiswa = kalender_beasiswa::findOrFail($id);
            $kalenderBeasiswa->status_tampil = 1; // Assuming '1' means accepted
            $kalenderBeasiswa->save();

            return redirect()->route('kalender_beasiswa.index')->with('success', 'Proposal accepted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('kalender_beasiswa.index')->with('error', 'Failed to accept proposal.');
        }
    }
}
