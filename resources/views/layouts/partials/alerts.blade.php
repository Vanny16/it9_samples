

@if (session('test'))
    <script>
        window.addEventListener('load', function() {

            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: @json(session('test')),
                footer: '<a href="#">Why do I have this issue?</a>'
            });
        });
    </script>
@endif

@if (session('success'))
    <script>
        window.addEventListener('load', function() {

            Swal.fire({
                title: "Custom width, padding, color, background.",
                width: 600,
                padding: "3em",
                color: "#716add",
                background: "#fff",
                backdrop: `
    rgba(0,0,123,0.4)
    url("{{ asset('images/cat.gif')  }}")
    center top
    no-repeat
  `
            });

        });
    </script>
@endif




@if (session('errorMessage'))
    <script>
        window.addEventListener('load', function() {
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: @json(session('errorMessage')),
                // footer: '<a href="#">Why do I have this issue?</a>'
            });
        });
    </script>
@endif

@if (session('successMessage'))
    <script>
        window.addEventListener('load', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: 'success',
                title: @json('SUCCESS! ' . session('successMessage'))
            });
        });
    </script>
@endif



@if (session('infoMessage'))
    <script>
        window.addEventListener('load', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: 'info',
                title: @json('INFO! ' . session('infoMessage'))
            });
        });
    </script>
@endif

@if (session('warningMessage'))
    <script>
        window.addEventListener('load', function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
            });

            Toast.fire({
                icon: 'warning',
                title: @json('WARNING! ' . session('warningMessage'))
            });
        });
    </script>
@endif
