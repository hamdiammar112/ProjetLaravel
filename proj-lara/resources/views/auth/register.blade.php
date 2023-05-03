<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign Up</title>

        <link rel="icon" href="{{ asset('img/logo2.png') }}" type="image/png">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">


        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>



        <style>
            .dataTables_wrapper .dataTables_filter input {
                border: 1px solid #aaa;
                border-radius: 3px;
                padding: 5px;
                color: white;
                background-color: transparent;
                margin-left: 3px;
            }
            .dataTables_wrapper .dataTables_length select {
                border: 1px solid #aaa;
                border-radius: 3px;
                padding: 5px;
                color: white;
                background-color: #343a40;
                padding: 4px;
            }

        </style>

    </head>

  <body data-bs-theme="dark" class="d-flex flex-column min-vh-100">


    <div class="container-sm ">

                <section class="vh-100">
                    <div class="container py-5 h-100">
                        <div class="row d-flex align-items-center justify-content-center h-100">
                        <div class="col-md-8 col-lg-7 col-xl-6">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
                            class="img-fluid" alt="Phone image">
                        </div>
                        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                            <form method="POST" action="{{ route('register') }}">
                            @csrf

                             <!-- NAME input -->
                             <div class="form-outline mb-4">
                                <input type="text" id="name" name="name" :value="old('name')" required autofocus
                                class="form-control form-control-lg" />
                                <label class="form-label" for="name" :value="__('Name')" >Name</label>
                            </div>

                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" name="email" :value="old('email')" required autofocus class="form-control form-control-lg" />
                                <label class="form-label" for="email" type="email" name="email" :value="old('email')" required>Email address</label>
                            </div>

                            <!-- Password input -->
                            <div class="form-outline mb-4">

                                <input class="form-control form-control-lg"
                                id="password"
                                type="password"
                                name="password"
                                required autocomplete="new-password"   />

                                <label class="form-label" for="password" :value="__('Password')">Password</label>
                            </div>

                             <!-- Confirm Password input -->
                             <div class="form-outline mb-4">

                                <input class="form-control form-control-lg"
                                id="password_confirmation"
                                type="password"
                                name="password_confirmation" required    />

                                <label class="form-label" for="password_confirmation" :value="__('Confirm Password')" >Confirm Password</label>
                            </div>

                            <div class="d-flex justify-content-around align-items-center mb-4">

                                <!-- Checkbox -->
                                <div class="form-check">
                                <input class="form-check-input" type="checkbox"  id="remember_me"  name="remember" />
                                <label class="form-check-label" for="remember_me"> {{ __('Remember me') }} </label>
                                </div>
                                @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}">  {{ __('Forgot your password?') }}</a>
                                @endif
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-lg btn-block">  {{ __('Register') }}</button>

                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0 text-muted">



                                    <!-- Validation Errors -->
                                    <x-auth-validation-errors class="mb-4" style="color:red;" :errors="$errors" />
                                </p>
                            </div>

                            <div class="divider d-flex align-items-center my-4">
                                <p class="text-center fw-bold mx-3 mb-0 text-muted">
                                {{ __('Already registered?') }}
                                </p>
                            </div>
                                <a class="btn btn-light btn-lg btn-block"  href="{{ route('login') }}"  role="button">
                                    Login
                                </a>

                            </form>
                        </div>
                        </div>
                    </div>
                </section>





    </div>

    @include('layouts.footer')


  </body>
</html>
