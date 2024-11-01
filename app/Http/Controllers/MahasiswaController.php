<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;

class MahasiswaController extends Controller
{
    // GET all mahasiswa
    public function index()
    {
        return Mahasiswa::all();
    }

    // POST create mahasiswa
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required|unique:mahasiswas',
            'jurusan' => 'required',
        ]);

        $mahasiswa = Mahasiswa::create($request->all());

        return response()->json($mahasiswa, 201);
    }

    // GET single mahasiswa by id
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404);
        }

        return response()->json($mahasiswa);
    }

    // PUT update mahasiswa
    public function update(Request $request, $id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404);
        }

        $mahasiswa->update($request->all());

        return response()->json($mahasiswa);
    }

    // DELETE mahasiswa
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);

        if (!$mahasiswa) {
            return response()->json(['message' => 'Mahasiswa not found'], 404);
        }

        $mahasiswa->delete();

        return response()->json(['message' => 'Mahasiswa deleted']);
    }
}