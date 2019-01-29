<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" >
    
        <title>Inicio Sesión</title>
    
        <!-- Bootstrap core CSS -->
        {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous"> --}}
        <link href="{{ URL::asset('assets/css/bootstrap2.css')}}?v=<?php echo microtime();?>" rel="stylesheet" />
        <script src="{{ URL::asset('assets/js/jquery-2.2.4.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('assets/js/jquery.bootstrap.js') }}" type="text/javascript"></script>
        
        <!-- Custom styles for this template -->
       <link href="{{ URL::asset('css/signin.css')}}?v=<?php echo microtime();?>" rel="stylesheet" />
       <link href="{{ URL::asset('css/presupuesto.css')}}?v=<?php echo microtime();?>" rel="stylesheet" />


       
      <style>
      #descargarEbookBtn{
        background-color: white;
        color: rgb(163, 163, 163);
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
        box-shadow: 1px 1px 10px rgba(209, 209, 209, 0.85);
      }
      #descargarEbookBtn:hover{
        background-color: rgb(66, 236, 225);
        color: white;
      }
      body{
           /* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#f6f8f9+1,f1f1f1+70,eaeaea+70,eaeaea+70 */
background: rgb(246,248,249); /* Old browsers */
background: -moz-linear-gradient(top, rgba(246,248,249,1) 1%, rgba(241,241,241,1) 70%, rgba(234,234,234,1) 70%, rgba(234,234,234,1) 70%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(246,248,249,1) 1%,rgba(241,241,241,1) 70%,rgba(234,234,234,1) 70%,rgba(234,234,234,1) 70%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(246,248,249,1) 1%,rgba(241,241,241,1) 70%,rgba(234,234,234,1) 70%,rgba(234,234,234,1) 70%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f6f8f9', endColorstr='#eaeaea',GradientType=0 ); /* IE6-9 */
        }

   
      </style>
    </head>
    
    <body class="text-center">
        <?php  
    date_default_timezone_set("Europe/Madrid");  
    ?> 

      {!! Form::open(['action' => 'LoginController@start', 'class' =>'form-signin', 'style' => 'margin-top: 5%;']) !!}
        <img class="mb-4" src="/img/logo.png" alt="" width="280" >

        <input type="text" name="usuario" class="form-control" placeholder="Usuario" required="" autofocus="">

        <input type="password" name="password" class="form-control" placeholder="Contraseña" required="">
        <?php 
        if($_SERVER['SERVER_NAME'] == 'renta.somostuwebmaster.es') { 
          echo '<select name="mode_system" class="form-control" style=" margin-bottom: 10px;height: 45px;">
              <option value="TURNO">TURNO</option>
              <option value="DESPACHO">DESPACHO</option>
            </select>';
        }else{
          echo '<input type="hidden" name="mode_system" value="" >';
        }
        ?>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar Sesión</button>

        <div style="">
            
            <div onclick="window.open('{{ URL::asset('files/EbookConsultasRenta17.pdf')}}')"  style="margin-top: 20px;background-color: rgb(4, 215, 217);top: 20px;color: white;padding: 5px;border-radius: 1px; ">Descarga nuestro E-Book informativo <br>de la Declaración de la Renta 2017</div>
             <div id="descargarEbookBtn" onclick="window.open('{{ URL::asset('files/EbookConsultasRenta17.pdf')}}')" style="">Descargar</div>
         </div>
      {!! Form::close() !!}
      
      <div class="footer">
            <p><a href="http://somostuwebmaster.es" style=" color:white;">Powered by SomosTuWebMaster.es - {{date('Y')}}</a></p>
      </div>
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
              html += '<div style=" text-align: center;width: 100%;color: rgb(28, 95, 152);">';
                html += '<h1>Lo sentimos, su navegador no es compatible</h1>';
                html += '<h3>Recomendamos usar  Google Chrome </h3>';
                html += '<a href="https://www.google.com/chrome/"><img src="/img/Google_Chrome_icon.png"  height="80" ></a>';
              html += '</div>'
              document.getElementsByTagName("BODY")[0].innerHTML = html;
            }
        }
        
      </script>
    </body>
</html>