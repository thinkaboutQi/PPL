@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Chat Admin</h2>
    <div class="card">
        <div class="card-body">
            <div class="mb-3">
                <label class="form-label">Admin</label>
                <input type="text" class="form-control" value="Admin" disabled>
            </div>
            <div class="border rounded p-3 mb-3" style="height: 350px; overflow-y: auto; background: #f8f9fa;">
                @php
                    $messages = \App\Models\Chat::where(function($q){
                        $q->where('from_id', auth()->id())->where('to_id', 1); // 1 diasumsikan id admin
                    })->orWhere(function($q){
                        $q->where('from_id', 1)->where('to_id', auth()->id());
                    })->orderBy('created_at')->get();
                @endphp
                @foreach($messages as $msg)
                    <div class="mb-2">
                        <span class="fw-bold">{{ $msg->from_id == auth()->id() ? 'Saya' : 'Admin' }}</span>:
                        <span>{{ $msg->message }}</span>
                        <small class="text-muted">({{ $msg->created_at->format('d-m-Y H:i') }})</small>
                    </div>
                @endforeach
            </div>
            <form method="POST" action="{{ route('user.chat.send') }}">
                @csrf
                <input type="hidden" name="to_id" value="1">
                <div class="input-group">
                    <input type="text" name="message" class="form-control" placeholder="Ketik pesan..." required>
                    <button class="btn btn-primary" type="submit">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
