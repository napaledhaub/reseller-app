@extends('layout.ownerlayout')

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
        
        <div class="card-deck">
            @foreach($dropshipperList as $list)
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
                            <h7 class="card-text">{{$list->description}}</h7>
                            @if($list->isPartnerWithDropshipper())
                                <form method="POST" action="{{route('deletePartner', $list->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Hapus Partner</button>
                                </form> 
                            @else
                                <form method="POST" action="{{route('addPartner', $list->id)}}">
                                    @csrf
                                    <button class="btn btn-primary">Tambah Partner</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection