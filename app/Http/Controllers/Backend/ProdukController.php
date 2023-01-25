<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisProduk;
use App\Models\Produk;
use App\Models\TempatProduk;
use App\DataTables\ProdukDataTable;
use App\Imports\ImportProduk;
use App\Exports\ExportProduk;
use Maatwebsite\Excel\Facades\Excel;

class ProdukController extends Controller
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
    public function index(ProdukDatatable $dataTable)
    {
        $headPage           = 'Data Produk';
        $data               = Produk::all();
        $jenisProduk        = JenisProduk::all();
        $totalProduk        = count($data);
        $totalJenisProduk   = count($jenisProduk);
        $produkKosong       = Produk::where('stok_produk','=',0)->count(); 
        $stokProdukMenipis  = Produk::where('stok_produk','<',3)->count(); 

        return $dataTable->render('Backend.pages.produk', compact(
                'data',
                'headPage',
                'jenisProduk',
                'totalProduk',
                'totalJenisProduk',
                'produkKosong',
                'stokProdukMenipis'));
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
        $cekProduk = Produk::where('barcode_produk',$request->barcode_produk)->first();
        $hargaJualProduk = str_replace(",","",$request->harga_beli_produk) + str_replace(",","",$request->margin);
        if($cekProduk == null){
            $data = [
                'barcode_produk'    => $request->barcode_produk,
                'nama_produk'       => $request->nama_produk,
                'barcode_produk'    => $request->barcode_produk,
                'stok_produk'       => $request->stok_produk,
                'harga_beli_produk' => str_replace(",","",$request->harga_beli_produk),
                'harga_jual_produk' => $hargaJualProduk,
                'margin'            => str_replace(",","",$request->margin),
                'fkid_tempat_produk'=> $request->fkid_tempat_produk,
                'fkid_jenis_produk' => $request->fkid_jenis_produk,
            ];
            Produk::create($data);
            return response()->json([
                'icon' => 'success',
                'status' =>  'Berhasil',
                'message' => 'Produk telah ditambahkan.',
            ]);
        }
        else{
            return response()->json([
                'icon' => 'error',
                'status' =>  'Gagal',
                'message' => 'Barcode produk telah terdaftar.',
            ]);
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
        $produk = Produk::where('barcode_produk',$id)->first();
        $jenisProduk    = JenisProduk::all();
        $tempatProduk   = TempatProduk::all();
        return view('Backend.modal.modal-produk',compact('produk','jenisProduk','tempatProduk'));
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
        $hargaJualProduk = str_replace(",","",$request->harga_beli_produk) + str_replace(",","",$request->margin);
        Produk::where('barcode_produk',$id)->update([
                'barcode_produk'    =>$request->barcode_produk,
                'nama_produk'       =>$request->nama_produk,
                'stok_produk'       =>$request->stok_produk,
                'harga_beli_produk' => str_replace(",","",$request->harga_beli_produk),
                'harga_jual_produk' => $hargaJualProduk,
                'margin'            => str_replace(",","",$request->margin),
                'fkid_tempat_produk'=> $request->fkid_tempat_produk,
                'fkid_jenis_produk' => $request->fkid_jenis_produk,
        ]);
        // $data = $request->all();
        // Produk::where('id_produk',$id)->update($data);
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Data telah berhasil diubah.'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        Produk::where('barcode_produk',$id)->delete();
        // TempTransaksiPenjualan::where('fkid_barcode_produk',$id)->delete();
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Produk telah dihapus.',
        ]);
    }

    public function showModalProduk(){
        $jenisProduk    = JenisProduk::all();
        $tempatProduk   = TempatProduk::all();
        return view('Backend.modal.modal-produk',['produk'=> new Produk()],compact('jenisProduk','tempatProduk'));
    }

    public function showModalCetakStokProduk(){
        return view('Backend.modal.modal-cetak-stok-produk');
    }

    public function showDetailProduk($id){
        $produk = Produk::where('barcode_produk',$id)->first();
        return view('Backend.modal.modal-produk-detail', compact('produk'));
    }

    public function resetProduk(){
        Produk::truncate();
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Data Produk telah di reset',
        ]);
    }

    public function importFileProduk(Request $request){
        // dd($request->file('file'));
        $file = $request->file('file');
        $namaFile = $file->getClientOriginalName();
        $file->move('FileDataProduk',$namaFile);
        Excel::import(new ImportProduk, public_path('/FileDataProduk/'.$namaFile));
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Import data produk berhasil.',
        ]);

    }

    public function exportFileProduk(){
        return Excel::download(new ExportProduk,'produk.xlsx');
    }
}
