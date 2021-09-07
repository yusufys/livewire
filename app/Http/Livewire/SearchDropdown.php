<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Str;

class SearchDropdown extends Component
{
    public $searchKey;
    public $noResults = false;
    public $results = [];
    public function updatedSearchKey($newValue)
    {
        if(strlen($this->searchKey) <= 2){
            $this->results = [];
            return;
        }
        $response = Http::get('https://itunes.apple.com/search?term=' . $this->searchKey . '&limit=10');
        $this->results = $response->json()['results'];
        if(count($this->results) < 1){
            $this->noResults = true;
        }
    }
    public function render()
    {
        return view('livewire.search-dropdown');
    }
}
