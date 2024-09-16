<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Centered Login Form</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
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
  </style>
</head>
<body>

  <div class="container-fluid login-container d-flex justify-content-center align-items-center rounded-circle">
    <div class="row login-card">
      <div class="col-md-6 p-0">
        <img src="{{asset('images\Pexels Photo by Bakytzhan  Baurzhanov.png')}}" alt="Login Image" class="login-image" style="border-radius:8px;">
      </div>
      <div class="col-md-6 p-4">
        <h3 class="text-center">Masuk</h3>
        <form>
          <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <div class="input-group">
              <input type="text" class="form-control" id="username">
              <span class="input-group-text">
                <img src="{{asset('images\flowbite_user-solid.png')}}" style="width: 20px; height: 20px; ">
              </span>
            </div>
          </div>          
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" placeholder="">
                <button class="btn btn-outline-secondary" type="button" id="button-addon2"><img src="{{asset('images\Frame.png')}}" style="width: 20px; height: 20px; "></button>
            </div>
          </div>   
          <div class="form-check mb-3 d-flex justify-content-between align-items-center">
            <div>
              <input class="form-check-input" type="checkbox" id="rememberMe">
              <label class="form-check-label" for="rememberMe">
                Ingat saya
              </label>
            </div>
            <a href="#" class="text-end" style="color: black">Lupa password?</a>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Masuk</button>
          </div>
          <div class="text-center my-3">OR</div>
          <div class="d-grid">
            <button type="button" class="btn btn-outline-secondary">Log in with Google</button>
          </div>
          <div class="text-center mt-3">
            Belum punya akun? <a href="#" style="text-decoration: none; color:blue">Daftar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
