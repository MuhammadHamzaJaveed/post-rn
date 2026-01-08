<?php

return [
    'email' => env('APP_ENV') == 'production' ? 'livewire-test-emails' : 'livewire-test-'.config('app.env'),
];
