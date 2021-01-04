<div>
    <table class="table table-dark">
      <thead>
        <tr>
          @foreach ($columnList as $key => $value)
              <th scope="col">{{$value}}</th>
          @endforeach
        </tr>
      </thead>
      <tbody>
        @php 
         $count = 1;
        @endphp
          @foreach ($list as $key => $value)
          <tr>
            @foreach ($columnList as $key2 => $value2)
              @if($key2 == 'id')
                <th scope="row">@php echo $value->{$key2} @endphp</th>
              @elseif($key2 == 'OrderAsc')
              <td>@php echo $count++  @endphp</td>
              @elseif($key2 == 'acao')
                <td>    
                <a href="{{route($routeName, $value->id)}}"><i class="material-icons" style="padding-right:10px; color:white;" alt="Detalhes" >pageview</i></a>
              
                </td>
              @else
                <td>@php echo $value->{$key2} @endphp</td>
              
              @endif
              
            @endforeach
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  