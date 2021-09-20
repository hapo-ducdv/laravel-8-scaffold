@extends('layouts.app')

@section('title', 'Login')

@section('content')
    @include('components._home')

    <div hidden id="modal-login" class="show-modal-login"></div>
@endsection
