@extends('layout.dropshipperlayout')

@section('content')
    <div class="container my-5">
        @if(session()->has('create'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('create')}}
            </div>
        @endif
        
        <div class="card-deck">
            @foreach($goodList as $list)
                <div class="col-md-3 p-2">
                    <div class="card border-dark mb-3" style="max-width: 18rem;">
                        <h5 class="card-header">{{$list->good_name}}</h5>
                        <div class="card-body text-dark">
                            <img src="/image/{{$list->good_picture}}" class="img-fluid" style="width:50px;height:50px;"/>
                            <br>
                            @if($list->isOwnedByPartner())
                                <h7 class="card-text"><s>Rp. {{$list->price}}</s></h7>
                                <br>
                                <h7 class="card-text">Rp. {{$list->getPrice()}} Harga Partner</h7>
                            @else
                                <h7 class="card-text">Rp. {{$list->getPrice()}}</h7>
                            @endif
                            <br>
                            <a class="btn" href="{{route('goodCategory', $list->category->id)}}">{{$list->category->category_name}}</a>
                            <a class="btn" href="{{route('goodDetail', $list->id)}}">Detail</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection