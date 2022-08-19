@extends('layouts.app')

@section('content')

{{-- {{ dd($arrCbo->first()->vparent) }} --}}
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Ventas</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Ventas</a></li>
            <li class="breadcrumb-item active">Factura</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div>
                        <div class="list card-header">
                            <h3 class="card-title">Factura</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="details d-none card-header">
                            <h3 class="card-title">Detalle de Comprobante</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool btn-cerrar-detalle">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-tools -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="list">
                            <form id="quick-form">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Fecha Inicio:</label>
                                        <input type="date" class="form-control form-control form-control-sm" name="fechaInicio" id="fechaInicio" value="{{ date('Y-m-01') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Fecha Fin:</label>
                                        <input type="date" class="form-control form-control form-control-sm" name="fechaFin" id="fechaFin" value="{{ date('Y-m-t') }}">
                                    </div>
                                    <div class="col-md-2">
                                        <label>Mes:</label>
                                        <select class="form-control form-control-sm" id="cboMes" name="cboMes">
                                            <option value="01" {{ date('m') == 1 ?'selected' : '' }}>ENERO</option>
                                            <option value="02" {{ date('m') == 2 ?'selected' : '' }}>FEBRERO</option>
                                            <option value="03" {{ date('m') == 3 ?'selected' : '' }}>MARZO</option>
                                            <option value="04" {{ date('m') == 4 ?'selected' : '' }}>ABRIL</option>
                                            <option value="05" {{ date('m') == 5 ?'selected' : '' }}>MAYO</option>
                                            <option value="06" {{ date('m') == 6 ?'selected' : '' }}>JUNIO</option>
                                            <option value="07" {{ date('m') == 7 ?'selected' : '' }}>JULIO</option>
                                            <option value="08" {{ date('m') == 8 ?'selected' : '' }}>AGOSTO</option>
                                            <option value="09" {{ date('m') == 9 ?'selected' : '' }}>SEPTIEMBRE</option>
                                            <option value="10" {{ date('m') == 10 ?'selected' : '' }}>OCTUBRE</option>
                                            <option value="11" {{ date('m') == 11 ?'selected' : '' }}>NOVIEMBRE</option>
                                            <option value="12" {{ date('m') == 12 ?'selected' : '' }}>DICIEMBRE</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Año:</label>
                                        <select class="form-control form-control-sm" id="cboAnio" name="cboAnio">
                                            <option value="" selected disabled>[ SELECCIONE ]</option>
                                            {{ $now = date('Y') }}
                                            {{ $last= date('Y')+20 }}

                                            @for ($i = $now; $i <= $last; $i++)
                                                <option value="{{ $i }}" {{ date('Y') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label>Condición:</label>
                                        <select name="cboCondicion" id="cboCondicion" class="form-control form-control-sm">
                                            <option value="" selected disabled>[ SELECCIONE ]</option>
                                            @foreach ($arrCbo as $cbo)
                                                @if ($cbo->vparent == "ConDoc")
                                                    <option value="{{ $cbo->vcodalt }}">{{ $cbo->vdescri }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label>Estado:</label>
                                        <select name="cboCondicion" id="cboCondicion" class="form-control form-control-sm">
                                            <option value="" selected disabled>[ SELECCIONE ]</option>
                                            @foreach ($arrCbo as $cbo)
                                                @if ($cbo->vparent == "TipEstDoc")
                                                    <option value="{{ $cbo->vcodalt }}">{{ $cbo->vdescri }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label>Buscar: </label>
                                        <input type="text" class="form-control form-control-sm" placeholder="Buscar" id="busqueda" name="busqueda">
                                    </div>
{{--
                                    <div class="col-md-1">
                                    </div> --}}
                                    <div class="col-md-2">
                                        <label>Nro.:</label>
                                        <div class="form-inline">
                                            <input type="text" class="form-control form-control-sm" style="width: 40%">
                                            {{-- <label class="WHITE">&nbsp;&nbsp;&nbsp;</label> --}}
                                            <input type="text" class="form-control form-control-sm" style="width: 60%">
                                        </div>
                                    </div>
                                    <input type="hidden" name="tipodoc" id="tipodoc" value="{{ $tipodoc }}">
                                    <div class="col-md-1">
                                        <label class="text-white">BTN:</label>
                                        <button type="submit" class="btn btn-primary btn-sm btn-block"><i class="fa fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <div class="row mt-3">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-sm text-center">
                                            <thead>
                                                <tr>
                                                    <th>Estado</th>
                                                    <th>Persona</th>
                                                    <th>RUC / DNI</th>
                                                    <th>Documento</th>
                                                    <th>Condición</th>
                                                    <th>Fecha</th>
                                                    <th>Moneda</th>
                                                    <th>Saldo</th>
                                                    <th>Total</th>
                                                    <th>Acción</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyfactura">
                                                <tr>
                                                    <td colspan="10">[ FILTRE ]</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="details d-none">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>DNI: </label>
                                        <input type="text" class="form-control form-control-sm" id="dni_details" name="dni_details" disabled>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">

                                    </div>
                                </div>
                                <div class="col-md-3">

                                </div>
                                <div class="col-md-3">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm">
                                            <thead>
                                                <tr>
                                                    <th>icodart</th>
                                                    <th>icodund</th>
                                                    <th>ctipart</th>
                                                    <th>iitems</th>
                                                    <th>vcodalt</th>
                                                    <th>Descripción</th>
                                                    <th>Cantidad</th>
                                                    <th>Precio</th>
                                                    <th>SubTotal</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbodyDetalle">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="overlay dark d-none">
                        <i class="fas fa-2x fa-sync-alt"></i>
                    </div>
                <!-- /.card-body -->
                </div>
            </div>
        <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
@push('scripts')
    <script src="{{ asset('plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('plugins/axios/axios.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let datosComprobantes = new Array();
            $("#quick-form").validate({
                rules: {
                    fechaInicio: {required: false},
                    fechaFin:{required: false},
                },
                messages: {
                    fechaInicio:{
                        required: 'Campo requerido'
                    },
                    fechaFin:{
                        required: 'Campo requerido'
                    }
                },
                errorElement: 'span',
                errorPlacement: function (error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function (e) {
                    console.log(e);
                    data = {
                        'doc'           : e.tipodoc.value,
                        'fechaInicio'   : e.fechaInicio.value,
                        'fechaFin'      : e.fechaFin.value,
                    }
                    search(data);
                }
            });

            $("#tbodyfactura").on("click",".btn-detalle",function(e){
                $(".details").removeClass('d-none');
                $(".list").addClass('d-none');
                let id = $(this).attr('data-id');

                detalleComprobante(id);
            });

            $(".btn-cerrar-detalle").click(function(){
                $(".details").addClass('d-none');
                $(".list").removeClass('d-none');
            });

            $("#cboMes").change(function (){
                firstDate($(this).val(),$("#cboAnio").val());
            });

            $("#cboAnio").change(function(){
                firstDate($("#cboMes").val(),$(this).val());
            });

            function search(data){
                axios.get("{{ route('venta.listar.factura') }}",{
                    params: data
                })
                .then(res=>{
                    html = '';
                    console.log(res.data);
                    datosComprobantes = res.data;

                    res.data.forEach((e)=>{
                        html+=`<tr>
                            <td>${e.Estado}</td>
                            <td>${e.vclient}</td>
                            <td>${e.vdocide}</td>
                            <td>${e.vserie} - ${e.nro}</td>
                            <td>${e.Condicion}</td>
                            <td>${dateFormat(e.sdfecdoc)}</td>
                            <td class="text-left">${e.Moneda == null ? 'S/M': e.Moneda}</td>
                            <td class="text-right">${parseFloat(e.nSaldos).toFixed(2)}</td>
                            <td class="text-right">${parseFloat(e.nTotal).toFixed(2)}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false"></button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item btn-detalle" href="javascript:void(0)" data-id="${e.vcoddv}">Detalle</a>
                                    </div>
                                </div>
                            </td>
                        </tr>`;
                    });

                    $("#tbodyfactura").html(html);
                })
                .catch(err=>{
                    console.log(err);
                })
            }

            function dateFormat(date){
                date = new Date(date);
                new_date = date.getDate() + "/" + pad('00',(date.getMonth() + 1),true) + "/" + String(date.getFullYear()).substring(2)
                return new_date;
            }
            function firstDate(month,year){
                ddd = year+'-'+month+'-02';
                let date = new Date(ddd);
                let primerDia = new Date(date.getFullYear(), date.getMonth(), 1);
                let ultimoDia = new Date(date.getFullYear(), date.getMonth() + 1, 0);

                nprimerDia =  primerDia.getFullYear() + "-" + pad('00',(primerDia.getMonth() + 1),true) + "-" + "01";
                nultimoDia =  ultimoDia.getFullYear() + "-" + pad('00',(ultimoDia.getMonth() + 1),true) + "-" + pad('00',ultimoDia.getDate());


                // console.log(primerDia);
                $("#fechaInicio").val(nprimerDia);
                $("#fechaFin").val(nultimoDia);
            }
            function pad(pad, str, padLeft) {
                if (typeof str === 'undefined')
                    return pad;
                if (padLeft) {
                    return (pad + str).slice(-pad.length);
                } else {
                    return (str + pad).substring(0, pad.length);
                }
            }

            function detalleComprobante(id){
                // console.log(id);
                axios.get("{{ route('venta.detalle.factura') }}",{
                    params: {id:id}
                })
                .then(res=>{
                    console.log(res.data);
                    html = '';
                    res.data.forEach((e,i)=>{
                        html += `
                            <tr>
                                <td>${e.icodart}</td>
                                <td>${e.ctipart}</td>
                                <td>${e.iitems}</td>
                                <td>${e.vcodalt}</td>
                                <td>${e.descripcion}</td>
                                <td>${e.ncantid}</td>
                                <td>${e.vdescri}</td>
                                <td>${e.nprecio}</td>
                                <td>${e.nsubtot}</td>
                            </tr>
                        `;
                    });

                    $("#tbodyDetalle").html(html);
                })
                .catch(err=>{
                    console.log(err);
                })
            }

        });
    </script>
@endpush
