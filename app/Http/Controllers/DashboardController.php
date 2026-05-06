<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua kategori untuk dropdown filter
        $kategoris = Kategori::orderBy('nama_kategori')->get();

        // Query barang dengan search & filter
        $query = Barang::with('kategori');

        // Filter by nama (search)
        if ($request->filled('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%');
        }

        // Filter by kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // Pagination 10 per halaman
        $barangs = $query->orderBy('nama_barang')->paginate(10)->withQueryString();

        // Statistik cards
        $totalBarang    = Barang::count();
        $totalKategori  = Kategori::count();
        $stokMenipis    = Barang::where('jumlah_stok', '>', 0)
            ->where('jumlah_stok', '<', 20)->count();
        $stokHabis      = Barang::where('jumlah_stok', 0)->count();

        return view('dashboard.index', compact(
            'barangs',
            'kategoris',
            'totalBarang',
            'totalKategori',
            'stokMenipis',
            'stokHabis'
        ));
    }
}
