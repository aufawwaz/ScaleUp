<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'nama_usaha' => 'nullable|string|max:255',
            'nomor_handphone' => 'nullable|string|max:50',
            'tipe_usaha' => 'nullable|string|max:255',
            'npwp' => 'nullable|string|max:30',
            'provinsi' => 'nullable|string|max:255',
            'kabupaten_kota' => 'nullable|string|max:255',
            'kecamatan' => 'nullable|string|max:255',
            'desa' => 'nullable|string|max:255',
        ]);

        // Handle upload foto profil
        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && \Storage::disk('public')->exists($user->profile_photo)) {
                \Storage::disk('public')->delete($user->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $user->update($validated);
        return redirect()->route('profile.show')->with('success', 'Profil berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
