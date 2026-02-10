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
        <input type="text" class="form-control" name="nama" required  value="{{$item->nama ?? ''}}">
    </div>

    <div class="form-group">
        <label>Harga Beli</label>
        <input type="number" class="form-control" name="harga_beli" required  value="{{$item->harga_beli ?? ''}}">
    </div>

    <div class="form-group">
        <label>Laba (dalam persen)</label>
        <input type="number" class="form-control" name="laba" required  value="{{$item->laba ?? ''}}">
    </div>

    @php $selected = $item->supplier ?? ''; @endphp
    <div class="form-group">
        <label>Supplier</label>
        <select class="form-control" required name="supplier">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Tokopaedi') selected @endif>Tokopaedi</option>
            <option @if($selected == 'Bukulapuk') selected @endif>Bukulapuk</option>
            <option @if($selected == 'TokoBagas') selected @endif>TokoBagas</option>
            <option @if($selected == 'E Commurz') selected @endif>E Commurz</option>
            <optio @if($selected == 'Blublu') selected @endif>Blublu</option>
        </select>
    </div>

    @php $selected = $item->jenis ?? ''; @endphp
    <div class="form-group">
        <label>Jenis</label>
        <select class="form-control" required name="jenis">
            <option @if($selected == '') selected @endif value="">--Pilih--</option>
            <option @if($selected == 'Obat') selected @endif>Obat</option>
            <option @if($selected == 'Alkes') selected @endif>Alkes</option>
            <option @if($selected == 'Matkes') selected @endif>Matkes</option>
            <optio @if($selected == 'Umum') selected @endif>Umum</option>
            <optio @if($selected == 'ATK') selected @endif>ATK</option>
        </select>
    </div>
    
    <div class="form-group">
            <label for="">Kategori</label>
            @foreach ($categories as $category)
                <div class="form-check">
                    <input
                        type="checkbox"
                        name="categories[]"
                        value="{{ $category->id }}"
                        class="form-check-input"
                        id="cat_{{ $category->id }}"

                        @isset($item)
                            @checked(
                                in_array(
                                    $category->id,
                                    old('categories', $item->categories->pluck('id')->toArray())
                                )
                            )
                        @else
                            @checked(in_array($category->id, old('categories', [])))
                        @endisset
                    >

                    <label class="form-check-label" for="cat_{{ $category->id }}">
                        {{ $category->name }}
                    </label>
                </div>
            @endforeach
    </div>
    <div class="form-group">
        <label for="product_image">Foto Item</label>
        <input type="file" name="preview_item" id="preview_item" class="form-control"
            accept="image/*"
            onchange="previewImage(event)">
        <img
            id="imagePreview"
            src="{{ $item->img_url ?? ''}}"
            alt="Preview"
            class="h-100 form-control mt-4"
            style="width:200px"
        >
    </div>
    <button class="btn btn-primary mt-3">Submit</button>

</form>