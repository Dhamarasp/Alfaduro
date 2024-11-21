@extends('app')

@section('content')
<div class="container">
    @include('layouts/toast')
    @livewire('transaksi')
</div>
@endsection
