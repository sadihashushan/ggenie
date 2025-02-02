<?php

namespace App\Livewire;

use App\Models\Supermarket;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

#[Title ('Supermarkets - GroceryGenie')]
class SupermarketsPage extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $supermarketQuery = Supermarket::query();
        return view('livewire.supermarkets-page', [
            'supermarkets' => $supermarketQuery->paginate(6)
        ]);
    }
}
