<?php

namespace App\Http\Controllers;

use App\Models\MasterBarang;
use App\Models\Promo;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['promos'] = Promo::all();
        return view('promo.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('promo.create');
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
            'kode_promo' => 'required|unique:promo',
        ],
        [
            'kode_promo.unique' => 'Kode Promo telah digunakan!'
        ]
        );
        $data = $request->except(['_token']);
        $data['potongan'] = str_replace('.', '', $request->potongan);
        $promo = Promo::create($data);
        if($promo){
            return redirect('/promo')->with('success', 'Data promo telah disimpan!');
        } else {
            return redirect('/promo')->with('error', 'Data promo gagal disimpan!');
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
        $data['promo'] = Promo::find($id);
        return view('promo.edit', $data);
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
        $promo = Promo::find($id);
        if ($promo->kode_promo != $request->kode_promo){
            $request->validate([
                'kode_promo' => 'required|unique:promo',
            ],
            [
                'kode_promo.unique' => 'Kode Promo telah digunakan!'
            ]
            );
        }
        $data = $request->except(['_token', '_method']);
        $data['potongan'] = str_replace('.', '', $request->potongan);
        $promo->update($data);
        if($promo){
            return redirect('/promo')->with('success', 'Data promo telah diupdate!');
        } else {
            return redirect('/promo')->with('error', 'Data promo gagal diupdate!');
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
        $promo = Promo::find($id);
        $promo->delete();

        return redirect('/promo')->with('success', 'Data promo telah dihapus!');
    }
}
