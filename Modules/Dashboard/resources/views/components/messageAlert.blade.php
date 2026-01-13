@if(session('message'))
    @push('alert-toast')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: @json(session('message')),
                    showConfirmButton: false,
                    timer: 2000,
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
                height: 100px !important;
                font-size: 1.125rem;
                padding: 1.5rem 2rem;
            }
        </style>
    @endpush
@endif
