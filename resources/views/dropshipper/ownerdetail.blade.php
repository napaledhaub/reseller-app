@extends('layout.dropshipperlayout')

@section('content')
    <div class="container my-5"><a class="btn btn-danger" href="{{route('owner')}}">Back</a></div>
    <div class="container my-5">
        @if(session()->has('create'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('create')}}
            </div>
        @endif

        @if($goodList->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Goods</th>
                        <th>Picture</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($goodList as $list)
                        <tr>
                            <td>{{$list->good_name}}</td>
                            <td><img src="/image/{{$list->good_picture}}" class="img-fluid" style="width:50px;height:50px;"/></td>
                            <td>{{$list->good_description}}</td>
                            <td>{{$list->category->category_name}}</td>
                            <td>Rp. {{$list->getPrice()}}</td>
                            <td>
                                <a class="btn btn-success" href="{{route('goodDetail', $list->id)}}">Buy</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="m-4 text-center"><h4>No Good Found</h4></div>
        @endif
    </div>
@endsection