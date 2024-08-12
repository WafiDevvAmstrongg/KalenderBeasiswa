<?php

namespace App\Http\Controllers;

use App\Models\level_user;
use App\Models\User;
use Illuminate\Http\Request;

class LevelUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = level_user::all();
        return view('level_user.index', compact('data'));
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

        $simpan = level_user::create($validasiData);
        return redirect('/level_user')->with('success', 'Record created successfully!');
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
        $data = level_user::findOrFail($id);
        return view('level_user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
        ]);

        $data = level_user::findOrFail($id);
        $data->update($validatedData);

        return redirect('/level_user')->with('success', 'Record updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $levelUser = level_user::findOrFail($id);

            // Soft delete the main level_user record
            $levelUser->delete();

            return redirect()->route('level_user.index')->with('success', 'Level user deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('level_user.index')->with('error', 'Failed to delete level user.');
        }
    }

    /**
     * Display a listing of soft deleted resources.
     * Retrieves all soft deleted level_users.
     */
    public function soft_delete()
    {
        $trash = level_user::onlyTrashed()->get();

        return view('level_user.soft_delete', compact('trash'));
    }

    /**
     * Restore the soft deleted level_user record.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function restore($id)
    {
        try {
            $levelUser = level_user::withTrashed()->findOrFail($id);

            // Restore the main level_user record
            $levelUser->restore();

            return redirect()->route('level_user.index')->with('success', 'Level user restored successfully.');
        } catch (\Exception $e) {
            return redirect()->route('level_user.index')->with('error', 'Failed to restore level user.');
        }
    }

    /**
     * Force delete (permanently delete) the level_user record.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function force_delete($id)
    {
        try {
            // Find the level_user with the given ID, including soft-deleted records
            $levelUser = level_user::withTrashed()->findOrFail($id);

            // Perform force delete
            $levelUser->forceDelete();

            // Redirect back with success message
            return redirect()->route('level_user_soft_delete')->with('success', 'Level user permanently deleted.');
        } catch (\Exception $e) {
            return redirect()->route('level_user_soft_delete')->with('error', 'Failed to permanently delete level user.');
        }
    }
}