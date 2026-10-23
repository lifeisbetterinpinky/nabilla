<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => Berita::latest()->get()
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:255',
            'siapa_yang_buat' => 'required|string|max:255',
            'isian' => 'required',
            'tanggal' => 'required|date',
        ]);

        $berita = Berita::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil ditambahkan',
            'data' => $berita
        ], 201);
    }

    public function show(string $id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $berita
        ], 200);
    }

    public function update(Request $request, string $id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $berita->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diubah',
            'data' => $berita
        ], 200);
    }

    public function destroy(string $id)
    {
        $berita = Berita::find($id);

        if (!$berita) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $berita->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus'
        ], 200);
    }
}