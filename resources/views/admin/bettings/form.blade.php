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
        <label for="score_points">{{ __('bolao.score_points') }}</label>
        <input type="text" class="form-control @error('score_points') is-invalid @enderror" name="score_points" value="{{ old('score_points') ?? ($register->score_points ?? '') }}">
        @error('score_points')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label for="extra_points">{{ __('bolao.extra_points') }}</label>
        <input type="text" class="form-control @error('extra_points') is-invalid @enderror" name="extra_points" value="{{ old('extra_points') ?? ($register->extra_points ?? '') }}">
        @error('extra_points')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label for="rate_points">{{ __('bolao.rate_points') }}</label>
        <input type="text" class="form-control @error('rate_points') is-invalid @enderror" name="rate_points" value="{{ old('rate_points') ?? ($register->rate_points ?? '') }}">
        @error('rate_points')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
          