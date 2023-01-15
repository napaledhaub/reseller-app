@extends('layout.ownerlayout')

@section('content')
    <div class="container my-5"><a class="btn btn-danger" href="{{route('good')}}">Back</a></div>
    <div class="container my-5">
        <div class="col-md-5">
            <form action="{{route('updateGood')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="form-group row">
                    <div class="col">
                        <img src="/image/{{$good->good_picture}}" class="img-fluid" style="width:200px;height:200px;"/>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Name</label>
                    <div class="col">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{$good->good_name}}">
                        @error('name')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Description</label>
                    <div class="col">
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5">{{$good->good_description}}</textarea><br>
                        @error('description')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Price</label>
                    <div class="col">
                        <input class="form-control @error('price') is-invalid @enderror" type="text" name="price" value="{{$good->price}}">
                        @error('price')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Photo</label>
                    <div class="col">
                        <input class="btn form-control-file" type="file" name="image">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Category</label>
                    <label class="col-md-4 col-form-label">{{$good->category->category_name}}</label>
                </div>

                <input class="form-control" type="hidden" name="id" value="{{$good->id}}">
                <div class="form-group row mb-0">
                    <div class="col-md-8 offset-md-4">
                        <button class="btn btn-warning">Edit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection