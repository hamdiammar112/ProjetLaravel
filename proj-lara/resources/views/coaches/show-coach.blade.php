<!doctype html>
<html lang="en">

@include('layouts.head')

<body data-bs-theme="dark" class="d-flex flex-column min-vh-100">

  @include('layouts.nav')
  <div class="container-sm ">
    </br>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{url('liste-coaches')}}" class="btn btn-light ">Retour</a>
            </hr>
    </div>

    </br>



    <div class="container ">
        <div class="row " >

            <div class="col-6">
                <h3 class=" text-center">Info Coach :</h3>
                </br>
                <div class="row justify-content-md-center">

                <div class="card" style="width: 18rem;text-align: center;" >

                    <img src="{{asset('img/coach.png')}}" style="display: block; margin-left: auto;margin-top: 10px;  margin-right: auto;width: 50%;background-color:white;"
                    class="avatar rounded-circle mr-3 " alt="Loading">

                    <div class="card-body" >
                        <h5 class="card-title">{{$coach->nom}}  {{$coach->prenom}}</h5>
                        <p class="card-text">{{$coach->email}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nais : {{ date('d/M/Y', strtotime($coach->birthdate)) }}</li>
                        <li class="list-group-item">CIN : {{$coach->cin}}</li>
                        <li class="list-group-item">N° : {{$coach->phone}}</li>

                    </ul>
                    <div class="card-body">

                    </div>
                </div>

                </div>
            </div>

            <div class="col-6">
                <h3 class=" text-left"> Liste Clients :</h3>
                </br>
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

                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($clients as $client)
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

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
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
