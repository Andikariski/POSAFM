<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AlamatPelanggan;
use App\Models\Pelanggan;
use App\Models\PelangganPLN;
use Illuminate\Http\Request;
use App\DataTables\PelangganDataTable;
use App\DataTables\PelangganPLNDataTable;


class PelangganController extends Controller
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
    public function index(PelangganDataTable $dataTable)
    {
        $headPage = 'Pelanggan Toko';
        $data = Pelanggan::all();
        $alamatPelanggan = AlamatPelanggan::all();

        // return view('Backend.pelanggan', compact('headPage', 'data', 'alamatPelanggan'));

        return $dataTable->render('Backend.pelanggan', compact('headPage', 'data', 'alamatPelanggan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $alamat = AlamatPelanggan::all();
        return view('Backend.modal.modal-pelanggan', ['pelangganToko' => new Pelanggan()], compact('alamat'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pelanggan::create($request->all());
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Data Telah Berhasil Disimpan.'
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
        $pelangganToko = Pelanggan::where('id_pelanggan',$id)->first();
        $alamat = AlamatPelanggan::all();
        return view('Backend.modal.modal-pelanggan',compact('pelangganToko','alamat'));
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
        Pelanggan::where('id_pelanggan',$id)->update([
                'nama_pelanggan'        => $request->nama_pelanggan,
                'nomer_hp'              => $request->nomer_hp,
                'fkid_alamat_pelanggan' => $request->fkid_alamat_pelanggan,
                'deskripsi'             => $request->deskripsi
        ]);
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Data Telah Berhasil Diubah.'
        ]);
    }

    public function detailPelangganToko(Request $request, $id)
    {
        $pelangganToko = Pelanggan::where('id_pelanggan',$id)->first();
        return view('Backend.modal.modal-pelanggan-detail',compact('pelangganToko'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function hapusDataPelanggan($id)
    {
        Pelanggan::where('id_pelanggan',$id)->delete();
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Pelanggan Telah Dihapus',
            // 'message' => ' "'.$pelanggan->nama_pelanggan.'" '.'Telah Dihapus Dari Daftar Pelanggan Toko.',
        ]);
    }

    public function dataAlamat()
    {
        $headPage = 'Data Alamat';
        $data = AlamatPelanggan::all();
        return view('Backend.alamatPelanggan', compact('data', 'headPage'));
    }

    public function simpanDataAlamat(Request $request)
    {
        $data = [
            'alamat_detail' => $request->alamat_detail
        ];

        AlamatPelanggan::create($data);
        return redirect('dataAlamat')->with('alert-success', 'Data Berhasil Disimpan');
    }

    public function updateDataAlamat(Request $request, $id)
    {
        $data       = $request->all();
        $ubahData   = AlamatPelanggan::findOrFail($id);
        $ubahData->update($data);
        return redirect('dataAlamat')->with('alert-success', 'Data Berhasil Diubah');
    }

    public function destroyAlamat($id)
    {
        AlamatPelanggan::destroy($id);
        return redirect('dataAlamat')->with('alert-success', 'Data Berhasil Dihapus');

        // return response()->json([
        //     'icon' => 'success',
        //     'massage' => 'Selamat data anda berhasil disimpan',
        //     'status' => 'Berhasil',

        // ]);
    }

    //Menu Utama Pelanggan PLN
    public function showIdPLN(PelangganPLNDataTable $dataTable){
        $headPage = 'Pelanggan PLN';
        // $data = Pelanggan::all();
        $alamatPelanggan = AlamatPelanggan::all();

        $pelangganTerdaftar = PelangganPLN::select('fkid_pelanggan')->groupBy('fkid_pelanggan')->get();
        $data =[];
        foreach ($pelangganTerdaftar as $item) {
            $data[] = $item->fkid_pelanggan;
        }
        $dataPelanggan = Pelanggan::whereNotIn('id_pelanggan', $data)->get();
        // dd($dataPelanggan);
        return $dataTable->render('Backend.pelangganPLN', compact('headPage', 'dataPelanggan', 'alamatPelanggan'));
    }

    public function storePelangganPLN(Request $request){

        // dd($request->all());
        $cekPelangganPLN = PelangganPLN::where('nomer_pelanggan_pln',$request->nomer_pelanggan_pln)->first();
         if (!$cekPelangganPLN == null) {
            return response()->json([
                'icon' => 'error',
                'status' =>  'Gagal',
                'message' => 'ID PLN Telah Terdaftar Dengan Nama ' . '"'. $cekPelangganPLN->nama->nama_pelanggan.'"',
            ]);
        }
        
        PelangganPLN::create($request->all());
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Data Telah Berhasil Disimpan.'
        ]);
    }

    
    public function destroyPelangganPLN($id)
    {
        PelangganPLN::where('id_pelanggan_pln',$id)->delete();
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Pelanggan PLN Telah Dihapus',
        ]);
    }

    // Modal Get Data Ubah pelanggan PLN
    public function showModalUbahDataPelangganPLN($id){
        $dataPelangganPLN = PelangganPLN::where('id_pelanggan_pln',$id)->first();
        return view('Backend.modal.modal-pelanggan-PLN', compact('dataPelangganPLN'));
    }

    //Modal Show detail pelanggan PLN
    public function showModalDetailDataPelangganPLN($id){
        $dataPelangganPLN = PelangganPLN::where('id_pelanggan_pln',$id)->first();
        return view('Backend.modal.modal-pelanggan-PLN-detail', compact('dataPelangganPLN'));
    }
    
    // Store Ubah Data Pelanggan PLN
    public function ubahDataPelangganPLN(Request $request, $id){
        PelangganPLN::where('id_pelanggan_pln',$id)->update([
            'nomer_pelanggan_pln' => $request->nomer_pelanggan_pln
        ]);
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Data Telah Berhasil Diubah.'
        ]);
        
        return;
    }

    public function getDataPelanggan(){
        $dataPelanggan = Pelanggan::all();
        $data = array();
        foreach($dataPelanggan as $d){
            $data[]= array("id"=>$d->id,"nama_pelanggan"=>$d->nama_pelanggan);
        }
        echo json_encode($data);
    }
}
