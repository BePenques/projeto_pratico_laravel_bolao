@extends('layouts.app')

@section('content')

<x-page_component col=12  :page=$page>

    <x-alert :msg="session('msg'??'')" :status="session('status')" />  <!-- status: success, error or notification-->

<span id="portfolio">
    <div class="container">     
        <div class="row">
        @can('users-list')
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item" onclick="window.location='{{route('users.index')}}'" style="cursor:pointer">
                    <a class="portfolio-link" >
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                    <img class="img-fluid" src="{{asset('assets/img/portfolio/user.png')}}" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">@lang('bolao.list',['page'=>__('bolao.user_list')])</div>
                        <div class="portfolio-caption-subheading text-muted">@lang('bolao.Manage_users')</div>
                    </div>
                </div>
            </div> 
        @endcan 
        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="portfolio-item" onclick="window.location='{{route('bettings.index')}}'" style="cursor:pointer">
                <a class="portfolio-link" >
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                <img class="img-fluid" src="{{asset('assets/img/portfolio/placar.jpg')}}" alt="" />
                </a>
                <div class="portfolio-caption">
                    <div class="portfolio-caption-heading">@lang('bolao.betting_list')</div>
                    <div class="portfolio-caption-subheading text-muted">@lang('bolao.Manage_bettings')</div>
                </div>
            </div>
        </div> 
        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="portfolio-item" onclick="window.location='{{route('rounds.index')}}'" style="cursor:pointer">
                <a class="portfolio-link" >
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                <img class="img-fluid" src="{{asset('assets/img/portfolio/placar.jpg')}}" alt="" />
                </a>
                <div class="portfolio-caption">
                    <div class="portfolio-caption-heading">@lang('bolao.Round_list')</div>
                    <div class="portfolio-caption-subheading text-muted">@lang('bolao.Manage_rounds')</div>
                </div>
            </div>
        </div> 
        <div class="col-lg-4 col-sm-6 mb-4">
            <div class="portfolio-item" onclick="window.location='{{route('matches.index')}}'" style="cursor:pointer">
                <a class="portfolio-link" >
                    <div class="portfolio-hover">
                        <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                    </div>
                <img class="img-fluid" src="{{asset('assets/img/portfolio/placar.jpg')}}" alt="" />
                </a>
                <div class="portfolio-caption">
                    <div class="portfolio-caption-heading">@lang('bolao.Match_list')</div>
                    <div class="portfolio-caption-subheading text-muted">@lang('bolao.Manage_matches')</div>
                </div>
            </div>
        </div> 
        @can('acl-full-permission')
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item" onclick="window.location='{{route('roles.index')}}'" style="cursor:pointer">
                    <a class="portfolio-link" >
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio/conf2.png" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">@lang('bolao.list',['page'=>__('bolao.Role_list')])</div>
                        <div class="portfolio-caption-subheading text-muted">@lang('bolao.Manage_roles')</div>
                    </div>
                </div>
            </div>  
            <div class="col-lg-4 col-sm-6 mb-4">
                <div class="portfolio-item" onclick="window.location='{{route('permissions.index')}}'" style="cursor:pointer">
                    <a class="portfolio-link" >
                        <div class="portfolio-hover">
                            <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                        </div>
                        <img class="img-fluid" src="assets/img/portfolio/conf2.png" alt="" />
                    </a>
                    <div class="portfolio-caption">
                        <div class="portfolio-caption-heading">@lang('bolao.list',['page'=>__('bolao.permission_list')])</div>
                        <div class="portfolio-caption-subheading text-muted">@lang('bolao.Manage_permissions')</div>
                    </div>
                </div>
            </div>  
        @endcan      
        </div>
    </div>
</span>

</x-page_component>

@endsection
