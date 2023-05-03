<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('dashboard') }}">
        <img src="{{asset('img/logo2.png')}}" style="width:45px; border-right: 1px solid #000;" class="avatar rounded-circle mr-3" /> HSC
      </a>
      <hr>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 text-center" style="margin-left: auto; margin-right: auto;">
          <li class="nav-item" title="Liste Clients">
            <a class="{{ (request()->is('liste-clients*')) ? 'nav-link active' : 'nav-link' }}" aria-current="page" href="{{ route('clients') }}">
              Liste Clients
            </a>
          </li>
          <li class="nav-item" title="Liste Coaches">
            <a class="{{ (request()->is('liste-coaches*')) ? 'nav-link active' : 'nav-link' }}" aria-current="page" href="{{ route('coaches') }}">
              Liste Coaches
            </a>
          </li>
          <li class="nav-item" title="Plans">
            <a class="{{ (request()->is('liste-plans*')) ? 'nav-link active' : 'nav-link' }}"   href="{{ route('plans') }}">Plans</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link disabled">Disabled</a>
          </li> --}}

          {{-- <li class="nav-item dropdown" style="margin-right: 10px;">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <span style="position: relative;">
                <i class="bi bi-bell" style="font-size:20px;"></i>
                <span class="badge rounded-pill bg-danger" style="position: absolute; top: -5px; right: -5px;">3</span>
              </span>
            </a>
            <ul class="dropdown-menu notification-panel" aria-labelledby="navbarDropdown">
              <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action " style="background-color: orangered;" aria-current="true">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Bientôt Expiré</h5>
                    <small>16:20</small>
                  </div>
                  <p class="mb-1">l'abonnement de Foulen expirera bientôt.</p>
                  <p class="mb-1">La date d'expiration est prévue pour : </p>
                  <strong style="color: beige;">24/Mar/2023</strong>
                </a>

                <a href="{{url('show-client/1')}}" class="list-group-item list-group-item-action bg-danger">
                  <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">Abonnement Expiré</h5>
                    <small class="text-body-secondary">08:30</small>
                  </div>
                  <p class="mb-1">l'abonnement de Foulen est expiré.</p>
                  <p class="mb-1">La date d'expiration est : </p>
                  <strong style="color: beige;">24/Mar/2023</strong>
                </a>


              </div>
            </ul>
          </li> --}}

        </ul>

        <form class="d-flex" method="POST" action="{{ route('logout') }}">
          @csrf
          <x-responsive-nav-link class="btn btn-outline-warning" :href="route('logout')" style="text-align: center; margin-left: auto; margin-right: auto;" onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
          </x-responsive-nav-link>
        </form>
      </div>

    </div>

  </nav>
