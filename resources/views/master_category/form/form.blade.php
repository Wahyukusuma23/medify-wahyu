<form method="POST" enctype="multipart/form-data">
    @csrf
    @if($method == 'edit')
    <div class="form-group">
        <label>Kode Barang</label>
        <input type="text" class="form-control" name="kode_barang" required readonly value="{{$item->kode ?? ''}}">
    </div>
    @endif

    <div class="form-group">
        <label>Nama</label>
        <input type="text" class="form-control" name="category_name" required  value="{{$item->name ?? ''}}">
    </div>
    
    @if($method == 'edit')
    @endif
    <button class="btn btn-primary mt-3">Submit</button>

</form>