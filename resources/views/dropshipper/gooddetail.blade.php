@extends('layout.dropshipperlayout')

@section('content')
    <div class="container my-5"><a class="btn btn-danger" href="{{url()->previous()}}">Back</a></div>
    <div class="container my-5">
        <div class="col-md-5">
            <div class="form-group row">
                <div class="col">
                    <img src="/image/{{$good->good_picture}}" class="img-fluid" style="width:200px;height:200px;"/>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Name</label>
                <label class="col-md-4 col-form-label">{{$good->good_name}}</label>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Owner</label>
                <label class="col-md-4 col-form-label">{{$good->owner->name}}</label>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Description</label>
                <label class="col-md-4 col-form-label">{{$good->good_description}}</label>
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Price</label>
                @if($good->isOwnedByPartner())
                    <label class="col-md-4 col-form-label"><s>Rp. {{$good->price}}</s></label>
                    <br>
                    <label class="col-md-4 col-form-label">Rp. {{$good->getPrice()}} Harga Partner</label>
                @else
                    <label class="col-md-4 col-form-label">Rp. {{$good->getPrice()}}</label>
                @endif
            </div>

            <div class="form-group row">
                <label class="col-md-4 col-form-label text-md-right">Category</label>
                <label class="col-md-4 col-form-label">{{$good->category->category_name}}</label>
            </div>

            <form action="{{route('addToCart', $good->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label class="col-md-4 col-form-label text-md-right">Quantity</label>
                    <input class="form-control col-md-4 col-form-label @error('total') is-invalid @enderror" type="number" name="quantity" id="quantity" min="1" step="1" value="1">
                    @error('quantity')
                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                    @enderror
                </div>

                <div class="form-group row">
                    <div class="col-md-4 col-form-label text-md-right">
                        <button class="btn btn-primary">Add to Cart</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection