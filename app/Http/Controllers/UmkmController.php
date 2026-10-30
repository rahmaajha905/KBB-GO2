<?php

namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    /**
     * Menampilkan daftar UMKM lokal Kabupaten Bandung Barat.
     */
    public function index(Request $request)
    {
        $query = Umkm::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%")
                  ->orWhere('alamat', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $umkm = $query->latest()->paginate(8)->withQueryString();
        $kategoriList = Umkm::select('kategori')->distinct()->pluck('kategori');

        return view('umkm.index', compact('umkm', 'kategoriList'));
    }

    /**
     * Menampilkan form tambah UMKM.
     */
    public function create()
    {
        return view('umkm.create');
    }

    /**
     * Menyimpan UMKM baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'alamat'      => 'required|string|max:255',
            'gambar'      => 'nullable|string|max:255',
            'gambar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ], [
            'nama.required'      => 'Nama UMKM wajib diisi.',
            'kategori.required'  => 'Kategori UMKM wajib diisi.',
            'deskripsi.required' => 'Deskripsi UMKM wajib diisi.',
            'alamat.required'    => 'Alamat UMKM wajib diisi.',
            'gambar_file.image'  => 'File harus berupa gambar yang valid.',
            'gambar_file.max'    => 'Ukuran gambar maksimal 5MB.',
        ]);

        if ($request->hasFile('gambar_file')) {
            $file = $request->file('gambar_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $validated['gambar'] = $filename;
        } elseif (empty($validated['gambar'])) {
            $validated['gambar'] = 'batik2.png';
        }

        unset($validated['gambar_file']);

        Umkm::create($validated);

        return redirect()->route('umkm.index')
                         ->with('success', 'Data UMKM berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail informasi UMKM.
     */
    public function show(string $id)
    {
        $umkm = Umkm::findOrFail($id);

        return view('umkm.show', compact('umkm'));
    }

    /**
     * Menampilkan form edit UMKM.
     */
    public function edit(string $id)
    {
        $umkm = Umkm::findOrFail($id);

        return view('umkm.edit', compact('umkm'));
    }

    /**
     * Memperbarui data UMKM di database.
     */
    public function update(Request $request, string $id)
    {
        $umkm = Umkm::findOrFail($id);

        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'kategori'    => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'alamat'      => 'required|string|max:255',
            'gambar'      => 'nullable|string|max:255',
            'gambar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ], [
            'nama.required'      => 'Nama UMKM wajib diisi.',
            'kategori.required'  => 'Kategori UMKM wajib diisi.',
            'deskripsi.required' => 'Deskripsi UMKM wajib diisi.',
            'alamat.required'    => 'Alamat UMKM wajib diisi.',
            'gambar_file.image'  => 'File harus berupa gambar yang valid.',
            'gambar_file.max'    => 'Ukuran gambar maksimal 5MB.',
        ]);

        if ($request->hasFile('gambar_file')) {
            $file = $request->file('gambar_file');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $validated['gambar'] = $filename;
        }

        unset($validated['gambar_file']);

        $umkm->update($validated);

        return redirect()->route('umkm.index')
                         ->with('success', 'Data UMKM berhasil diperbarui!');
    }

    /**
     * Menghapus UMKM dari database.
     */
    public function destroy(string $id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();

        return redirect()->route('umkm.index')
                         ->with('success', 'Data UMKM berhasil dihapus!');
    }
}
