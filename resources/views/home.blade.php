@extends('layouts.app')

@section('content')

<x-page_component col=8  :page=$page>

    <x-alert :msg="session('msg'??'')" :status="session('status')" />  <!-- status: success, error or notification-->

    <div class="row">

        @can('users-list')
            <div onclick="window.location='{{route('users.index')}}'" style="cursor:pointer" class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                <div class="card-header">@lang('bolao.list',['page'=>__('bolao.user_list')])</div>
                <div class="card-body">
                    <p class="card-text">@lang('bolao.Manage_users')</p>
                </div>
            </div>
        @endcan

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

</x-page_component>

@endsection
