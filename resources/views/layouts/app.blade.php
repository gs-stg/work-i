<html lang="es">
<head>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <meta name="viewport" content="width=device-width" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> --}}
    <link href="{{ URL::asset('assets/css/bootstrap2.css') }}?v=<?php echo microtime();?>" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> 
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
   
    <!--     Fonts and icons     -->
	<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->

    <link href="{{ URL::asset('assets/css/bootstrap.min.css')}}?v=<?php echo microtime();?>" rel="stylesheet" />
    <link href="{{ URL::asset('assets/css/material-bootstrap-wizard.css')}}?v=<?php echo microtime();?>" rel="stylesheet" />
    <link href="{{ URL::asset('css/presupuesto.css')}}?v=<?php echo microtime();?>" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >


    <script src="{{ URL::asset('assets/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('assets/js/jquery.bootstrap.js') }}" type="text/javascript"></script>

    <!--  Plugin for the Wizard -->
    <script src="{{ URL::asset('assets/js/material-bootstrap-wizard.js') }}" type="text/javascript"></script>

    <!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
    <script src="{{ URL::asset('assets/js/jquery.validate.min.js')}}"></script>

    {{-- <script src="https://code.jquery.com/jquery-1.12.4.js"></script> --}}
    <script src="{{ URL::asset('jquery/jquery-ui.js')}}?v=<?php echo microtime();?>"></script>
    <link rel="stylesheet" href="{{ URL::asset('jquery/jquery-ui.css')}}?v=<?php echo microtime();?>">

    {{-- summernote --}}
    <script src="{{ URL::asset('summernote/summernote.js')}}?v=<?php echo microtime();?>"></script>
    <link rel="stylesheet" href="{{ URL::asset('summernote/summernote.css')}}?v=<?php echo microtime();?>">
    <script src="{{ URL::asset('summernote/lang/summernote-es-ES.js')}}?v=<?php echo microtime();?>"></script>

    {{-- calendar --}}
    <link rel="stylesheet" href="{{ URL::asset('dist-calendar/vanillaCalendar.css')}}?v=<?php echo microtime();?>">

    {{-- mention --}}
    <link rel="stylesheet" href="{{ URL::asset('assets/css/recommended-styles.css')}}?v=<?php echo microtime();?>">
	<script type='text/javascript' src="{{ URL::asset('assets/js/bootstrap-typeahead.js')}}?v=<?php echo microtime();?>"></script>
	<script type='text/javascript' src="{{ URL::asset('assets/js/mention.js')}}?v=<?php echo microtime();?>"></script>
    {{-- clipboard --}}
    <script  src="{{ URL::asset('js/clipboard.js')}}?v=<?php echo microtime();?>"></script>

    <title>Sistema</title>
    <style>
    body { padding-right: 0 !important }
    </style>

</head>
<body>
    <?php  
    date_default_timezone_set("Europe/Madrid");   
    ?>  

   @include('inc.navbar')
   @include('inc.messages')
   @yield('content')


   <div class="footer">
   <p><a href="http://somostuwebmaster.es" style=" color:white;">Powered by SomosTuWebMaster.es - {{date('Y')}}</a></p>
      </div>

      @yield('js')
      <script>
        
        checkBrowser();
        function checkBrowser()
        {
            // Opera 8.0+
            var isOpera = (!!window.opr && !!opr.addons) || !!window.opera || navigator.userAgent.indexOf(' OPR/') >= 0;

            // Firefox 1.0+
            var isFirefox = typeof InstallTrigger !== 'undefined';

            // Safari 3.0+ "[object HTMLElementConstructor]" 
            var isSafari = /constructor/i.test(window.HTMLElement) || (function (p) { return p.toString() === "[object SafariRemoteNotification]"; })(!window['safari'] || (typeof safari !== 'undefined' && safari.pushNotification));

            // Internet Explorer 6-11
            var isIE = /*@cc_on!@*/false || !!document.documentMode;

            // Edge 20+
            var isEdge = !isIE && !!window.StyleMedia;

            // Chrome 1+
            var isChrome = !!window.chrome && !!window.chrome.webstore;

            // Blink engine detection
            var isBlink = (isChrome || isOpera) && !!window.CSS;

            if (isIE) {
              var html = '';
              html += '<div style=" text-align: center;width: 100%;color: rgb(96, 96, 96);padding: 20px;margin-top: 45px;/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#ffffff+0,e5e5e5+11,e5e5e5+20,e5e5e5+26,ededed+35,e5e5e5+45,f3f3f3+50,ededed+51,f9f9f9+83,ffffff+100 */background: rgb(255,255,255); /* Old browsers */background: -moz-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(229,229,229,1) 11%, rgba(229,229,229,1) 20%, rgba(229,229,229,1) 26%, rgba(237,237,237,1) 35%, rgba(229,229,229,1) 45%, rgba(243,243,243,1) 50%, rgba(237,237,237,1) 51%, rgba(249,249,249,1) 83%, rgba(255,255,255,1) 100%); /* FF3.6-15 */background: -webkit-linear-gradient(45deg, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 11%,rgba(229,229,229,1) 20%,rgba(229,229,229,1) 26%,rgba(237,237,237,1) 35%,rgba(229,229,229,1) 45%,rgba(243,243,243,1) 50%,rgba(237,237,237,1) 51%,rgba(249,249,249,1) 83%,rgba(255,255,255,1) 100%); /* Chrome10-25,Safari5.1-6 */background: linear-gradient(45deg, rgba(255,255,255,1) 0%,rgba(229,229,229,1) 11%,rgba(229,229,229,1) 20%,rgba(229,229,229,1) 26%,rgba(237,237,237,1) 35%,rgba(229,229,229,1) 45%,rgba(243,243,243,1) 50%,rgba(237,237,237,1) 51%,rgba(249,249,249,1) 83%,rgba(255,255,255,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */filter: progid:DXImageTransform.Microsoft.gradient( startColorstr=\'#ffffff\', endColorstr=\'#ffffff\',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */">';
                html += '<h1>Lo sentimos, su navegador no es compatible </h1>';
                html += '<h3>Recomendamos usar  Google Chrome </h3>';
                html += '<a href="https://www.google.com/chrome/"><img src="/img/Google_Chrome_icon.png"  height="80" ></a>';
              html += '</div>'
              document.getElementsByTagName("BODY")[0].innerHTML = html;
            }
        }
        
      </script>
</body>


<!--   Control Presupuesto   -->
<script src="{{ URL::asset('/js/presupuesto.js')}}?v=<?php echo microtime();?>"></script>
<script src="{{ URL::asset('/js/impuesto.js')}}?v=<?php echo microtime();?>"></script>
<!--   Core JS Files   -->
{{-- <script src="{{ URL::asset('assets/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/jquery.bootstrap.js') }}" type="text/javascript"></script>

<!--  Plugin for the Wizard -->
<script src="{{ URL::asset('assets/js/material-bootstrap-wizard.js') }}" type="text/javascript"></script>

<!--  More information about jquery.validate here: http://jqueryvalidation.org/  -->
<script src="{{ URL::asset('assets/js/jquery.validate.min.js')}}"></script> --}}


</html>