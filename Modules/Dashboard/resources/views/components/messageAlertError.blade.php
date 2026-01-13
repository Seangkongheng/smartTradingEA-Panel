@if(session('message') || session('error'))
    @push('alert-toast')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: '{{ session('error') ? 'error' : 'success' }}',
                    title: @json(session('error') ?? session('message')),
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    showClass: {
                        popup: 'animate__animated animate__slideInRight'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__slideOutLeft'
                    },
                    customClass: {
                        popup: 'rounded-lg text-sm shadow-md custom-toast-size',
                    }
                });
            });
        </script>
        <style>
            .custom-toast-size {
                width: 400px !important;
                height: auto !important;
                font-size: 1.125rem;
                padding: 1.5rem 2rem;
            }
        </style>
    @endpush
@endif
