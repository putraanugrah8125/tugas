<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota;

class AnggotaController extends Controller
{
    // 🔹 GET semua data
    public function index()
    {
return response()->json(\App\Models\Anggota::all());    }

    // 🔹 GET by ID
    public function show($id)
    {
        $data = Anggota::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }
        return response()->json($data);
    }

    // 🔹 POST (tambah anggota max 3)
    public function store(Request $request)
{
    // 1. Validate
    $validated = $request->validate([
        'nama' => 'required',
        'kelas' => 'required',
        'email' => 'required|email|unique:anggotas,email'
    ]);

   
    // 3. Create
    $data = Anggota::create($validated);

    return response()->json([
        'message' => 'Data berhasil ditambahkan',
        'data' => $data
    ]);
}

    // 🔹 PUT (update)
    public function update(Request $request, $id)
    {
        $data = Anggota::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data->update([
            'nama' => $request->nama,
            'kelas' => $request->kelas,
            'email' => $request->email,
        ]);

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $data
        ]);
    }

    // 🔹 DELETE
    public function destroy($id)
    {
        $data = Anggota::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data->delete();

        return response()->json(['message' => 'Data berhasil dihapus']);
    }
}
