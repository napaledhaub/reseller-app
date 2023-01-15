@extends('layout.ownerlayout')

@section('content')
    <div class="container my-5">
        @if(session()->has('cancel'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('cancel')}}
            </div>
        @endif

        @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('success')}}
            </div>
        @endif

        @if($orderList->count() > 0)
            @foreach($orderList as $list)
                <div class="row">
                    <div class="col-md-6">{{$list->created_at}}</div>
                    <div class="col-md-6 text-right">Status: {{$list->status}}</div>
                </div>
                <div class="row">
                    <div class="col-md-6">Total: Rp. {{$list->total}}</div>
                    <div class="col-md-6 text-right">
                        @if($list->isPending())
                            <form method="POST" action="{{route('cancelOrder', $list->id)}}">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-danger">Cancel Order</button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">Dropshipper: {{$list->dropshipper()->name}}</div>
                    <div class="col-md-6 text-right">
                        @if($list->isPending())
                            <form method="POST" action="{{route('sentOrder', $list->id)}}">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success">Good Sent</button>
                            </form> 
                        @endif
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Goods</th>
                            <th>Picture</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($list->ordergoods as $ordergood)
                            <tr>
                                <td>{{$ordergood->good->good_name}}</td>
                                <td><img src="/image/{{$ordergood->good->good_picture}}" class="img-fluid" style="width:50px;height:50px;"/></td>
                                <td>Rp. {{$ordergood->good->getPrice()}}</td>
                                <td>{{$ordergood->quantity}}</td>
                                <td>Rp.{{$ordergood->total}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
        @else
            <div class="m-4 text-center"><h4>No Order Found</h4></div>
        @endif
    </div>
@endsection