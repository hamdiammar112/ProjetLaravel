<!doctype html>
<html lang="en">

        @include('layouts.head')

  <body data-bs-theme="dark" class="d-flex flex-column min-vh-100">

        @include('layouts.nav')
        <div class="b-example-divider b-example-vr"></div>
        <div class="container">
            </br>
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{url('show-client/'.$client->id)}}" class="btn btn-light ">Retour</a>
            </hr>
            </div>
            <h3 class=" text-center">Ajouter un nouveau Abonnement pour {{$client->nom}} {{$client->prenom}}</h3>
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

                    @isset($sub)
                    <div class="alert alert-primary text-center" role="alert">
                        <span style="font-weight:bold;font-size: larger;color:lightblue;">{{$client->nom}} {{$client->prenom}} a deja un Abonnement Actif</span>
                    </div>
                    @else
                    <form method="post" action="{{url('save-subscription')}}" class="needs-validation" novalidate >
                        @csrf
                            <input type="hidden" name="client_id" value="{{$client->id}}" >
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Plan</label>
                                @if ($plans->count() > 0)
                                <select class="form-select"  id="inlineFormCustomSelect" name="plan_id" required>
                                <option value="" selected>Choisir Plan...</option>
                                @foreach ($plans as $plan)
                                    @if($plan->statut)
                                    <option value="{{ $plan->id }}">{{ $plan->titre }}</option>
                                    @endif
                                @endforeach
                                </select>
                                <div class="invalid-feedback">Champ Invalide !</div>
                                @else
                                <strong style="color:red;">No Plans available.</strong>
                                @endif
                            </div>
                            </br>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">TYPE d'Abonnement</label>
                                <select class="form-select"  id="inlineFormCustomSelect" name="type" required>
                                <option value="" selected>Choisir TYPE...</option>
                                <option value="0">Mensuel</option>
                                <option value="1">Trimestriel</option>
                                <option value="2">Semestriel </option>
                                <option value="3">Annuel</option>
                                </select>
                                <div class="invalid-feedback">Champ Invalide !</div>
                            </div>
                            </br>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Statut Paiement</label>
                                <select class="form-select"  id="inlineFormCustomSelect" name="pay_statut" required>
                                <option value="" selected>Choisir Statut Paiement...</option>
                                <option value="1">Payé</option>
                                <option value="0">NON Payé</option>
                                </select>
                                <div class="invalid-feedback">Champ Invalide !</div>
                            </div>
                            </br>



                            <div  class="text-center" style="margin: 5px; ">
                            <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
                            <button type="submit" class="btn btn-info btn-lg">Save</button>
                            </div> </br>
                    </form>
                    @endisset

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
