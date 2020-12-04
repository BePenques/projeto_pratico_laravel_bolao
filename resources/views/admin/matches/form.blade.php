<div class="row">
    <div class="form-group col-6">
      <label for="title">{{ __('bolao.title') }}</label>
      <input type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') ?? ($register->title ?? '') }}">
      @if ($errors->has('title'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('title') }}</strong>
          </span>
      @endif
  
    </div>
    <div class="form-group col-6">
      <label for="round_id">{{ __('bolao.Round') }}</label>
      <select class="form-control{{ $errors->has('round_id') ? ' is-invalid' : '' }}" name="round_id">
  
        @foreach ($listRel as $key => $value)
          @php
            $select = '';
  
            if(old('round_id') ?? false){
                if(old('round_id') == $value->id){
                  $select = 'selected';
                }
            }else{
              if($register->round_id ?? false){
                if($register->round_id == $value->id){
                  $select = 'selected';
                }
              }
            }
  
          @endphp
          <option {{$select}} value="{{$value->id}}">{{$value->title}}</option>
  
        @endforeach
  
      </select>
      @if ($errors->has('round_id'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('round_id') }}</strong>
          </span>
      @endif
    </div>
</div>
<div class="row">
 
  <div class="form-group col-6">
    <label for="team_a">{{ __('bolao.team_a') }}</label>
    <input type="text" class="form-control @error('team_a') is-invalid @enderror" name="team_a" value="{{ old('team_a') ?? ($register->team_a ?? '') }}" >
    @error('team_a')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>  
  <div class="form-group col-6">
    <label for="team_a">{{ __('bolao.team_b') }}</label>
    <input type="text" class="form-control @error('team_b') is-invalid @enderror" name="team_b" value="{{ old('team_b') ?? ($register->team_b ?? '') }}" >
    @error('team_b')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>  
</div>
<div class="row">
  <div class="form-group col-6">
    <label for="stadium">{{ __('bolao.stadium') }}</label>
    <input type="text" class="form-control @error('stadium') is-invalid @enderror" name="stadium" value="{{ old('stadium') ?? ($register->stadium ?? '') }}" >
    @error('stadium')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div> 
  <div class="form-group col-6">
    <label for="scoreboard_a">{{ __('bolao.scoreboard_a') }}</label>
    <input type="text" class="form-control @error('scoreboard_a') is-invalid @enderror" name="scoreboard_a" value="{{ old('scoreboard_a') ?? ($register->scoreboard_a ?? 0) }}" >
    @error('scoreboard_a')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>  
</div>
<div class="row"> 
  <div class="form-group col-6">
    <label for="scoreboard_b">{{ __('bolao.scoreboard_b') }}</label>
    <input type="text" class="form-control @error('scoreboard_b') is-invalid @enderror" name="scoreboard_b" value="{{ old('scoreboard_b') ?? ($register->scoreboard_b ?? 0) }}" >
    @error('scoreboard_b')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
  </div>
  <div class="form-group col-6">
    <label for="result">{{ __('bolao.result') }}</label>
    <i><label for="result">{{ __('bolao.result_expli') }}</label></i>
    <select class="form-control{{ $errors->has('result') ? ' is-invalid' : '' }}" name="result">
      @php
      $list = ['A','B','E'];
      @endphp
      @foreach ($list as $key => $value)
        @php
          $select = '';

          if(old('result') ?? false){
              if(old('result') == $value->result){
                $select = 'selected';
              }
          }else{
            if($register->result ?? false){
              if($register->result == $value){
                $select = 'selected';
              }
            }else{
              if($value == 'E'){
                $select = 'selected';
              }
            }
          }

        @endphp
        <option {{$select}} value="{{$value}}">{{$value}}</option>

      @endforeach

    </select>
    @if ($errors->has('result'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('result') }}</strong>
        </span>
    @endif
  </div>  
</div>
<div class="row">
  <div class="form-group col-6">
    <label for="date">{{ __('bolao.date') }} ({{date('Y-m-d H:i:s')}})</label>
    <input type="datetime" class="form-control{{ $errors->has('date') ? ' is-invalid' : '' }}" name="date" value="{{ old('date') ?? ($register->date ?? '') }}">
    @if ($errors->has('date'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('date') }}</strong>
        </span>
    @endif

  </div>
</div>



    {{-- <div class="form-group col-6">
      <label for="date_start">{{ __('bolao.date_start') }} ({{date('d-m-Y H:i:s')}})</label>
      <input type="date" class="form-control{{ $errors->has('date_start') ? ' is-invalid' : '' }}" name="date_start" value="{{ old('date_start') ?? ($register->date_start ?? '') }}">
      @if ($errors->has('date_start'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('date_start') }}</strong>
          </span>
      @endif
  
    </div>
  
    <div class="form-group col-6">
      <label for="date_end">{{ __('bolao.date_end') }} ({{date('d-m-Y H:i:s')}})</label>
      <input type="date"  class="form-control{{ $errors->has('date_end') ? ' is-invalid' : '' }}" name="date_end" value="{{ old('date_end') ?? ($register->date_end ?? '') }}">
      @if ($errors->has('date_end'))
          <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('date_end') }}</strong>
          </span>
      @endif
  
    </div> --}}
  
  
  
  