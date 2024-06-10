<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @include('backend.layouts.head')
  <title>Ecommerce Laravel - Login Panel</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(to right, #d7e1ec, #f3d5b5);
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0;
      padding: 0;
    }

    .card {
      border: none;
      border-radius: 1rem;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      animation: fadeIn 1.5s ease-in-out;
      width: 100%;
      max-width: 1200px; /* Increased max-width */
    }

    .form-control-user {
      border-radius: 2rem;
      padding: 1.5rem;
      font-size: 1rem;
    }

    .btn-user {
      border-radius: 2rem;
      padding: 0.75rem 1rem;
      font-size: 1rem;
      background: linear-gradient(to right, #56ab2f, #a8e063);
      border: none;
      transition: background 0.3s ease;
    }

    .btn-user:hover {
      background: linear-gradient(to right, #a8e063, #56ab2f);
      transform: scale(1.05);
    }

    .invalid-feedback {
      font-size: 0.875em;
    }

    .bg-login-image {
      border-radius: 1rem 0 0 1rem;
      width: 100%;
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      overflow: hidden;
    }

    .bg-login-image img {
      width: 100%;
      height: auto;
      object-fit: cover;
    }

    @media (max-width: 767.98px) {
      .bg-login-image {
        display: none;
      }
    }

    .container {
      width: 100%;
      max-width: 1200px; /* Increased max-width */
      margin: 0 auto;
      padding: 15px;
    }

    .row.justify-content-center {
      margin: 0;
    }

    .col-xl-10, .col-lg-12, .col-md-9 {
      max-width: 100%;
      padding: 0;
    }

    .card-body {
      padding: 2.5rem;
      padding-top: 5rem; /* Added padding-top */
    }

    .custom-control-label::before, .custom-control-label::after {
      top: 0.25rem;
      width: 1rem;
      height: 1rem;
    }

    .form-group:last-of-type {
      margin-bottom: 0;
    }

    .card-body .text-center:last-of-type {
      margin-bottom: 0;
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }
  </style>
</head>

<body>

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-12 col-lg-12 col-md-12 mt-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="row no-gutters">
            <div class="col-md-6 d-none d-md-block bg-login-image">
              <img src="{{ asset('images/BJMP.jpg') }}" alt="Logo">
            </div>
            <div class="col-md-6">
              <div class="card-body p-120 text-center">
                <div class="text-center">
                  <h1 class="h4 text-gray-900 mb-4">Admin login panel</h1>
                </div>
                <form class="user" method="POST" action="{{ route('login') }}">
                  @csrf
                  <div class="form-group">
                    <input type="email" class="form-control form-control-user @error('email') is-invalid @enderror text-center" name="email" value="{{ old('email') }}" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address..." required autocomplete="email">
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-user @error('password') is-invalid @enderror text-center" id="exampleInputPassword" placeholder="Password" name="password" required autocomplete="current-password">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <div class="custom-control custom-checkbox small text-center">
                      <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="custom-control-label" for="remember">Remember Me</label>
                    </div>
                  </div>
                  <button type="submit" class="btn btn-success btn-user btn-block">
                    Login
                  </button>
                </form>
                <hr>
                {{-- <div class="text-center">
                  @if (Route::has('password.request'))
                  <a class="btn btn-link small" href="{{ route('password.request') }}">
                    Forgot Your Password?
                  </a>
                  @endif
                </div> --}}
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>

</html>
