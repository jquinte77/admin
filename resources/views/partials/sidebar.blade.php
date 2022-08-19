
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link active">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Active Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inactive Page</p>
                </a>
              </li>
            </ul>
          </li> --}}
          @php
              $niveles = [];
          @endphp
          @foreach ($options as $option)
            {{-- {{ dump($option->idopcionmenu) }} --}}
            @php
                $length  = Str::length($option->idopcionmenu);
                $ruta = $option->webrutas ?? NULL;
                if($length == 2){
                    $niveles[$option->idopcionmenu]['name'] = $option->nombreopcionmenu;
                    $niveles[$option->idopcionmenu]['icon'] = $option->iconfontawe;
                    $niveles[$option->idopcionmenu]['tipodoc'] = $option->tipodoc;
                    $niveles[$option->idopcionmenu]['webrutas'] = $ruta;
                    $niveles[$option->idopcionmenu]['arr'] = [];
                    $niveles[$option->idopcionmenu]['routes'][] = $ruta;
                }

                if($length == 4) {
                    $id1 = Str::substr($option->idopcionmenu,0,2);
                    $niveles[$id1]['routes'][] = $option->webrutas;
                    $niveles[$id1]['arr'][$option->idopcionmenu]['name'] = $option->nombreopcionmenu;
                    $niveles[$id1]['arr'][$option->idopcionmenu]['icon'] = $option->iconfontawe;
                    $niveles[$id1]['arr'][$option->idopcionmenu]['tipodoc'] = $option->tipodoc;
                    $niveles[$id1]['arr'][$option->idopcionmenu]['webrutas'] = $ruta;
                    $niveles[$id1]['arr'][$option->idopcionmenu]['arr'] = [];
                    $niveles[$id1]['arr'][$option->idopcionmenu]['routes'][] = $ruta;
                    // $niveles[$option->idopcionmenu]['routes'][] = $option->webrutas;
                }

                if($length == 6) {
                    $id1 = Str::substr($option->idopcionmenu,0,2);
                    $id2 = Str::substr($option->idopcionmenu,0,4);
                    $niveles[$id1]['routes'][] = $ruta;
                    $niveles[$id1]['arr'][$id2]['routes'][] = $ruta;

                    $niveles[$id1]['arr'][$id2]['arr'][$option->idopcionmenu]['name'] = $option->nombreopcionmenu;
                    $niveles[$id1]['arr'][$id2]['arr'][$option->idopcionmenu]['icon'] = $option->iconfontawe;
                    $niveles[$id1]['arr'][$id2]['arr'][$option->idopcionmenu]['tipodoc'] = $option->tipodoc;
                    $niveles[$id1]['arr'][$id2]['arr'][$option->idopcionmenu]['webrutas'] = $ruta;
                    $niveles[$id1]['arr'][$id2]['arr'][$option->idopcionmenu]['arr'] = [];
                    $niveles[$id1]['arr'][$id2]['arr'][$option->idopcionmenu]['routes'][] = $ruta;
                }
            @endphp

          @endforeach
          @php
            $niveles = array_values($niveles);
          @endphp
          @foreach ($niveles as $key => $nivel)
            <li class="nav-item {{ setActiveRoute(array_values(array_filter($nivel['routes']))) == 'active' ? 'menu-is-opening menu-open' : '' }}">
                <a href="{{ $nivel['webrutas'] == '' ? 'javascript:void(0)' : route($nivel['webrutas'],$nivel['tipodoc']) }}" class="nav-link {{ setActiveRoute(array_values(array_filter($nivel['routes']))) }}">
                    <i class="nav-icon {{ ArrValidate($nivel["icon"]) ?? 'fas fa-tachometer-alt' }}"></i>
                    <p>
                        {{ $nivel["name"] ?? '' }}
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    @foreach(array_values($nivel['arr'] ?? []) as $value)
                        <li class="nav-item" >
                            <a href="{{ $value['webrutas'] == '' ? 'javascript:void(0)' : route($value['webrutas'],$value['tipodoc']) }}" class="nav-link {{ setActiveRoute(array_values(array_filter($value['routes']))) }}">
                                &nbsp;&nbsp;&nbsp;<i class="nav-icon {{ ArrValidate($value["icon"]) ?? 'far fa-circle' }}"></i>
                                <p>{{ $value['name'] ?? '' }}</p>
                            </a>
                            @foreach(array_values($value['arr'] ?? []) as $val)
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                    <a href="{{ $val['webrutas'] == '' ? 'javascript:void(0)' : route($val['webrutas'],$val['tipodoc']) }}" class="nav-link">
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon {{ ArrValidate($val["icon"]) ?? 'far fa-dot-circle' }}"></i>
                                        <p>{{ $val['name'] ?? '' }}</p>
                                    </a>
                                    </li>
                                </ul>
                            @endforeach
                        </li>
                    @endforeach
                </ul>
            </li>
          @endforeach
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
