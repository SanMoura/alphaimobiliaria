@inject('menusN', 'App\Http\Controllers\menu\MenuController')
@inject('menus', 'App\Http\Controllers\menu\MenuController')
<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            {{-- <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg"> --}}
                            <img alt="Image placeholder" src="{{ asset('files/fotos') }}/{{ auth()->user()->foto ?? 'coringa.png' }}">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Bem Vindo!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('Meu Perfil') }}</span>
                    </a>
                  
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Sair') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="{{ __('Search') }}" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            @forelse ($menus->index() as $menu)
            @if (auth()->user()->cargo_id == 1)
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route($menu->route) }}">
                            {!!$menu->icone !!} {{ $menu->ds_menu }}
                        </a>
                    </li>
                </ul>    
            @else
                @if ($menu->cargo_id == null)
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route($menu->route) }}">
                            {!!$menu->icone !!} {{ $menu->ds_menu }}
                        </a>
                    </li>
                </ul>    
                @endif
            @endif
            
            @empty
                
            @endforelse
            @if (auth()->user()->cargo_id == 1)
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted"><i class="far fa-chart-bar" style="color: #852E2A;"></i> Relatórios</h6>
            
            
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('relatorioOperacional') }}">
                        <i class="fas fa-building" style="color: #852E2A;"></i> OPERACIONAL
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('relatorioAdministrativo') }}">
                        <i class="fas fa-user-cog" style="color: #852E2A;"></i> ADMINISTRATIVO
                    </a>
                </li>
            </ul>
            @endif


            @if (auth()->user()->cargo_id == 1)
            <!-- Divider -->
            <hr class="my-3">
            <!-- Heading -->
            <h6 class="navbar-heading text-muted"><i class="far fa-window-restore" style="color: #852E2A;"></i> Site</h6>
            
            
            <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('cadPostagem') }}">
                        <i class="fas fa-rss" style="color: #852E2A;"></i> Postagens
                    </a>
                </li>
            </ul>
            @endif
        
        </div>
    </div>
</nav>