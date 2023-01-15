@extends('layout.ownerlayout')

@section('content')
    <div class="container my-5">
        @if(session()->has('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('message')}}
            </div>
        @endif

        <div class="d-flex justify-content-center">
            @if(!empty($owner->picture))
                <img src="/image/{{$owner->picture}}" class="img-fluid" style="width:150px;height:150px;" />
            @else
                <img src="/image/npc_wojak.png" class="img-fluid" style="width:150px;height:150px;" />                        
            @endif
        </div>

        <form action="{{route('ownerProfileUpdate')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <br>
            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$owner->name}}" required autocomplete="name" autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                <label class="col-md-4 col-form-label">{{$owner->email}}</label>
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