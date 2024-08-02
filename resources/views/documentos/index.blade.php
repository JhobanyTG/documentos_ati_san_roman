@extends('layout.template')

@section('title', 'Documentos')

@section('content')
    <div class="d-flex justify-content-end">
        <a href="{{ route('documentos.create') }}" class="btn btn-agregar pt-serif-regular"><i class="fa fa-plus" aria-hidden="true"></i> Registrar</a>
    </div>
    <div class="card-body">
        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <table id="example1" class="table mt-4 table-hover pt-serif-regular" role="grid" aria-describedby="example1_info">
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
                        <tr role="row" class="border-table border-bottom-3">
                            <!-- <td class="text-center">
                                <div class="previwe-pdf">
                                    <div class="archivo-preview" style="overflow: hidden">
                                        <div style="margin-right: -16px;">
                                            <iframe id="pdfIframe" src="{{ asset('storage/archivos/' . basename($documento->archivo)) }}" type="application/pdf" style="display: block; overflow: hidden scroll; height: 160px; width: 100%; pointer-events: none;" frameborder="0" loading="lazy"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </td> -->
                            <td class="text-center">
                                <div class="previwe-pdf">
                                    <div class="archivo-preview" style="overflow: hidden">
                                        <div style="margin-right: -16px;">
                                            <iframe id="pdfIframe" src="{{ asset('storage/archivos/' . basename($documento->archivo)) }}" type="application/pdf" style="display: block; overflow: hidden scroll; height: 160px; width: 100%; pointer-events: none;" frameborder="0" loading="lazy"></iframe>
                                        </div>
                                    </div>
                                </div>
                                <img class="img_file_pdf centered-img" src="{{ asset('images/icons/pdf.png') }}" alt="PDF" />
                            </td>
                            <td class="text-center">{{ $documento->titulo }}</td>
                            <td class="text-center">
                                @if(strlen($documento->descripcion) > 370)
                                    <span class="truncated">{{ substr($documento->descripcion, 0, 370) }}...</span>
                                    <span class="expand-description" data-target="#desc-{{ $documento->id }}">Ver más</span>
                                    <div id="desc-{{ $documento->id }}" class="collapse full-description">
                                        <span>{{ $documento->descripcion }}</span>
                                        <span class="collapse-description">Ver menos</span>
                                    </div>
                                @else
                                    {{ $documento->descripcion }}
                                @endif
                            </td>
                            <!-- <td class="text-center">{{ $documento->created_at->format('Y-m-d H:i') }}</td> -->
                            <td class="text-center">
                                {{ $documento->created_at->format('Y-m-d') }}<br>
                                {{ $documento->created_at->format('H:i') }}
                            </td>
                            <td class="text-center border-table-row-final">
                                <a href="{{ asset('storage/archivos/' . basename($documento->archivo)) }}" class="btn btn-primary" download><i class="fa fa-download" aria-hidden="true"></i></a>
                                <a href="{{ route('documentos.edit', $documento->id) }}" class="btn btn-warning"><i class="fa fa-edit" aria-hidden="true"></i></a>
                                <button type="button" class="btn btn-danger" onclick="showConfirmationModal()">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </button>                               
                            </td>
                        </tr>
                        <div class="modal fade pt-serif-regular" id="pdfModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel" aria-hidden="true">
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
                        <div class="modal pt-serif-regular" tabindex="-1" role="dialog" id="confirmationModal">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Confirmar Eliminación</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p class="text-center">¿Estás seguro de eliminar este trabajo de aplicación? Esta acción no se puede deshacer.</p>
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

        <!-- <div class="d-flex justify-content-center mt-4">
            {{ $documentos->links() }}
        </div> -->
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
    <!-- <script>
        function openPdfModal(pdfUrl, pdfName) {
            var modalBody = document.getElementById('pdfModalBody');
            modalBody.innerHTML = '<embed src="' + pdfUrl + '" type="application/pdf" width="100%" height="500px" />';
            document.getElementById('pdfModalLabel').innerText = pdfName;
            $('#pdfModal').modal('show');
        }

        $(document).ready(function() {
            $('.archivo-preview').on('click', function() {
                var pdfUrl = $(this).find('iframe').attr('src');
                var pdfName = $(this).closest('tr').find('td.text-center:first').text().trim();
                openPdfModal(pdfUrl, pdfName);
            });

            $('.btn-close, .btn-no').click(function() {
                $('#pdfModal').modal('hide');
            });
        });
    </script> -->
    <script>
        function openPdfModal(pdfUrl, pdfName) {
            var modalBody = document.getElementById('pdfModalBody');
            modalBody.innerHTML = '<embed src="' + pdfUrl + '" type="application/pdf" width="100%" height="500px" />';
            document.getElementById('pdfModalLabel').innerText = pdfName;
            $('#pdfModal').modal('show');
        }

        $(document).ready(function() {
            $('.archivo-preview').on('click', function() {
                var pdfUrl = $(this).find('iframe').attr('src');
                var pdfName = $(this).closest('tr').find('td.text-center:first').text().trim();
                openPdfModal(pdfUrl, pdfName);
            });

            $('.img_file_pdf').on('click', function() {
                var pdfUrl = $(this).closest('td').find('.archivo-preview iframe').attr('src');
                var pdfName = $(this).closest('tr').find('td.text-center:first').text().trim();
                openPdfModal(pdfUrl, pdfName);
            });

            $('.btn-close, .btn-no').click(function() {
                $('#pdfModal').modal('hide');
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.expand-description').on('click', function(e) {
                e.preventDefault();
                var target = $(this).data('target');
                $(this).hide();
                $(target).collapse('show');
                $(target).find('.collapse-description').show();
                $(target).siblings('.truncated').hide();
            });

            $('.collapse-description').on('click', function(e) {
                e.preventDefault();
                var target = $(this).closest('.full-description');
                $(target).collapse('hide');
                $(this).hide();
                $(target).siblings('.expand-description').show();
                $(target).siblings('.truncated').show();
            });

            $('.collapse-description').hide();
            $('.full-description').collapse('hide');
        });
    </script>


@stop
