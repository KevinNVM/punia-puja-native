<?php

namespace App\Http\Controllers;

use App\Models\Tx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tx.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tx.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'name' => 'required',
            'phone' => 'string|nullable',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'events' => ['string', 'nullable'],
            'proof' => 'image|max:5012'
        ]);

        if ($request->hasFile('proof')) {
            $validated['proof'] = $request->file('proof')
                ->store('uploads', 'public');
        }

        Tx::create($validated);

        return redirect()
            ->route('dashboard')
            ->with('flash', [
                'banner' => 'Data berhasil ditambahkan!',
                'bannerStyle' => 'success'
            ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Tx $tx)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tx $tx)
    {
        return view('tx.edit', [
            'tx' => $tx
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tx $tx)
    {


        $validated = $request->validate([
            'type' => 'required',
            'name' => 'required',
            'phone' => 'string',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'events' => 'string|nullable',
            'proof' => 'image|max:5012|nullable'
        ]);

        // Check if a new image is uploaded
        if ($request->hasFile('proof')) {
            // Delete the old image if it exists
            if ($tx->proof) {
                Storage::disk('public')->delete($tx->proof);
            }

            // Store the new image
            $validated['proof'] = $request->file('proof')->store('uploads', 'public');
        }

        $tx->update($validated);

        return redirect()
            ->route('dashboard')
            ->with('flash', [
                'banner' => 'Data berhasil diperbarui!',
                'bannerStyle' => 'success'
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tx $tx)
    {
        //
    }

    public function subtotal()
    {
        return view('tx.subtotal');
    }
}
