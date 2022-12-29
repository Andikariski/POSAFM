<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\SubTransaksiPenjualan;
use App\Models\TransaksiPenjualan;
use Illuminate\Http\Request;

class DashboardController extends Controller
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
    public function index()
    {
        $tanggalSekarang     = date('Y-m-d');
        $jumlahPelanggan     = Pelanggan::pluck('id_pelanggan')->count();
        $totalTransaksi      = TransaksiPenjualan::pluck('faktur')->count();
        $Transaksilunas      = TransaksiPenjualan::where('status_transaksi','=','Lunas')->count();
        $TransaksiBelumLunas = TransaksiPenjualan::where('status_transaksi','=','Belum Lunas')->count();
        $omset               = TransaksiPenjualan::where('tanggal','=',$tanggalSekarang)->pluck('total_pembayaran')->sum();
        $produkTerlaris      = SubTransaksiPenjualan::groupBy('fkid_barcode_produk')
                                                ->select('fkid_barcode_produk',SubTransaksiPenjualan::raw('sum(jumlah_produk) as totalProduk'))
                                                ->orderBy('totalProduk', 'desc')->limit(5)->get();
        // Ambil data faktur Lunas
        $fakturLunas = TransaksiPenjualan::where('status_transaksi','=','Lunas')->get();
        $fakturArray = [];
        foreach($fakturLunas as $row){
            $fakturArray[] = 
            $row->faktur;
        }

        // Ambil profit dari data sub faktur yang lunas
        $getProfit = SubTransaksiPenjualan::whereIn('fkid_faktur',$fakturArray)->get();
        $profitArray = [];
        foreach($getProfit as $row){
            $profitArray[] = 
                $row->produk->profit * $row['jumlah_produk'];
        }
        $profit = array_sum($profitArray);
       
        return view('Backend.pages.dashboard', 
                compact('jumlahPelanggan',
                        'totalTransaksi',
                        'Transaksilunas',
                        'TransaksiBelumLunas',
                        'omset',
                        'profit',
                        'produkTerlaris'));
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
}
