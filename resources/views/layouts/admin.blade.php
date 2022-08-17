<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" type="image/jpg" href="{{ URL::asset('assets/logo.png'); }}"/>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>NetMD</title>
        <meta name="google-translate-customization" content="9f841e7780177523-3214ceb76f765f38-gc38c6fe6f9d06436-c"></meta>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
        
        <link href="{{ URL::asset('plugins/bootstrap-4.6.2-dist/css/bootstrap.min.css'); }}" rel="stylesheet">
        <link href="{{ URL::asset('plugins/DataTables/datatables.min.css'); }}" rel="stylesheet">

        <script src="{{ URL::asset('plugins/jquery-3.6.0.min.js'); }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="{{ URL::asset('plugins/bootstrap-4.6.2-dist/js/bootstrap.min.js'); }}"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ URL::asset('css/app.css'); }}" rel="stylesheet">
        <link href="{{ URL::asset('plugins/iconos/style.css'); }}" rel="stylesheet">
        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link href="{{ URL::asset('css/spin.css'); }}" rel="stylesheet">
        <style>
.google-translate {
    display: inline-block;
    vertical-align: top;
    padding-top: 15px;
}

.goog-logo-link {
    display: none !important;
}

.goog-te-gadget {
    color: transparent !important;
}

#google_translate_element {
   
}

.goog-te-banner-frame.skiptranslate {
    display: none !important;
}

body {
    top: 0px !important;
}

</style>

    </head>
    <body class="antialiased">
        <div style="position:absolute;background: white;width:100%;">
            <header >
                <div class="row">
                    <div class="col-sm-4">
                    <img src="{{ URL::asset('assets/LOGO NET.jpeg'); }}" style="width:220px;"/>
                    </div>
                    <div class="col-sm-4 d-flex text-center align-items-center justify-content-center" >
                    <label> Aplicación Administrativa</label>
                    </div>
                    <div class="col-sm-4 d-flex justify-content-end text-center align-items-center" id="google_translate_element"></div>
                </div>
            </header>
            <nav class="d-flex align-items-center" style="padding: 0px 0px 0px 10px;    margin-top: 35px;opacity:0.9;">
                <div class="row " style="width: 99%;">
                    <div class="col-sm-2 d-flex align-items-center justify-content-center text-center border-right">
                        <a href="{{route('cuestionarios.index')}}" class="text-white font-weight-bold"><i class="fa fa-cog" aria-hidden="true"></i> Cuestionarios</a>
                    </div>
                    <?php $case=8;?>
                    @if(!empty($_SESSION['id']))
                        @if($_SESSION['id']==1)
                            <?php $case=6;?>
                            <div class="col-sm-2 d-flex align-items-center justify-content-center text-center border-right">
                                <a href="{{route('usuarios.index')}}" class="text-white font-weight-bold"><i class="fa fa-cog" aria-hidden="true"></i> Usuarios</a>
                            </div>
                        @endif
                    @endif
                    <div class="col-sm-2 d-flex align-items-center justify-content-center text-center border-right">
                        <a href="{{route('usuarios.perfil')}}" class="text-white font-weight-bold"><i class="i i-cogs" aria-hidden="true"></i> Perfil</a>
                    </div>
                    <div class="col-sm-{{$case}} d-flex align-items-center justify-content-end text-center ">
                        <a href="{{route('login.logout')}}" class="text-white font-weight-bold"><i class="fa fa-sign-out" aria-hidden="true"></i> </a>
                    </div>
                </div>
            </nav>
            <div class="flex-container body" style="overflow-x: hidden;padding-bottom:25px;">
                <div class="row">
                        
                        <div class="col-sm-12">
                            @section('content')
                        
                            @show
                        </div>
                </div>
            </div>
            <footer class="d-flex align-items-center text-white">
                <div class="row w-100">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-6 d-flex justify-content-center text-white font-weight-bold"> Copyright ©<?php echo date("Y")?></div>
                    <div class="col-sm-3"></div>
                </div>
            </footer>
</div>
        <div class="spin" >
            <div class="e-loadholder">
                <div class="m-loader">
                    <span class="e-text">Cargando</span>
                </div>
            </div>
            <div id="particleCanvas-Blue"></div>
            <div id="particleCanvas-White"></div>
        </div>
        <script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
        <script src="{{ URL::asset('plugins/sweetalert2/dist/sweetalert2.all.min.js'); }}"></script>
        <script src="{{ URL::asset('plugins/DataTables/datatables.min.js'); }}"></script>
        <script src="{{ URL::asset('js/Validaciones.js'); }}"></script>
        <script src="{{ URL::asset('js/alerts.js'); }}"></script>
        <script src="{{ URL::asset('js/spin.js'); }}"></script>
    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement(
                {pageLanguage: 'en'},
                'google_translate_element'
            );
            $('#google_translate_element select').addClass("form-select");
        }
    </script>
    </body>
</html>