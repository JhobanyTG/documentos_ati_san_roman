@extends('layout.template')

@section('title', 'Editar Documento')

@section('content')
    <div class="card-body">        
        <form action="{{ route('documentos.update', $documento->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="row">
                        <div class="col-md-12 d-flex justify-content-center">
                            <img class="img_file" src="{{ asset('images/icons/pdf.png') }}" />
                        </div>
                        <div class="col-md-12 d-flex justify-content-center">
                            <p class="nombre_archivo text-center" data-original-name="{{ basename($documento->archivo) }}">{{ basename($documento->archivo) }}</p>
                        </div>
                        <div class="col-md-12 container-input">
                            <input type="file" name="archivo" id="archivo" class="inputfile inputfile-1" accept=".pdf" />
                            <label for="archivo">
                                <i class="fa fa-repeat" aria-hidden="true"></i>
                                <span class="iborrainputfile">Reemplazar archivo</span>
                            </label>
                        </div>
                        <div class="col-md-12 container-input">
                            <a href="#" class="btn btn-success" onclick="openPdfModal()"><i class="fa fa-eye" aria-hidden="true"></i> Visualizar Archivo Actual</a>
                        </div>
                        <div class="modal fade" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="pdfModalLabel">{{ basename($documento->archivo) }}</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" id="pdfModalBody"></div>
                                    <div class="modal-footer">
                                    <a href="{{ asset('storage/archivos/'.basename($documento->archivo)) }}" class="btn btn-info" target="_blank"><i class="fa fa-external-link-square" aria-hidden="true"></i> Abrir en otra ventana</a>
                                    <a href="{{ asset('storage/archivos/'.basename($documento->archivo)) }}" download="{{ basename($documento->archivo) }}" class="btn btn-dark"><i class="fa fa-download" aria-hidden="true"></i> Descargar</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-8">
                    <div class="form-group mt-3">
                        <label for="titulo">Título</label>
                        <input type="text" id="titulo" name="titulo" class="form-control" value="{{ old('titulo', $documento->titulo) }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="detalles">Detalles</label>
                        <input type="text" id="detalles" name="detalles" class="form-control" value="{{ old('detalles', $documento->detalles) }}">
                    </div>
                    <div class="form-group mt-3">
                        <label for="descripcion">Descripción</label>
                        <textarea id="descripcion" name="descripcion" class="form-control">{{ old('descripcion', $documento->descripcion) }}</textarea>
                    </div>
                    <div class="d-flex justify-content-end mt-3">
                        <a href="{{ route('documentos.index') }}" class="btn btn-secondary btn-cancel"><i class="fa fa-arrow-left" aria-hidden="true"></i> Volver</a>
                        <button type="submit" class="btn btn-primary btn-actualizar">Actualizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        function openPdfModal() {
            var pdfUrl = "{{ asset('storage/archivos/'.basename($documento->archivo)) }}";
            var modalBody = document.getElementById('pdfModalBody');
            modalBody.innerHTML = '<embed src="' + pdfUrl + '" type="application/pdf" width="100%" height="500px" />';
            $('#pdfModal').modal('show');
        }
    </script>
    <script>
        function showConfirmationModal() {
            $('#confirmationModal').modal('show');
        }

        function deleteRecord() {
            document.getElementById('deleteForm').submit();
        }
    </script>
    <script>
        $(document).ready(function() {
            $('.btn-close, .btn-no').click(function() {
                $('#confirmationModal, #pdfModal').modal('hide');
            });
        });
    </script>
@stop
