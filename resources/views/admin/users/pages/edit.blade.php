@extends('layouts.app')
@section('title')
    Edit User
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('css/user.style.css') }}">
@endsection
@section('content')
    <h4><i class="fas fa-user"></i> Edit user</h4>
    <hr />
    <div class="user_management">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PATCH')
            <h5 class="titles">User Credential</h5>
            <hr />
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fullNameInput">Full Name</label>
                    <input type="text" name="name" class="form-control" id="fullNameInput" placeholder="Enter Full Name"
                        value="{{ old('name') }}@isset($user){{ $user->name }}@endisset" autocomplete="off">
                        @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="emailInput">Email</label>
                    <input type="email" name="email" class="form-control" id="emailInput" placeholder="email"
                        value="{{ old('email') }}@isset($user){{ $user->email }}@endisset"
                        autocomplete="off">
                        @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <h5 class="titles">User Role/Permissions</h5>
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
                    @foreach (\Spatie\Permission\Models\Permission::all() as $permission)
                        <div class="formCheck">
                            <input type="checkbox" name="permission"
                            id="{{ $permission->id }}" @isset($user) @if (in_array($permission->id, $user->permissions->pluck('id')->toArray())) checked @endif @endisset>
                            <label for="{{ $permission->name }}">{{ $permission->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <h5 class="titles">User Information</h5>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="phoneInput">Phone</label>
                    <input type="text" name="phone" class="form-control" id="phoneInput" placeholder="Enter Phone"
                    value="{{ old('phone') }}@isset($user){{ $user->address ? $user->address->phone : "" }}@endisset" autocomplete="off">
                </div>
                <div class="form-group col-md-4">
                    <label for="jobInput">Accupation</label>
                    <input type="text" name="job" class="form-control" id="jobInput" placeholder="Enter User Accupation"
                    value="{{ old('job') }}@isset($user){{ $user->address ? $user->address->job : "" }}@endisset" autocomplete="off">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
