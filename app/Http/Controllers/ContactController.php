<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contact::query();
        $contacts = $query->paginate(10);

        return view('contact.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate( [
            'nama_kontak'       => 'required|string|max:255',
            'nomor_handphone'   => 'nullable|string|max:50',
            'image_kontak'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'email_kontak'      => 'nullable|email',
            'alamat_kontak'     => 'nullable|string',
            'jumlah_transaksi'  => 'nullable|integer'
        ]);

        // Handle upload gambar
        if ($request->hasFile('image_kontak')) {
            $validated['image_kontak'] = $request->file('image_kontak')->store('contact', 'public');
        }

        Contact::create($validated);

        return redirect()->route('contact.index')->with('success', 'Kontak berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        return view('contact.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contact.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'nama_kontak'       => 'required|string|max:255',
            'nomor_handphone'   => 'nullable|string|max:50',
            'image_kontak'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
            'email_kontak'      => 'nullable|email',
            'alamat_kontak'     => 'nullable|string',
            'jumlah_transaksi'  => 'nullable|integer'
        ]);

        // Handle image update
        if ($request->hasFile('image_kontak')) {
            if ($contact->image_kontak && Storage::disk('public')->exists($contact->image_kontak)) {
                Storage::disk('public')->delete($contact->image_kontak);
            }
            $validated['image_kontak'] = $request->file('image_kontak')->store('contact', 'public');
        }

        $contact->update($validated);

        return redirect()->route('contact.index')->with('success', 'Kontak berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        // Hapus gambar kalo ada
        if ($contact->image_kontak && Storage::disk('public')->exists($contact->image_kontak)) {
            Storage::disk('public')->delete($contact->image_kontak);
        }
        $contact->delete();

        return redirect()->route('contact.index')->with('success', 'Kontak berhasil dihapus');
    }
}
