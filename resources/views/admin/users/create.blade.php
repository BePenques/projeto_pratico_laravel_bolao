@extends('layouts.app')

@section('content')

      <x-page_component col=12 :breadcrumb="$breadcrumb" :page="__('bolao.create_crud',['page'=>$page_create])" >

      <!--  <x-alert msg="hello" status="success"   /> status: success, error or notification-->

        <x-form_component :action="$action" method="POST">
          @include('admin.users.form')
          <button type="submit" class="btn btn-primary btn-lg float-right">{{ __('bolao.register-verb') }}</button>
        </x-form_component>

      </x-page_component>

@endsection
