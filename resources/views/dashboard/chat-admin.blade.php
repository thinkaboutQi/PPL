@extends('layouts.appadmin')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Chat Customer</h2>
    <div class="card">
        <div class="card-body">
            <form method="GET" action="">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="user_id" class="form-label">Pilih User</label>
                        <select name="user_id" id="user_id" class="form-select" onchange="this.form.submit()">
                            <option value="">-- Pilih User --</option>
                            @foreach(\App\Models\User::where('role', '!=', 'admin')->get() as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
            @if(request('user_id'))
                <div class="border rounded p-3 mb-3" style="height: 350px; overflow-y: auto; background: #f8f9fa;">
                    @php
                        $messages = \App\Models\Chat::where(function($q){
                            $q->where('from_id', auth()->id())->where('to_id', request('user_id'));
                        })->orWhere(function($q){
                            $q->where('from_id', request('user_id'))->where('to_id', auth()->id());
                        })->orderBy('created_at')->get();
                    @endphp
                    @foreach($messages as $msg)
                        <div class="d-flex mb-2 {{ $msg->from_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                            <div class="p-2 rounded"
                                style="max-width: 70%;
                                    background: {{ $msg->from_id == auth()->id() ? '#1E388D' : '#e9ecef' }};
                                    color: {{ $msg->from_id == auth()->id() ? '#fff' : '#333' }};
                                    box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                                <div class="fw-bold mb-1" style="font-size: 0.95em;">
                                    {{ $msg->from_id == auth()->id() ? 'Admin' : $msg->from->name }}
                                </div>
                                <div style="white-space: pre-line;">{{ $msg->message }}</div>
                                <div class="text-end" style="font-size: 0.8em; color: #bbb;">
                                    {{ $msg->created_at->format('d-m-Y H:i') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <form method="POST" action="{{ route('admin.chat.send') }}">
                    @csrf
                    <input type="hidden" name="to_id" value="{{ request('user_id') }}">
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Ketik pesan..." required>
                        <button class="btn btn-primary" type="submit">Kirim</button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
