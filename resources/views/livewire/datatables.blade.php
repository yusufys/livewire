<div>
    <div class="row">
        <div class="col-4">
            <div class="input-group flex-nowrap">
                <span class="input-group-text" id="addon-wrapping">search</span>
                <input wire:model='searchKey' type="text" class="form-control" placeholder="" aria-label="Username"
                    aria-describedby="addon-wrapping">
            </div>
        </div>
        <div class="col-2">
            <div class="form-check">
                <input wire:model='filterStatus' class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    status
                </label>
            </div>
        </div>
    </div>
   <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col"><button wire:click='sortBy("name")'>name  @if($sortField == 'name' && $sortAsc ) <i class="fas fa-arrow-up"></i>  @else <i class="fas fa-arrow-down"></i>  @endif</button></th>
            <th scope="col"><button wire:click='sortBy("email")'>email @if($sortField == 'email' && $sortAsc ) <i class="fas fa-arrow-up"></i> @else <i class="fas fa-arrow-down"></i> @endif</button></th>
            <th scope="col">Handle</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $item)
            <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->status == 1 ? 'Active' : 'passive' }}</td>
            </tr>
        @endforeach

    </tbody>
</table>

{{ $users->links() }}
</div>
