@php

$method = strtolower($method);
$method_input = "";

if($method == "post")
{

}elseif($method == "put")
{
  $method =  "POST";
  $method_input =  method_field('PUT');

}elseif($method == "delete"){

  $method_input =  method_field('DELETE');

}else{

  $method =  "GET";
}

@endphp

<form class="" action={{$action}} method="{{$method}}" enctype="multipart/form-data">
  {{ csrf_field() }} <!-- token de segurança -->

  {{$method_input}}

  {{$slot}}

</form>
