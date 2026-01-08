<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChallanStatusModal extends Component
{
    public $showModal = false;
    public $modalTitle = '';
    public $modalMessage = '';
    public $modalType = 'info'; // info, success, warning, error

    protected $listeners = ['showChallanModal' => 'openModal'];

    public function openModal($title, $message, $type = 'info')
    {
        $this->modalTitle = $title;
        $this->modalMessage = $message;
        $this->modalType = $type;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        // Reset values
        $this->modalTitle = '';
        $this->modalMessage = '';
        $this->modalType = 'info';
    }

    public function render()
    {
        return view('livewire.challan-status-modal');
    }
}