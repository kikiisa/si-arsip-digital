@if (session()->has('success'))
    <div class="alert alert-success alert-dismissible show fade">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
@if (session()->has('error'))
    <div class="alert alert-error alert-dismissible show fade">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
<script src="{{ asset('assets/extensions/sweetalert2/sweetalert2.min.js') }}"></script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener("mouseenter", Swal.stopTimer);
                toast.addEventListener("mouseleave", Swal.resumeTimer);
            },
        });
    </script>
    @if ($errors->any())
    <script>
        var errors = @json($errors->all());
        Toast.fire({
            icon: 'error',
            title: errors.join('\n')
        });
    </script>
    @endif
    @if (session()->has('success'))
    <script>
        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        });
    </script>
    @endif
    @if (session()->has('error'))
    <script>
        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        });
    </script>
    @endif
