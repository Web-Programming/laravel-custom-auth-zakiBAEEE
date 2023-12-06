<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Prodi;

class ProdiController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $prodis = Prodi::all();
        return $this->sendResponse($prodis, "Data Prodi");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Membuat validasi semua field wajib diisi
        $validasi = $request->validate([
            'nama' => 'required|min:5|max:20',
            'foto' => 'required|file|image|max:5000'
        ]);
        //ambil extension file
        $ext = $request->foto->getClientOriginalExtension();
        $name_file = "foto-" . time() . "." . $ext;

        $path = $request->foto->storeAs('public', $name_file);

        $prodi = new Prodi();
        $prodi->nama = $validasi['nama'];
        $prodi->foto = $name_file;

        if ($prodi->save()) {
            $success['data'] = $prodi;
            return $this->sendResponse($success . 'Data prodi berhasil diperbarui.');
        } else {
            return $this->sendError('Error.', ['error' => 'Data prodi gagal diperbarui.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // Membuat validasi semua field wajib diisi
        $validasi = $request->validate([
            'nama' => 'required|min:5|max:20',
            'foto' => 'required|file|image|max:5000'
        ]);
        //ambil extension file
        $ext = $request->foto->getClientOriginalExtension();
        $name_file = "foto-" . time() . "." . $ext;

        $path = $request->foto->storeAs('public', $name_file);

        $prodi = Prodi::find($id);
        $prodi->nama = $validasi['nama'];
        $prodi->foto = $name_file;

        if ($prodi->save()) {
            $success['data'] = $prodi;
            return $this->sendResponse($success . 'Data prodi berhasil diperbarui.');
        } else {
            return $this->sendError('Error.', ['error' => 'Data prodi gagal diperbarui.']);
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function delete(string $id)
    {
        $prodi = Prodi::findOrFail($id);
        //hapus data menggunakan method delete()
        if ($prodi->delete()) {
            $success['data'] = [];
            return $this->sendResponse($success, "Data prodi dengan id $id berhasil dihapus");
        } else {
            return $this->sendError('Error', ['error' => 'Data prodi gagal dihapus']);
        }
    }
}
