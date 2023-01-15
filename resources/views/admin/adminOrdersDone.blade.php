@extends('layout.adminLayout')

@section('content')
    <div class="container my-5">
        <div class="m-4"><h4>Finished Transaction</h4></div>
        @if($doneOrderList->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Owner</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($doneOrderList as $list)
                        <tr>
                            <td>{{$list->owner()->name}}</td>
                            <td>Rp. {{$list->total}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="m-4 text-center"><h5>No Order Found</h5></div>
        @endif

        <div class="m-4"><h4>Complained Transaction</h4></div>
        @if($complainedOrderList->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Dropshipper</th>
                        <th>Owner</th>
                        <th>Picture</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($complainedOrderList as $list)
                        <tr>
                            <td>{{$list->dropshipper()->name}}</td>
                            <td>{{$list->owner()->name}}</td>
                            <td><img src="/image/{{$list->complain_picture}}" class="img-fluid" style="width:50px;height:50px;"/></td>
                            <td>{{$list->complain_desc}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="m-4 text-center"><h5>No Order Found</h5></div>
        @endif
    </div>
@endsection