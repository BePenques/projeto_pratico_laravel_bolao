@extends('layouts.app')

@section('content')

      <x-page_component col=12 :breadcrumb="$breadcrumb" :page="__('bolao.details_crud',['page'=>$page_create])" >

        <x-alert :msg="session('msg'??'')" :status="session('status'??'')" />  

        <p>{{ __('bolao.title') }}: {{$register->title}}</p>
          <p>{{ __('bolao.bet') }}: {{$register->betting_title}}</p>
          <p>{{ __('bolao.date_start') }}: {{$register->date_start}}</p>
          <p>{{ __('bolao.date_end') }}: {{$register->date_end}}</p>

        @if($delete)
          <x-form_component :action="$action" method="DELETE">
            <br>
            <p>{{__('bolao.confirmDelete')}}</p>
            <button class="btn btn-danger btn-lg ">{{__('bolao.delete')}}</button>
          </x-form_component>
        @endif

      </x-page_component>

@endsection
