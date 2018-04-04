@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1  style-default-bright" style="margin-top: 10px;margin-left: 1%;width: 98%;">
            <form class="form-horizontal" id="search-form">
                <div class="card">
                    <div class="card-head style-primary">
                        <header>Filtros</header>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <h2 class="text-primary">Por Fechas:</h2>
                                <div class="form-group" style="padding: 10px 25px">
                                    <div class="input-daterange input-group" id="demo-date-range">
                                        <div class="input-group-content">
                                            <input type="text" class="form-control" name="inicio"  id="inicio" />
                                            <label>Desde</label>
                                        </div>
                                        <span class="input-group-addon">hasta</span>
                                        <div class="input-group-content">
                                            <input type="text" class="form-control" name="fin"  id="fin"/>
                                            <div class="form-control-line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <h2 class="text-primary">Por Regionales:</h2>
                                <div class="form-group" style="padding: 10px 25px">
                                    <div class="col-sm-9" id="regional">
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="regional[]"  type="checkbox" value="LA PAZ" checked="checked"><span>La Paz</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="regional[]"  type="checkbox" value="COCHABAMBA" checked="checked"><span>Cochabamba</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="regional[]"  type="checkbox" value="TARIJA" checked="checked"><span>Tarija</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="regional[]"  type="checkbox" value="EPC" checked="checked"><span>EPC</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="regional[]"  type="checkbox" value="SANTA CRUZ" checked="checked"><span>Santa Cruz</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="regional[]"  type="checkbox" value="CENTRAL" checked="checked"><span>Unidad Central</span>
                                        </label>
                                    </div><!--end .col -->
                                </div><!--end .form-group -->
                            </div>
                            <div class="col-md-12">
                                <h2 class="text-primary">Por Tipos:</h2>
                                <div class="form-group" style="padding: 10px 25px">
                                    <div class="col-sm-12" id="tipo">
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="tipó[]"  type="checkbox" value="ADMINISTRATIVO" checked="checked"><span>ADMINISTRATIVO</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="tipo[]"  type="checkbox" value="DOCENTE TIEMPO COMPLETO" checked="checked"><span>DOCENTE TIEMPO COMPLETO</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="tipo[]"  type="checkbox" value="DOCENTE TIEMPO HORARIO" checked="checked"><span>DOCENTE TIEMPO HORARIO</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="tipo[]"  type="checkbox" value="AUTORIDAD" checked="checked"><span>AUTORIDAD</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="tipo[]"  type="checkbox" value="AUTORIDAD ADMINISTRATIVA" checked="checked"><span>AUTORIDAD ADMINISTRATIVA</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="tipo[]"  type="checkbox" value="AUTORIDAD ACADEMICA" checked="checked"><span>AUTORIDAD ACADEMICA</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="tipo[]"  type="checkbox" value="DOCENTE MEDIO TIEMPO" checked="checked"><span>DOCENTE MEDIO TIEMPO</span>
                                        </label>
                                        <label class="checkbox-inline checkbox-styled">
                                            <input name="tipo[]"  type="checkbox" value="ACADEMICO" checked="checked"><span>ACADEMICO</span>
                                        </label>
                                    </div><!--end .col -->
                                </div><!--end .form-group -->
                            </div>
                        </div>
                    </div><!--end .card-body -->
                    <div class="card-actionbar">
                        <div class="card-actionbar-row">
                            <button type="submit" class="btn btn-primary btn-lg">Buscar</button>
                        </div>
                    </div>
                </div><!--end .card -->
            </form>
        </div><!--end .col -->
    </div><!--end .row -->
    <!-- END HORIZONTAL FORM -->
    <section class="card col-md-11 col-md-offset-1  style-default-bright" style="margin-top: 10px;margin-left: 1%;width: 98%;">
        <div class="section-body">
            <h2 class="text-primary">Listado de Altas y bajas</h2>
            <table id="task" class="table table-hover" style="width: 98%;font-size: smaller;">
                <thead>
                <tr>
                    <th>Mes</th>
                    <th>Estado</th>
                    <th>CI</th>
                    <th>Regional</th>
                    <th>Tipo</th>
                    <th>Cargo</th>
                    <th>Departamento</th>
                </tr>
                </thead>
            </table>
            <!--button type="button" class="btn ink-reaction btn-floating-action btn-lg" data-toggle="modal" style="background: #ffc107;color: #FFFFFF;position:absolute;top:33px; left:240px;" data-target="#myModal"><i class="md md-add"></i></button-->
        </div>
    </section>


    <script type="text/javascript">
        $.fn.datepicker.defaults.format = "yyyy-mm-dd";
        $(document).ready(function() {
            oTable = $('#task').DataTable({
                "processing": true,
                "serverSide": true,
                bPaginate:false,
                dom: 'Bfrtip',
                buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
                searching:false,
                ajax: {
                    url: "{{ url('/rotacionTable') }}",
                    data: function (d) {
                        d.inicio = $('#inicio').val();
                        d.fin = $('#fin').val();
                        d.regional = [];
                        d.tipo = [];
                        $('#regional input[type="checkbox"]:checked').each(function () {
                            d.regional.push($(this).val());
                        });
                        $('#tipo input[type="checkbox"]:checked').each(function () {
                            d.tipo.push($(this).val());
                        });
                    }
                },
                "columns": [
                    {data: 'gestion', name: 'gestion'},
                    {data: 'estado', name: 'estado'},
                    {data: 'ci', name: 'ci'},
                    {data: 'regional', name: 'regional'},
                    {data: 'tipo', name: 'tipo'},
                    {data: 'cargo_nuevo', name: 'cargo_nuevo'},
                    {data: 'departamento', name: 'departamento'}
                ]

            });
        });
        $('#search-form').on('submit', function(e) {
            oTable.draw();
            e.preventDefault();
        });
    </script>

@endsection