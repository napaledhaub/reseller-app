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
        
        @if($partnerships->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Gambar Profil</th>
                        <th>Alamat</th>
                        <th>Deskripsi</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partnerships as $partnership)
                        @php($dropshipper = $partnership->dropshipper())
                        <tr>
                            <td>{{$dropshipper->name}}</td>
                            @if(!empty($list->picture))
                                <td><img src="/image/{{$partnership->dropshipper()->picture}}" class="img-fluid" style="width:50px;height:50px;"/></td>
                            @else
                                <td><img src="/image/npc_wojak.png" class="img-fluid" style="width:50px;height:50px;"/></td>
                            @endif
                            <td>{{$dropshipper->address}}</td>
                            <td>{{$dropshipper->description}}</td>
                            <td>
                                <form method="POST" action="{{route('deletePartner', $dropshipper->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">Hapus Dropshipper</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="m-4 text-center"><h4>Anda belum mempunyai partner</h4></div>
        @endif
    </div>
@endsection