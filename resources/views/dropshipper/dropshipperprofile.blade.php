@extends('layout.dropshipperlayout')

@section('content')
    <div class="container my-5">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('message')}}
            </div>
        @endif

        <div class="d-flex justify-content-center">
            @if(!empty($dropshipper->picture))
                <img src="/image/{{$dropshipper->picture}}" class="img-fluid" style="width:150px;height:150px;" />
            @else
                <img src="/image/npc_wojak.png" class="img-fluid" style="width:150px;height:150px;" />                        
            @endif
        </div>

        <form action="{{route('dropshipperProfileUpdate')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <br>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$dropshipper->name}}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <label class="col-md-4 col-form-label">{{$dropshipper->email}}</label>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>
                <div class="col-md-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{$dropshipper->address}}" required autocomplete="name" autofocus>
                    @error('address')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                <div class="col-md-6">
                    <input id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$dropshipper->description}}" required autocomplete="name" autofocus>
                    @error('description')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="ktp" class="col-md-4 col-form-label text-md-right">{{ __('Ktp') }}</label>
                <label class="col-md-4 col-form-label">{{$dropshipper->ktp}}</label>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>
                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{$dropshipper->phone}}" required autocomplete="name" autofocus>
                    @error('phone')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Photo</label>
                <div class="col-md-6">
                    <input class="btn form-control-file" type="file" name="image">
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button class="btn btn-warning">Update Profile</button>
                </div>
            </div>
        </form>
    </div>
@endsection