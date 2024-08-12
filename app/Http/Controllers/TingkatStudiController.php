<?php

namespace App\Http\Controllers;

use App\Models\tingkat_studi;
use Illuminate\Http\Request;

class TingkatStudiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = tingkat_studi::all();
        return view('tingkat_studi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasiData = $request->validate([
            'nama' => 'required'
        ]);

        $simpan = tingkat_studi::create($validasiData);
        return redirect('/tingkat_studi')->with('success', 'Record created successfully!');
    }

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
        $data = tingkat_studi::findOrFail($id);
        return view('tingkat_studi.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validatedData = $request->validate([
        'nama' => 'required',
    ]);

    $data = tingkat_studi::findOrFail($id);
    $data->update($validatedData);

    return redirect('/tingkat_studi')->with('success', 'Record updated successfully!');
}

public function destroy($id)
{
    try {
        $tingkatStudi = tingkat_studi::findOrFail($id);

        // Soft delete the main TingkatStudi record
        $tingkatStudi->softDeleteTingkatStudi();

        return redirect()->route('tingkat_studi.index')->with('success', 'Tingkat Studi deleted successfully.');
    } catch (\Exception $e) {
        return redirect()->route('tingkat_studi.index')->with('error', 'Failed to delete Tingkat Studi.');
    }
}

/**
 * Display a listing of soft deleted resources.
 * Retrieves all soft deleted TingkatStudi records.
 */
public function soft_delete()
{
    $trash = tingkat_studi::onlyTrashed()->get();

    return view('tingkat_studi.soft_delete', compact('trash'));
}

/**
 * Restore the specified soft deleted resource.
 */
public function restore($id)
{
    try {
        $tingkatStudi = tingkat_studi::withTrashed()->findOrFail($id);

        // Restore the main TingkatStudi record
        $tingkatStudi->restoreTingkatStudi();

        return redirect()->route('tingkat_studi.index')->with('success', 'Tingkat Studi restored successfully.');
    } catch (\Exception $e) {
        return redirect()->route('tingkat_studi.index')->with('error', 'Failed to restore Tingkat Studi.');
    }
}

/**
 * Permanently delete the specified soft deleted resource.
 */
public function force_delete($id)
{
    try {
        // Find the Tingkat Studi with the given ID, including soft-deleted records
        $tingkatStudi = tingkat_studi::withTrashed()->findOrFail($id);

        // Perform force delete
        $tingkatStudi->forceDeleteTingkatStudi();

        return redirect()->route('tingkat_studi_soft_delete')->with('success', 'Tingkat Studi permanently deleted.');
    } catch (\Exception $e) {
        return redirect()->route('tingkat_studi_soft_delete')->with('error', 'Failed to permanently delete Tingkat Studi.');
    }
}
}