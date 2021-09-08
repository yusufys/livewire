<?php

namespace Tests\Feature;

use App\Http\Livewire\Datatables as LivewireDatatables;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class DatatablesTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_can_main_page_contains_livewire_component()
    {
        $this->get('/datatables')->assertStatus(200)->assertSeeLivewire('datatables');
    }

    public function test_datatables_active_checkbox_works_correctly()
    {
        $userA = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'status' => true,
        ]);

        $userB = User::create([
            'name' => 'Another',
            'email' => 'another@another.com',
            'password' => bcrypt('password'),
            'status' => false,
        ]);
        Livewire::test(LivewireDatatables::class)
            ->assertSee($userA->name)
            ->assertDontSee($userB->name)
            ->set('filterStatus', false)
            ->assertSee($userB->name)
            ->assertSee($userA->name);
    }

    public function test_datatables_search_for_name_works_correctly()
    {
        $userA = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'status' => true,
        ]);

        $userB = User::create([
            'name' => 'Another',
            'email' => 'another@another.com',
            'password' => bcrypt('password'),
            'status' => false,
        ]);
        Livewire::test(LivewireDatatables::class)
            ->assertSee($userA->name)
            ->set('searchKey', $userA->name)
            ->assertDontSee($userB->name)
            ->assertSee($userA->name);
    }
    public function test_datatables_search_for_email_works_correctly()
    {
        $userA = User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => bcrypt('password'),
            'status' => true,
        ]);

        $userB = User::create([
            'name' => 'Another',
            'email' => 'another@another.com',
            'password' => bcrypt('password'),
            'status' => false,
        ]);
        Livewire::test(LivewireDatatables::class)
            ->assertSee($userA->email)
            ->set('searchKey', $userA->email)
            ->assertDontSee($userB->email)
            ->assertSee($userA->email);
    }
    // public function test_datatables_sort_name_asc_correctly()
    // {
    //     $userA = User::create([
    //         'name' => 'User',
    //         'email' => 'user@user.com',
    //         'password' => bcrypt('password'),
    //         'status' => true,
    //     ]);

    //     $userB = User::create([
    //         'name' => 'Another',
    //         'email' => 'another@another.com',
    //         'password' => bcrypt('password'),
    //         'status' => false,
    //     ]);
    //     Livewire::test(LivewireDatatables::class)
    //         ->call('sortBy', 'name')
    //         ->assertSeeInOrder(['User', 'Another',]);
    // }
}
