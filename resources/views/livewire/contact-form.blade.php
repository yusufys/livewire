<div>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif
    <form action="" method="post" wire:submit.prevent='submitForm'>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Full name</label>
            {{$name}}
            <input wire:model.defer="name" name="name" type="text" class="form-control" id="exampleFormControlInput1"
                placeholder="Joe doe">
            @error('name')
            <p class="text-danger lead">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput2" class="form-label">Email address</label>
            <input wire:model.defer="email" name="email" type="text" class="form-control" id="exampleFormControlInput2"
                placeholder="name@example.com">
            @error('email')
            <p class="text-danger lead">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlInput3" class="form-label">Phone</label>
            <input wire:model.defer="phone" name="phone" type="text" class="form-control" id="exampleFormControlInput3"
                placeholder="name@example.com">
            @error('phone')
            <p class="text-danger lead">{{ $message }}</p>
            @enderror
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
            <textarea wire:model.defer="message" name="message" class="form-control" id="exampleFormControlTextarea1"
                rows="3"></textarea>
            @error('message')
            <p class="text-danger lead">{{ $message }}</p>
            @enderror
        </div>

        <button class="btn btn-success">

            Send
        </button>
    </form>
</div>