<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        // Assuming the user is authenticated and available via the request
        $user = $request->user();

        return response()->json([
            'user' => $user,
            'message' => 'User profile retrieved successfully.'
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = $request->user();
        $validated = $request->validate([
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

        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo && Storage::disk('public')->exists($user->profile_photo)) {
                Storage::disk('public')->delete($user->profile_photo);
            }
            $validated['profile_photo'] = $request->file('profile_photo')->store('profile_photos', 'public');
        }

        $user->update($validated);

        return response()->json([
            'user' => $user,
            'message' => 'User profile updated successfully.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
