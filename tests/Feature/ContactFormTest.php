<?php

namespace Tests\Feature;

use App\Http\Livewire\ContactForm;
use App\Mail\Email;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    /** @test */
    public function contact_form_sends_mail()
    {
        Mail::fake();

        Livewire::test(ContactForm::class)
            ->set('name', 'Yusuf')
            ->set('email', 'yusuf@gmail.com')
            ->set('phone', '32507295327')
            ->set('message', 'LOOOOLOOOOLOOOL')
            ->call('submitForm')
            ->assertSee('successfully sent');

        Mail::assertSent(function (Email $mail) {
            $mail->build();
            return $mail->hasTo('yusuf@gmail.com');
        });
    }
    /** @test */
    public function contact_name_field_is_required()
    {
        Livewire::test(ContactForm::class)
            ->set('email', 'yusuf@gmail.com')
            ->set('phone', '32507295327')
            ->set('message', 'LOOOOL')
            ->call('submitForm')
            ->assertHasErrors(['name' => 'required']);
    }
    /** @test */
    public function message_is_ten_char_min()
    {
        Livewire::test(ContactForm::class)
            ->set('email', 'yusuf@gmail.com')
            ->set('phone', '32507295327')
            ->set('message', 'LOOOOL')
            ->call('submitForm')
            ->assertHasErrors(['message' => 'min']);
    }
    /** @test */
    public function it_can_main_page_contains_livewire_component()
    {
        $this->get('/contact-form')->assertStatus(200)->assertSeeLivewire('contact-form');
    }
}
