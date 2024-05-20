<?php

namespace App\Http\Controllers;

use App\Models\Papernote;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PaperNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $papernote = Papernote::all();
        return view('papernote', compact('papernote'));
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
        // dd($request->all());
        $request->validate([
            'judul' => 'required|string|max:255',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'isi' => 'required|string',
        ], [
            'judul.required' => 'Judul catatan wajib diisi.',
            'judul.string' => 'Judul catatan harus berupa teks.',
            'judul.max' => 'Judul catatan tidak boleh lebih dari :max karakter.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar yang diperbolehkan adalah jpeg, png, jpg, gif, atau svg.',
            'gambar.max' => 'Ukuran gambar tidak boleh lebih dari :max kilobita.',
            'isi.required' => 'Isi catatan wajib diisi.',
            'isi.string' => 'Isi catatan harus berupa teks.',
        ]);

        $file = $request->file('gambar');

        if ($file) {
            $fileName = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('storage/papernote'), $fileName);
        } else {
            $fileName = 'mynote.png';
        }

        Papernote::create([
            'judul' => $request->judul,
            'gambar' => $fileName,
            'isi' => $request->isi,
        ]);

        return redirect()->route('papernote')->with('success', 'Catatan berhasil ditambahkan.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
