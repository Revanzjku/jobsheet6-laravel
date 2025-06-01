<?php

namespace App\Http\Controllers;

use App\Http\Requests\SiswaRequest;
use App\Models\Aktivitas;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $search = request()->search;
        $sort = request()->sort;
        
        $query = Siswa::with('kelas');

        if ($search) {
            $query->where('nama_siswa', 'like', "%{$search}%")
                    ->orWhere('jk', 'like', "%{$search}%")
                    ->orWhereHas('kelas', function($q) use ($search) {
                        $q->where('nama_kelas', 'like', "%{$search}%");
                    });
        }

        switch ($sort) {
            case 'nama_asc':
                $query->orderBy('nama_siswa', 'asc');
                break;
            case 'nama_desc':
                $query->orderBy('nama_siswa', 'desc');
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

        $siswa = $query->paginate(10)->appends(request()->query());

        session(['previous_url' => request()->fullUrl()]);

        return view('admin.siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelas = Kelas::all();

        return view('admin.siswa.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SiswaRequest $request)
    {
        Siswa::create($request->all());

        Aktivitas::create(['detail' => 'Siswa baru ditambahkan']);

        return redirect()->route('siswa.index')->with('success', 'Siswa baru berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Siswa $siswa)
    {
        $kelas = Kelas::all();

        return view('admin.siswa.create', compact('kelas', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SiswaRequest $request, Siswa $siswa)
    {
        $siswa->update($request->all());
        
        return redirect(session('previous_url', route('siswa.index')))->with('success', 'Data siswa berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}
