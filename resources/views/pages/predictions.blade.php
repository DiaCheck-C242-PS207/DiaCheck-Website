@extends('layouts.main')

@push('styles')
    @livewireStyles()
@endpush

@section('content')
    @livewire('predictions')

    <!-- Modal -->
    <div class="modal fade" id="addPrediction" tabindex="-1" aria-labelledby="addPredictionLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title" id="addPredictionLabel">Add Prediction</h5>
                    <i type="button" class="bx bx-x text-color fs-2" data-bs-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/predictions">
                        @csrf
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender:</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="0" {{ old('gender', 0) == 0 ? 'selected' : '' }}>Female</option>
                                <option value="1" {{ old('gender', 0) == 1 ? 'selected' : '' }}>Male</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="age" class="form-label">Age:</label>
                            <input type="number" id="age" name="age" step="1" class="form-control"
                                placeholder="Enter your age" required>
                        </div>

                        <div class="mb-3 d-flex gap-2 w-100">
                            <div class="hypertension w-100">
                                <label for="hypertension" class="form-label">Hypertension:</label>
                                <select class="form-select" id="hypertension" name="hypertension" required>
                                    <option value="0" {{ old('hypertension', 0) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('hypertension', 0) == 1 ? 'selected' : '' }}>Yes</option>
                                </select>
                            </div>

                            <div class="heart_disease w-100">
                                <label for="heart_disease" class="form-label">Heart Disease:</label>
                                <select class="form-select" id="heart_disease" name="heart_disease" required>
                                    <option value="0" {{ old('heart_disease', 0) == 0 ? 'selected' : '' }}>No</option>
                                    <option value="1" {{ old('heart_disease', 0) == 1 ? 'selected' : '' }}>Yes
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="bmi" class="form-label">BMI:</label>
                            <input type="number" id="bmi" name="bmi" step="0.01" class="form-control"
                                placeholder="Enter your BMI ex.23" required>
                        </div>

                        <div class="mb-3">
                            <label for="HbA1c_level" class="form-label">HbA1c Level:</label>
                            <input type="number" id="HbA1c_level" name="HbA1c_level" step="0.01"
                                class="form-control" placeholder="Enter your HbA1c level ex.6.5" required>
                        </div>

                        <div class="mb-3">
                            <label for="blood_glucose_level" class="form-label">Blood Glucose Level:</label>
                            <input type="number" id="blood_glucose_level" name="blood_glucose_level" step="1"
                                class="form-control" placeholder="Enter your blood glucose level ex.100" required>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-4 py-2 mt-2 w-100">Predict</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div style="color: red;">
            <h4>Error:</h4>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection

@push('scripts')
    @livewireScripts()

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
