<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\UserDataTable;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
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
    public function index(UserDataTable $dataTable)
    {
        $headPage = 'Data User';
        // return view('Backend.pages.user',compact('headPage'));
        return $dataTable->render('Backend.pages.user', compact('headPage'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $user = User::all();
        return view('Backend.modal.modal-user', ['User' => new User()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data =[
            'name' => $request->nama_user,
            'email' => $request->email_user,
            'password' => bcrypt($request->password),
            'is_admin' => $request->role,
        ];
        User::insert($data);
        return response()->json([
            'icon'      => 'success',
            'status'    =>  'Berhasil',
            'message'   => 'User berhasil ditambahkan.'
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
        $User = User::where('id',$id)->first();
        return view('Backend.modal.modal-user', compact('User'));

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
        User::where('id',$id)->delete();
        return response()->json([
            'icon' => 'success',
            'status' =>  'Berhasil',
            'message' => 'User berhasil dihapus.'
        ]);
    }

    // public function showModal
}
