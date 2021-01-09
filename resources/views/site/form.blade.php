<div class="row">    
   <div class="form-group col-6">
        <label for="scoreboard_a">{{ $register->team_a }}</label>
        <input type="text" class="form-control @error('scoreboard_a') is-invalid @enderror" name="scoreboard_a" value="{{ old('scoreboard_a') ?? ($register->scoreboard_a_betting ?? 0) }}" >
        @error('scoreboard_a')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>  
    <div class="form-group col-6">
        <label for="scoreboard_b">{{$register->team_b }}</label>
        <input type="text" class="form-control @error('scoreboard_b') is-invalid @enderror" name="scoreboard_b" value="{{ old('scoreboard_b') ?? ($register->scoreboard_b_betting ?? 0) }}" >
        @error('scoreboard_b')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <p><i>{{__('bolao.obs3') }} {{$date_end}}</i></p>
</div>