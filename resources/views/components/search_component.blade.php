<div>

  <form class="form-inline" method="GET" action="{{route($routeName.'.index')}}">
    <div class="form-group mb-2">
    <!--  <button type="submit" class="btn btn-primary"> {{$titleAdd}}</button> -->
    @can('create-user')
      <a class="btn btn-primary" href="{{route($routeName.'.create')}}">{{$titleAdd}}</a>
    @endcan
    </div>
    <div class="form-group mx-sm-3 mb-2">
      <input type="search" name="search" class="form-control"  placeholder="busca" value="{{$search}}">
    </div>
    <button type="submit" class="btn btn-primary mb-2">@lang('bolao.search')</button>
    <a class="btn btn-warning mb-2" href="{{route($routeName.'.index')}}">@lang('bolao.clean')</a>
 </form>

</div>
