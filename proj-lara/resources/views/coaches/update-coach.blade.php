<!doctype html>
<html lang="en">

        @include('layouts.head')

  <body data-bs-theme="dark" class="d-flex flex-column min-vh-100">

        @include('layouts.nav')
        <div class="b-example-divider b-example-vr"></div>
        <div class="container">
            </br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{url('liste-coaches')}}" class="btn btn-light ">Retour</a>
            </hr>
            </div>
            <h3 class=" text-center">Modifier un Coach</h3>
            </br></br></br>
            <div class="row justify-content-md-center">
            <div class="col-md-6">
                {{-- Edit Alert  --}}
                @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    @foreach ($errors->all() as $error)
                    <strong> {{ $error }}</strong> </br>
                    @endforeach
                </div>
                @endif


              <form method="post" action="{{url('edit-coach')}}" class="needs-validation" novalidate >
                @csrf
                <input type="hidden" name="id" value="{{$coach->id}}" >
                <div class="form-group row ">
                    <div class="form-group col-md-6">
                      <label for="exampleFormControlInput1">Nom</label>
                      <input style="color:black;font-weight:bold" type="text" class="form-control" name="nom" value="{{$coach->nom}}"  required>
                      <div class="invalid-feedback">Champ Invalide !</div>
                    </div>
                    <div class="form-group col-md-6 ">
                      <label for="exampleFormControlInput1">Prenom</label>
                      <input style="color:black;font-weight:bold" type="text" class="form-control" name="prenom" value="{{$coach->prenom}}" required>
                      <div class="invalid-feedback">Champ Invalide !</div>
                    </div>
                  </div>
                  </br>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Birthdate</label>
                      <input style="color:black;font-weight:bold" type="date" class="form-control" name="birthdate" value="{{$coach->birthdate}}" required>
                      <div class="invalid-feedback">Champ Invalide !</div>
                    </div>
                    </br>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">@Email</label>
                      <input style="color:black;font-weight:bold" type="email"  name="email" value="{{$coach->email}}"
                      pattern="[^@\s]+@[^@\s]+\.[^@\s]+" title="Invalid email address"
                      size="30" required class="form-control"  >
                      <div class="invalid-feedback">Champ Invalide !</div>
                    </div>
                    </br>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">CIN</label>
                      <input style="color:black;font-weight:bold" type="number" class="form-control" name="cin" value="{{$coach->cin}}"
                       min="8" required>
                       <div class="invalid-feedback">Champ Invalide !</div>
                    </div>
                    </br>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">N°</label>
                      <input style="color:black;font-weight:bold" type="number" class="form-control" name="phone"  value="{{$coach->phone}}" required>
                      <div class="invalid-feedback">Champ Invalide !</div>
                    </div>
                    </br>



                    <div  class="text-center" style="margin: 5px; ">
                    <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
                    <button type="submit" style="color:white;" class="btn btn-info btn-lg">Save</button>
                    </div>
                </form>

              </div>
            </div>

        </div>

        @include('layouts.footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.1/baguetteBox.min.js"></script>
    <script>
      // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
          'use strict'

          // Fetch all the forms we want to apply custom Bootstrap validation styles to
          var forms = document.querySelectorAll('.needs-validation')

          // Loop over them and prevent submission
          Array.prototype.slice.call(forms)
          .forEach(function (form) {
            form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
          })
        })()
    </script>

  </body>
</html>
