@extends('layouts.app')

@section('content')

            <x-page_component col=12  :page="__('bolao.list',['page'=>$page])" :breadcrumb="$breadcrumb" >

                  <x-alert :msg="session('msg'??'')" :status="session('status')" />  <!-- status: success, error or notification-->

                  <x-search_component :titleAdd="$titleAdd" :search="$search"  :routeName="$routeName"/>

                  <x-table_component :columnList="$columnList" :list="$list" :routeName="$routeName" />

                  <x-paginate_component :search="$search" :list="$list"/>
                  
            </x-page_component>

@endsection
