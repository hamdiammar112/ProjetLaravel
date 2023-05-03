<!doctype html>
<html lang="en">

    @include('layouts.head')

  <body data-bs-theme="dark" class="d-flex flex-column min-vh-100">

    @include('layouts.nav')
    <div class="container-sm ">
        </br>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{url('create-client')}}" class="btn btn-success">Ajout Client</a>
            </hr>
        </div>
        </br>
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
        {{-- No DELETE  --}}
        @if(Session::has('no_delete'))
        <div class="alert alert-danger" role="alert">
            {{Session::get('no_delete')}}
        </div>
        @endif

        <h3>Table Clients</h3>
        <table id="table_id" class="table" style="border: 1px solid black; border-radius: 10px;">
            <thead>
                <tr>
                <th scope="col">#ID</th>
                <th scope="col">NOM</th>
                <th scope="col">PRENOM</th>
                <th scope="col">CIN</th>
                <th scope="col">BIRTHDATE</th>
                <th scope="col">PHONE</th>
                <th scope="col">EMAIL</th>
                <th scope="col">Info</th>
                <th scope="col">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($data as $client)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$client->nom}}</td>
                    <td>{{$client->prenom}}</td>
                    <td>{{$client->cin}}</td>
                    <td>{{ date('d/M/Y', strtotime($client->birthdate)) }}</td>
                    <td>{{$client->phone}}</td>
                    <td>{{$client->email}}</td>
                    <td>
                        <a style="color:white;" href="{{url('show-client/'.$client->id)}}" class="btn btn-outline-info">
                                Info
                        </a>

                    </td>

                    <td>
                            <a style="color:white;" href="{{url('update-client/'.$client->id)}}" class="btn btn-warning">
                                Modifier
                            </a>
                            |
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                            data-bs-target="#ModalDelete_{{$client->id}}" >Supprimer</button>
                            <!-- Modal DELETE -->
                            <div class="modal fade" id="ModalDelete_{{$client->id}}" tabindex="-1" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header btn btn-danger">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirmation</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body ">
                                        <span style="color:white;font-weight:bold">Êtes-vous sûr de bien vouloir supprimer cet élément ? </span>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                        <form action="/delete-client">
                                            <input type="hidden" name="id" value="{{$client->id}}" />
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
