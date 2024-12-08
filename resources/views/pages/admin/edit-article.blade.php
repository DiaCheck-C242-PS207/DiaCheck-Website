@extends('layouts.main')

@push('styles')
    <link rel="stylesheet" href="{{ url('https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/article.css') }}">
@endpush

@section('content')
    <div class="title d-flex align-items-center gap-2 mb-4">
        <a href="{{ route('articles.index') }}" class="text-color d-flex align-items-center text-decoration-none" title="Back">
            <i class='bx bx-arrow-back fs-3'></i>
        </a>
        <h3 class="text-color fw-bold my-0 py-0">Edit Artikel</h3>
    </div>

    <form action="{{ route('articles.update', $article->id) }}" method="post" enctype="multipart/form-data" class="create-article d-flex flex-column gap-3 pb-5 mb-5">
        @csrf @method('PUT')

        <!-- Assets -->
        <div class="card">
            <div class="card-body p-3 p-lg-4">
                <h3 class="text-color">Assets</h3>
                <hr class="bg-hr-modal">
                <div class="mb-3">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control @error('thumbnail') is-invalid @enderror" accept=".jpg, .jpeg, .png, .webp">
                    @error('thumbnail')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Data -->
        <div class="card">
            <div class="card-body p-3 p-lg-4">
                <h3 class="text-color">Data</h3>
                <hr class="bg-hr-modal">
                <div class="mb-3">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $article->title }}" placeholder="Enter title" required>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="body">Content</label>
                    <textarea name="body" id="body">{{ $article->body }}</textarea>
                </div>
            </div>
        </div>

        <div class="d-grid d-md-flex justify-content-md-end w-100">
            <button class="btn btn-primary px-4 py-2" type="submit">Update</button>
        </div>
    </form>
@endsection

@push('scripts')
    <script src="{{ url('https://code.jquery.com/jquery-3.4.1.slim.min.js') }}" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

    <script type="importmap">
        {
            "imports": {
                "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.2/ckeditor5.js",
                "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.2/"
            }
        }
    </script>
    <script type="module" src="{{ url('assets/js/ckeditor.js') }}"></script>
@endpush

