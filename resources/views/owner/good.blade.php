@extends('layout.ownerlayout')

@section('content')
    <div class="container my-5">
        <div style="padding-bottom:20px">
            <a class="btn btn-primary" href="{{route('createGood')}}">Add Good</a>
        </div>
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
                            <td>Rp. {{$list->price}}</td>
                            <td>
                                <div class="row">
                                    <form class="mx-3" action="{{route('editGood', $list->id)}}">
                                        <button class="btn btn-warning">Edit</button>
                                    </form>
                                    <form method="POST" action="{{route('destroyGood', $list->id)}}">
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
        @else
            <div class="m-4 text-center"><h4>No Good Found</h4></div>
        @endif
    </div>
@endsection