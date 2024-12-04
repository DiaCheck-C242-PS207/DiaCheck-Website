@extends('layouts.main')

@section('content')
    <div class="row pb-5 mb-5">
        <div class="d-flex gap-2">
            <a href="{{ route('profile.index') }}"><h2>Profile</h2></a>
            <h2>></h2>
            <h2 class="fw-semibold">History</h2>
        </div>
        @forelse ($histories as $history)
            <div class="col-md-4 g-3">
                <div class="card">
                    <div class="card-header py-3 my-0 d-flex justify-content-between">
                        <h5 class="text-color py-0 my-0">{{ $history->created_at->format('d-m-Y H:i') }} WIB</h5>
                        <form action="{{ route('history.destroy', $history->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn text-danger p-0 m-0" onclick="confirmDelete(this.form)">
                                <i class='bx bx-trash p-0 m-0'></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold {{ $history->prediction == 'Diabetes' ? 'primary-color' : 'text-color' }}">
                            {{ $history->prediction }}
                        </h5>
                        <p class="text-color">{{ number_format($history->probability, 2) }}%</p>
                        <p class="text-color fst-italic opacity-75">"{{ $history->message }}"</p>
                        <div class="more-details d-flex align-items-center justify-content-center mb-3">
                            <a href="#" class="text-color text-center w-100 py-0 my-0" id="more-details-{{ $history->id }}" onclick="toggleDetails({{ $history->id }})">More details</a>
                        </div>
                        <div class="more-detail-content mt-4" id="detail-content-{{ $history->id }}" style="display: none;">
                            <table class="table table-borderless text-color">
                                <tbody>
                                    <tr>
                                        <th class="fw-semibold" scope="row">Gender</th>
                                        <td>: {{ $history->gender == 1 ? 'Male' : 'Female' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold" scope="row">Age</th>
                                        <td>: {{ $history->age }} years old</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold" scope="row">Hypertension</th>
                                        <td>: {{ $history->hypertension == 1 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold" scope="row">Heart Disease</th>
                                        <td>: {{ $history->heart_disease == 1 ? 'Yes' : 'No' }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold" scope="row">BMI</th>
                                        <td>: {{ $history->bmi }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold" scope="row">HbA1c Level</th>
                                        <td>: {{ $history->HbA1c_level }}</td>
                                    </tr>
                                    <tr>
                                        <th class="fw-semibold" scope="row">Blood Glucose Level</th>
                                        <td>: {{ $history->blood_glucose_level }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="position-absolute top-50 start-50 translate-middle">
                <p class="text-center">No history available.</p>
            </div>
        @endforelse
    </div>
@endsection

@push('scripts')
    <script>
        function confirmDelete(form) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                customClass: {
                    popup: 'bg-modal',
                    title: 'text-color',
                    htmlContainer: 'text-color fw-normal',
                    icon: 'border-primary primary-color',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }

        function toggleDetails(id) {
            const detailContent = document.getElementById('detail-content-' + id);
            detailContent.style.display = detailContent.style.display === 'none' ? 'block' : 'none';
        }
    </script>
@endpush

