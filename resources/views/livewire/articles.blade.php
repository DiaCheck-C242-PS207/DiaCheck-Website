<div>
    <div class="articles pb-5 mb-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <h2 class="fw-semibold py-0 my-0">Articles</h2>
            <div class="actions d-flex gap-2">
                <div class="search-box">
                    <i class='bx bx-search'></i>
                    <input wire:model.live="search" class="ms-0 ps-1" type="search" id="search"
                        placeholder="Search here..." autocomplete="off" style="outline: none !important; border: none;">
                    <div class="dropdown dropdown-menu-end">
                        <a class="d-flex align-items-center justify-content-center text-decoration-none p-0 m-0"
                            style="cursor: pointer;" id="dropdownMenuLink" data-bs-toggle="dropdown"
                            aria-expanded="false" title="Filter">
                            <i class='bx bx-slider p-0 m-0'></i>
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item {{ $currentFilter == 'Latest' ? 'active' : '' }}"
                                    wire:click="sortBy('latest')" style="cursor: pointer;">Latest</a></li>
                            <li><a class="dropdown-item {{ $currentFilter == 'Oldest' ? 'active' : '' }}"
                                    wire:click="sortBy('oldest')" style="cursor: pointer;">Oldest</a></li>
                        </ul>
                    </div>
                </div>

                @if (Auth::user()->roles == 'admin')
                    <a href="{{ route('articles.create') }}" type="button"
                        class="add-article-btn-1 text-decoration-none" style="border-radius: 10px;">
                        <i class='bx bx-plus text-light fs-4 p-0 m-0'></i>
                    </a>

                    <a href="{{ route('articles.create') }}" type="button"
                        class="add-article-btn-2 text-decoration-none" style="border-radius: 10px; display: none;">
                        <i class='bx bx-plus text-light fs-4 p-0 m-0'></i>
                    </a>
                @endif
            </div>
        </div>

        @if (Auth::user()->roles == 'admin')
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="datatable" style="width: 100%">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Title</th>
                            <th class="text-nowrap">Author</th>
                            <th class="text-nowrap">Created At</th>
                            <th class="text-nowrap text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($articles as $item)
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td class="text-nowrap">{{ $item->user->name }}</td>
                                <td class="text-nowrap">{{ $item->created_at->format('d M Y') }}</td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center gap-2">
                                        <a href="{{ route('articles.edit', $item->slug) }}"
                                            class="d-flex align-items-center justify-content-center bg-warning border-0 p-2 text-decoration-none"
                                            style="border-radius: 10%;"><i
                                                class='bx bxs-pencil text-dark p-0 m-0'></i></a>
                                        <form id="delete-article-form-{{ $item->id }}"
                                            action="{{ route('articles.destroy', $item->id) }}" method="post"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')

                                            <button type="button"
                                                class="d-flex align-items-center justify-content-center bg-danger border-0 p-2"
                                                style="border-radius: 10%;"
                                                onclick="confirmDeleteArticle({{ $item->id }})">
                                                <i class='bx bxs-trash-alt text-light p-0 m-0'></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 g-md-4 mt-0 pt-0 mt-lg-2 mb-5">
            @forelse ($articles as $item)
                <div class="col mb-3 mb-md-0">
                    <div class="card h-100">
                        <a href="{{ route('articles.show', $item->slug) }}" class="h-100 text-decoration-none">
                            <div class="thumbnail">
                                <img src="{{ url('storage/thumbnails/' . $item->thumbnail) }}" alt="thumbnail"
                                    class="rounded-3 mb-3">
                            </div>
                            <h3 class="article-title mb-3">{{ $item->title }}</h3>
                        </a>

                        <hr class="bg-hr-modal">
                        <div class="footer d-flex justify-content-between align-items-center">
                            <div class="author d-flex align-items-center gap-1">
                                <div class="profile-author">
                                    @if (!empty($item->user->avatar))
                                        <img class="img"
                                            src="{{ asset('storage/avatars/' . $item->user->avatar) }}">
                                    @elseif (!empty($item->user->avatar_google))
                                        <img class="img" src="{{ $item->user->avatar_google }}">
                                    @else
                                        <img class="img"
                                            src="https://ui-avatars.com/api/?background=random&name={{ urlencode($item->user->name) }}">
                                    @endif
                                    <img class="img"
                                        src="https://ui-avatars.com/api/?background=random&name=DiaCheck">
                                </div>
                                <p class="my-0 py-0 fs-7 text-color">
                                    {{ $item->author ? $item->author : $item->user->name }}</p>
                            </div>
                            <p class="mb-0 text-secondary fs-7">
                                {{ Carbon\Carbon::parse($item->created_at)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>

            @empty
                <div class="position-fixed top-50 start-50 translate-middle">
                    <p class="text-center">Article not found.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination-container d-flex justify-content-center">
            {{ $articles->links() }}
        </div>
    </div>
</div>
