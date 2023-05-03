<!doctype html>
<html lang="en">

@include('layouts.head')

  <body data-bs-theme="dark" class="d-flex flex-column min-vh-100">

    @include('layouts.nav')
    <div class="container-sm ">
        </br>
        <h3>Dashboard Admin</h3>

        </br>

              <div class="alert alert-light text-center" role="alert">

                <span style="font-weight:bold;font-size: larger;color:brown;"> Welcome Back {{ Auth::user()->name }}  </span>
                </br>
                <span style="font-weight:bold;font-size: larger;color:brown;">  LogMail : {{ Auth::user()->email }}  </span>


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
