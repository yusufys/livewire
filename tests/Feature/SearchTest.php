<?php

namespace Tests\Feature;

use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Str;
use App\Http\Livewire\SearchDropdown;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_search_results()
    {
        Livewire::test(SearchDropdown::class)
            ->AssertDontSee('John Lennon')
            ->set('searchKey', 'Imagine')
            ->AssertSee('John Lennon');
    }

    public function test_shows_message_if_no_results()
    {
        Livewire::test(SearchDropdown::class)
            ->set('searchKey', Str::random(64))
            ->AssertSee('there are no results');
    }
}
