<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TempTransaksiPenjualan;
use App\DataTables\TempTransaksiDataTable;
use App\Models\Produk;
use App\Models\Pelanggan;
use App\Models\TransaksiPenjualan;
use App\Models\SubTransaksiPenjualan;


class TransaksiController extends Controller
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

    public function transaksiPenjualan(TempTransaksiDataTable $dataTable){
        $headPage = 'Transaksi Penjualan';
        $DataProduk = Produk::all();
        $tempPenjualan = TempTransaksiPenjualan::all();
        $totalBelanja = TempTransaksiPenjualan::pluck('sub_total')->sum();
        $totalProdukTerpilih = TempTransaksiPenjualan::count();
        $faktur = $this->buatFaktur();
        $pelanggan = Pelanggan::all();
        return $dataTable->render('Backend.pages.penjualan',compact('headPage','DataProduk','tempPenjualan','totalBelanja','totalProdukTerpilih','faktur','pelanggan'));
       

    }

    public function addProdukTempTransaksi(Request $request){

        // dd($request->all());
      
        $cekBarcodeProduk = Produk::where('barcode_produk',$request->fkid_barcode_produk)->first();
        $cekProdukTemp = TempTransaksiPenjualan::where('fkid_barcode_produk',$request->fkid_barcode_produk)->first();
        $getProduk = Produk::where('barcode_produk',$request->fkid_barcode_produk)->first();
        
        // dd($cekProdukTemp['profit']);
        // dd($getProduk['margin']* $request->jumlah_produk);
        if($cekBarcodeProduk == null){
            return response()->json([
                'aksi' => 'cekproduk',
                'icon' => 'error',
                'status' => 'Gagal',
                'message' =>  'Produk tidak ditemukan.',
            ]); 
        }

        if($cekProdukTemp == null){
            if($cekBarcodeProduk['stok_produk'] >= $request->jumlah_produk){
            $data=[
                'fkid_barcode_produk' => $request->fkid_barcode_produk,
                'nama_produk'         => $getProduk->nama_produk,
                'harga_satuan'        => $getProduk->harga_jual_produk,
                'fkid_faktur'         => $request->faktur,
                'jumlah_produk'       => $request->jumlah_produk,
                'sub_total'           => $getProduk['harga_jual_produk'] * $request->jumlah_produk,
                'profit'              => $getProduk['margin'] * $request->jumlah_produk,
                'tanggal'             => $request->tanggal,
            ];
            TempTransaksiPenjualan::insert($data);
            return response()->json([
                'aksi' => 'tambah',
                'icon' => 'success',
                'status' =>  'Berhasil',
                'message' => 'Produk telah ditambahkan.',
            ]);
            }else{
                return response()->json([
                    'aksi' => 'cekstok',
                    'icon' => 'warning',
                    'status' =>  'Gagal',
                    'message' => 'Stok produk kosong.',
                ]);
            }
        }
        else{
            if($cekBarcodeProduk['stok_produk'] >= $cekProdukTemp['jumlah_produk']+$request->jumlah_produk){
            if($cekProdukTemp){
                $addJumlahProduk = $cekProdukTemp['jumlah_produk'] + $request->jumlah_produk;
                $cekProdukTemp->update([
                    'jumlah_produk' => $addJumlahProduk,
                    'sub_total'     => $getProduk['harga_jual_produk'] * $addJumlahProduk,
                    'profit'        => $cekProdukTemp['profit'] + $getProduk['margin']
                ]);
                return response()->json([
                    'aksi' => 'update',
                    'icon' => 'success',
                    'status' =>  'Berhasil',
                    'message' => 'Jumlah produk berhasil ditambah.',
                ]);
            }
            else{
                $data=[
                    'fkid_barcode_produk'   => $request->fkid_barcode_produk,
                    'nama_produk'           => $getProduk->nama_produk,
                    'harga_satuan'          => $getProduk->harga_jual_produk,
                    'fkid_faktur'           => $request->faktur,
                    'jumlah_produk'         => $request->jumlah_produk,
                    'sub_total'             => $getProduk['harga_jual_produk'] * $request->jumlah_produk,
                    'profit'                => $getProduk['margin'] * $request->jumlah_produk,
                    'tanggal'               => $request->tanggal,
                ];
                TempTransaksiPenjualan::insert($data);
                return response()->json([
                    'aksi' => 'tambah',
                    'icon' => 'success',
                    'status' =>  'Berhasil',
                    'message' => 'Produk telah ditambahkan.',
                ]);
            }
        }
        else{
            return response()->json([
                'aksi' => 'cekstok',
                'icon' => 'warning',
                'status' =>  'Gagal',
                'message' => 'Stok produk tidak mencukupi.',
            ]);
        }
    }
   
}

    public function resetTransaksi(){
        TempTransaksiPenjualan::truncate();
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Transaksi telah di reset',
        ]);
    }

    public function buatFaktur(){
        $tgl = date('Y-m-d');
        $query = TransaksiPenjualan::where('tanggal','=',$tgl)->max('faktur');
        $lastNomorUrut = substr($query,-3);
        $nextNomorUrut = intval($lastNomorUrut) + 1;
        $faktur = 'FAF-' . date('dm/y',strtotime($tgl)).'/'.sprintf('%03s',$nextNomorUrut);
        return $faktur;
    }

    public function hapusItemTransaksi(Request $request){
        TempTransaksiPenjualan::where('id_temp_transaksi_penjualan',$request->id)->delete();
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Field berhasil di hapus',
        ]);
    }
    
    public function getDataProduk(Request $request){
            $search = $request->search;
            
            if($search == ''){
                $dataProduk = Produk::orderby('nama_produk','asc')->select('barcode_produk','nama_produk')->limit(5)->get();
            }
            else{
                $dataProduk = Produk::orderby('nama_produk','asc')->select('barcode_produk','nama_produk')->where('nama_produk','like','%'.$search.'%')->limit(5)->get();
            }

            $response = array();
            foreach($dataProduk as $produk){
                $response[] = array(
                    "id" => $produk->barcode_produk,
                    "text" => strtoupper($produk->nama_produk)
                );
            }
            return response()->json($response);
    }
    
    public function showModalPembayarn(Request $request){
        $totalBayar = $request->totalBayar;
        $faktur     = $request->faktur;
        $pelanggan  = $request->fkid_pelanggan;
        $kasir      = $request->user;
        $tanggal    = $request->tanggal;

        $cekData = TempTransaksiPenjualan::where('fkid_faktur',$request->faktur)->first();
        if($cekData != null){
            return view('Backend.modal.modal-transaksi-pembayaran',compact('totalBayar','pelanggan','kasir','tanggal','faktur'));
        }
        else{
            return response()->json([
                'icon' => 'warning',
                'status' =>  'Gagal',
                'message' => 'Belum ada produk yang dipilih',
            ]);
        }
    }
    
    public function simpanTransaksi(Request $request){

        $uangTerbayar       = str_replace(",","",$request->uang_terbayar);
        $totalPembayaran    = str_replace(",","",$request->total_pembayaran);
        
        if($uangTerbayar >= $totalPembayaran){
            $status_transaksi = 'Lunas';
        }else{
            $status_transaksi = 'Belum Lunas';
        }
        $dataCreate = [
            'faktur'            => $request->faktur,
            'fkid_pelanggan'    => $request->fkid_pelanggan,
            'fkid_user'         => $request->fkid_user,
            'total_pembayaran'  => $totalPembayaran,
            'uang_terbayar'     => $uangTerbayar,
            'status_transaksi'  => $status_transaksi,
            'profit'            => 'test',
            'tanggal'           => $request->tanggal,
        ];
        TransaksiPenjualan::create($dataCreate);
        
        //Insert ke table sub penjualan dari TEMP Penjualan
        $getData = TempTransaksiPenjualan::where('fkid_faktur',$request->faktur)->get();
        $fieldTabelSubPenjualan = [];
        foreach($getData as $row){
            $fieldTabelSubPenjualan[] = [
                'fkid_barcode_produk' => $row['fkid_barcode_produk'],
                'nama_produk'         => $row['nama_produk'],
                'harga_satuan'        => $row['harga_satuan'],
                'fkid_faktur'         => $row['fkid_faktur'],
                'jumlah_produk'       => $row['jumlah_produk'],
                'sub_total'           => $row['sub_total'],
                'profit'              => $row['profit'],
                'tanggal'             => $row['tanggal'],
            ];
        }
        
        // PROSES UPDATE STOK PRODUK
        foreach($fieldTabelSubPenjualan as $row){
            $stok = Produk::where('barcode_produk',$row['fkid_barcode_produk'])->first();
                Produk::where('barcode_produk',$row['fkid_barcode_produk'])->update([
                    'stok_produk' => $stok['stok_produk'] - $row['jumlah_produk'],
                ]);
            }
            
            foreach ($fieldTabelSubPenjualan as $data) {
                SubTransaksiPenjualan::create($data);
            }
            
            //Hapus semua data dalam TEMP Penjualan
            TempTransaksiPenjualan::truncate();
            return response()->json([
                'icon' => 'success',
                'status' =>  'Berhasil',
                'message' => 'Transaksi telah selesai.',
            ]);
        }
        
        public function showModalTambahJumlah(Request $request){
            $dataTemp = TempTransaksiPenjualan::where('id_temp_transaksi_penjualan',$request->id)->first();
            return view('Backend.modal.modal-transaksi-tambahJumlah',compact('dataTemp'));
        }

        public function tambahJumlahProduk(Request $request){
            $getProduk = TempTransaksiPenjualan::where('id_temp_transaksi_penjualan',$request->id)->first();
            $getHarga  = Produk::where('barcode_produk',$request->fkid_barcode_produk)->first();
            if($getHarga['stok_produk']>=$request->jumlah_produk){
                $getProduk->update([
                    'jumlah_produk' => $request->jumlah_produk,
                    'sub_total'     => $getHarga['harga_jual_produk'] * $request->jumlah_produk,
                    'profit'        => $getHarga['margin'] * $request->jumlah_produk,
                ]);
                return response()->json([
                    'icon' => 'success',
                    'status' =>  'Berhasil',
                    'message' => 'Jumlah produk telah diubah.',
                ]);
            }
            else{
                return response()->json([
                    'icon' => 'error',
                    'status' =>  'Gagal',
                    'message' => 'Gagal, Stok produk tidak mencukupi.',
                ]);
            }
        }
}
