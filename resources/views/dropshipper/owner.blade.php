@extends('layout.dropshipperlayout')

@section('content')
    <div class="container my-5">        
        @if($ownerList->count() > 0)
            <div class="card-deck">
                @foreach($ownerList as $list)
                    <div class="col-md-3 p-2">
                        <div class="card border-dark mb-3" style="max-width: 18rem;">
                            <h5 class="card-header">{{$list->name}}</h5>
                            <div class="card-body text-dark">
                                @if(!empty($list->picture))
                                    <img src="/image/{{$list->picture}}" class="img-fluid" style="width:50px;height:50px;"/>
                                @else
                                    <img src="/image/npc_wojak.png" class="img-fluid"  style="width:50px;height:50px;" />                        
                                @endif
                                <br>
                                <a class="btn" href="{{route('ownerDetail', $list->id)}}">Goods</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="m-4 text-center"><h4>No Partnership Found</h4></div>
        @endif
    </div>
@endsection