@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">@lang('bolao.dashboard')</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="row">
                        <div onclick="window.location='{{route('users.index')}}'" style="cursor:pointer" class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">@lang('bolao.list',['page'=>__('bolao.user_list')])</div>
                            <div class="card-body">
                                <p class="card-text">@lang('bolao.Manage_users')</p>
                            </div>
                        </div>
                        <div onclick="window.location='{{route('roles.index')}}'" style="cursor:pointer; margin-left:10px" class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">@lang('bolao.list',['page'=>__('bolao.Role_list')])</div>
                            <div class="card-body">
                                <p class="card-text">@lang('bolao.Manage_roles')</p>
                            </div>
                        </div>
                        <div onclick="window.location='{{route('permissions.index')}}'" style="cursor:pointer; margin-left:10px" class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                            <div class="card-header">@lang('bolao.list',['page'=>__('bolao.permission_list')])</div>
                            <div class="card-body">
                                <p class="card-text">@lang('bolao.Manage_permissions')</p>
                            </div>
                        </div>               
                    </div>
                    <!--You are logged in!
                    <a href="{{route('users.index')}}">Lista de usuários</a> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
