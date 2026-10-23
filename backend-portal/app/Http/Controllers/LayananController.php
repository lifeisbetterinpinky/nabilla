<?php

namespace App\Http\Controllers;

use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    // READ (Tampilkan Semua Data)
    public function index()
    {
        return response()->json(Layanan::latest()->get(), 200);
    }

    // CREATE (Tambah Data Baru)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_layanan' => 'required|string|max:255',
            'kode_layanan' => 'required|string|unique:layanans,kode_layanan',
            'deskripsi'    => 'required|string',
            'persyaratan'  => 'required|string',
            'status'       => 'required|in:aktif,nonaktif',
        ]);

        $layanan = Layanan::create($validated);

        return response()->json([
            'message' => 'Layanan berhasil ditambahkan!',
            'data'    => $layanan
        ], 201);
    }

    // SHOW (Tampilkan 1 Data berdasarkan ID)
    public function show($id)
    {
        $layanan = Layanan::find($id);

        if (!$layanan) {
            return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
        }

        return response()->json($layanan, 200);
    }

    // UPDATE (Edit Data)
    public function update(Request $request, $id)
    {
        $layanan = Layanan::find($id);

        if (!$layanan) {
            return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
        }

        $validated = $request->validate([
            'nama_layanan' => 'sometimes|required|string|max:255',
            'kode_layanan' => 'sometimes|required|string|unique:layanans,kode_layanan,' . $id,
            'deskripsi'    => 'sometimes|required|string',
            'persyaratan'  => 'sometimes|required|string',
            'status'       => 'sometimes|required|in:aktif,nonaktif',
        ]);

        $layanan->update($validated);

        return response()->json([
            'message' => 'Layanan berhasil diperbarui!',
            'data'    => $layanan
        ], 200);
    }

    // DELETE (Hapus Data)
    public function destroy($id)
    {
        $layanan = Layanan::find($id);

        if (!$layanan) {
            return response()->json(['message' => 'Layanan tidak ditemukan'], 404);
        }

        $layanan->delete();

        return response()->json(['message' => 'Layanan berhasil dihapus!'], 200);
    }
}