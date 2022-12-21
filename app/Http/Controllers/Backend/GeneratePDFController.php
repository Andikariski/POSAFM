<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\TransaksiPenjualan;
// use Barryvdh\DomPDF\PDF as PDF;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class GeneratePDFController extends Controller
{
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
        $title = 'Data Pelanggan Andika Maros';
        $dataPelanggan = Pelanggan::all();
        $pdf = PDF::loadView('Backend.pdf.PDFpelanggan',['data'=>$dataPelanggan,'title'=>$title]);
        return $pdf->stream();
    }
    
    public function generatePDFProduk(){
        $title = 'Data Produk Andika Maros';
        $data = Produk::all();
        $pdf = PDF::loadView('Backend.pdf.PDFproduk',['data'=>$data,'title'=>$title])->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
