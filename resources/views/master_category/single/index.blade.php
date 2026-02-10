@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-group mb-2">
                <a href="{{url('master-items')}}" class="btn btn-secondary">Kembali ke Daftar Item</a>
            </div>
            <div class="card">
                <div class="card-header">Master Item</div>

                <div class="card-body">
                    <table>
                        <colgroup>
                        <col style="width: 100px">
                        <col>
                        </colgroup>
                        <tr>
                            <th>Kode</th>
                            <td>:</td>
                            <td>{{$data->kode}}</td>
                        </tr>
                        <tr>
                            <th>Nama</th>
                            <td>:</td>
                            <td>{{$data->name}}</td>
                        </tr>
                        <tr style="vertical-align: baseline;">
                            <th>List Produk</th>
                            <td>:</td>
                            <td>
                                @if ($data->items)
                                    <ul style="padding-left: 20px;">
                                        @foreach ($data->items as $item)
                                        <li>{{$item->nama}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <a class="btn btn-info" href="{{url('master-items/form/edit')}}/{{$data->id}}">Edit</a>
                    <a class="btn btn-danger" href="{{url('master-items/delete')}}/{{$data->id}}" onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    <a class="btn btn-warning" href="{{route('category-item.print', $data->id)}}" >Cetak</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
@endsection