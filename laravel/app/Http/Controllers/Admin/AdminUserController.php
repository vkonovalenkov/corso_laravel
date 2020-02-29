<?php

namespace LaraCourse\Http\Controllers\Admin;

use Illuminate\Http\Request;
use LaraCourse\Http\Controllers\Controller;
use LaraCourse\Models\User;
use DataTables;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::orderBy('name')->get();
        //return view('admin/users',compact('users'));
        return view('admin/users');
    }
    private function getUsersButtons($id){
        $buttonEdit = '<a href="'.route('users.edit',['id'=>$id]).'" id="edit-'.$id.'" class="btn btn-sm btn-primary">
                <i class="fa fa-pencil-square-o"></i></a>&nbsp;';
        $buttonDelete = '<a href="'.route('users.destroy',['id'=>$id]).'" id="delete-'.$id.'" class="btn btn-sm btn-danger">
                <i class="fa fa-trash-o"></i></a>&nbsp;';
        $buttonForceDelete = '<a href="'.route('users.destroy',['id'=>$id]).'?hard=1" id="forcedelete-'.$id.'" class="btn btn-sm btn-danger">
                <i class="fa fa-minus-square-o"></i></a>';
        return $buttonEdit.$buttonDelete.$buttonForceDelete;
    }

    public function getUsers(){

        $users = User::select(['id','name','email','role','created_at','deleted_at'])->orderBy('name')->get();
        $result = DataTables::of($users)
            ->addColumn('action', function ($user) {
                return $this->getUsersButtons($user->id);
            })
            ->make(true);
        return $result;
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
        return "form";
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
}
