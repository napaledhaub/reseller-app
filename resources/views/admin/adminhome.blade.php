@extends('layout.adminLayout')

@section('content')
    <div class="container my-5">
        @if(session()->has('create'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{session('create')}}
            </div>
        @endif

        @if(session()->has('cancel'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{session('cancel')}}
            </div>
        @endif

        <div class="m-4"><h4>Pending Transaction</h4></div>
        @if($orderList->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Receipt</th>
                        <th>Dropshipper</th>
                        <th>Owner</th>
                        <th>Total</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orderList as $list)
                        <tr>
                            <td><img src="/image/{{$list->picture}}" class="img-fluid" style="width:50px;height:50px;"/></td>
                            <td>{{$list->dropshipper()->name}}</td>
                            <td>{{$list->owner()->name}}</td>
                            <td>Rp. {{$list->total}}</td>
                            <td>
                                <div class="row">
                                    <form method="POST" action="{{route('rejectReceipt', $list->id)}}">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-danger">Reject</button>
                                    </form>
                                </div>
                            </td>
                            <td>
                                <form method="POST" action="{{route('approveReceipt', $list->id)}}">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-success">Approve</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="m-4 text-center"><h5>No Order Found</h5></div>
        @endif
    </div>
@endsection