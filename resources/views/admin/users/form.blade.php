<div class="row">
    <div class="form-group col-6">
        <label for="name">{{ __('bolao.name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? ($register->name ?? '') }}" >
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label for="name">E-mail</label>
        <input type="mail" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? ($register->email ?? '') }}" >
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>


    <div class="form-group col-6">
        <label for="password">{{ __('bolao.password') }}</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group col-6">
        <label for="password">{{ __('bolao.confirmPassword') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="">
    </div>
   
      
    <div class="form-group col-6">
        <label for="roles">{{ __('bolao.select_roles') }}</label>    
        <select class="custom-select js-example-basic-multiple" multiple="multiple" name="roles[]" id="">
            @foreach ($roles as $key => $value)
            @php
                $select = '';

                if(old('roles') ?? false){
                    foreach (old('roles') as $key => $id) {
                        if($id == $value->id){
                            $select = "selected";
                        }
                    }
                }else{
                    if($register ?? false){
                        foreach ($register->roles as $key => $role) {
                            if($role->id == $value->id){
                                $select = "selected";
                            }
                        }
                    }
                }
                @endphp
                <option {{$select}} value="{{$value->id}}">{{$value->name}}</option>
            @endforeach           
        </select>      
    </div>
  
</div>
          