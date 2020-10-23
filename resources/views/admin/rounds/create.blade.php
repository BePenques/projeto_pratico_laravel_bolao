@extends('layouts.app')

@section('content')

      <x-page_component col=12 :breadcrumb="$breadcrumb" :page="$titleAdd" >

        <x-alert :msg="session('msg'??'')" :status="session('status'??'')" />  

        <x-form_component :action="$action" method="POST">
          @include('admin.'.$routeName.'.form')
          <button type="submit" class="btn btn-primary btn-lg float-right">{{ __('bolao.register-verb') }}</button>
        </x-form_component>

      </x-page_component>

@endsection
