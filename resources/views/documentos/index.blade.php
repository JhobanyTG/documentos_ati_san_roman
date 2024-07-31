@extends('layout/template')

@section('title', 'Documentos')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="programa/create" class="btn btn-agregar"><i class="fa fa-plus" aria-hidden="true"></i> Registrar</a>
    </div>
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <table id="example1" class="table mt-4 table-hover" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Opciones</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

    <script>
    // Verificar si existe el mensaje de éxito
    $(documento).ready(function() {
        @if(Session::has('success'))
            toastr.options = {
                "positionClass": "toast-bottom-right",
            };
            toastr.success("{{ Session::get('success') }}");
        @endif
    });
    </script>

@stop