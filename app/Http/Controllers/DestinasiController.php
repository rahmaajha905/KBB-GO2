<?php

namespace App\Http\Controllers;

use App\Models\Destinasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinasiController extends Controller
{
    /**
     * Menampilkan daftar destinasi wisata.
     */
    public function index(Request $request)
    {
        $query = Destinasi::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('lokasi', 'like', "%{$search}%")
                  ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        $destinasi = $query->latest()->paginate(9)->withQueryString();

        return view('destinasi.index', compact('destinasi'));
    }

    /**
     * Menampilkan form tambah destinasi.
     */
    public function create()
    {
        return view('destinasi.create');
    }

    /**
     * Menyimpan destinasi baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'lokasi'      => 'required|string|max:255',
            'harga_tiket' => 'required|numeric|min:0',
            'gambar'      => 'nullable|string|max:255',
            'gambar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ], [
            'nama.required'        => 'Nama destinasi wajib diisi.',
            'deskripsi.required'   => 'Deskripsi destinasi wajib diisi.',
            'lokasi.required'      => 'Lokasi destinasi wajib diisi.',
            'harga_tiket.required' => 'Harga tiket wajib diisi.',
            'harga_tiket.numeric'  => 'Harga tiket harus berupa angka.',
            'gambar_file.image'    => 'File harus berupa gambar yang valid.',
            'gambar_file.mimes'    => 'Format gambar harus JPG, JPEG, PNG, WEBP, atau GIF.',
            'gambar_file.max'      => 'Ukuran gambar maksimal 5MB.',
        ]);

        if ($request->hasFile('gambar_file')) {
            $validated['gambar'] = $request->file('gambar_file')
                ->store('destinasi', 'public');
        } elseif (empty($validated['gambar'])) {
            $validated['gambar'] = 'curug.jpg';
        }

        unset($validated['gambar_file']);

        Destinasi::create($validated);

        return redirect()->route('destinasi.index')
            ->with('success', 'Destinasi wisata berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail destinasi.
     */
    public function show(string $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        return view('destinasi.show', compact('destinasi'));
    }

    /**
     * Menampilkan form edit destinasi.
     */
    public function edit(string $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        return view('destinasi.edit', compact('destinasi'));
    }

    /**
     * Memperbarui data destinasi.
     */
    public function update(Request $request, string $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        $validated = $request->validate([
            'nama'        => 'required|string|max:255',
            'deskripsi'   => 'required|string',
            'lokasi'      => 'required|string|max:255',
            'harga_tiket' => 'required|numeric|min:0',
            'gambar'      => 'nullable|string|max:255',
            'gambar_file' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ], [
            'nama.required'        => 'Nama destinasi wajib diisi.',
            'deskripsi.required'   => 'Deskripsi destinasi wajib diisi.',
            'lokasi.required'      => 'Lokasi destinasi wajib diisi.',
            'harga_tiket.required' => 'Harga tiket wajib diisi.',
            'harga_tiket.numeric'  => 'Harga tiket harus berupa angka.',
            'gambar_file.image'    => 'File harus berupa gambar yang valid.',
            'gambar_file.mimes'    => 'Format gambar harus JPG, JPEG, PNG, WEBP, atau GIF.',
            'gambar_file.max'      => 'Ukuran gambar maksimal 5MB.',
        ]);

        $gambarLama = $destinasi->gambar;
        $gambarBaru = $gambarLama;

        if ($request->hasFile('gambar_file')) {
            $gambarBaru = $request->file('gambar_file')
                ->store('destinasi', 'public');
        } elseif ($request->filled('gambar')) {
            $gambarBaru = $validated['gambar'];
        }

        // Hapus foto lama jika foto benar-benar diganti.
        if (
            $gambarLama !== $gambarBaru &&
            !empty($gambarLama) &&
            Storage::disk('public')->exists($gambarLama)
        ) {
            Storage::disk('public')->delete($gambarLama);
        }

        unset($validated['gambar_file']);
        $validated['gambar'] = $gambarBaru;

        $destinasi->update($validated);

        return redirect()->route('destinasi.index')
            ->with('success', 'Destinasi wisata berhasil diperbarui!');
    }

    /**
     * Menghapus destinasi dan foto dari storage.
     */
    public function destroy(string $id)
    {
        $destinasi = Destinasi::findOrFail($id);

        if (
            !empty($destinasi->gambar) &&
            Storage::disk('public')->exists($destinasi->gambar)
        ) {
            Storage::disk('public')->delete($destinasi->gambar);
        }

        $destinasi->delete();

        return redirect()->route('destinasi.index')
            ->with('success', 'Destinasi wisata berhasil dihapus!');
    }
}
