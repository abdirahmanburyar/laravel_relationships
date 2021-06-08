@extends('layouts.app')
@section('title')
{{$user->name}}'s Permission
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user.style.css') }}">
@endsection
@section('content')
    <h4><i class="fas fa-user"></i> Update User Permission</h4>
    <hr />
    <legend>
        <span style="text-transform: capitalize"><strong>{{$user->name}}'s</strong> Permission</span>
    </legend>
    <div class="user_management" style="font-size: 15px">
        <form action="{{ route('admin.users.postPermission', $user->id) }}" method="POST">
            @csrf
            <h5 class="titles">Role</h5>
            <hr />
            <div class="form-row">
                <div class="form-group col-md-12">
                    @foreach (\Spatie\Permission\Models\Role::all() as $role)
                        <div class="formCheck">
                            <input type="radio" name="role"
                            value="{{ $role->id }}" @isset($user) @if (in_array($role->id, $user->roles->pluck('id')->toArray())) checked @endif @endisset id="{{$role->id}}">
                            <label for="{{ $role->id }}">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
                <div class="form-group col-md-12">
                    <h5 class="titles">Permissions</h5>
                    <hr />
                    @foreach (\Spatie\Permission\Models\Permission::all() as $permission)
                        <div class="formCheck">
                            <input type="checkbox" name="permissions[]"
                            value="{{ $permission->id }}" @isset($user) @if (in_array($permission->id, $user->permissions->pluck('id')->toArray())) checked @endif @endisset id="{{ $permission->id }}">
                            <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection

