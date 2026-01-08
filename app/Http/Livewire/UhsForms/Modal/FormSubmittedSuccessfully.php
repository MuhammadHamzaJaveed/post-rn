<?php

namespace App\Http\Livewire\UhsForms\Modal;

use LivewireUI\Modal\ModalComponent;

class FormSubmittedSuccessfully extends ModalComponent
{
    public static function modalMaxWidth(): string
    {
        return 'xl';
    }

    public function render()
    {
        return view('livewire.uhs-forms.modal.form-submitted-successfully');
    }
}
