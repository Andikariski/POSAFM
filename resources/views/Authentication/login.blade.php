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
    body {
    /* background: url('https://source.unsplash.com/twukN12EN7c/1920x1080') no-repeat center center fixed; */
    background:  url('/style/image/Background/body1.jpg')  no-repeat center center fixed;
    background-size: 100%;
    /* webkit-background-size: cover;
    moz-background-size: cover;
    background-size: cover;
    o-background-size: cover;  */
    /* background-color: rgb(209, 209, 209); */
  }

</style>

<div class="container text-center mt-5">
    <div class="row gx-lg-5">
      <div class="card" style="width: 38rem;">
      <h3 class="display-3 fw-bold mb-2 mt-4" style="font-size: 55px;color: #0394ae">
        AGRO FARM MANDIRI
      </h3>
      
        {{-- <img src="{{ url('/style/image/Logo.png')}}" alt="" height="35%" width="35%" class="text-center"/> --}}
        {{-- <img src="{{ url('/style/image/Logo.png')}}" alt="" height="35%" width="35%" class="text-center"/> --}}
            <!-- Pills navs -->
    <ul class="nav nav-pills nav-justified mb-3 m-3" id="ex1" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab"
        aria-controls="pills-login" aria-selected="true"><strong>Login</strong></a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="tab-register" data-mdb-toggle="pill" href="#pills-register" role="tab"
        aria-controls="pills-register" aria-selected="false"><strong>Registrasi</strong></a>
    </li>
  </ul>
  <hr>
  <!-- Pills navs -->
  
  <!-- Pills content -->
  <div class="tab-content">
    <div class="tab-pane fade show active m-4" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
        {{-- <div class="text-center mb-4">
          <p><strong>FORM LOGIN</strong></p>
        </div> --}}
      <form action="{{ route('login') }}" method="POST">
        <!-- Email input -->
        @csrf
        <div class="form-outline mb-4">
          <input type="email" id="loginName" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" name="email" autocomplete="off" style="font-size:15pt;" required/>
            @error('email')
            <span class="invalid-feedback" role="alert">
                {{ $message }}
            </span>
            @enderror
          <label class="form-label" for="loginName">Email atau Username</label>
        </div>
  
        <!-- Password input -->
        <div class="form-outline mb-4 mt-4">
          <input type="password" id="loginPassword" class="form-control form-control-lg mt-4" name="password" style="font-size:15pt;" required/>
          <label class="form-label" for="loginPassword">Password</label>
        </div>
  
  
        <!-- Submit button -->
        <div class="row">
            <div class="col">
                <button type="submit" class="btn btn-primary btn-lg btn-block mb-4">Masuk <i class="fas fa-fw fa-arrow-alt-circle-right"></i></button>
            </div>
            <div class="col">
                <button type="reset" class="btn btn-danger btn-lg btn-block mb-4">Reset <i class="fas fas-fw fa-recycle"></i></button>
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
        {{-- <div class="text-center mb-4">
          <p><strong>FORM REGISTRASI</strong></p>
          </div> --}}
          <form method="POST" action="{{ route('register') }}">
            @csrf
        <!-- Name input -->
        <div class="form-outline mb-4">
          <input type="text" id="registerName" class="form-control form-control-lg" name="name" style="font-size:15pt;" required/>
          <label class="form-label" for="registerName">Nama</label>
        </div>
  
        <!-- Email input -->
        <div class="form-outline mb-4">
          <input type="email" id="registerEmail" class="form-control form-control-lg" name="email" style="font-size:15pt;" required/>
          <label class="form-label" for="registerEmail">Email</label>
        </div>
  
        <!-- Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="registerPassword" class="form-control form-control-lg" name="password" style="font-size:15pt;" required />
          <label class="form-label" for="registerPassword">Password</label>
        </div>
  
        <!-- Repeat Password input -->
        <div class="form-outline mb-4">
          <input type="password" id="registerRepeatPassword" class="form-control form-control-lg" name="password_confirmation" style="font-size:15pt;" required/>
          <label class="form-label" for="registerRepeatPassword">Ulangi Password</label>
        </div>
        <!-- Submit button -->
      <!-- Submit button -->
      <div class="row">
        <div class="col">
            <button type="submit" class="btn btn-success btn-lg btn-block mb-4">Registrasi <i class="fas fa-fw fa-sign-in-alt"></i></button>
        </div>
        <div class="col">
            <button type="reset" class="btn btn-danger btn-lg btn-block mb-4">Reset  <i class="fas fa-fw fa-recycle"></i></button>
        </div>
    </div>
      </form>
    </div>
  </div>
  <!-- Pills content -->
        </div>
      {{-- </div> --}}
</div>
  {{-- </div>
  <!-- Jumbotron -->
</section> --}}
<!-- Section: Design Block -->
<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.0.1/mdb.min.js"
></script>