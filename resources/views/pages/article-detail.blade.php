@extends('layouts.article')

@push('styles')
    <link rel="stylesheet" href="{{ url('assets/css/article.css') }}">
    <style>
        ol li,
        ul li {
            color: #6c747c !important;
        }
    </style>
@endpush

@section('content')
    <nav class="navbar-detail sticky-top">
        <div class="container d-flex align-items-center justify-content-between py-2">
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('articles.index') }}" class="py-0 my-0 text-color" title="Back">
                    <i class='bx bx-arrow-back fw-semibold py-0 my-0 mt-1'></i>
                </a>
                <span class="py-0 my-0 fs-6 fw-semibold article-title-nav"
                    id="article-title-nav">{{ $article->title }}</span>
            </div>
            <div class="dark-mode">
                <button class="dark-mode-toggle"><i class='bx bx-sun'></i></button>
            </div>
        </div>
    </nav>

    <div class="thumbnail py-0 my-0">
        <img src="{{ url('storage/thumbnails/' . $article->thumbnail) }}" alt="thumbnail">
    </div>

    <div class="container bg-color px-3 px-md-5 mt-4">
        <h1 class="text-color fw-bold">{{ $article->title }}</h1>
        <hr class="bg-hr-modal">

        <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
            <div class="author d-flex gap-2">
                <div class="profile-image">
                    @if (!empty($article->user->avatar))
                        <img class="img" src="{{ asset('storage/avatars/' . $article->user->avatar) }}">
                    @elseif (!empty($article->user->avatar_google))
                        <img class="img" src="{{ $article->user->avatar_google }}">
                    @else
                        <img class="img"
                            src="https://ui-avatars.com/api/?background=random&name={{ urlencode($article->user->name) }}">
                    @endif
                </div>
                <div class="info d-flex flex-column">
                    <div class="author-name">
                        <p class="my-0 py-0 primary-color fw-semibold">{{ $author->name }}</p>
                    </div>
                    <a class="d-flex align-items-center gap-1 p-0 m-0 text-decoration-none"
                        onclick="viewDetails('{{ $article->id }}')" style="cursor: pointer;">
                        <p class="mb-0 text-secondary fs-7">Diperbarui pada
                            {{ Carbon\Carbon::parse($article->updated_at)->translatedFormat('d F Y, H:i') }} WIB</p>
                        <i class='bx bx-chevron-down text-secondary' id="icon-down-{{ $article->id }}"></i>
                        <i class='bx bx-chevron-up text-secondary' id="icon-up-{{ $article->id }}"></i>
                    </a>
                    <div class="view-details" id="view-details-{{ $article->id }}">
                        <p class="mb-0 text-secondary fs-7">Diterbitkan pada
                            {{ Carbon\Carbon::parse($article->created_at)->translatedFormat('d F Y, H:i') }} WIB</p>
                    </div>
                </div>
            </div>

            <div class="actions d-flex align-items-center justify-content-between gap-2">
                <div class="share">
                    <button onclick="shareToFacebook('{{ url('/article/' . $article->slug) }}')" class="facebook"
                        title="Share to Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </button>
                    <button onclick="shareToX('{{ url('/article/' . $article->slug) }}', '{{ $article->title }}')"
                        class="x" title="Share to X">
                        <i class="fa-brands fa-x-twitter"></i>
                    </button>
                    <button onclick="shareToEmail('{{ url('/article/' . $article->slug) }}', '{{ $article->title }}')"
                        class="email" title="Share to Email">
                        <i class="fa-solid fa-envelope"></i>
                    </button>
                    <button onclick="copyLink('{{ $article->id }}')" class="copy-link-btn"
                        id="copy-link-btn-{{ $article->id }}" title="Copy Link">
                        <p class="copy-link-text p-0 m-0 fs-7" id="copy-link-text-{{ $article->id }}">
                            <i class="fa-solid fa-copy"></i>
                        </p>
                        <input type="text" id="copy-link-{{ $article->id }}"
                            value="{{ url('/article/' . $article->slug) }}" hidden>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-cols-1 g-0 mb-5 pb-5">
        <div class="col article-body">
            <div class="container px-3 px-md-5">
                <div class="thumbnail">
                    <img src="{{ url('storage/thumbnails/' . $article->thumbnail) }}" alt="thumbnail"
                        class="rounded-2 mb-5">
                </div>
                <div class="px-0 mx-0 text-break">
                    {!! $article->body !!}
                </div>
            </div>
        </div>
    </div>
@endsection
