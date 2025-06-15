<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    //GET /api/contact
    public function index(Request $request)
    {
        $query = Contact::where('user_id', $request->user()->id);

        // Filter berdasarkan nama kontak
        if ($request->filled('search')) {
            $query->where('nama_kontak', 'like', '%' . $request->search . '%');
        }

        $contacts = $query->paginate(10)->withQueryString();

        return response()->json($contacts);
    }

    // POST /api/contact
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_kontak'       => 'required|string|max:255',
            'nomor_handphone'   => 'nullable|string|max:50',
            'image_kontak'      => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            'email_kontak'      => 'nullable|email',
            'alamat_kontak'     => 'nullable|string',
            'jumlah_transaksi'  => 'nullable|integer'
        ]);

        $validated['user_id'] = $request->user()->id;

        // Handle upload gambar
        if ($request->hasFile('image_kontak')) {
            $validated['image_kontak'] = $request->file('image_kontak')->store('contact', 'public');
        }

        Contact::create($validated);

        return response()->json(['message' => 'Kontak berhasil ditambah!']);
    }

    // GET /api/contact/{id}
    public function show(Contact $contact)
    {
        $transactions = Transaction::where('kontak_id', $contact->id)
            ->orderByDesc('tanggal')
            ->limit(20)
            ->get();

        return response()->json([
            'contact' => $contact,
            'transactions' => $transactions
        ]);
    }

    // PUT/PATCH /api/contact/{id}
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

        return response()->json(['message' => 'Kontak berhasil diupdate!']);
    }

    // DELETE /api/contact/{id}
    public function destroy(Contact $contact)
    {
        if ($contact->image_kontak && Storage::disk('public')->exists($contact->image_kontak)) {
            Storage::disk('public')->delete($contact->image_kontak);
        }
        $contact->delete();

        return response()->json(['message' => 'Kontak berhasil dihapus!']);
    }

    /**
     * Endpoint untuk auto-complete nama kontak
     */
    public function autocomplete(Request $request)
    {
        $search = $request->get('q', '');
        $userId = $request->user() ? $request->user()->id : null;
        $query = Contact::query();
        if ($userId) {
            $query->where('user_id', $userId);
        }
        if ($search) {
            $query->where('nama_kontak', 'like', "%$search%");
        }
        $results = $query->limit(4)->get(['id', 'nama_kontak as label']);

        return response()->json($results);
    }
}
