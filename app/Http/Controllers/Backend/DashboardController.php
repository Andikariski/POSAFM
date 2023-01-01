<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\SubTransaksiPenjualan;
use App\Models\TransaksiPenjualan;
use Carbon\Carbon;
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
        $hariIni = Carbon::now();
        $tanggalSekarang     = date('Y-m-d');
        $jumlahPelanggan     = Pelanggan::pluck('id_pelanggan')->count();
        $totalTransaksi      = TransaksiPenjualan::pluck('faktur')->count();
        $Transaksilunas      = TransaksiPenjualan::where('status_transaksi','=','Lunas')->count();
        $TransaksiBelumLunas = TransaksiPenjualan::where('status_transaksi','=','Belum Lunas')->count();
        $omsetHariIni        = TransaksiPenjualan::where('tanggal','=',$tanggalSekarang)->pluck('total_pembayaran')->sum();
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
        $profitHariIni = SubTransaksiPenjualan::whereIn('fkid_faktur',$fakturArray)->where('tanggal','=',$tanggalSekarang)->sum('profit');

        //Omset mingguan
        $omsetMingguan = TransaksiPenjualan::whereBetween('tbl_transaksi_penjualan.tanggal',[
                            $hariIni->startOfWeek()->format('Y-m-d'),
                            $hariIni->endOfWeek()->format('Y-m-d')])
                            ->select('tbl_transaksi_penjualan.tanggal','faktur',SubTransaksiPenjualan::raw('sum(sub_total) as totalOmset'),SubTransaksiPenjualan::raw('sum(profit) as totalProfit'))
                            ->rightJoin('tbl_sub_transaksi_penjualan','tbl_transaksi_penjualan.faktur','=','tbl_sub_transaksi_penjualan.fkid_faktur')
                            ->groupBy('tbl_transaksi_penjualan.tanggal')->get();
                            
        // dd($omsetMingguan);
        // Bug di tabel transaksi mengoutputkan 2 faktur yang sub semuanya
        $omsetMingguanArray = [];
        foreach($omsetMingguan as $row){
                $omsetMingguanArray[] = [ 
                    'tanggal'   =>Carbon::createFromFormat('Y-m-d', $row->tanggal)->isoFormat('dddd D MMM'),
                    'omset'     =>$row->totalOmset,
                    'profit'    =>$row->totalProfit
            ];
        }
        $dataPemasukan = $omsetMingguanArray;
        // dd($dataPemasukan);
        // Compact View
        return view('Backend.pages.dashboard', 
                compact('jumlahPelanggan',
                        'totalTransaksi',
                        'Transaksilunas',
                        'TransaksiBelumLunas',
                        'omsetHariIni',
                        'profitHariIni',
                        'produkTerlaris',
                        'dataPemasukan',));
    }

    // ->select('tbl_transaksi_penjualan.tanggal','faktur',TransaksiPenjualan::raw('sum(total_pembayaran) as totalOmset'),SubTransaksiPenjualan::raw('sum(profit) as totalProfit'))
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

    public function dataOmsetMingguan(){
          //Omset mingguan
          $hariIni = Carbon::now();
          $omsetMingguan = TransaksiPenjualan::whereBetween('tanggal',[
                              $hariIni->startOfWeek()->format('Y-m-d'),
                              $hariIni->endOfWeek()->format('Y-m-d')])
                              ->select('tanggal',SubTransaksiPenjualan::raw('sum(uang_terbayar) as totalOmset'))
                              ->groupBy('tanggal')->get();
      
                              $omsetMingguanArray = [];
                              foreach($omsetMingguan as $row){
                                      $omsetMingguanArray[] = [
                                          'tanggal'   =>Carbon::createFromFormat('Y-m-d', $row->tanggal)->isoFormat('D MMMM YYYY'),
                                          'omset'     =>$row->totalOmset
                                          // date('D',strtotime($row->tanggal)) => $row->totalOmset,
                                  ];
                              }
                              return json_encode($omsetMingguanArray);
    }
}
