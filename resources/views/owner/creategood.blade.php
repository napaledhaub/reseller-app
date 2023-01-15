@extends('layout.ownerlayout')

@section('content')
    <div class="container my-5"><a class="btn btn-danger" href="{{ url()->previous() }}">Back</a></div>
    <div class="container my-5">
        <div class="col-md-5">
            <form action="{{route('storeGood')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <label>Name</label>
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name">
                @error('name')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <br>

                <label>Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="5"></textarea><br>
                @error('description')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <br>

                <label>Photo</label>
                <input class="btn form-control-file" type="file" name="image">
                @error('image')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <br>

                <label>Price</label>
                <input class="form-control @error('price') is-invalid @enderror" type="text" name="price">
                @error('price')
                    <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
                <br>

                <label>Category</label>
                <select class="form-control" name="category">
                    @foreach($categoryList as $list)
                        <option value="{{$list->id}}">{{$list->category_name}}</option>
                    @endforeach
                </select>

                <br>
                <button class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
@endsection