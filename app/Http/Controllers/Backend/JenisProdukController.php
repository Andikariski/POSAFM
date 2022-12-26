<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\JenisProduk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\DataTables\JenisProdukDataTable as DataTablesJenisProdukDataTable;

class JenisProdukController extends Controller
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
    public function index(DataTablesJenisProdukDataTable $dataTable)
    {
        $headPage = 'Jenis Produk';
        return $dataTable->render('Backend.pages.jenisProduk', compact('headPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('Backend.modal.modal-jenisProduk', ['jenisProduk' => new JenisProduk()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        JenisProduk::create($request->all());
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Jenis produk telah disimpan.'
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
        // dd($id);
        $jenisProduk = JenisProduk::where('id_jenis_produk',$id)->first();
        // dd($jenisProduk);
        return view('Backend.modal.modal-jenisProduk', compact('jenisProduk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, JenisProduk $jenisProduk)
    {
        JenisProduk::where('id_jenis_produk',$id)->update([
            'kategori_produk' => $request->kategori_produk
        ]);

        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Data berhasil diubah.'
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
        // JenisProduk::destroy($id);
        JenisProduk::where('id_jenis_produk',$id)->delete();
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'Data berhasil dihapus.'
        ]);
    }
}
