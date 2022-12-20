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
        //  $date = Carbon::now();
        // dd($date);
        $headPage = 'Transaksi Penjualan';
        $DataProduk = Produk::all();
        $tempPenjualan = TempTransaksiPenjualan::all();
        $totalBelanja = TempTransaksiPenjualan::pluck('sub_total')->sum();
        $totalProdukTerpilih = TempTransaksiPenjualan::count();
        $faktur = $this->buatFaktur();
        $pelanggan = Pelanggan::all();
        return $dataTable->render('Backend.penjualan',compact('headPage','DataProduk','tempPenjualan','totalBelanja','totalProdukTerpilih','faktur','pelanggan'));
       

    }

    public function addProdukTempTransaksi(Request $request){
      
        $cekBarcodeProduk = Produk::where('barcode_produk',$request->fkid_barcode_produk)->first();
        $cekProdukTemp = TempTransaksiPenjualan::where('fkid_barcode_produk',$request->fkid_barcode_produk)->first();
        $getHarga = Produk::where('barcode_produk',$request->fkid_barcode_produk)->first();
        
        if($cekBarcodeProduk == null){
            return response()->json([
                'aksi' => 'cekproduk',
                'icon' => 'error',
                'status' =>  'Gagal, Produk Tidak Ditemukan',
                'message' => 'Produk Tidak Ditemukan, Silakan tambahkan produk terlebih dahulu.',
            ]); 
        }

        if($cekProdukTemp == null){
            if($cekBarcodeProduk['stok_produk'] >= $request->jumlah_produk){
            $data=[
                'fkid_barcode_produk' => $request->fkid_barcode_produk,
                'fkid_faktur'         => $request->faktur,
                // 'fkid_pelanggan' => $request->fkid_pelanggan,
                // 'fkid_user' => $request->fkid_user,
                'jumlah_produk' => $request->jumlah_produk,
                'sub_total' => $getHarga['harga_jual_produk'] * $request->jumlah_produk,
                'tanggal' => $request->tanggal,
            ];
            TempTransaksiPenjualan::insert($data);
            return response()->json([
                'aksi' => 'tambah',
                'icon' => 'success',
                'status' =>  'Berhasil Menambahkan Produk',
                'message' => 'Produk Telah Ditambahkan',
            ]);
            }else{
                return response()->json([
                    'aksi' => 'cekstok',
                    'icon' => 'warning',
                    'status' =>  'Stok Produk Sedang Kosong..!!',
                    'message' => 'Stok Produk Kosong',
                ]);
            }
        }
        else{
            // dd($cekBarcodeProduk['stok_produk']);
            if($cekBarcodeProduk['stok_produk'] >= $cekProdukTemp['jumlah_produk']+$request->jumlah_produk){
            if($cekProdukTemp){
                $addJumlahProduk = $cekProdukTemp['jumlah_produk'] + $request->jumlah_produk;
                $cekProdukTemp->update([
                    'jumlah_produk' => $addJumlahProduk,
                    'sub_total' => $getHarga['harga_jual_produk'] * $addJumlahProduk,
                ]);
                return response()->json([
                    'aksi' => 'update',
                    'icon' => 'success',
                    'status' =>  'Jumlah Produk Berhasil ditambah',
                    'message' => 'Jumlah Produk Berhasil ditambah',
                ]);
            }
            else{
                $data=[
                    'fkid_barcode_produk' => $request->fkid_barcode_produk,
                    'fkid_faktur'         => $request->faktur,
                    // 'fkid_pelanggan' => $request->fkid_pelanggan,
                    // 'fkid_user' => $request->fkid_user,
                    'jumlah_produk' => $request->jumlah_produk,
                    'sub_total' => $getHarga['harga_jual_produk'] * $request->jumlah_produk,
                    'tanggal' => $request->tanggal,
                ];
                TempTransaksiPenjualan::insert($data);
                return response()->json([
                    'aksi' => 'tambah',
                    'icon' => 'success',
                    'status' =>  'Berhasil Menambahkan Produk',
                    'message' => 'Produk Telah Ditambahkan',
                ]);
                
            }
        }
        else{
            return response()->json([
                'aksi' => 'cekstok',
                'icon' => 'warning',
                'status' =>  'Gagal, Stok Produk Tidak Mencukupi',
                'message' => 'Stok Produk Tidak Cukup',
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
        $faktur = 'AFM-' . date('dm/y',strtotime($tgl)).'/'.sprintf('%03s',$nextNomorUrut);
        return $faktur;
    }

    public function hapusItemTransaksi(Request $request){
        // dd($request->id);
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
                    "text" => $produk->nama_produk
                );
            }
            return response()->json($response);
    }
    
    public function showModalPembayarn(Request $request){
        // dd($request->all());
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
                'status' =>  'Pembayaran Gagal',
                'message' => 'Belum ada produk yang dipilih',
            ]);
        }
    }
    
    public function simpanTransaksi(Request $request){
        // dd($request->all());
        // $dataCreate = $request->all();
        $dataCreate = [
            'faktur'            => $request->faktur,
            'fkid_pelanggan'    => $request->fkid_pelanggan,
            'fkid_user'         => $request->fkid_user,
            'total_pembayaran'  => str_replace(",","",$request->total_pembayaran),
            'uang_terbayar'     => str_replace(",","",$request->uang_terbayar),
            'tanggal'           => $request->tanggal,
        ];
        TransaksiPenjualan::create($dataCreate);
        
        //Insert ke table sub penjualan dari TEMP Penjualan
        $getData = TempTransaksiPenjualan::where('fkid_faktur',$request->faktur)->get();
        $fieldTabelSubPenjualan = [];
        foreach($getData as $row){
            $fieldTabelSubPenjualan[] = [
                'fkid_barcode_produk' => $row['fkid_barcode_produk'],
                'fkid_faktur'         => $row['fkid_faktur'],
                'jumlah_produk'       => $row['jumlah_produk'],
                'sub_total'           => $row['sub_total'],
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
                'message' => 'Transaksi Telah Selesai',
            ]);
        }
        
        public function showModalTambahJumlah(Request $request){
            // dd($request->id);
            $dataTemp = TempTransaksiPenjualan::where('id_temp_transaksi_penjualan',$request->id)->first();
            return view('Backend.modal.modal-transaksi-tambahJumlah',compact('dataTemp'));
        }

        public function tambahJumlahProduk(Request $request){
            // dd($request->all());
            $getProduk = TempTransaksiPenjualan::where('id_temp_transaksi_penjualan',$request->id)->first();
            $getHarga  = Produk::where('barcode_produk',$request->fkid_barcode_produk)->first();
            $getProduk->update([
                'jumlah_produk' => $request->jumlah_produk,
                'sub_total' => $getHarga['harga_jual_produk'] * $request->jumlah_produk
            ]);
            return response()->json([
                'icon' => 'success',
                'status' =>  'Berhasil',
                'message' => 'Produk Telah Ditamh',
            ]);
        }
}
