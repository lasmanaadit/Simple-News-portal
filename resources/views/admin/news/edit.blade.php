@extends('admin.master-admin')

@section('content')
<div class="container mt-4">
    <h3>Edit Berita</h3>
    <form action="{{ route('news.update', $news->id) }}" method="post">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Judul Berita</label>
            <input type="text" name="title" id="title"
                class="form-control @error('title') is-invalid @enderror"
                value="{{ old('title', $news->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Konten Berita</label>
            <textarea name="content" id="content"
                class="form-control @error('content') is-invalid @enderror"
                rows="5" required>{{ old('content', $news->content) }}</textarea>
            @error('content')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="{{ route('news.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
