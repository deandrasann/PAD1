<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apotech</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .forgot-password-container {
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
    .form-container{
        display: flex;
            flex-direction: column;
            align-items: center;
            width: 250px;
            margin: auto;
    }
    button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
            font-size: 16px;
    }
    .btn-forgot-password {
            width: 100%;
            box-sizing: border-box;
            font-size: 16px;
    }
    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
        }
  </style>
</head>
<body>

  <div class="container-fluid forgot-password-container d-flex justify-content-center align-items-center rounded-circle">
    <div class="row login-card">
      <div class="col-md-6 p-0">
        <img src="{{asset('images\forgot password.png')}}" class="login-image" style="border-radius:8px;">
      </div>
      <div class="col-md-6 p-4">
        <h3 class="text-center">Lupa Password?</h3>
        <form>
          <div class="form-container col-mb-3">
            <p class="p-2">Masukkan alamat email yang terkait dengan akun Anda untuk mendapatkan kode.</p>
            <div class="btn-forgot-password">
                <strong>Email</strong>
                <input type="email" class="form-control" name="email" required>
            </div>
            <button type="submit" class="btn btn-primary">
                <a style="color: white; text-decoration:none;" href="{{'password-verification'}}">Kode</a>
            </button>
            <a style="color: blue; text-decoration:none; font-weight:bold" href="{{'login'}} ">Kembali ke Masuk</a>
        </form>
      </div>
    </div>
  </div>
</body>

</html>
