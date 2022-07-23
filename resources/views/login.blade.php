<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>
<body class="bg-light">
    <main class="container">
        <div id="content" class="d-flex justify-content-center align-items-center vh-100">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-header">
                        <h4 class="mb-0">Silahkan Login !</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.login') }}" method="post">
                            @csrf
                            <input type="email" name="email" id="email" placeholder="Email ..." class="form-control my-2">
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <input type="password" name="password" id="password" placeholder="Password ..." class="form-control my-2">
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                            <div class="mt-3 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
