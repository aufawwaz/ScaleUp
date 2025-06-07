<?php

namespace App\Http\Controllers;

use App\Models\Saldo;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Saldo::all();
        return view('saldo', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('saldo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validation($request);
        Saldo::create($request->all());
        // return redirect('/saldo')->with('success', 'Data berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Saldo $saldo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Saldo $saldo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Saldo $saldo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Saldo $saldo)
    {
        //
    }
    private function validation(Request $request){
        $request->validate([
            'nama' => 'required',
            'jenis' => 'required|in:cash,bank',
            'jumlah' => 'required|float',
        ]);
    }
}
