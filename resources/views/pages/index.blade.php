@extends('layouts.main')

@section('content')
    <h1>Hi, {{ Auth::user()->name }}👋</h1>
    <div class="row mt-4">
        @if ($prediction)
            <div class="col">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="fw-bold {{ $prediction->prediction == 'Diabetes' ? 'primary-color' : 'text-color' }}">
                            {{ $prediction->prediction }}
                        </h5>
                        <p class="text-color">{{ number_format($prediction->probability, 2) }}%</p>
                        <p class="text-color fst-italic opacity-75">"{{ $prediction->message }}"</p>
                    </div>
                </div>
            </div>
            
        @else
            <div class="col">
                <div class="card h-100">
                    <div class="card-body py-4">
                        <h5 class="text-color py-0 my-0 text-center">
                            You haven't checked yet
                        </h5>
                        <div class="d-grid gap-2 mt-3">
                            <a href="{{ route('predictions.index') }}" class="btn btn-primary text-semibold text-light">Check Now</a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
