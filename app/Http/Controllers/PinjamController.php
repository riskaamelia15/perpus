<?php

namespace App\Http\Controllers;

use Alert;
use App\Models\anggota;
use App\Models\Buku;
use App\Models\Petugas;
use App\Models\pinjam;
use Illuminate\Http\Request;

class PinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pinjam = Pinjam::all();
        return view('admin.peminjaman.index', compact('pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buku = Buku::all();
        $anggota = Anggota::all();
        $petugas = Petugas::all();

        return view('admin.peminjaman.create', compact('buku', 'anggota', 'petugas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            // 'id_peminjaman' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
            'buku_id' => 'required',
            'jumlah' => 'required|numeric',
            'anggota_id' => 'required',
        ]);

        $pinjam = new Pinjam;
        //   $pinjam->id_peminjaman = $request->id_peminjaman;
        $pinjam->tanggal_pinjam = $request->tanggal_pinjam;
        $pinjam->tanggal_kembali = $request->tanggal_kembali;
        $pinjam->buku_id = $request->buku_id;
        $pinjam->jumlah = $request->jumlah;
        $pinjam->anggota_id = $request->anggota_id;
        $pinjam->save();
        $buku = Buku::findOrFail($request->buku_id = $request->buku_id);
        $buku->stok -= $request->jumlah;
        Alert::success('data Berhasil Ditambahkan');
        $buku->save();
        return redirect()->route('peminjaman.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pinjam = Book::findOrFail($id);
        return view('admin.peminjaman.show', compact('pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buku = Buku::all();
        $anggota = Anggota::all();
        $pinjam = Pinjam::findOrFail($id);
        return view('admin.peminjaman.edit', compact('pinjam', 'buku', 'anggota'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            // 'id_peminjaman' => 'required',
            'tanggal_pinjam' => 'required',
            'tanggal_kembali' => 'required',
            'buku_id' => 'required',
            'anggota_id' => 'required',
        ]);
        $pinjam = Pinjam::findOrFail($id);
        //   $pinjam->id_peminjaman = $request->id_peminjaman;
        $pinjam->tanggal_pinjam = $request->tanggal_pinjam;
        $pinjam->tanggal_kembali = $request->tanggal_kembali;
        $pinjam->buku_id = $request->buku_id;
        $pinjam->anggota_id = $request->anggota_id;
        Alert::success('data Berhasil Diubah');
        $pinjam->save();
        return redirect()->route('peminjaman.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pinjam  $pinjam
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pinjam = pinjam::find($id);
        $buku = Buku::where("id", "=", $pinjam->buku_id)->first();
        $buku->stok += $pinjam->jumlah;
        $pinjam->delete();
        $buku->save();
        alert::success('Mantap', 'Buku berhasil di kembalikan');
        return redirect()->route('peminjaman.index');
    }
}
