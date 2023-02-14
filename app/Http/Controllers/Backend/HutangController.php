<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\HutangDataTable;
use App\Http\Controllers\Controller;
use App\Models\SubTransaksiPenjualan;
use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;


class HutangController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(HutangDataTable $dataTable)
    {
        $headPage = 'Hutang Pelanggan';
        // $dataTransaksi = TransaksiPenjualan::all();
        // return view('Backend.riwayatTransaksiPenjualan',compact('dataTransaksi','headPage'));
        return $dataTable->render('Backend.pages.hutang', compact('headPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $faktur = decrypt($request->id);
        $dataHutang = TransaksiPenjualan::where('faktur',$faktur)->first();
        // dd($dataHutang);
        return view('Backend.modal.modal-transaksi-pembayaran-hutang',compact('dataHutang'));
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
        //
    }

    public function rekapitulasiHutang($id){
        $headPage = 'Rekapitulasi Hutang Pelanggan';
        $idDec = Crypt::decrypt($id);
     
        $dataSubTransaksi = SubTransaksiPenjualan::where('fkid_faktur',$idDec)->get();
        $dataTransaksi = TransaksiPenjualan::where('faktur',$idDec)->first();
        $totalPembayaran = SubTransaksiPenjualan::where('fkid_faktur',$idDec)->sum('sub_total');
        return view('Backend.pages.rekapitulasiHutang',compact('dataSubTransaksi','dataTransaksi','headPage','totalPembayaran'));
    }
}
