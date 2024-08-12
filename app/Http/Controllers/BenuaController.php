<?php

namespace App\Http\Controllers;

use App\Models\Benua;
use Illuminate\Http\Request;

class BenuaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Benua::all();
        return view('benua.index', compact('data'));
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

        $simpan = Benua::create($validasiData);
        return redirect('/benua')->with('success', 'Record created successfully!');
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
        $data = Benua::findOrFail($id);
        return view('benua.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $data = Benua::findOrFail($id);
        $data->update($validatedData);

        return redirect('/benua')->with('success', 'Record updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    // public function destroy(string $id)
    // {
    //     $data = Benua::findOrFail($id);
    //     $data->delete();
    //     return redirect('/benua')->with('success', 'Record deleted successfully!');
    // }

    public function destroy($id)
    {
        try {
            $benua = Benua::findOrFail($id);

            // Soft delete the main benua record
            $benua->softDeleteBenua();

            return redirect()->route('benua.index')->with('success', 'Benua deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('benua.index')->with('error', 'Failed to delete benua.');
        }
    }

    public function soft_delete()
    {
        $trash = Benua::onlyTrashed()->get();

        return view('benua.soft_delete', compact('trash'));
    }

    public function restore($id)
    {
        try {
            $benua = Benua::withTrashed()->findOrFail($id);

            // Restore the main benua record
            $benua->restoreBenua();

            return redirect()->route('benua.index')->with('success', 'Benua restored successfully.');
        } catch (\Exception $e) {
            return redirect()->route('benua.index')->with('error', 'Failed to restore Benua.');
        }
    }

    public function force_delete($id)
    {
        try {
            // Find the Benua with the given ID, including soft-deleted records
            $benua = Benua::withTrashed()->findOrFail($id);

            // Perform force delete
            $benua->forceDeleteBenua();

            return redirect()->route('benua_soft_delete')->with('success', 'Benua permanently deleted.');
        } catch (\Exception $e) {
            return redirect()->route('benua_soft_delete')->with('error', 'Failed to permanently delete Benua.');
        }
    }
}