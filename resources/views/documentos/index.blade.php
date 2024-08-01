@extends('layout.template')

@section('title', 'Documentos')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('documentos.create') }}" class="btn btn-agregar"><i class="fa fa-plus" aria-hidden="true"></i> Registrar</a>
    </div>
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <table id="example1" class="table mt-4 table-hover" role="grid" aria-describedby="example1_info">
                <thead>
                    <tr role="row">
                        <th class="col-1"><div class="imagen_title_index">Imagen</div></th>
                        <th class="text-center col-2">Titulo</th>
                        <th class="text-center col-7">Descripcion</th>
                        <th class="text-center col-1">Fecha y Hora</th>
                        <th class="text-center col-1">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($documentos as $documento)
                        <tr role="row">
                            <td class="text-center">
                                <div class="previwe-pdf">
                                    <div class="archivo-preview" style="overflow: hidden">
                                        <div style="margin-right: -16px;">
                                            <iframe id="pdfIframe" src="{{ asset('storage/archivos/' . basename($documento->archivo)) }}" type="application/pdf" style="display: block; overflow: hidden scroll; height: 160px; width: 100%; pointer-events: none;" frameborder="0" loading="lazy"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="text-center">{{ $documento->titulo }}</td>
                            <td class="text-center">{{ $documento->descripcion }}</td>
                            <td class="text-center">{{ $documento->created_at->format('Y-m-d H:i') }}</td>
                            <td class="text-center">
                                <a href="{{ asset('storage/archivos/' . basename($documento->archivo)) }}" class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i></a>
                                <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <button type="button" class="btn btn-danger" onclick="showConfirmationModal()">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>                               
                            </td>
                        </tr>
                        <div class="modal" tabindex="-1" role="dialog" id="confirmationModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Estás seguro de eliminar este trabajo de aplicación? Esta acción no se puede deshacer.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-no" data-dismiss="modal"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</button>
                                        <form action="{{ route('documentos.destroy', $documento->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return);"><i class="fa fa-trash" aria-hidden="true"></i> Confirmar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $documentos->links() }}
        </div>
    </div>

    <script>
        $(document).ready(function() {
            @if(Session::has('success'))
                toastr.options = {
                    "positionClass": "toast-bottom-right",
                };
                toastr.success("{{ Session::get('success') }}");
            @endif
        });
    </script>
    <script>
        function showConfirmationModal() {
            $('#confirmationModal').modal('show');
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.btn-close, .btn-no').click(function() {
                $('#confirmationModal').modal('hide');
            });
        });
    </script>
@stop
