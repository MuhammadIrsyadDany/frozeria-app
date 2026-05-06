<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class BarangController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard');
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('barang.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang'  => 'required|string|max:150',
            'kategori_id'  => 'nullable|exists:kategoris,id',
            'satuan'       => 'required|string|max:50',
            'jumlah_stok'  => 'required|integer|min:0',
            'stok_minimum' => 'nullable|integer|min:0',
            'harga_jual'   => 'required|numeric|min:0',
            'harga_beli'   => 'nullable|numeric|min:0',
            'berat_ukuran' => 'nullable|string|max:100',
            'lokasi_simpan' => 'nullable|string|max:100',
            'deskripsi'    => 'nullable|string',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'satuan.required'      => 'Satuan wajib diisi.',
            'jumlah_stok.required' => 'Jumlah stok wajib diisi.',
            'harga_jual.required'  => 'Harga jual wajib diisi.',
            'foto.image'           => 'File harus berupa gambar.',
            'foto.max'             => 'Ukuran foto maksimal 2MB.',
        ]);

        $data = $request->except('foto');

        // Upload foto jika ada
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')
                ->store('foto_barang', 'public');
        }

        Barang::create($data);

        return redirect()->route('dashboard')
            ->with('success', 'Barang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $barang = Barang::with('kategori')->findOrFail($id);
        return view('barang.show', compact('barang'));
    }

    public function edit($id)
    {
        $barang    = Barang::findOrFail($id);
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('barang.edit', compact('barang', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);

        $request->validate([
            'nama_barang'   => 'required|string|max:150',
            'kategori_id'   => 'nullable|exists:kategoris,id',
            'satuan'        => 'required|string|max:50',
            'jumlah_masuk'  => 'nullable|integer|min:0',
            'stok_minimum'  => 'nullable|integer|min:0',
            'harga_jual'    => 'required|numeric|min:0',
            'harga_beli'    => 'nullable|numeric|min:0',
            'berat_ukuran'  => 'nullable|string|max:100',
            'lokasi_simpan' => 'nullable|string|max:100',
            'deskripsi'     => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'nama_barang.required' => 'Nama barang wajib diisi.',
            'satuan.required'      => 'Satuan wajib diisi.',
            'harga_jual.required'  => 'Harga jual wajib diisi.',
            'foto.image'           => 'File harus berupa gambar.',
            'foto.max'             => 'Ukuran foto maksimal 2MB.',
        ]);

        $data = $request->except(['foto', 'jumlah_masuk', '_method', '_token']);

        // Akumulatif stok: tambahkan jumlah masuk ke stok yang ada
        $jumlahMasuk = (int) $request->input('jumlah_masuk', 0);
        $data['jumlah_stok'] = $barang->jumlah_stok + $jumlahMasuk;

        // Upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama
            if ($barang->foto) {
                \Storage::disk('public')->delete($barang->foto);
            }
            $data['foto'] = $request->file('foto')
                ->store('foto_barang', 'public');
        }

        $barang->update($data);

        return redirect()->route('dashboard')
            ->with('success', 'Barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $barang = Barang::findOrFail($id);

        if ($barang->foto) {
            \Storage::disk('public')->delete($barang->foto);
        }

        $barang->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Barang berhasil dihapus.');
    }
}
