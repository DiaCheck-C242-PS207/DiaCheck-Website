@extends('layouts.main', ['active' => 'predictions', 'title' => 'Result - DiaCheck'])

@section('content')
    <div class="d-flex gap-2">
        <a href="{{ route('predictions.index') }}">
            <h2>Predictions</h2>
        </a>
        <h2>></h2>
        <h2 class="fw-semibold">Result</h2>
    </div>

    @if ($prediction)
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 g-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="fw-bold {{ $prediction == 'Diabetes' ? 'primary-color' : 'text-color' }}">
                            {{ $prediction['prediction'] == 1 ? 'Diabetes' : 'No Diabetes' }}
                        </h5>
                        <p class="text-color">
                            @foreach ($prediction['probabilities'] as $probability)
                                @foreach ($probability as $value)
                                    {{ number_format(floatval($value) * 100, 2) }}%
                                @endforeach
                            @endforeach
                        </p>
                        <p class="text-color fst-italic opacity-75">"{{ $message }}"</p>
                        <a href="{{ route('history.index') }}" class="d-flex align-items-center justify-content-end gap-1">More details <i class='bx bx-link-external'></i></a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
