<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>
<!-- MDB -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.css" rel="stylesheet"/>
<style>
    .card {
        margin: 0 auto; /* Added */
        float: none; /* Added */
        margin-bottom: 10px; /* Added */
    }
    /* .form-outline {
        margin:0 0px; // for left and right margin
        margin:10px 0; // form top and bottom margin
 } */
</style>
<!-- Section: Design Block -->
<section class="">
  <!-- Jumbotron -->
  <div class="mt-5 text-center text-lg-start" style="background-color: hsl(0, 0%, 100%)">
    <div class="container text-center">
      <div class="row gx-lg-5">
        {{-- <div class="col-lg-6 mb-5 mb-lg-0"> --}}
          <h3 class="display-3 fw-bold ls-tight" style="font-size: 55px">
            {{-- Sistem Manajemen Toko <br /> --}}
            <span class="text-primary">AGRO FARM MANDIRI</span>
          </h3>
          {{-- <p style="color: hsl(217, 10%, 50.8%)" class="mt-2">
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            Eveniet, itaque accusantium odio, soluta, corrupti aliquam
            quibusdam tempora at cupiditate quis eum maiores libero
            veritatis? Dicta facilis sint aliquid ipsum atque?
          </p> --}}
        {{-- </div> --}}

        {{-- <div class="col-lg-6 mb-5 mb-lg-0"> --}}
    <div class="card" style="width: 50rem;">
            <!-- Pills navs -->
    <ul class="nav nav-pills nav-justified mb-3 m-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
        aria-controls="pills-login" aria-selected="true">Login</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
        aria-controls="pills-register" aria-selected="false">Registrasi</a>
    </li>
  </ul>
  <!-- Pills navs -->
  
  <!-- Pills content -->
  <div class="tab-content">
    <div class="tab-pane fade show active m-4" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        <div class="text-center mb-4">
          <p>FORM LOGIN</p>
        </div>
      <form action="{{ route('login') }}" method="POST">
        <!-- Email input -->
        @csrf
        <div class="form-outline mb-4">
          <input type="email" id="loginName" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" name="email" style="font-size:15pt;" autocomplete="off"/>
            @error('email')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
          <label class="form-label" for="loginName">Email atau Username</label>
        </div>
  
        <!-- Password input -->
        <div class="form-outline mb-4 mt-2">
          <input type="password" id="loginPassword" class="form-control mt-4" name="password" style="font-size:15pt;"/>
          <label class="form-label" for="loginPassword">Password</label>
        </div>
  
  
        <!-- Submit button -->
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-block mb-4">Masuk</button>
            </div>
            <div class="col">
                <button type="reset" class="btn btn-danger btn-block mb-4">Reset</button>
            </div>
        </div>
  
        <!-- Register buttons -->
        <div class="text-center">
          <p>Not a member? <a href="#!">Register</a></p>
        </div>
      </form>
    </div>

    {{-- //Registrasi form --}}
    <div class="tab-pane fade m-4" id="pills-register" role="tabpanel" aria-labelledby="tab-register">
        <div class="text-center mb-4">
            <p>FORM REGISTRASI</p>
          </div>
          <form method="POST" action="{{ route('register') }}">
            @csrf
        <!-- Name input -->
        <div class="form-outline mb-4">
          <input type="text" id="registerName" class="form-control" name="name" style="font-size:15pt;"/>
          <label class="form-label" for="registerName">Nama</label>
        </div>
  
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" id="registerEmail" class="form-control" name="email" style="font-size:15pt;"/>
          <label class="form-label" for="registerEmail">Email</label>
        </div>
  
        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="registerPassword" class="form-control" name="password" style="font-size:15pt;" />
          <label class="form-label" for="registerPassword">Password</label>
        </div>
  
        <!-- Repeat Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="registerRepeatPassword" class="form-control" name="password_confirmation" style="font-size:15pt;" />
          <label class="form-label" for="registerRepeatPassword">Ulangi Password</label>
        </div>
        <!-- Submit button -->
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-block mb-4">Registrasi</button>
            </div>
            <div class="col">
                <button type="reset" class="btn btn-danger btn-block mb-4">Reset</button>
            </div>
        </div>
      </form>
    </div>
  </div>
  <!-- Pills content -->
        </div>
      {{-- </div> --}}
    </div>
  </div>
  </div>
  <!-- Jumbotron -->
</section>
<!-- Section: Design Block -->
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>