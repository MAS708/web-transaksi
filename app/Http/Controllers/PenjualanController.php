<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\PenjualanHeader;
use App\Models\PenjualanHeaderDetail;
use App\Models\Promo;
use Illuminate\Http\Request;

class PenjualanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['penjualans'] = PenjualanHeader::all();
        return view('penjualan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['barangs'] = MasterBarang::all();
        $data['promos'] = Promo::all();
        return view('penjualan.create', $data);
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
            'no_transaksi' => 'required|unique:penjualan_header',
        ],
        [
            'no_transaksi.unique' => 'Nomor Transaksi telah digunakan!'
        ]
        );
        $penjualan = PenjualanHeader::create([
            "no_transaksi" => $request->no_transaksi,
            "tgl_transaksi" => $request->tgl_transaksi,
            "customer" => $request->customer,
            "total_bayar" => str_replace('.', '', $request->total_bayar),
            "ppn" => str_replace('.', '', $request->ppn),
            "grand_total" => str_replace('.', '', $request->grand_total),
        ]);
        foreach ($request->kode_barang_id as $key => $value) {
            if ($value != null) {
                $penjualan_detail = PenjualanHeaderDetail::create([
                    "no_transaksi_id" => $request->no_transaksi,
                    "kode_barang_id" => $request->kode_barang_id[$key],
                    "qty" => $request->qty[$key],
                    "harga" => str_replace('.', '', $request->harga[$key]),
                    "kode_promo_id" => $request->kode_promo_id[$key],
                    "discount" => str_replace('.', '', $request->discount[$key]),
                    "subtotal" => str_replace('.', '', $request->subtotal[$key]),
                ]);
            }
        }
        if($penjualan){
            return redirect('/penjualan')->with('success', 'Data penjualan telah disimpan!');
        } else {
            return redirect('/penjualan')->with('error', 'Data penjualan gagal disimpan!');
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
        $data['penjualan'] = PenjualanHeader::find($id);
        $data['penjualan_details'] = PenjualanHeaderDetail::with(['master_barang', 'promo'])->where('no_transaksi_id', $data['penjualan']->no_transaksi)->get();
        return view('penjualan.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $penjualan = PenjualanHeader::find($id);
        $penjualan_details = PenjualanHeaderDetail::with(['master_barang', 'promo'])->where('no_transaksi_id', $penjualan->no_transaksi)->get();
        if (!$penjualan_details->isEmpty()){
            foreach ($penjualan_details as $penjualan_detail) {
                $penjualan_detail->delete();
            }
        }
        $penjualan->delete();
        return redirect('/penjualan')->with('success', 'Data penjualan telah dihapus!');
    }
}
