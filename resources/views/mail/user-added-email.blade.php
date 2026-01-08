@extends('layouts.mail')

@section('content')
    <div class="email-inner">
        <p class="main-heading">Livewire</p>
        <p class="email-text">
            Subject: New User Email Verification Success! </span>,
        </p>
        <p class="email-text">
            Dear <span class="">{{ $data['name'] ?: '' }}</span>,
        </p>
        <p class="email-text">
            A new user ({{ $data['currentUserName'] ?: '' }}) has successfully verified their email (<span>{{ $data['email'] ?: '' }})</span> address and is now officially a member of CPAT.
        </p>
    </div>
@endsection
