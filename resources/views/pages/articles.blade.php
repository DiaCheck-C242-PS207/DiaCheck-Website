@extends('layouts.main')

@push('styles')
    @livewireStyles()

    <!-- Datatables -->
    <link rel="stylesheet" href="{{ url('https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ url('assets/css/article.css') }}">
@endpush

@section('content')
    @livewire('articles')
@endsection

@push('scripts')
    @livewireScripts()
    
    <!-- Datatables Js -->
    <script src="{{ url('https://code.jquery.com/jquery-3.7.1.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/2.1.8/js/dataTables.js') }}"></script>
    <script src="{{ url('https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        });

        function confirmDeleteArticle(articleId) {
            Swal.fire({
                icon: 'question',
                title: 'Are you sure?',
                text: 'Are you sure you want to delete this article?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                customClass: {
                    popup: 'bg-modal',
                    title: 'text-color',
                    htmlContainer: 'text-color fw-normal',
                    icon: 'border-orange primary-color',
                    closeButton: 'bg-secondary border-0 shadow-none',
                    confirmButton: 'bg-danger border-0 shadow-none',
                },
                reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-article-form-' + articleId).submit();
                }
            });
        }
    </script>
@endpush
