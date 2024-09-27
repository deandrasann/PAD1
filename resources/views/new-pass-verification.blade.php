<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Apotech</title>
  <!-- Bootstrap CSS -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
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
        <h3 class="text-center">Verifikasi</h3>
        <form>
          <div class="form-container col-mb-3">
            <p class="p-2">Masukkan kode yang diterima di email Anda</p>
            <div class="btn-forgot-password">
                <strong>Kode</strong>
                <input type="number" id="pin" class="form-control" name="pin" maxlength="6" required>
                <p>check github</p>
            </div>
            <button type="submit" class="btn btn-primary ">Verifikasi</button>
            <p> Belum menerima kode?<a style="color: blue; text-decoration:none; font-weight:bold" href="{{'login'}}">Kirim ulang sekarang</a></p>
            <button type="submit" class="btn btn-primary ">Verifikasi</button>
            <p>check github</p>
            <p> Belum menerima kode?<a style="color: blue; text-decoration:none; font-weight:bold" href="{{'login'}}">Kirim ulang sekarang</a></p><button type="submit" class="btn btn-primary ">Verifikasi</button>
            <p>check coba1</p>
            <p> Belum menerima kode?<a style="color: blue; text-decoration:none; font-weight:bold" href="{{'login'}}">Kirim ulang sekarang</a></p>

            <button type="submit" class="btn btn-primary ">Verifikasi</button>
            <p>check coba2</p>
            <p> Belum menerima kode?<a style="color: blue; text-decoration:none; font-weight:bold" href="{{'login'}}">Kirim ulang sekarang</a></p>
            <button type="submit" class="btn btn-primary ">Verifikasi</button>
            <p>check dea</p>
            <p> Belum menerima kode?<a style="color: blue; text-decoration:none; font-weight:bold" href="{{'login'}}">Kirim ulang sekarang</a></p>
          </form>
      </div>
    </div>
  </div>
</body>
<script>
    document.getElementById('pin').addEventListener('input', function() {
        const maxLength = 6;
        if (this.value.length > maxLength) {
            this.value = this.value.slice(0, maxLength); // Trim to max length
        }
    });
    </script>
</html>
