<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Articles as ArticlesModel;
use Livewire\WithPagination;

class Articles extends Component
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
        }

        $this->resetPage();
    }

    public function render()
    {
        $query = ArticlesModel::where('title', 'like', '%'.$this->search.'%');
        $articles = $query->orderBy($this->sortField, $this->sortDirection)->paginate(6);

        return view('livewire.articles', [
            'articles' => $articles,
            'currentFilter' => $this->currentFilter,
        ]);
    }
}
