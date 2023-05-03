<!doctype html>
<html lang="en">

@include('layouts.head')

<body data-bs-theme="dark" class="d-flex flex-column min-vh-100">

    @include('layouts.nav')
    <div class="container-sm ">
        </br>
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a href="{{ url('liste-plans') }}" class="btn btn-light ">Retour</a>
            </hr>
        </div>

        </br>
        <div class="container ">
            <div class="row">

                <h3 class=" text-center">Info Plan </h3>
                    </br>
                    <div class="col-6 mx-auto">
                        <div class="card text-center">
                            <div class="card-header">
                            <span style=" color:yellow;"> {{ $plan->titre }}  </span>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    <li class="list-group-item" >
                                        <img src="{{ asset('img/plan.png') }}"
                                        style="display: block; margin-left: auto;margin-top: 10px;  margin-right: auto;width: 80px;background-color:white;"
                                        class="avatar rounded-circle mr-3 " alt="Loading">
                                    </li>
                                    <li class="list-group-item">{{ $plan->description }}</li>
                                    <li class="list-group-item">{{ $plan->features }}</li>


                                    <li class="list-group-item" style=" color:crimson;" >
                                        <table class="mx-auto" style=" border:hidden;">
                                                <thead>
                                                <tr>

                                                    <th style=" border:hidden;" >1 M</th>
                                                    <th style=" border:hidden;" >3 M</th>
                                                    <th style=" border:hidden;" >6 M</th>
                                                    <th style=" border:hidden;" >1 Y</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                    <tr>

                                                        <td  style=" border:1px solid lightgrey;" >
                                                            &MediumSpace; {{ $plan->prix_mensuel }} TND &MediumSpace;
                                                        </td>
                                                        <td  style=" border:1px solid lightgrey;" >
                                                            &MediumSpace; {{ $plan->prix_trimestriel }} TND &MediumSpace;
                                                        </td>
                                                        <td  style=" border:1px solid lightgrey;" >
                                                            &MediumSpace; {{ $plan->prix_semestriel }} TND &MediumSpace;
                                                        </td>
                                                        <td  style=" border:1px solid lightgrey;" >
                                                            &MediumSpace; {{ $plan->prix_annuel }} TND &MediumSpace;
                                                        </td>

                                                    </tr>

                                                </tbody>
                                        </table>
                                    </li>

                                </ul>
                            </div>
                            <div class="card-footer text-body-secondary">

                                @if ($plan->statut == true)
                                    <div class="spinner-grow spinner-grow-sm text-light" role="status"></div>
                                    <span style=" color:lightblue;"> ACTIVE </span>
                                @else
                                    <div class="spinner-grow spinner-grow-sm text-danger" role="status"></div>
                                    <span style=" color:red;"> INACTIVE </span>
                                @endif


                            </div>
                        </div>
                    </div>

            </div>

        </div>
    </div>
        @include('layouts.footer')


</body>

</html>
