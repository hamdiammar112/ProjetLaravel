<!doctype html>
<html lang="en">

        @include('layouts.head')

  <body data-bs-theme="dark" class="d-flex flex-column min-vh-100">

        @include('layouts.nav')
        <div class="b-example-divider b-example-vr"></div>
        <div class="container">
            </br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{url('liste-plans')}}" class="btn btn-light ">Retour</a>
            </hr>
            </div>
            <h3 class=" text-center">Modifier un Plan</h3>
            </br></br></br>
            <div class="row justify-content-md-center">
            <div class="col-md-6">
            {{-- Create Alert  --}}

            @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                @foreach ($errors->all() as $error)
                <strong> {{ $error }}</strong> </br>
                @endforeach
            </div>
            @endif


              <form method="post" action="{{url('edit-plan')}}" class="needs-validation" novalidate >
                @csrf
                <input type="hidden" name="id" value="{{$plan->id}}" >
                <div class="form-group row ">
                    <div class="form-group col-md-6">
                      <label for="exampleFormControlInput1">Titre</label>
                      <input type="text" class="form-control" name="titre" value="{{$plan->titre}}" required>
                      <div class="invalid-feedback">Champ Invalide !</div>
                    </div>

                    <div class="form-group col-md-6">
                        <label for="exampleFormControlInput1">Statut</label>
                        <select class="form-select{{ $errors->has('statut') ? ' is-invalid' : '' }}" id="inlineFormCustomSelect" name="statut" required>
                          <option value="" disabled {{ old('statut') === null ? 'selected' : '' }}>Choose...</option>
                          <option value="1" {{ old('statut', $plan->statut) == 1 ? 'selected' : '' }}>ACTIVE</option>
                          <option value="0" {{ old('statut', $plan->statut) == 0 ? 'selected' : '' }}>INACTIVE</option>
                        </select>
                        @if ($errors->has('statut'))
                          <div class="invalid-feedback">{{ $errors->first('statut') }}</div>
                        @else
                          <div class="invalid-feedback">Champ Invalide !</div>
                        @endif
                    </div>

                </div>
                  </br>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Desc</label>
                      <textarea class="form-control" id="desc" rows="3" name="description" required>
                        {!! nl2br(e($plan->description)) !!}
                      </textarea>
                      <div class="invalid-feedback">Champ Invalide !</div>
                    </div>
                    </br>
                    <div class="form-group">
                      <label for="exampleFormControlInput1">Features</label>
                      <textarea class="form-control" id="features" rows="3" name="features" required>
                        {{$plan->features}}
                      </textarea>
                      <div class="invalid-feedback">Champ Invalide !</div>
                    </div>
                    </br>
                    <div class="form-group row ">
                        <div class="form-group col-md-6">
                          <label for="exampleFormControlInput1">Prix Mensuel</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="prix_mensuel" value="{{$plan->prix_mensuel}}" step="0.01" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"> <strong>TND</strong></span>
                                </div>
                            </div>
                          <div class="invalid-feedback">Champ Invalide !</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlInput1">Prix Trimestriel</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="prix_trimestriel" value="{{$plan->prix_trimestriel}}" step="0.01" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"> <strong>TND</strong></span>
                                </div>
                            </div>
                            <div class="invalid-feedback">Champ Invalide !</div>
                          </div>
                    </div>
                    </br>
                    <div class="form-group row ">
                        <div class="form-group col-md-6">
                          <label for="exampleFormControlInput1">Prix Semestriel</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="prix_semestriel" value="{{$plan->prix_semestriel}}" step="0.01" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"> <strong>TND</strong></span>
                                </div>
                            </div>
                          <div class="invalid-feedback">Champ Invalide !</div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleFormControlInput1">Prix Annuel</label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="prix_annuel" value="{{$plan->prix_annuel}}" step="0.01" required>
                                <div class="input-group-append">
                                    <span class="input-group-text"> <strong>TND</strong></span>
                                </div>
                            </div>
                            <div class="invalid-feedback">Champ Invalide !</div>
                          </div>
                    </div>
                    </br>

                    <div  class="text-center" style="margin: 5px; ">
                    <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
                    <button type="submit" class="btn btn-info btn-lg">Save</button>
                    </div> </br>
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
