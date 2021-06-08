<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = User::with('address');
        if ($request->ajax()) {
            return DataTables::eloquent($model)
                ->addIndexColumn()
                ->addColumn('address', function (User $user) {
                    return $user->address ? $user->address->job : "";
                })
                ->addColumn('roles', function (User $user) {
                    return $user->roles ? $user->roles()->pluck('name')->implode(", ") : '';
                })
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
        return view('admin.users.index');
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
        $request->validate([
            'name' => 'required|max:25',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|max:12|confirmed',
            'job' => 'required',
            'phone' => 'required',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $user->roles()->sync($request->role);
        $address = new Address();
        $address->job = $request->job ? $request->job : '';
        $address->phone = $request->phone ? $request->phone : '';
        $user->address()->save($address);
        Toastr::success('User has been created successfully :)','Success');
        return response()->json(['success' => 'User has been Created']);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getPermission($id){
        $user = User::where('id', $id)->with('roles','permissions')->get()->first();
        return view('admin.users.pages.permission', compact('user'));
    }
    public function show($id)
    {
        //
    }
    public function postPermission($id, Request $request){
        try {
           $user = User::where('id', $id)->get()->first();
           $user->roles()->sync($request->role);
           $user->syncPermissions($request->permissions);
           return redirect(route('admin.users.index'));
        } catch (\Exception $e) {
            return back()->with(['error' => $e->getMessage()]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userModel = User::where('id', $id)->with(['roles', 'address','permissions']);
        if($userModel->count()){

        $user = QueryBuilder::for($userModel)
            ->get()->first();
        return view('admin.users.pages.edit', compact('user'));
        }
        return App::abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $request->input([
            'email' => 'email|unique:users'
        ]);

        $user = User::where('id', $id)->get()->first();
        $user->update($request->except(['_token','role']));
        $user->roles()->sync($request->role);
        $address = $user->address;
        $address->job = $request->job ? $request->job : $user->address->job;
        $address->phone = $request->phone ? $request->phone : $user->address->phone;
        $address->save();
        Toastr::success('User has been updated successfully :)','Success');
        return redirect(route('admin.users.index'))->with(['success' => 'user has been updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        try {
            if (Auth::id() == $id) {
                return response()->json(['error' => 'You can not delete Your Account']);
            }
            User::find($id)->delete();
            return response()->json(['success' => 'user has been deleted']);

        } catch (\Exception $e) {
            report($e);
            return response()->json(['error' => $e->getMessage()]);
        }
    }
}
