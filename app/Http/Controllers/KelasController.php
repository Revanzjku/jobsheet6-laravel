<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->search;
        $sort = request()->sort;
        
        $query = Kelas::with('siswas');

        if ($search) {
            $query->where('nama_kelas', 'like', "%{$search}%");
        }

        switch ($sort) {
            case 'nama_asc':
                $query->orderBy('nama_kelas', 'asc');
                break;
            case 'nama_desc':
                $query->orderBy('nama_kelas', 'desc');
                break;
            case 'terbaru':
                $query->latest('created_at');
                break;
            case 'terlama':
                $query->oldest('created_at');
                break;
            default:
                $query->oldest('created_at'); 
                break;
        }

        $kelas = $query->paginate(5)->appends(request()->query());

        session(['previous_url' => request()->fullUrl()]);

        return view('admin.kelas.index', compact('kelas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|unique:kelas,nama_kelas'
        ], [
            'nama_kelas.required' => 'Nama kelas harus diisi.',
            'nama_kelas.string' => 'Nama kelas harus berupa teks.',
            'nama_kelas.unique' => 'Nama kelas ini sudah digunakan. Silakan pilih nama kelas yang lain.'
        ]);

        Kelas::create(['nama_kelas' => $request->nama_kelas]);

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelas $kelas)
    {
        return view('admin.kelas.create', compact('kelas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|unique:kelas,nama_kelas,' .$kelas->id,
        ], [
            'nama_kelas.required' => 'Nama kelas harus diisi.',
            'nama_kelas.string' => 'Nama kelas harus berupa teks.',
            'nama_kelas.unique' => 'Nama kelas ini sudah digunakan. Silakan pilih nama kelas yang lain.'
        ]);

        $kelas->update(['nama_kelas' => $request->nama_kelas]);

        return redirect(session('previous_url', route('kelas.index')))->with('success', 'Data kelas berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelas $kelas)
    {
        if($kelas->siswas()->count() > 0)
        {
            return redirect()->route('kelas.index')->with('error', 'Kelas tidak dapat dihapus karena masih diisi oleh siswa!');
        }

        $kelas->delete();

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }
}
