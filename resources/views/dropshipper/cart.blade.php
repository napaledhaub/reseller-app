@extends('layout.dropshipperlayout')

@section('content')
    <div class="container my-5">
        @if(session()->has('create'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('create')}}
            </div>
        @endif

        @if(session()->has('delete'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('delete')}}
            </div>
        @endif

        <h2 class="m-4 text-center">Barang yang Dipesan</h2>
        @if($carts->count() > 0)
            @foreach($carts as $cart)
                @if($cart->cartgoods->count() == 0) @continue
                @endif
                <h3 class="m-4">Owner: {{$cart->owner()->name}}</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Goods</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($cart->cartgoods as $cartgood)
                        <tr>
                            <td>{{$cartgood->good->good_name}}</td>
                            <td>Rp.{{$cartgood->good->getPrice()}}</td>
                            <td>{{$cartgood->quantity}}</td>
                            <td>Rp.{{$cartgood->total()}}</td>
                            <td>
                                <div class="row">
                                    <form method="POST" action="{{route('destroyCart', $cartgood->id)}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <form method="POST" action="{{route('checkout', $cart->id)}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">Total Payment</label>
                        <label class="col-md-4 col-form-label">Rp. {{$cart->total()}}</label>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">Address</label>
                        <textarea class="form-control col-md-4 col-form-label @error('address') is-invalid @enderror" aria-label="With textarea" name="address" id="address"></textarea>
                        @error('address')
                            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2 col-form-label text-md-right">Upload Receipt</label>
                        <input class="col-md-4 col-form-label" type="file" name="image">
                    </div>
                    <div class="form-group row">
                        <div class="col-md-4 offset-md-2">
                            <button class="btn btn-primary">Checkout</button>
                        </div>
                    </div>
                </form>
            @endforeach
        @else
            <div class="m-4 text-center"><h5>Your cart is empty</h5></div>
        @endif
    </div>
@endsection