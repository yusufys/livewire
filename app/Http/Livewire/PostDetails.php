<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Post;
use Livewire\Component;

class PostDetails extends Component
{
    public $post;
    public $commentBody;
    protected $rules= ['commentBody' => ['min:4', 'required'], 'post' => ['required']];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.post-details');
    }

    public function postComment()
    {
        $this->validate();
        // $this->post->comments()->add();
        Comment::create(['body' => $this->commentBody, 'post_id' => $this->post->id]);
        $this->commentBody = '';
        $this->post->refresh();
        session()->flash('success', 'comment posted');
    }
}
