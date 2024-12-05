<div>
    <div class="predictions pb-5 mb-5">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
            <h2 class="fw-semibold py-0 my-0">Predictions</h2>
            <div class="actions d-flex gap-2">
                <div class="search-box">
                    <i class='bx bx-search'></i>
                    <input wire:model.live="search" class="ms-0 ps-1" type="search" id="search" placeholder="Search here..." autocomplete="off" style="outline: none !important; border: none;">
                    <div class="dropdown dropdown-menu-end">
                        <a class="d-flex align-items-center justify-content-center text-decoration-none p-0 m-0" style="cursor: pointer;" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false" title="Filter">
                            <i class='bx bx-slider p-0 m-0'></i>
                        </a>
    
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item {{ $currentFilter == 'Latest' ? 'active' : '' }}" wire:click="sortBy('latest')" style="cursor: pointer;">Latest</a></li>
                            <li><a class="dropdown-item {{ $currentFilter == 'Oldest' ? 'active' : '' }}" wire:click="sortBy('oldest')" style="cursor: pointer;">Oldest</a></li>
                            <li><a class="dropdown-item {{ $currentFilter == 'Percentage' ? 'active' : '' }}" wire:click="sortBy('percentage')" style="cursor: pointer;">Percentage</a></li>
                        </ul>
                    </div>
                </div>
    
                <a href="#" type="button" class="add-prediction-btn-1"
                    data-bs-toggle="modal" data-bs-target="#addPrediction" style="border-radius: 10px;">
                    <i class='bx bx-plus text-light fs-4 p-0 m-0'></i>
                </a>

                <a href="#" type="button" class="add-prediction-btn-2" style="display: none;"
                    data-bs-toggle="modal" data-bs-target="#addPrediction" style="border-radius: 10px;">
                    <i class='bx bx-plus text-light fs-4 p-0 m-0'></i>
                </a>
            </div>
        </div>
    
        <div class="row">
            @forelse ($predictions as $prediction)
                <div class="col-md-6 col-lg-4 g-3">
                    <div class="card h-100">
                        <div class="card-header py-3 my-0 d-flex justify-content-between">
                            <h5 class="text-color py-0 my-0">{{ $prediction->created_at->format('d-m-Y H:i') }} WIB</h5>
                            <form action="{{ route('predictions.destroy', $prediction->id) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="button" class="btn text-danger p-0 m-0" onclick="confirmDelete(this.form)">
                                    <i class='bx bx-trash p-0 m-0'></i>
                                </button>
                            </form>
                        </div>
                        <div class="card-body">
                            <h5 class="fw-bold {{ $prediction->prediction == 'Diabetes' ? 'primary-color' : 'text-color' }}">
                                {{ $prediction->prediction }}
                            </h5>
                            <p class="text-color">{{ number_format($prediction->probability, 2) }}%</p>
                            <p class="text-color fst-italic opacity-75">"{{ $prediction->message }}"</p>
                            <a href="{{ route('predictions.show', $prediction->id) }}" class="d-flex align-items-center justify-content-end gap-2 w-100 py-0 my-0" id="more-details-{{ $prediction->id }}">
                                More details <i class='bx bx-link-external'></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="position-absolute top-50 start-50 translate-middle">
                    <p class="text-center">No history available.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination-container d-flex justify-content-center">
            {{ $predictions->links() }}
        </div>
    </div>
</div>