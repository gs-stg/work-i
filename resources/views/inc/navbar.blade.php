<nav class="navbar navbar-expand-lg navbar-light bg-light rounded border-bottom box-shadow"  >
    <a class="navbar-brand" href="/"><img src="/img/logo.png" height="50" style=" margin-top: -20px;">
      
    </a>
    
       
    <div class="collapse navbar-collapse" style="max-width: 200px;">
        <div style=" text-transform: capitalize;color: rgb(255, 117, 63);max-width: 200px;"> {{Session::get('user') -> t_usuariosNombre}} {{Session::get('user') -> t_usuariosApellido}}</div>
        <div style=" text-transform: capitalize;color: rgb(120, 120, 120);max-width: 200px;"> {{Session::get('oficina') -> t_oficinasNombre }}</div>
        
        
    </div>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">



            <!-- Dropdown -->
            @if (isset(Session::get('permisos')['menu_meeting']) || isset(Session::get('permisos')['menu_task']) || isset(Session::get('permisos')['menu_note']))
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbardrop1" data-toggle="dropdown" >
                Agenda
              </a>
              
              <div class="dropdown-menu">
                <div class="dropdown-header">Agenda</div>

                @if (isset(Session::get('permisos')['menu_note']))
                  <a class="dropdown-item"  href="/task/project">Anotaciones</a>
                @endif
      
                @if (isset(Session::get('permisos')['menu_meeting']))
                  <a class="dropdown-item"  href="/task/meeting">Reuniones</a>
                @endif

                @if (isset(Session::get('permisos')['menu_task']))
                <a class="dropdown-item"  href="/task">Tareas</a>
                @endif

              </div>
            </li>
            @endif

          {{-- @if (isset(Session::get('permisos')['menu_meeting']))
            <li class="nav-item">
              <a class="nav-link "  href="/task/meeting">Reuniones</a>
            </li>
          @endif
          @if (isset(Session::get('permisos')['menu_task']))
            <li class="nav-item">
              <a class="nav-link "  href="/task">Tareas</a>
            </li>
          @endif --}}

          {{-- @if (isset(Session::get('permisos')['menu_crearPresupuesto']))
            <li class="nav-item">
              <a class="nav-link " style=" font-size: 16px;color: rgb(111, 111, 111);" href="/presupuesto">Crear Presupuesto</a>
            </li>
          @endif

          @if (isset(Session::get('permisos')['menu_consultarPresupuestos']))
            <li class="nav-item">
            <a class="nav-link "  style=" font-size: 16px;color: rgb(111, 111, 111);" href="/consultar">Consultar Presupuestos</a>
            </li>
          @endif --}}

          {{-- @if (isset(Session::get('permisos')['menu_crearCustionarioRenta']))
            <li class="nav-item">
              <a class="nav-link "  style=" font-size: 16px;color: rgb(111, 111, 111);" href="/impuesto">Crear Cuestionario Renta</a>
            </li>
          @endif

          @if (isset(Session::get('permisos')['menu_consultarCustionarioRenta']))
            <li class="nav-item">
              <a class="nav-link "  style=" font-size: 16px;color: rgb(111, 111, 111);" href="/impuesto/consultar">Consultar Cuestionarios Renta</a>
            </li>
          @endif --}}

          


          <!-- Dropdown -->
          @if (isset(Session::get('permisos')['menu_consultarPresupuestos']))
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop1" data-toggle="dropdown" >
              Presupuestos
            </a>
            
            <div class="dropdown-menu">
                <div class="dropdown-header">Presupuestos</div>
              @if (isset(Session::get('permisos')['menu_crearPresupuesto']))
                <a class="dropdown-item"  href="/presupuesto">Crear Presupuesto</a>
              @endif
    
              @if (isset(Session::get('permisos')['menu_consultarPresupuestos']))
                <a class="dropdown-item"  href="/consultar">Consultar Presupuestos</a>
              @endif
            </div>
          </li>
          @endif
          <!-- Dropdown -->
          @if (isset(Session::get('permisos')['menu_consultarCustionarioRenta']))
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop2" data-toggle="dropdown" >
              Impuestos
            </a>
            <div class="dropdown-menu">
                <div class="dropdown-header">Impuestos</div>
              @if (isset(Session::get('permisos')['menu_crearCustionarioRenta']))
                <a class="dropdown-item" href="/impuesto">Crear Cuestionario Renta</a>
              @endif
    
              @if (isset(Session::get('permisos')['menu_consultarCustionarioRenta']))
                <a class="dropdown-item"  href="/impuesto/consultar">Consultar Cuestionarios Renta</a>
              @endif
            </div>
          </li>
          @endif
          <li class="nav-item">
            <a class="nav-link "  onclick="window.open('{{ URL::asset('files/EbookConsultasRenta17.pdf')}}')" >E-Book Renta 2017</a>
          </li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="/login/out"><span class="glyphicon glyphicon-log-out"></span> Cerrar Sesión</a></li>
          </ul>
      </div>  


      







      

      


    
  {{-- <ul class="nav justify-content-center">
    <li class="nav-item">
      <a class="nav-link " style=" font-size: 20px;color: rgb(111, 111, 111);" href="/{{Session::get('user') -> t_usuariosReferencia}}">Crear</a>
    </li>
    <li class="nav-item">
      <a class="nav-link "  style=" font-size: 20px;color: rgb(111, 111, 111);" href="/consultar">Consultar</a>
    </li>
  </ul> --}}
</nav> 



	


  
   