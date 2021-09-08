<div>
    <h1>
        {{ $post->title }}
    </h1>
    <p>
        {{ $post->contents }}
    </p>


    @if($post->comments->count() > 0)
        <hr>
        <h3>Comments</h3>
        <ul>
            @foreach ($post->comments as $comment)
                <li>{{ $comment->body }}</li>
            @endforeach
        </ul>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form method="post" wire:submit.prevent='postComment'>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Write comment</label>
                        <input wire:model.defer="commentBody" name="commentBody" type="text" class="form-control" id="exampleFormControlInput1"
                            placeholder="Joe doe">
                        @error('commentBody')
                        <p class="text-danger lead">{{ $message }}</p>
                        @enderror
                    </div>
            </div>
            <div class="col-12">
                <button class="btn btn-success">
                    <small wire:loading wire:target='postComment'>LOADING</small>
                    Post comment
                </button>
            </div>
        </div>
    </form>
</div>
