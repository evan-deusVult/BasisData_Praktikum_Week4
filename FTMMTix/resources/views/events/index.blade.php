@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Events</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($events as $event)
            <div class="col-md-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ $event->description }}</p>
                        <a href="{{ route('admin.events.show', $event->id) }}" class="btn btn-primary">View</a>
                        @if(auth()->user() && auth()->user()->role === 'admin')
                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{ $events->links() }}
</div>
@endsection