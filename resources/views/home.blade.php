@extends('layouts.master1')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="widget-box widget-color-blue" style='opacity: 1;'>
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                        Alertas del dia
                    </h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <table class='table table-striped table-bordered table-hover'>
                            <thead class='thin-border-bottom'>
                                <tr>
                                    <th>Mensaje</th><th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($alertas as $alert)
                                <tr>
                                    <td>{{$alert->message}}</td>
                                    <td>
                                        <a class='btn btn-info btn-xs' href='{{route("oportunities.oportunity.show", $alert->oportunity_id)}}'><i class='fa fa-eye'></i>Ver</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div>
        <div class="col-sm-6">
            <div class="widget-box widget-color-red" style='opacity: 1;'>
                <div class="widget-header widget-header-flat widget-header-small">
                    <h5 class="widget-title">
                        <i class="fa fa-check-square-o"></i>
                        Tareas Abiertas
                    </h5>

                </div>

                <div class="widget-body">
                    <div class="widget-main no-padding">
                        <table class='table table-striped table-bordered table-hover'>
                            <thead class='thin-border-bottom'>
                                <tr>
                                    <th>Tarea</th><th>Detalle</th><th>Fecha</th><th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($tareas as $tarea)
                                <tr>
                                    <td>{{$tarea->task->task}}</td>
                                    <td>{{$tarea->detail}}</td>
                                    <td>{{date_format(date_create($tarea->fecha),'d/m/Y')}}</td>
                                    <td>
                                        <a class='btn btn-danger btn-xs' href='{{route("oportunities.oportunity.show", $tarea->oportunity_id)}}'><i class='fa fa-eye'></i>Ver</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div><!-- /.widget-main -->
                </div><!-- /.widget-body -->
            </div><!-- /.widget-box -->
        </div>
    </div>
</div>
@endsection
