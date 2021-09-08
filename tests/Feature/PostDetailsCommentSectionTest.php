<?php

namespace Tests\Feature;

use App\Http\Livewire\PostDetails;
use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PostDetailsCommentSectionTest extends TestCase
{
    /** @test */
    public function main_page_contains_posts()
    {
        $post = Post::create([
            'title' => 'My First Post',
            'contents' => 'Content here',
        ]);

        $this->get('/posts')
            ->assertSee('My First Post');
    }

    /** @test */
    public function post_page_contains_comments_livewire_component()
    {
        $post = Post::create([
            'title' => 'My First Post',
            'contents' => 'Content here',
        ]);

        $this->get(route('posts', $post->id))
            ->assertSeeLivewire('post-details');
    }

    /** @test */
    public function valid_comment_can_be_posted()
    {
        $post = Post::create([
            'title' => 'My First Post',
            'contents' => 'Content here',
        ]);

        Livewire::test(PostDetails::class)
            ->set('post', $post)
            ->set('commentBody', 'This is my comment')
            ->call('postComment')
            ->assertSee('comment posted')
            ->assertSee('This is my comment');
    }


    /** @test */
    public function comment_is_required()
    {
        $post = Post::create([
            'title' => 'My First Post',
            'contents' => 'Content here',
        ]);

        Livewire::test(PostDetails::class)
            ->set('post', $post)
            ->call('postComment')
            ->assertHasErrors(['commentBody' => 'required'])
            ->assertSee('The comment body must be at least 4 characters');
    }

    /** @test */
    public function comment_requires_min_characters()
    {
        $post = Post::create([
            'title' => 'My First Post',
            'contents' => 'Content here',
        ]);
        Livewire::test(PostDetails::class)
            ->set('post', $post)
            ->set('commentBody', 'c')
            ->call('postComment')
            ->assertHasErrors(['commentBody' => 'min'])
            ->assertSee('The comment body must be at least 4 characters');
    }
}
