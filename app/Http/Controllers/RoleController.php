<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use Brian2694\Toastr\Facades\Toastr;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $model = Role::with('users');
        if ($request->ajax()) {
            return DataTables::eloquent($model)
                ->addIndexColumn()
                // ->addColumn('users', function (User $user) {
                //     return $user->roles ? $user->roles()->pluck('name')->implode(", ") : '';
                // })
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                    <a href="javascript:void(0)" id="' . $row->id . '"class="view btn btn-primary btn-sm"><i class="far fa-eye"></i></a>
                    <a href='.\URL::route('admin.users.getPermission', $row->id).' class="edit btn btn-success btn-sm"><i class="fas fa-user-cog"></i></a>
                    <a href='.\URL::route('admin.users.edit', $row->id).' class="edit btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                    <a href="javascript:void(0)" id="' . $row->id . '" class="delete btn btn-danger btn-sm"><i class="far fa-trash-alt"></i></a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                // ->paginate(20)
                ->toJson();
        }
        return view('admin.roles.index');
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
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);

        Role::create(['name' => $request->name]);
        Toastr::success('Role has been created successfully :)','Success');
        return response()->json(['success' => 'User has been Created']);
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
}
