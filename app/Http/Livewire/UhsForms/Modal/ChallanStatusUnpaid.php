<?php

namespace App\Http\Livewire\UhsForms\Modal;

use LivewireUI\Modal\ModalComponent;

class ChallanStatusUnpaid extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render()
    {
        return view('livewire.uhs-forms.modal.challan-status-unpaid');
    }
}
