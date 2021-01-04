@extends('layouts.app')

@section('content')

            <x-page_component col=12  :page="__('bolao.list',['page'=>$page])" :breadcrumb="$breadcrumb" >

                  <x-alert :msg="session('msg'??'')" :status="session('status')" />  <!-- status: success, error or notification-->

                  {{-- <x-search_component :titleAdd="$titleAdd" :search="$search"  :routeName="$routeName"/> --}}

                  {{-- <x-table_site_component :columnList="$columnList" :list="$list" :routeName="$routeName"/>

                  <x-paginate_component :search="$search"??'' :list="$list"/> --}}

                  <x-form_component :action="$action" method="PUT">
                        @include('site.form')
                        <button type="submit" class="btn btn-primary btn-lg float-right">{{ __('bolao.add') }}</button>
                  </x-form_component>
                  
            </x-page_component>

@endsection
