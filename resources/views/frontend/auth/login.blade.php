<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | HUB</title>
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
      <h3 class="text-warning mb-3 text-center">Login to HUB</h3>

      @if($errors->any())
        <div class="alert alert-danger">
          {{ $errors->first() }}
        </div>
      @endif

      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label>Email</label>
          <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
        </div>
        <div class="mb-3">
          <label>Password</label>
          <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
        </div>
        <button type="submit" class="btn btn-warning w-100">Login</button>
      </form>

      <p class="mt-3 text-center text-muted">
        Don't have an account? <a href="{{ route('register') }}" class="text-warning">Register</a>
      </p>
    </div>
  </div>

</body>

</html>