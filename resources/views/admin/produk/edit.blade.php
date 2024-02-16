@extends('admin.layout.index')
@section('title', 'Produk')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Edit Produk</p>

                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Kategori</label>
                                        <select name="id_kategori" class="form-control" id="">
                                            @foreach ($kategori as $k)
                                                <option value="{{ $k->id }}"
                                                    {{ $k->id == $produk->id_kategori ? 'selected' : '' }}>
                                                    {{ $k->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Nama Produk</label>
                                        <input class="form-control @error('nama_produk  ') is-invalid @enderror"
                                            name="nama_produk" type="text" placeholder="nama produk"
                                            value="{{ $produk->nama_produk }}">
                                        <div class="invalid-feedback">
                                            @error('nama_produk ')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Harga Beli</label>
                                        <input class="form-control @error('harga_beli') is-invalid @enderror"
                                            name="harga_beli" type="text" placeholder="harga_beli"
                                            value="{{ $produk->harga_beli }}">
                                        <div class="invalid-feedback">
                                            @error('harga_beli')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Harga Jual</label>
                                        <input class="form-control @error('harga_jual') is-invalid @enderror"
                                            name="harga_jual" type="text" placeholder="harga jual" readonly
                                            value="{{ $produk->harga_jual }}">
                                        <div class="invalid-feedback">
                                            @error('harga_jual')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Stok</label>
                                        <input class="form-control @error('stok') is-invalid @enderror" name="stok"
                                            type="text" placeholder="stok" value="{{ $produk->stok }}">
                                        <div class="invalid-feedback">
                                            @error('stok')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Image</label>
                                        <input class="form-control @error('image') is-invalid @enderror" name="image"
                                            type="file" placeholder="Passing Grade">
                                        <div class="invalid-feedback">
                                            @error('image')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="/produk" class="btn btn-dark btn-sm ms-auto ">Kembali</a>
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var hargaBeliInput = document.querySelector('input[name="harga_beli"]');
        var hargaJualInput = document.querySelector('input[name="harga_jual"]');

        hargaBeliInput.addEventListener('input', function() {
            var hargaBeli = parseFloat(hargaBeliInput.value);

            var hargaJual = hargaBeli + (hargaBeli * 0.3);

            hargaJualInput.value = hargaJual.toFixed(0);
        });
    </script>

@endsection
