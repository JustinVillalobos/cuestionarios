<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>NetMD</title>
        <meta name="google-translate-customization" content="9f841e7780177523-3214ceb76f765f38-gc38c6fe6f9d06436-c"></meta>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">
        
        <link href="{{ URL::asset('plugins/bootstrap-4.6.2-dist/css/bootstrap.min.css'); }}" rel="stylesheet">

        <script src="{{ URL::asset('plugins/jquery-3.6.0.min.js'); }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="{{ URL::asset('plugins/bootstrap-4.6.2-dist/js/bootstrap.min.js'); }}"></script>
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="{{ URL::asset('css/spin.css'); }}" rel="stylesheet">
        <link href="{{ URL::asset('css/home.css'); }}" rel="stylesheet">
        <link href="{{ URL::asset('plugins/iconos/style.css'); }}" rel="stylesheet">
        <!-- Styles -->

        
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
        
        <div class="flex-container body" style="padding: 0px;">
           <div class="row" style="    width: 100%;">
                
                <div class="col-sm-12" style="    padding: 0px;">
                    @section('content')
                
                    @show
                </div>
           </div>
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
        <script src="{{ URL::asset('plugins/sweetalert2/dist/sweetalert2.all.min.js'); }}"></script>
        <script src="https://code.createjs.com/easeljs-0.7.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>
        <script src="{{ URL::asset('plugins/confetti.min.js'); }}"></script>
        
        <script src="https://use.fontawesome.com/b5bf1bd49e.js"></script>
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
        

       
        <script src="{{ URL::asset('js/Validaciones.js'); }}"></script>
        <script src="{{ URL::asset('js/alerts.js'); }}"></script>
        <script src="{{ URL::asset('js/spin.js'); }}"></script>
        <script src="{{ URL::asset('js/home.js'); }}"></script>
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