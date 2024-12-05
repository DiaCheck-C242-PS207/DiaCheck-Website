@extends('layouts.main', ['active' => 'predictions', 'title' => 'Result - DiaCheck'])

@section('content')
    <div class="d-flex gap-2 mb-3">
        <a href="{{ route('predictions.index') }}">
            <h2 class="py-0 my-0">Predictions</h2>
        </a>
        <h2>></h2>
        <h2 class="fw-semibold py-0 my-0">Details</h2>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="text-color py-0 my-0">
                {{ $prediction->created_at->format('d-m-Y H:i') }} WIB
            </h5>
        </div>
        <div class="card-body">
            <h3 class="fw-bold {{ $prediction->prediction == 'Diabetes' ? 'primary-color' : 'text-color' }}">
                {{ $prediction->prediction }}
            </h3>
            <p class="text-color">
                {{ number_format($prediction->probability, 2) }}%
            </p>
            <p class="text-color fst-italic opacity-75">"{{ $prediction->message }}"</p>

            <div class="table-responsive">
                <table class="table table-prediction table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Hypertension</th>
                            <th>Heart Disease</th>
                            <th>BMI</th>
                            <th>HbA1c Level</th>
                            <th>Blood Glucose Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $prediction->gender == 1 ? 'Male' : 'Female' }}</td>
                            <td>{{ $prediction->age }}</td>
                            <td>{{ $prediction->hypertension == 1 ? 'Yes' : 'No' }}</td>
                            <td>{{ $prediction->heart_disease == 1 ? 'Yes' : 'No' }}</td>
                            <td>{{ number_format($prediction->bmi, 2) }}</td>
                            <td>{{ number_format($prediction->HbA1c_level, 2) }}</td>
                            <td>{{ number_format($prediction->blood_glucose_level, 2) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
