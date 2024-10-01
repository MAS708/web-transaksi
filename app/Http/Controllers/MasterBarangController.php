<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use Illuminate\Http\Request;

class MasterBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['barangs'] = MasterBarang::all();
        return view('barang.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang.create');
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
            'kode_barang' => 'required|unique:master_barang',
        ],
        [
            'kode_barang.unique' => 'Kode Barang telah digunakan!'
        ]
        );
        $data = $request->except(['_token']);
        $data['harga'] = str_replace('.', '', $request->harga);
        $barang = MasterBarang::create($data);
        if($barang){
            return redirect('/barang')->with('success', 'Data barang telah disimpan!');
        } else {
            return redirect('/barang')->with('error', 'Data barang gagal disimpan!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['barang'] = MasterBarang::find($id);
        return view('barang.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $barang = MasterBarang::find($id);
        if ($barang->kode_barang != $request->kode_barang){
            $request->validate([
                'kode_barang' => 'required|unique:master_barang',
            ],
            [
                'kode_barang.unique' => 'Kode Barang telah digunakan!'
            ]
            );
        }
        $data = $request->except(['_token', '_method']);
        $data['harga'] = str_replace('.', '', $request->harga);
        $barang->update($data);
        if($barang){
            return redirect('/barang')->with('success', 'Data barang telah diupdate!');
        } else {
            return redirect('/barang')->with('error', 'Data barang gagal diupdate!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = MasterBarang::find($id);
        $barang->delete();

        return redirect('/barang')->with('success', 'Data barang telah dihapus!');
    }
}
