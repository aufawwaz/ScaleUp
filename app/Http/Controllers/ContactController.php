<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Contact::where('user_id', $request->user()->id);

        // Filter berdasarkan nama kontak
        if ($request->filled('search')) {
            $query->where('nama_kontak', 'like', '%' . $request->search . '%');
        }

        $contacts = $query->paginate(10)->withQueryString();

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

        return redirect()->route('contact.index')->with('success', 'Kontak berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        // Ambil transaksi dari model Transaction, bukan relasi, berdasarkan kontak_id
        $transactions = Transaction::where('kontak_id', $contact->id)
            ->orderByDesc('tanggal')
            ->limit(20)
            ->get();
        return view('contact.show', compact('contact', 'transactions'));
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

        return redirect()->route('contact.index')->with('success', 'Kontak berhasil dihapus!');
    }

    /**
     * Endpoint untuk auto-complete nama kontak (pelanggan)
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

    // Ambil produk berdasarkan ID (API/JSON)
    public function getById($id) : JsonResponse
    {
        $product = Contact::find($id);
        if (!$product) {
            return response()->json(['error' => 'Produk tidak ditemukan'], 404);
        }
        return response()->json($product);
    }
}
