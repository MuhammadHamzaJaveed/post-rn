<?php

namespace App\Http\Livewire\Components\FlashMessage;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class FlashMessage extends ModalComponent
{
    public $message;

    public $status;

    /**
     * @return Application|Factory|View
     */
    public function render()
    {
        return view('livewire.components.flash-message.flash-message');
    }
}
