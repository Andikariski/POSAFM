<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JenisProduk;
use App\Models\Produk;
use App\Models\TempatProduk;
use App\DataTables\ProdukDataTable;

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
        $headPage           = 'Produk';
        $data               = Produk::all();
        $jenisProduk        = JenisProduk::all();
        $totalDataAsset     = Produk::sum('harga_beli_produk');
        $totalStokProduk    = Produk::sum('stok_produk');
        $totalProduk        = count($data);
        $totalJenisProduk   = count($jenisProduk);

        return $dataTable->render('Backend.pages.produk', compact(
                'data',
                'headPage',
                'jenisProduk',
                'totalProduk',
                'totalJenisProduk',
                'totalDataAsset',
                'totalStokProduk'));
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
        // dd($request->all());
        $hargaJual = str_replace(",","",$request->harga_beli_produk);
        $data = [
            'barcode_produk'    => $request->barcode_produk,
            'nama_produk'       => $request->nama_produk,
            'barcode_produk'    => $request->barcode_produk,
            'stok_produk'       => $request->stok_produk,
            'harga_beli_produk' => str_replace(",","",$request->harga_beli_produk),
            'harga_jual_produk' => str_replace(",","",$request->harga_jual_produk),
            'fkid_tempat_produk'=> $request->fkid_tempat_produk,
            'fkid_jenis_produk' => $request->fkid_jenis_produk,
        ];
        Produk::create($data);
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Produk Telah Ditambahkan',
        ]);
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
        Produk::where('barcode_produk',$id)->update([
                'barcode_produk'    =>$request->barcode_produk,
                'nama_produk'       =>$request->nama_produk,
                'stok_produk'       =>$request->stok_produk,
                'harga_beli_produk' => str_replace(",","",$request->harga_beli_produk),
                'harga_jual_produk' => str_replace(",","",$request->harga_jual_produk),
                'fkid_tempat_produk'=> $request->fkid_tempat_produk,
                'fkid_jenis_produk' => $request->fkid_jenis_produk,
        ]);
        // $data = $request->all();
        // Produk::where('id_produk',$id)->update($data);
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Data Telah Berhasil Diubah.'
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
            'message' => 'Produk Telah Dihapus',
        ]);
    }

    public function showModalProduk(){
        $jenisProduk    = JenisProduk::all();
        $tempatProduk   = TempatProduk::all();
        return view('Backend.modal.modal-produk',['produk'=> new Produk()],compact('jenisProduk','tempatProduk'));
    }

    public function showDetailProduk($id){
        $produk = Produk::where('barcode_produk',$id)->first();
        return view('Backend.modal.modal-produk-detail', compact('produk'));
    }
}
