@extends('admin.layout.index')
@section('title', 'Produk')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Data Produk</p>
                            <div class="ms-auto">
                                <button class="btn btn-transparant btn-sm dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Filter Data
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="{{ route('produk.index') }}">Semua</a>
                                    </li>
                                    @foreach ($kategori as $k)
                                        <li><a class="dropdown-item"
                                                href="{{ route('produk.kategori', $k->id) }}">{{ $k->nama_kategori }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="{{ route('exportexcel') }}" target="_blank"
                                    class="btn btn-success btn-sm">Export</a>
                                <a href="{{ route('produk.create') }}" class="btn btn-primary btn-sm ms-2">Tambah</a>
                            </div>
                        </div>

                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-xs">No</th>
                                        <th class="text-uppercase text-xs">Image</th>
                                        <th class="text-uppercase text-xs">Nama Produk</th>
                                        <th class="text-uppercase text-xs">Kategori Produk</th>
                                        <th class="text-uppercase text-xs">Harga Beli </th>
                                        <th class="text-uppercase text-xs">Harga Jual</th>
                                        <th class="text-uppercase text-xs">Stok</th>
                                        <th class="text-uppercase text-xs">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table_body">
                                    @foreach ($produk as $data)
                                        <tr>
                                            <td align="center">{{ $loop->iteration }}</td>
                                            <td align="center"> <img src="{{ url('image/' . $data->image) }}" alt=""
                                                    srcset="" style="width: 30px;"></td>
                                            <td>{{ $data->nama_produk }}</td>
                                            <td>{{ $data->nama_kategori }}</td>
                                            <td>{{ number_format($data->harga_beli, 0, ',', '.') }}</td>
                                            <td>{{ number_format($data->harga_jual, 0, ',', '.') }}</td>

                                            <td>{{ $data->stok }}</td>
                                            <td align="center">
                                                <a href="{{ route('produk.edit', $data->id) }}"
                                                    class="btn btn-link text-primary text-gradient px-1 mb-0"><i
                                                        class="fas fa-pencil-alt text-dark me-2"></i></a>
                                                <form id="delete-form-{{ $data->id }}"
                                                    action="{{ route('produk.destroy', $data->id) }}" method="POST"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-link text-danger text-gradient px-1 mb-0"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                        <i class="far fa-trash-alt text-dark me-2"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
