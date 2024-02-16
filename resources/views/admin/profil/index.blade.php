@extends('admin.layout.index')
@section('title', 'Profil')
@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Data Profil</p>
                        </div>
                    </div>
                    <div class="card-body" style="display: flex; align-items: center;">
                        <img src="assets/img/foto.jpg" class="img-thumbnail" style="width: 250px; margin-right: 20px;"
                            alt="...">
                        <div>
                            <h3 style="margin: 0;">Hafizul Fadli</h3>
                            <h6 style="margin: 0;">Web Programming</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection
