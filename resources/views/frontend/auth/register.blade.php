<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | HUB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: "Poppins", sans-serif;
        }

        .card {
            background-color: #1e1e1e;
            border: 1px solid #444;
            border-radius: 10px;
        }

        .btn-warning {
            color: #121212;
            font-weight: 600;
        }

        input {
            background-color: #2b2b2b;
            color: #fff;
            border: 1px solid #555;
        }

        input::placeholder {
            color: #aaa;
        }
    </style>
</head>

<body>

    <div class="container d-flex justify-content-center align-items-center" style="min-height:100vh;">
        <div class="card p-4" style="width: 400px;">
            <h3 class="text-warning mb-3 text-center">Register to HUB</h3>

            @if($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register.submit') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password"
                        required>
                </div>
                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control"
                        placeholder="Confirm your password" required>
                </div>
                <button type="submit" class="btn btn-warning w-100">Register</button>
            </form>

            <p class="mt-3 text-center text-muted">
                Already have an account? <a href="{{ route('login') }}" class="text-warning">Login</a>
            </p>
        </div>
    </div>

</body>

</html>