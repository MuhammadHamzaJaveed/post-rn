<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class TopNav extends Component
{
    public $image;

    protected $listeners = [
        'refreshTopNavBar',
    ];

    public function mount()
    {
        $this->image = auth()->user()->image ? Storage::disk(auth()->user()->image->disk)->url(auth()->user()->image->path) : asset('images/account.png');
    }

    public function refreshTopNavBar()
    {
        $this->image = Storage::disk(auth()->user()->image->disk)->url(auth()->user()->image->path);
    }

    public function render()
    {
        return view('livewire.top-nav');
    }
}
