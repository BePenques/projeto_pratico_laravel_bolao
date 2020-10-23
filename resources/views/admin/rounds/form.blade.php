<div class="row">
    <div class="form-group col-6">
        <label for="title">{{ __('bolao.title') }}</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? ($register->title ?? '') }}">
        @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-6">
      <label for="title">{{ __('bolao.Betting') }}</label>
      <select class="form-control @error('betting_id') is-invalid @enderror" name="betting_id" id="betting_id">
          @foreach ($listRel as $item)
            <option value="{{$item->id}}">{{$item->title}}</option>  
          @endforeach
      </select>
    </div>
</div>
<div class="row">
    <div class="form-group col-6">
        <label for="date_start">{{ __('bolao.date_start') }}</label>
        <input type="date" class="form-control @error('date_start') is-invalid @enderror" name="date_start" value="{{ old('date_start') ?? ($register->date_start ?? '') }}">
        @error('date_start')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="form-group col-6">
        <label for="date_end">{{ __('bolao.date_end') }}</label>
        <input type="date" class="form-control @error('date_end') is-invalid @enderror" name="date_end" value="{{ old('date_end') ?? ($register->date_end ?? '') }}">
        @error('date_end')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

          