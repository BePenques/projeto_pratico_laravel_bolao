@extends('layouts.app')

@section('content')

      <x-page_component col=12 :breadcrumb="$breadcrumb" :page="__('bolao.edit_crud',['page'=>$page_create])" >
        
        <x-alert :msg="session('msg'??'')" :status="session('status'??'')" />  

        <x-form_component :action="$action" method="PUT">
          @include('admin.'.$routeName.'.form')
          <button type="submit" class="btn btn-primary btn-lg float-right">{{ __('bolao.register-verb') }}</button>
          <p><i>{{ trans('bolao.obs') }}</i></p>
        </x-form_component>

      </x-page_component>

@endsection
