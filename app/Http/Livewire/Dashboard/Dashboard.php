<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class Dashboard extends Component
{
    /**
     * @return mixed
     */
    public function render()
    {
        return view('livewire.dashboard.dashboard')
            ->extends('layouts.app')
            ->section('content');
    }
}
