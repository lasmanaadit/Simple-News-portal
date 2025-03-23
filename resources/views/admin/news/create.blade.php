@extends('admin.master-admin')
@section('page-style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection
@section('page-script')
    <script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#content').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImage(files[0])
                    }
                }
            })

            function uploadImage(files) {
                var formdata = new FormData();
                formdata.append('image', files);

                $.ajax({
                    url: "{{ route('news.uploadImage') }}",
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formdata,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.url) {
                            $('#content').summernote('insertImage', response.url);
                            $('#image').val(response.filename);
                        }
                    }
                });
            }
        });
    </script>
@endsection
@section('content')
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Entri Berita</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Entri Berita</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content Header-->
    <!--begin::App Content-->
    <div class="app-content">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Entri Berita</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data"
                                novalidate>
                                @csrf
                                <div class="mb-4">
                                    <label for="title" class="form-label">Judul</label>
                                    <input type="text" name="title" id="title"
                                        class="form-control @error('title') is-invalid
                                    @enderror"
                                        placeholder="Judul Berita" value="{{ old('title') }}" required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="category">Kategori</label>
                                    <select name="category"
                                        class="form-control @error('category')
                                        is-invalid
                                    @enderror"
                                        id="category">
                                        @foreach ($category as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="content">Isi Berita</label>
                                    <textarea name="content" id="content" cols="30" rows="10"></textarea>
                                </div>
                                <input type="hidden" name="image" id="image" value="{{ old('image') }}">
                                <div class="mb-4">
                                    <button type="submit" id="btn-save" name="btnSave"
                                        class="btn btn-success">Simpan</button>
                                    <a href="{{ url('admin/news') }}" id="btn-cancel" name="btnCancel"
                                        class="btn btn-secondary float-end">Batal</a>
                                </div>
                            </form>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::App Content-->
@endsection
