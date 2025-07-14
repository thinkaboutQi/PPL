@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4 fw-bold">Dashboard</h2>
        @include('dashboard.invoice-user-section')
    </div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Welcome to User Dashboard</h1>
    <p>This is the user dashboard.</p>
</div>
@endsection
