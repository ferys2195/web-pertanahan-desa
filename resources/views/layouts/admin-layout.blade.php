<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/templates/admin-kit/img/icons/icon-48x48.png') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>@yield('title', 'Administrator') | {{ env('APP_NAME') }}</title>

    <link href="{{ asset('assets/templates/admin-kit/css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    @stack('head')
</head>

<body>
    <div class="wrapper">
        <x-admin-side-bar />

        <div class="main">
            <x-admin-top-bar />

            <main class="content">
                @if (session('success'))
                    <div class="alert alert-info alert-dismissible show fade">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <div class="container-fluid p-0">
                    <h1 class="h3 mb-3"><strong>@yield('title')</strong></h1>
                    @yield('content')
                </div>
            </main>
            <footer class="footer">
                <x-admin-footer />
            </footer>
        </div>

        {{-- Logout --}}
        <form action="{{ route('admin.logout') }}" method="post" id="form-logout">
            @csrf
        </form>
        {{-- End of Logout --}}
    </div>

    <script src="{{ asset('assets/templates/admin-kit/js/app.js') }}"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("link-logout").addEventListener("click", () => {
            Swal.fire({
                title: 'Do you want to Logout?',
                showCancelButton: true,
                confirmButtonText: 'Ya',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document.getElementById("form-logout").submit();
                }
            })
        });
        document.getElementById('link-settings').addEventListener('click', () => {
            const myModalAlternative = new bootstrap.Modal('#staticBackdrop')
            myModalAlternative.show()
        })
    </script>
    @stack('foot')
</body>

</html>
