<?php

namespace App\Http\Controllers\Api;

use App\Models\karyawan;
use App\Http\Controllers\Controller;
use App\Http\Resources\karyawanResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class karyawanController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $karyawans = karyawan::all(); // Pastikan Anda mengambil semua data karyawan
        // return view('', ['data' => $karyawans]);  // Adjust the view if needed
        return new karyawanResource(true, 'List Data karyawan', $karyawans);
    }

    /**
     * store
     *
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'karyawan_name' => 'required|string',
            'deskripsi' => 'required|string',
            'karyawan_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload actor photo
        $karyawan_photo = $request->file('karyawan_photo');
        $karyawan_photo->storeAs('public/karyawans', $karyawan_photo->hashName());

        // Simpan data actor
        $karyawan = karyawan::create([
            'karyawan_name' => $request->karyawan_name,
            'deskripsi' => $request->deskripsi,
            'karyawan_photo' => $karyawan_photo->hashName(),
        ]);

        return new karyawanResource(true, 'Data karyawan Berhasil Ditambahkan!', $karyawan);
    }

    /**
     * update
     *
     * @param mixed $request
     * @param mixed $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'karyawan_name' => 'required|string',
            'deskripsi' => 'required|string',
            'karyawan_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $karyawan = karyawan::find($id);

        if (!$karyawan) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        if ($request->hasFile('karyawan_photo')) {
            // Upload gambar baru
            $karyawan_photo = $request->file('karyawan_photo');
            $karyawan_photo->storeAs('public/karyawans', $karyawan_photo->hashName());

            // Hapus gambar lama
            Storage::delete('public/karyawans/' . basename($karyawan->karyawan_photo));

            // Update data dengan gambar baru
            $karyawan->update([
                'karyawan_name' => $request->karyawan_name,
                'deskripsi' => $request->deskripsi,
                'karyawan_photo' => $karyawan_photo->hashName(),
            ]);
        } else {
            // Update data tanpa gambar baru
            $karyawan->update([
                'karyawan_name' => $request->karyawan_name,
                'deskripsi' => $request->deskripsi,
            ]);
        }

        return new karyawanResource(true, 'Data karyawan Berhasil Diubah!', $karyawan);
    }

    /**
     * destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $karyawan = karyawan::find($id);

        if (!$karyawan) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Hapus gambar
        Storage::delete('public/karyawans/' . basename($karyawan->karyawan_photo));

        // Hapus data actor
        $karyawan->delete();

        return new karyawanResource(true, 'Data karyawan Berhasil Dihapus!', null);
    }
}
