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
        $this->middleware(['auth','admin']);
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
        $totalTransaksiBulanan = TransaksiPenjualan::whereBetween('tanggal',[ 
                                $hariIni->startOfMonth()->format('Y-m-d'),
                                $hariIni->endOfMonth()->format('Y-m-d')])->count();

        $omsetBulanan          = TransaksiPenjualan::whereBetween('tanggal',[ 
                                $hariIni->startOfMonth()->format('Y-m-d'),
                                $hariIni->endOfMonth()->format('Y-m-d')])->sum('total_pembayaran');

        $profitBulanan          = SubTransaksiPenjualan::whereBetween('tanggal',[ 
                                $hariIni->startOfMonth()->format('Y-m-d'),
                                $hariIni->endOfMonth()->format('Y-m-d')])->sum('profit');
        // dd($profitBulanan);
        return view('Backend.pages.laporan',compact('headPage','totalTransaksiBulanan','omsetBulanan','profitBulanan'));
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

    public function dataTransaksiJSON(){
        $hariIni = Carbon::now();
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
        return json_encode($jumlahTransaksi);
    }

    public function dataPemasukanJSON(){
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
        $pemasukan = $omsetBulananArray;
        return json_encode($pemasukan);

    }

    public function dataTransaksiTahunanJSON(){
        $hariIni = Carbon::now();
        $month = TransaksiPenjualan::get()->groupBy(function($d){
            return Carbon::parse($d->tanggal)->format('m');
        });

        dd($month);
        $transaksiTahunan = TransaksiPenjualan::whereBetween('tanggal',[ 
            $hariIni->startOfMonth()->format('Y-m-d'),
            $hariIni->endOfMonth()->format('Y-m-d')])
            ->select('tanggal','faktur',TransaksiPenjualan::raw('count(*) as totalTransaksi'))
            ->groupBy($month)->get();

        $transaksiTahunanArray =[];
        foreach($transaksiTahunan as $row){
            $transaksiTahunanArray[] = [
            'bulan'       =>Carbon::createFromFormat('Y-m-d', $row->tanggal)->isoFormat('MMMM Y'),
            'transaksi'     =>$row->totalTransaksi,
            ];
        }
       

        $jumlahTransaksi = $transaksiTahunanArray;
        return json_encode($jumlahTransaksi);
    }

    public function getFilteredData(Request $request, $filter)
    {
        $hariIni = Carbon::now();
        $transaksiBulanan = TransaksiPenjualan::whereBetween('tanggal',[ 
            $hariIni->startOfMonth()->format('Y-m-d'),
            $hariIni->endOfMonth()->format('Y-m-d')])
            ->select('tanggal','faktur',TransaksiPenjualan::raw('count(*) as totalTransaksi'))
            ->groupBy('tanggal')->where('status_transaksi',$filter)->get();

        $transaksiBulananArray =[];
        foreach($transaksiBulanan as $row){
            $transaksiBulananArray[] = [
            'tanggal'       =>Carbon::createFromFormat('Y-m-d', $row->tanggal)->isoFormat('dddd D MMM'),
            'transaksi'     =>$row->totalTransaksi,
            ];
        }
        $data = $transaksiBulananArray;
        return response()->json($data);
    }

    public function laporanTransaksi(){
        $headPage = 'Grafik Laporan Test';
        return view('Backend.pages.laporanTransaksi',compact('headPage'));
    }

    public function testGetData(Request $request,$filter){
        
        $hariIni = Carbon::now();
        // $filter = 'Harian';
        // $filter = 'Mingguan';
        // $filter = 'Bulanan';

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;

        if($filter == 'Harian'){
            // menampilkan data harian dalam 1 minggu
            $transaksiBulanan = TransaksiPenjualan::whereBetween('tanggal',[ 
                $hariIni->startOfWeek()->format('Y-m-d'),
                $hariIni->endOfWeek()->format('Y-m-d')])
                ->select('tanggal as lable','faktur',TransaksiPenjualan::raw('count(*) as totalTransaksi'))
                ->groupBy('tanggal')->get();
        }
        elseif($filter == 'Mingguan'){
            // menampilkan data mingguan dalam 1 bulan
            // Mengambil data dari model berdasarkan bulan dan tahun saat ini
            $transaksiBulanan = TransaksiPenjualan::selectRaw('WEEK(tanggal) - WEEK(DATE_SUB(tanggal, INTERVAL DAYOFMONTH(tanggal) - 1 DAY)) as lable, count(faktur) as totalTransaksi')
                ->whereMonth('tanggal', $month)
                ->whereYear('tanggal', $year)
                ->groupBy('lable')
                ->get();
        }
        elseif($filter == 'HarianDalamBulan'){
            $transaksiBulanan = TransaksiPenjualan::whereBetween('tanggal',[ 
                $hariIni->startOfMonth()->format('Y-m-d'),
                $hariIni->endOfMonth()->format('Y-m-d')])
                ->select('tanggal as lable','faktur',TransaksiPenjualan::raw('count(*) as totalTransaksi'))
                ->groupBy('tanggal')->get();
        }
        elseif($filter == 'Bulanan'){
            $transaksiBulanan = TransaksiPenjualan::selectRaw('YEAR(tanggal) AS tahun, MONTH(tanggal) AS lable,tanggal , COUNT(faktur) AS totalTransaksi')
            ->groupBy('tahun', 'lable')
            ->get();
        }
                
                
        $transaksiBulananArray =[];
            foreach($transaksiBulanan as $row){
                if($filter == 'Harian' or $filter == 'HarianDalamBulan'){
                    $transaksiBulananArray[] = [
                    'lable'     =>Carbon::createFromFormat('Y-m-d', $row->lable)->isoFormat('dddd D MMM'),
                    'value'     =>$row->totalTransaksi,
                    ];
                }
                elseif($filter == 'Mingguan'){
                    $transaksiBulananArray[] = [
                    'lable'     =>'Minggu ke ' . $row->lable .' '. Carbon::now()->isoFormat('MMM'),
                    'value'     =>$row->totalTransaksi,
                    ];
                }
                elseif($filter == 'Bulanan'){
                    $transaksiBulananArray[] = [
                    'lable'     =>Carbon::createFromFormat('Y-m-d', $row->tanggal)->isoFormat('MMM'),
                    'value'     =>$row->totalTransaksi,
                    ];
                }
            }
        $data = $transaksiBulananArray;
        return response()->json($data);
            

    }
}
