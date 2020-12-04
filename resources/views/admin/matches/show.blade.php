@extends('layouts.app')

@section('content')

      <x-page_component col=12 :breadcrumb="$breadcrumb" :page="__('bolao.details_crud',['page'=>$page_create])" >

        <x-alert :msg="session('msg'??'')" :status="session('status'??'')" />  

          <p>{{ __('bolao.title') }}: {{$register->title}}</p>
          <p>{{ __('bolao.stadium') }}: {{$register->stadium}}</p>
          <p>{{ __('bolao.team_a') }}: {{$register->team_a}}</p>
          <p>{{ __('bolao.team_b') }}: {{$register->team_b}}</p>
          <p>{{ __('bolao.result') }}<i>{{__('bolao.result_expli')}}</i>: {{$register->result}}</p>
          <p>{{ __('bolao.scoreboard_a')}}: {{$register->scoreboard_a}}</p>
          <p>{{ __('bolao.scoreboard_b') }}: {{$register->scoreboard_b}}</p>
          <p>{{ __('bolao.date') }}: {{$register->date}}</p>

        @if($delete)
          <x-form_component :action="$action" method="DELETE">
            <br>
            <p>{{__('bolao.confirmDelete')}}</p>
            <button class="btn btn-danger btn-lg ">{{__('bolao.delete')}}</button>
          </x-form_component>
        @endif

      </x-page_component>

@endsection
