<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Predictions as PredictionsModel;
use Livewire\WithPagination;

class Predictions extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $numberOfPaginatorsRendered = [];
    public $search = '';

    // Filter
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $currentFilter = 'Latest';


    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($field == 'latest') {
            $this->sortField = 'created_at';
            $this->sortDirection = 'desc';
            $this->currentFilter = 'Latest';
        } elseif ($field == 'oldest') {
            $this->sortField = 'created_at';
            $this->sortDirection = 'asc';
            $this->currentFilter = 'Oldest';
        } elseif ($field == 'percentage') {
            $this->sortField = 'probability';
            $this->sortDirection = 'desc';
            $this->currentFilter = 'Percentage';
        }

        $this->resetPage();
    }

    public function render()
    {
        $predictions = PredictionsModel::where('user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('message', 'like', '%' . $this->search . '%')
                    ->orWhere('prediction', 'like', '%' . $this->search . '%')
                    ->orWhere('probability', 'like', '%' . $this->search . '%')
                    ->orWhere('created_at', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate(9);

        return view('livewire.predictions', [
            'predictions' => $predictions,
        ]);
    }
}

