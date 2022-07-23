<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Administrator'. ' | ' . env('APP_NAME') }}</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yellowtail&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?JetBrains+Mono:wght@700&family=Lato:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/admin-style.css">
    @stack('head')
</head>
<body>
    <header class="mb-3">
        <nav class="navbar navbar-expand-lg navbar-sticky">
            @include('layouts._nav')
        </nav>
    </header>
    <main class="container mb-5">
        @if (session('success'))
        <div class="alert alert-info alert-dismissible show fade">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div id="content">
            {{ $content }}
        </div>
    </main>
    <aside>
        <form action="{{ route('admin.logout') }}" method="post" id="form-logout">
            @csrf
        </form>
    </aside>
    <footer class="position-fixed bottom-0 start-0 end-0 text-center p-2">
        <span>Copyright &copy; 2022 Pemerintah Desa Pamalian</span>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById("link-logout").addEventListener("click", () => {
            Swal.fire({
                title: 'Do you want to Logout?'
                , showCancelButton: true
                , confirmButtonText: 'Ya'
            , }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    document.getElementById("form-logout").submit();
                }
            })
        });

    </script>
    @stack('foot')
</body>
</html>
