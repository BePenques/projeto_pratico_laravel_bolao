@extends('layouts.app')

@section('content')

      <x-page_component col=12 :breadcrumb="$breadcrumb" :page="__('bolao.details_crud',['page'=>$page_create])" >

        <x-alert :msg="session('msg'??'')" :status="session('status'??'')" />  

        <p>{{__('bolao.name')}}: {{$register->name}}</p>
        <p>E-mail: {{$register->email}}</p>

        @if($delete)
          <x-form_component :action="$action" method="DELETE">
            <br>
            <p>Deseja deletar esse registro?</p>
            <button class="btn btn-danger btn-lg ">Deletar</button>
          </x-form_component>
        @endif

      </x-page_component>

@endsection
