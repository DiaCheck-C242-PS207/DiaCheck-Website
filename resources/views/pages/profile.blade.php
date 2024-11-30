@extends('layouts.main')

@section('content')
    <div class="container-edit-akun pb-5">
        <h2 class="fw-semibold">Profile</h2>
        <div class="row row-cols-1 row-cols-lg-2 pb-5 g-3">
            <div class="col col-lg-4">
                <div class="card">
                    <div class="card-body d-flex flex-column gap-4 py-4">
                        <figure class="profile d-flex flex-column justify-content-center align-items-center gap-3">
                            <div class="foto-profile">
                                @if (!empty(Auth::user()->avatar))
                                    <img class="img" src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}">
                                @elseif (!empty(Auth::user()->avatar_google))
                                    <img class="img" src="{{ Auth::user()->avatar_google }}">
                                @else
                                    <img class="img"
                                        src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name) }}">
                                @endif
                            </div>
                            <figcaption class="text-color text-center fw-semibold w-75">{{ Auth::user()->name }}
                            </figcaption>
                        </figure>

                        <div class="profile-details table-responsive">
                            <table class="table">
                                <tr>
                                    <td>Username</td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>:</td>
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col col-lg-8 d-flex flex-column gap-2">
                <div class="edit-profile py-4" data-bs-toggle="modal" data-bs-target="#edit-profile">
                    <a href="#" class="row d-flex justify-content-between text-decoration-none">
                        <div class="col d-flex align-items-center gap-3">
                            <i class='bx bxs-user text-color fs-2 icon'></i>
                            <h5 class="text-color py-0 my-0">Edit profile</h5>
                        </div>
                    </a>
                </div>

                <a id="logout-confirmation" href="{{ route('logout') }}" class="logout text-decoration-none py-4"
                    onclick="event.preventDefault(); logout();">
                    <div class="row d-flex justify-content-between">
                        <div class="col d-flex align-items-center gap-3">
                            <i class='bx bx-arrow-from-left text-color fs-2 icon'></i>
                            <h5 class="text-color py-0 my-0 fw-bold">Logout</h5>
                        </div>
                    </div>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="edit-profile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-body-dark">
            <div class="modal-content">
                <div class="modal-header border-0 d-flex align-items-center justify-content-between">
                    <h5 class="modal-title" id="edit-profile-label">Edit profile</h5>
                    <div class="close-btn" data-bs-dismiss="modal" aria-label="Close" style="cursor: pointer;">
                        <i class='bx bx-x text-color fs-2 icon'></i>
                    </div>
                </div>
                <div class="reset-btn">
                    <form id="reset-avatar-form-{{ $user->id }}"
                        action="{{ route('profile.delete.avatar', $user->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="button" onclick="resetAvatar({{ $user->id }})">Delete</button>
                    </form>
                </div>

                <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf @method('PUT')

                    <div class="modal-body">
                        <figure class="profile d-flex flex-column justify-content-center align-items-center gap-3 mb-4">
                            <div class="foto-profile">
                                @if (!empty(Auth::user()->avatar))
                                    <img class="img-avatar" id="img-avatar"
                                        src="{{ asset('storage/avatars/' . Auth::user()->avatar) }}">
                                @elseif (!empty(Auth::user()->avatar_google))
                                    <img class="img-avatar" id="img-avatar" src="{{ Auth::user()->avatar_google }}">
                                @else
                                    <img class="img-avatar" id="img-avatar"
                                        src="https://ui-avatars.com/api/?background=random&name={{ urlencode(Auth::user()->name) }}">
                                @endif
                            </div>
                        </figure>
                        <label for="upload-foto" class="mb-2">Upload foto (jpg, jpeg, png, dan webp)</label>
                        <input type="file" class="form-control" name="avatar" id="upload-foto"
                            accept=".jpg, .jpeg, .png, .webp">


                        <div class="edit-username-error-message-container d-flex align-items-center gap-2 mb-2 mt-3">
                            <label for="edit-username">Username</label>
                            <p class="text-danger fw-bolder py-0 my-0" id="edit-profile-error-message-username">
                            </p>
                        </div>
                        <input type="text" class="form-control text-color" name="name" id="edit-username"
                            placeholder="Enter username" value="{{ Auth::user()->name }}" autocomplete="off"
                            required>
                    </div>

                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary px-4" id="save-edit-profile-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End -->
@endsection


@push('scripts')
    <script>
        function resetAvatar(userId) {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: 'Are you sure you want to delete this avatar?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                customClass: {
                    popup: 'bg-modal',
                    title: 'text-color',
                    htmlContainer: 'text-color fw-normal',
                    icon: 'border-primary primary-color',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reset-avatar-form-' + userId).submit();
                }
            });
        }
    </script>
@endpush
