<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ApplicationIncompleteModal extends Component
{
    public $showModal = false;

    protected $listeners = ['showApplicationIncompleteModal' => 'openModal'];

    public function openModal()
    {
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function render()
    {
        return view('livewire.application-incomplete-modal');
    }
}