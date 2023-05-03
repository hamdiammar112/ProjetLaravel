<!doctype html>
<html lang="en">

    @include('layouts.head')

  <body data-bs-theme="dark" class="d-flex flex-column min-vh-100">

    @include('layouts.nav')
    <div class="container-sm ">
        </br>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{url('create-plan')}}" class="btn btn-success">Ajout Plan</a>
            </hr>
        </div>
        </br>

        {{-- No DELETE  --}}
        @if(Session::has('no_delete'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('no_delete')}}
        </div>
        @endif

        {{-- DELETE Alert  --}}
        @if(Session::has('delete'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('delete')}}
        </div>
        @endif

        {{-- Create Alert  --}}
        @if(Session::has('create'))
        <div class="alert alert-success" role="alert">
            {{Session::get('create')}}
        </div>
        @endif
        {{-- Edit Alert  --}}
        @if(Session::has('update'))
        <div class="alert alert-warning" role="alert">
            {{Session::get('update')}}
        </div>
        @endif
        {{-- Status change Alert  --}}
        @if(Session::has('update_status'))
        <div class="alert alert-primary" role="alert">
            {{Session::get('update_status')}}
        </div>
        @endif

        <h3>Table Plans</h3>
        <table id="table_id" class="table" style="border: 1px solid black; border-radius: 10px;">
            <thead>
                <tr>
                <th scope="col">titre</th>
                <th scope="col">description</th>
                <th scope="col">features</th>
                <th scope="col">Prix</th>
                <th scope="col">statut</th>
                <th scope="col">Info</th>
                <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody>

            @foreach ($plans as $plan)
            <tr>

                    <td>{{$plan->titre}}</td>
                    <td>{{$plan->description}}</td>
                    <td>{{$plan->features}}</td>
                    <td>
                        <table>
                            <thead>
                            <tr>

                                <th>1 M</th>
                                <th>3 M</th>
                                <th>6 M</th>
                                <th>1 Y</th>
                            </tr>
                            </thead>
                            <tbody>

                                <tr>

                                <td>{{ $plan->prix_mensuel }} TND</td>
                                <td>{{ $plan->prix_trimestriel }} TND</td>
                                <td>{{ $plan->prix_semestriel }} TND</td>
                                <td>{{ $plan->prix_annuel }} TND</td>
                                </tr>

                            </tbody>
                        </table>

                    </td>
                    <td>
                        @if ($plan->statut == true)
                        <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                        data-bs-target="#ModalStatus_{{$plan->id}}" >ACTIVE</button>
                        @else
                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                        data-bs-target="#ModalStatus_{{$plan->id}}" >INACTIVE</button>
                        @endif
                        <!-- Modal Status -->
                        <div class="modal fade" id="ModalStatus_{{$plan->id}}" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header btn btn-primary">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body ">
                                    <span style="color:white;font-weight:bold">Êtes-vous sûr de bien vouloir changer le Statut cet élément ? {{$plan->id}}</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                    <form action="/update-plan-status">
                                        <input type="hidden" name="id" value="{{$plan->id}}" />
                                        <input type="submit" class="btn btn-primary text-white ml-auto"value="Change" />
                                    </form>

                                </div>
                                </div>
                            </div>
                        </div>
                        <!-- Modal Status -->
                    </td>

                    <td>
                        <a style="color:white;" href="{{url('show-plan/'.$plan->id)}}" class="btn btn-outline-info">
                                Info
                        </a>

                    </td>

                    <td>
                        <div style="display: flex; flex-direction: column; gap: 5px;">
                            <a style="color:white;" href="{{url('update-plan/'.$plan->id)}}" class="btn btn-warning">
                                Modifier
                            </a>
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#ModalDelete_{{$plan->id}}">Supprimer
                            </button>
                        </div>
                            <!-- Modal DELETE -->
                            <div class="modal fade" id="ModalDelete_{{$plan->id}}" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header btn btn-danger">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        <span style="color:white;font-weight:bold">Êtes-vous sûr de bien vouloir supprimer cet élément ?</span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        <form action="/delete-plan">
                                            <input type="hidden" name="id" value="{{$plan->id}}" />
                                            <input type="submit" class="btn btn-danger text-white ml-auto"value="Supprimer" />
                                        </form>

                                    </div>
                                    </div>
                                </div>
                            </div>

                    </td>




            </tr>

            @endforeach
            </tbody>
        </table>




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
