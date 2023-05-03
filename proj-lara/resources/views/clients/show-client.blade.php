<!doctype html>
<html lang="en">

@include('layouts.head')

<body data-bs-theme="dark" class="d-flex flex-column min-vh-100">

    @include('layouts.nav')
    <div class="container-sm ">
        </br>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ url('liste-clients') }}" class="btn btn-light ">Retour</a>
            @isset($sub)

            @else
            <a href="{{ url('create-sub/' . $client->id) }}" class="btn btn-success">Ajout Abon</a>
            @endisset

        </br>
        </div>

        </br>
        {{-- Create Alert  --}}
        @if(Session::has('create'))
              <div class="alert alert-success" role="alert">
                {{Session::get('create')}}
              </div>
        @endif


        <div class="container ">
            <div class="row">
                <div class="col-6 ">

                    <h3 class=" text-center">Info Client </h3>
                    </br>
                    <div class="row justify-content-md-center">

                        <div class="card" style="width: 18rem;text-align: center;">

                            <img src="{{ asset('img/client.png') }}"
                                style="display: block; margin-left: auto;margin-top: 10px;  margin-right: auto;width: 50%;background-color:white;"
                                class="avatar rounded-circle mr-3 " alt="Loading">

                            <div class="card-body">
                                <h5 class="card-title">{{ $client->nom }} {{ $client->prenom }}</h5>

                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Client N° : {{ $client->id }} </li>
                                <li class="list-group-item">@Email : {{ $client->email }}</li>
                                <li class="list-group-item">Nais : {{ date('d/M/Y', strtotime($client->birthdate)) }}  </li>

                                <li class="list-group-item">CIN : {{ $client->cin }}</li>
                                <li class="list-group-item">N° : {{ $client->phone }}</li>



                            </ul>
                            <div class="card-body">

                            </div>
                        </div>

                    </div>
                    </br>
                </div>


                <div class="col-6 ">
                    <h3 class=" text-center">Info Abonnement </h3>
                    </br>
                    @isset($sub)
                    <div class="card text-center">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: yellow; flex-grow: 1; text-align: center;">Date de début: {{ date('d/M/Y', strtotime($sub->debut)) }}</span>
                                <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#ModalDeleteSub_{{$sub->id}}">
                                    <i class="bi bi-trash" style="font-size:20px;"></i>
                                </button>
                                    <!-- ModalDelete -->
                                        <div class="modal fade" id="ModalDeleteSub_{{$sub->id}}" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header btn btn-danger">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <span style="color:white;font-weight:bold">Êtes-vous sûr de bien vouloir Supprimer cet élément ?</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                    <form action="/delete-abon">
                                                        <input type="hidden" name="id" value="{{$sub->id}}" />
                                                        <input type="submit" class="btn btn-danger text-white ml-auto"value="Supprimer" />
                                                    </form>

                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- ModalDelete -->
                        </div>

                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item">Prix : <span style="color: black;" class="badge bg-light">{{$sub->prix}} TND</span></li>
                                <li class="list-group-item">
                                    @if ($sub->pay_statut == true)
                                    Statut de paiement : <span class="badge bg-success">Payé</span>
                                    @else
                                    Statut de paiement : <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#ModalPay2_{{$sub->id}}" ><span class="badge bg-danger">NON Payé</span></button>
                                        <!-- Modal Pay 2 -->
                                            <div class="modal fade" id="ModalPay2_{{$sub->id}}" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                    <div class="modal-header btn btn-primary">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body ">
                                                        <span style="color:white;font-weight:bold">Êtes-vous sûr de bien vouloir changer le Statut de Paiement de cet élément ?</span>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                        <form action="/update-pay-status">
                                                            <input type="hidden" name="id" value="{{$sub->id}}" />
                                                            <input type="submit" class="btn btn-primary text-white ml-auto"value="Change" />
                                                        </form>

                                                    </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- Modal Pay 2-->
                                    @endif
                                </li>
                                <li class="list-group-item">Type d'abonnement : <span class="badge bg-info">{{$sub->type}}</span></li>
                                <li class="list-group-item">Statut Abon :
                                    <div class="spinner-grow spinner-grow-sm text-success" role="status">

                                    </div>
                                    <span class="badge bg-success">Activé</span>
                                </li>
                                @if ($client->coach)
                                    <a href="{{ url('show-coach/' . $client->coach->id) }}" style="text-decoration: none;" class="card-link" >

                                        <li class="list-group-item">Coach personnel : <span  style=" color:white;">{{ $client->coach->nom }} {{ $client->coach->prenom }}</span></li>
                                    </a>
                                @else
                                    <li class="list-group-item" style=" color:crimson;">This client has no coach.</li>
                                @endif
                              </ul>
                        </div>
                        <div class="card-footer text-body-secondary">
                            <span style=" color:red;"> Date d'Expiration  : {{ date('d/M/Y', strtotime($sub->expiration)) }} </span>
                        </div>
                    </div>
                    @else
                    <div class="alert alert-warning" role="alert" style="text-align: center">
                        <strong>{{ $client->nom }} {{ $client->prenom }} n'a pas un abonnement ACTIF</strong>
                    </div>
                    @endisset
                </div>

            </div>

            <div class="row">
                <h3>Historique d'Abonnements </h3>
                {{-- Status Paiement change Alert  --}}
                @if(Session::has('update_status'))
                <div class="alert alert-primary" role="alert">
                    {{Session::get('update_status')}}
                </div>
                @endif
                {{-- DELETE Alert  --}}
                @if(Session::has('delete'))
                <div class="alert alert-danger" role="alert">
                    {{Session::get('delete')}}
                </div>
                @endif

                @if($other_subs->count()>0)
                <table id="table_id" class="table" style="border: 1px solid black; border-radius: 10px;">
                    <thead>
                        <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Plan</th>
                        <th scope="col">Type</th>
                        <th scope="col">Prix</th>
                        <th scope="col">Date Debut</th>
                        <th scope="col">Date Expiration</th>
                        <th scope="col">Statut Abon</th>
                        <th scope="col">Statut Paiement</th>
                        <th scope="col">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($other_subs as $data)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->plan->titre}}</td>
                            <td>{{$data->type}}</td>
                            <td>{{$data->prix}}</td>
                            <td>{{ date('d/M/Y', strtotime($data->debut)) }}</td>
                            <td>{{ date('d/M/Y', strtotime($data->expiration)) }}</td>
                            <td>
                                @if ($data->statut == true)
                                    <div class="spinner-grow spinner-grow-sm text-success" role="status"></div> <span class="badge bg-success">Activé</span>
                                @else

                                    <div class="spinner-grow spinner-grow-sm text-danger" role="status"></div> <span class="badge bg-danger">Expiré</span>


                                @endif
                            </td>
                            <td>
                                    @if ($data->pay_statut == true)
                                        <span class="badge bg-success">Payé</span>
                                    @else
                                        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal"
                                        data-bs-target="#ModalPay_{{$data->id}}" ><span class="badge bg-danger">NON Payé</span></button>

                                    @endif
                                    <!-- Modal Pay -->
                                        <div class="modal fade" id="ModalPay_{{$data->id}}" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header btn btn-primary">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body ">
                                                    <span style="color:white;font-weight:bold">Êtes-vous sûr de bien vouloir changer le Statut de Paiement de cet élément ?</span>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                    <form action="/update-pay-status">
                                                        <input type="hidden" name="id" value="{{$data->id}}" />
                                                        <input type="submit" class="btn btn-primary text-white ml-auto"value="Change" />
                                                    </form>

                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    <!-- Modal Pay -->
                            </td>

                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#ModalDelete_{{$data->id}}" >Supprimer</button>
                                <!-- ModalDelete -->
                                    <div class="modal fade" id="ModalDelete_{{$data->id}}" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header btn btn-danger">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body ">
                                                <span style="color:white;font-weight:bold">Êtes-vous sûr de bien vouloir Supprimer cet élément ?</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                <form action="/delete-abon">
                                                    <input type="hidden" name="id" value="{{$data->id}}" />
                                                    <input type="submit" class="btn btn-danger text-white ml-auto"value="Supprimer" />
                                                </form>

                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                <!-- ModalDelete -->

                            </td>




                        </tr>

                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="alert alert-light" role="alert" style="text-align: center">
                    <strong>{{ $client->nom }} {{ $client->prenom }} n'a pas d'historique d'Abonnements</strong>
                </div>
                @endif
            </div>
        </div>
    </div>
        @include('layouts.footer')


    <script>
        $(document).ready( function () {

            $('#table_id').DataTable({
             order: [[0, 'desc']], } );
         });

    </script>
</body>

</html>
