<div class="container">
    <div class="row">
        <form action="">
            <div class="col-12">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Search key</label>
                    <input wire:model.debounce.300ms="searchKey" name="searchKey" type="search" class="form-control" id="exampleFormControlInput1"
                        placeholder="Joe doe">
                    @error('searchKey')
                    <p class="text-danger lead">{{ $message }}</p>
                    @enderror
                </div>
                
            </div>
        </form>
        @if($noResults === true)
            <div class="alert alert-danger">
                there are no results
            </div>
        @endif
        @if(count($results) > 0)
            <div class="row">
                @foreach ($results as $song)
                   <div class="col-4">
                       <img src="{{ $song['artworkUrl60']  ?? "#"  }}" class="img-fluid" alt="">
                        <a href=" {{ $song['artworkUrl60']  ?? "#"}}">
                            <h3>{{ $song['trackName'] ?? "-" }}</h3>
                        </a>
                        <p>
                            {{ $song['artistName']  ?? "No Name"}}
                        </p>
                   </div>
                @endforeach
            </div>
        @endif
     
    </div>
</div>
