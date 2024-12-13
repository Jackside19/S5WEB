<?php

namespace App\Http\Controllers\Api;

use App\Models\produk;
use App\Http\Controllers\Controller;
use App\Http\Resources\produkResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class produkController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        $produks = produk::all(); // Pastikan Anda mengambil semua data
        // return view('', ['data' => $produks]);      
        return new produkResource(true, 'List Data produk', $produks);

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
            'name' => 'required|string',
            'deskripsi' => 'required|string',
            'price' => 'required|integer',
            'produk_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Upload gambar
        $produk_image = $request->file('produk_image');
        $produk_image->storeAs('public/produks', $produk_image->hashName());

        // Simpan data
        $produk = produk::create([
            'name' => $request->name,
            'deskripsi' => $request->deskripsi,
            'price' => $request->price,
            'produk_image' => $produk_image->hashName(),
        ]);

        return new produkResource(true, 'Data produk Berhasil Ditambahkan!', $produk);
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
            'name' => 'required|string',
            'deskripsi' => 'required|string',
            'price' => 'required|integer',
            'produk_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Cari produk berdasarkan ID
        $produk = produk::find($id);

        if (!$produk) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        if ($request->hasFile('produk_image')) {
            // Upload gambar baru
            $produk_image = $request->file('produk_image');
            $produk_image->storeAs('public/produks', $produk_image->hashName());

            // Hapus gambar lama
            Storage::delete('public/produks/' . basename($produk->produk_image));

            // Update data dengan gambar baru
            $produk->update([
                'name' => $request->name,
                'deskripsi' => $request->deskripsi,
                'price' => $request->price,
                'produk_image' => $produk_image->hashName(),
            ]);
        } else {
            // Update data tanpa gambar baru
            $produk->update([
                'name' => $request->name,
                'deskripsi' => $request->deskripsi,
                'price' => $request->price,
                
            ]);
        }

        return new produkResource(true, 'Data produk Berhasil Diubah!', $produk);
    }

    /**
     * destroy
     *
     * @param mixed $id
     * @return void
     */
    public function destroy($id)
    {
        $produk = produk::find($id);

        if (!$produk) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // Hapus gambar
        Storage::delete('public/produks/' . basename($produk->produk_image));

        // Hapus data
        $produk->delete();

        return new produkResource(true, 'Data produk Berhasil Dihapus!', null);
    }
}
