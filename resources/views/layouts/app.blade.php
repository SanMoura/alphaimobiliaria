<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Argon Dashboard') }}</title>
        <!-- Favicon -->
        <link href="{{ asset('argon') }}/img/brand/favicon.png" rel="icon" type="image/png">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
        <!-- Icons -->
        <link href="{{ asset('argon') }}/vendor/nucleo/css/nucleo.css" rel="stylesheet">
        <link href="{{ asset('argon') }}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <!-- Argon CSS -->
        <link type="text/css" href="{{ asset('argon') }}/css/argon.css?v=1.0.0" rel="stylesheet">
        <style>
            body{
                text-transform: uppercase;
            }
        </style>
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @include('layouts.navbars.sidebar')
            
        @endauth
        
        <div class="main-content">
            @include('layouts.navbars.navbar')
            @yield('content')
        </div>

        @guest()
            @include('layouts.footers.guest')
        @endguest

        <script src="{{ asset('argon') }}/vendor/jquery/dist/jquery.min.js"></script>
        <script src="{{ asset('argon') }}/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="{{ asset('argon') }}/js/jquery.mask.min.js"></script>
        <script src="{{ asset('argon') }}/js/axios.min.js"></script>
        
        @stack('js')
        
        <!-- Argon JS -->
        <script src="{{ asset('argon') }}/js/argon.js?v=1.0.0"></script>
   
        @if ($errors->any())
        <div class="alert alert-danger animated bounceInUp" style="
            width: 50%;
            position: fixed;
            bottom: 0;
            right: 5px;
            z-index: 1;
        ">
            <button type="button" class="close" data-dismiss="alert" aria-label="Clise">
                <span aria-hidden="true">&times;</span>
            </button>
            <div class="row">
                <div class="col-md-1">
                    <div class="text-center">
                        <i class="fas fa-exclamation-triangle fa-3x"></i>
                    </div>
                </div>
                <div class="col-md-11">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        
        @if (session('success'))
            <div id="alert-msg" class="alert alert-success animated bounceInUp" style="
            width: 30%;
            position: fixed;
            bottom: 0;
            right: 5px;
            z-index: 1;
            ">
                <div class="row">
                    <div class="col-md-2">
                        <div class="text-center">
                            <i class="fas fa-check fa-3x"></i>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Clise">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ session('success') }}
                    </div>
                </div>
            </div>
        @endif
        
        @if (session('error'))
            <div class="alert alert-danger animated bounceInUp" style="
            width: 50%;
            position: fixed;
            bottom: 0;
            right: 5px;
            z-index: 1;
            ">
                <button type="button" class="close" data-dismiss="alert" aria-label="Clise">
                    <span aria-hidden="true">&times;</span>
                </button>
               {{ session('error') }}
            </div>
        @endif
       
        <script>
            setTimeout(
                function () {
                    $('#alert-msg').show().addClass('animated bounceOutDown');
                }, 2500
            );
        </script>

        <script>

            $(document).ready(function () {
                    $('#cpf').mask('000.000.000-00', {reverse: true});
                    $('#cpfUsuario').mask('000.000.000-00', {reverse: true});
                    $('#telefone').mask('(00) 00000-0000');
                    $('#renda').mask('000.000.000.000.000,00', {reverse: true});
                    
                });

            function proposta_id(e) {
                $('#proposta_id').val(e.id);
            }


            function exibe_anexos(par) {

                    $('#anexosTable').html('');
                    axios.post("{{ route('anexos') }}", {
                        log_proposta_id : par.id
                    })
                .then(function (response) {
                    // handle success
                    //console.table(response.data[0].nomeOriginal);

                    response.data.forEach(element => {
                    $('#anexosTable').append("<tr>"
                    +'<th scope="row">'+element.nomeOriginal+'</th>'
                    +"<td class='text-right'>"
                        +"<a href=\"{{ asset('files') }}/uploads/"+element.nome+"\" class=\"btn btn-primary btn-sm\" style=\"border-radius: 0 !important\" target=\"blank\">ABRIR</a>"
                        +"</td>"
                    +"</tr>"  
                    );

                    
                                        
                    });
                    

                })
                .catch(function (error) {
                    // handle error
                    console.log(error);
                })
                .then(function () {
                    // always executed
                });
            }


            function exibe_anexos_finalizados(par) {
                
                $('#anexosTable').html('');
                axios.post("{{ route('anexos_finalizados') }}", {
                    proposta_id : par.id
                    
                })
                .then(function (response) {
                // handle success
                

                response.data.forEach(element => {

                $('#anexosTable').append("<tr>"
                +'<th scope="row">'+element.nomeOriginal+'</th>'
                +"<td class='text-right'>"
                    +"<a href=\"{{ asset('files') }}/uploads/"+element.nome+"\" class=\"btn btn-primary btn-sm\" style=\"border-radius: 0 !important\" target=\"blank\">ABRIR</a>"
                    +"</td>"
                +"</tr>"  
                );
                 
                });


                })
                .catch(function (error) {
                // handle error
                console.log(error);
                })
                .then(function () {
                // always executed
                });
                }

        </script>
    </body>
</html>