<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SubTransaksiPenjualan;
use App\Models\TransaksiPenjualan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LaporanController extends Controller
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
        $headPage = 'Grafik Laporan';
        $hariIni = Carbon::now();
        $omsetBulanan = SubTransaksiPenjualan::whereBetween('tbl_sub_transaksi_penjualan.tanggal',[
                                $hariIni->startOfMonth()->format('Y-m-d'),
                                $hariIni->endOfMonth()->format('Y-m-d')])
                                ->select('tbl_sub_transaksi_penjualan.tanggal',SubTransaksiPenjualan::raw('sum(sub_total) as totalOmset'),SubTransaksiPenjualan::raw('sum(profit) as totalProfit'))
                                ->join('tbl_transaksi_penjualan','tbl_sub_transaksi_penjualan.fkid_faktur','=','tbl_transaksi_penjualan.faktur')
                                ->where('status_transaksi','Lunas')
                                ->groupBy('tbl_sub_transaksi_penjualan.tanggal')->get();
        
        $omsetBulananArray =[];
        foreach($omsetBulanan as $row){
            $omsetBulananArray[] = [
                'tanggal'   =>Carbon::createFromFormat('Y-m-d', $row->tanggal)->isoFormat('dddd D MMM'),
                'omset'     =>$row->totalOmset,
                'profit'    =>$row->totalProfit
            ];
        }
        $yMaxArray = [];
        foreach($omsetBulanan as $row){
                $yMaxArray[] = [ 
                    $row->totalOmset + 50000,
                    $row->totalProfit + 10000,
            ];
        }

        $yMax = max($yMaxArray);
        $yMaxOmset = $yMax[0];
        $yMaxProfit = $yMax[1];

        $yMaxTopOmset = json_encode($yMaxOmset);
        $yMaxTopProfit = json_encode($yMaxProfit);
        $pemasukan = $omsetBulananArray;


        // Get Jumlah Transaksi Bulanan
        $transaksiBulanan = TransaksiPenjualan::whereBetween('tanggal',[ 
                                $hariIni->startOfMonth()->format('Y-m-d'),
                                $hariIni->endOfMonth()->format('Y-m-d')])
                                ->select('tanggal','faktur',TransaksiPenjualan::raw('count(*) as totalTransaksi'))
                                ->groupBy('tanggal')->get();
        
        $transaksiBulananArray =[];
        foreach($transaksiBulanan as $row){
            $transaksiBulananArray[] = [
                'tanggal'       =>Carbon::createFromFormat('Y-m-d', $row->tanggal)->isoFormat('dddd D MMM'),
                'transaksi'     =>$row->totalTransaksi,
            ];
        }
        $jumlahTransaksi = $transaksiBulananArray;
        // dd($jumlahTransaksi);
        
        return view('Backend.pages.laporan',compact(
                    'headPage',
                    'pemasukan',
                    'jumlahTransaksi',
                    'yMaxTopOmset',
                    'yMaxTopProfit'));
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
