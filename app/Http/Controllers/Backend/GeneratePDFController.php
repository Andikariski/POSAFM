<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\TransaksiPenjualan;
// use Barryvdh\DomPDF\PDF as PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Dflydev\DotAccessData\Data;

class GeneratePDFController extends Controller
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
        //
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

    public function generatePDFPelanggan(){
        $title  = 'Cetak PDF';
        $header = 'Data Pelanggan Andika Maros';
        $dataPelanggan = Pelanggan::orderBy('nama_pelanggan','ASC')->get();
        $pdf = PDF::loadView('Backend.pdf.PDFpelanggan',['data'=>$dataPelanggan,'title'=>$title,'header'=>$header]);
        return $pdf->stream();
    }
    
    public function generatePDFProduk(){
        $title  = 'Cetak PDF';
        $header = 'Data Produk Andika Maros';
        $data = Produk::orderBy('nama_produk','ASC')->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Backend.pdf.PDFproduk',['data'=>$data,'title'=>$title,'header'=>$header])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
    
    public function generatePDFstokProduk(Request $request){
        $title = 'Cetak PDF';
        $header  = 'Stok Produk Kurang Dari: '. $request->stok;
        $data = Produk::where('stok_produk','<=',$request->stok)->orderBy('nama_produk','ASC')->get();
        $pdf = PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadView('Backend.pdf.PDFstokProduk',['data'=>$data,'title'=>$title,'header'=>$header])->setPaper('a4', 'portrait');
        return $pdf->stream();

    }
}
