@extends('layouts.app')

@section('content')

      <x-page_component col=12 :breadcrumb="$breadcrumb" :page="__('bolao.create_crud',['page'=>$page_create])" >

      <x-alert msg="hello" status="success"   /><!-- status: success, error or notification-->

      </x-page>

@endsection
