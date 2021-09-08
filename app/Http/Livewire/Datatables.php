<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Datatables extends Component
{
    use WithPagination;
    public $searchKey;
    public $filterStatus = true;
    protected $paginationTheme = 'bootstrap';
    public $sortField;
    public $sortAsc = true;
    protected $queryString = ['searchKey', 'sortAsc', 'sortField', 'filterStatus'];
    public function updatingSearchKey()
    {
            $this->resetPage();
    }
    public function render()
    {
        $users = User::query()
            ->where(function ($squery) {
                $squery->where('name', 'like', '%' . $this->searchKey . '%')->orWhere('email','like', '%' . $this->searchKey . '%');
            })
            ->orderby($this->sortField ?: 'id', $this->sortAsc ? 'ASC' : 'DESC')
            ->where('status', $this->filterStatus);
        $users = $users->paginate(10);

        return view('livewire.datatables', ['users' => $users]);
    }

    public function sortBy($field)
    {
        if($this->sortField === $field){
            $this->sortAsc = !$this->sortAsc;
        }else{
            $this->sortAsc = true;
        }
        $this->sortField = $field;
    }
}
