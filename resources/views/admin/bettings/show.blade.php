@extends('layouts.app')

@section('content')

      <x-page_component col=12 :breadcrumb="$breadcrumb" :page="__('bolao.details_crud',['page'=>$page_create])" >

        <x-alert :msg="session('msg'??'')" :status="session('status'??'')" />  

        <p>{{__('bolao.title')}}: {{$register->title}}</p>
        <p>{{__('bolao.current_round')}}: {{$register->current_round}}</p>
        <p>{{__('bolao.score_points')}}: {{$register->score_points}}</p>
        <p>{{__('bolao.extra_points')}}: {{$register->extra_points}}</p>
        <p>{{__('bolao.rate_points')}}: {{$register->rate_points}}</p>

        @if($delete)
          <x-form_component :action="$action" method="DELETE">
            <br>
            <p>{{__('bolao.confirmDelete')}}</p>
            <button class="btn btn-danger btn-lg ">{{__('bolao.delete')}}</button>
          </x-form_component>
        @endif

      </x-page_component>

@endsection
