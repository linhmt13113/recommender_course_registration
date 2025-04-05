<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/css/login.css') }}">
    <link rel="icon" href="{{ asset('icons.png') }}" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<section class="vh-100" >
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" >
          <div class="card-body p-5 text-center">

            <h3 class="mb-5">Login</h3>

            @if($errors->any())
              <div class="alert alert-danger text-start">
                  @foreach ($errors->all() as $error)
                      <p>{{ $error }}</p>
                  @endforeach
              </div>
            @endif

            <form action="{{ route('post.login') }}" method="POST">
              @csrf

              <div class="form-outline mb-4 text-start">
                <label class="form-label" for="username">Username / Email</label>
                <input type="text" id="username" name="username" class="form-control form-control-lg" required autofocus />
              </div>

              <div class="form-outline mb-4 text-start">
                <label class="form-label" for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control form-control-lg" required />
              </div>



              <button class="btn btn-primary btn-lg btn-block" type="submit" >Login</button>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
