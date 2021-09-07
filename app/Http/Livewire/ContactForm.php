<?php

namespace App\Http\Livewire;

use App\Mail\Email;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{
    public $successMessage;
    public $name;
    public $email;
    public $phone;
    public $message;
    protected $rules = [
            'email' => 'email|required',
            'name' => 'required',
            'phone' => 'numeric|required',
            'message' => ['required', 'min:10']
    ];
    // updated hook/event
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function render()
    {
        return view('livewire.contact-form');
    }

    public function submitForm()
    {
        $result = $this->validate();
        Mail::to($this->email)->send(new Email($this->email));

        // Contanct->create($result);
        $this->resetForm();
        session()->flash('message', 'successfully sent');
    }

    public function resetForm()
    {
        $this->email = '';
        $this->name = '';
        $this->message = '';
        $this->phone = '';
    }
}
