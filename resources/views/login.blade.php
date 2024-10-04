<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apotech</title>
  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
  <style>
    body {
    font-family: 'Roboto', sans-serif;
    }
    .login-container {
      height: 100vh;
    }
    .login-card {
      width: 604px;
      height: auto
      border: 1px solid #ddd;
      box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    }
    .login-image {
      object-fit: cover;
      width: 100%;
      height: 100%;
    }
    .input-group .form-control, .input-group .btn {
      border-radius: 0.25rem;
      border-color: #ced4da; /* Same border color as input field */
    }
    .btn-custom {
      background-color: white;
      border: 1px solid #ced4da;
    }
    h3 {
     font-weight: 700; /* Bold */
    }

    p {
    font-weight: 400; /* Regular */
    }

  </style>
</head>
<body>
  <div class="container-fluid login-container d-flex justify-content-center align-items-center rounded-circle">
    <div class="row login-card">
      <div class="col-md-6 p-0">
        <img src="{{asset('images\login pict.png')}}" alt="Login Image" class="login-image" style="border-radius:8px;">
      </div>
      <div class="col-md-6 p-4">
        <h3 class="text-center">Masuk</h3>
        <form action="/login" method="POST">
          @csrf
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
              <input type="text" class="form-control" id="username" name="username" required>
              <span class="input-group-text">
                <img src="{{asset('images\user.png')}}" style="width: 20px; height: 20px; ">
              </span>
            </div>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" required>
                <button class="btn btn-outline-secondary" type="button" id="button-addon2"><img src="{{asset('images\hidden.png')}}" style="width: 20px; height: 20px; "></button>
            </div>
          </div>
          <div class="form-check mb-3 d-flex justify-content-between align-items-center">
            <div>
              <input class="form-check-input" type="checkbox" id="rememberMe">
              <label class="form-check-label" for="rememberMe">
                Ingat saya
              </label>
            </div>
            <a href="{{'forgot-password'}}" class="text-end" style="color: black">Lupa password?</a>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Kirim Kode</button>
          </div>
          <div class="text-center my-3">OR</div>
          <div class="d-grid">
            <button type="button" class="btn btn-outline-secondary"><img src="{{asset('images/google.png')}}" style="width: 20px; height: 20px; align-items-center; justify-content-center; margin-right:8px;">Log in with Google</button>
          </div>
          {{-- <div class="text-center mt-3">
            Belum punya akun? <a href="#" style="text-decoration: none; color:blue">Daftar</a>
          </div> --}}
        </form>
      </div>
    </div>
  </div>
</body>
</html>
