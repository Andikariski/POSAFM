<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\TransaksiPenjualan;
use App\Models\SubTransaksiPenjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\DataTables\RiwayatTransaksiPenjualanDataTable;

class RiwayatTransaksiController extends Controller
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
    public function index(RiwayatTransaksiPenjualanDataTable $dataTable)
    {
        $headPage = 'Riwayat Penjualan';
        // $dataTransaksi = TransaksiPenjualan::all();
        // return view('Backend.riwayatTransaksiPenjualan',compact('dataTransaksi','headPage'));
        return $dataTable->render('Backend.pages.riwayatTransaksiPenjualan', compact('headPage'));
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
    public function detailRiwayatTransaksi($id)
    {
        $data = SubTransaksiPenjualan::where('fkdi_faktur',$id)->get();
        // dd($request->all());
        dd($data);
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

    public function detailTransaksi($id){
        $headPage = 'Detail Riwayat Transaksi Penjualan';
        $idDec = Crypt::decrypt($id);
        // dd($totalPembayaran);
        $dataSubTransaksi = SubTransaksiPenjualan::where('fkid_faktur',$idDec)->get();
        $dataTransaksi = TransaksiPenjualan::where('faktur',$idDec)->first();
        $totalPembayaran = SubTransaksiPenjualan::where('fkid_faktur',$idDec)->sum('sub_total');
        return view('Backend.pages.detailRiwayatTransaksiPenjualan',compact('dataSubTransaksi','dataTransaksi','headPage','totalPembayaran'));
    }

    public function hapusRiwayatTransaksi(Request $request){
        $faktur = Crypt::decrypt($request->id);
        TransaksiPenjualan::where('faktur',$faktur)->delete();
        SubTransaksiPenjualan::where('fkid_faktur',$faktur)->delete();
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Riwayat transaksi telah dihapus.',
        ]);
    }
}
