@extends('layouts.rikassa')
@section('title', 'Formulário de Inscrição')

@section('content')
<style>
    .table {
        --bs-table-border-color: #eddbc4 !important;
    }
    th, .dataTables_info {
        color: #563101;
    }
    td, textarea, .url {
        color: #94580A  !important;
    }
    div.dataTables_wrapper div.dataTables_processing  {
        background-color: #94580A !important;
        color: #FFFFFF !important;
    }
    .pagination {
        --bs-pagination-active-bg: #94580a !important;
        --bs-pagination-active-border-color: #704309 !important;
        --bs-pagination-disabled-color: #d89b4c !important;
        --bs-pagination-color: #94580A !important;
        --bs-pagination-hover-color: #563101 !important;
    }
</style>
    <div class="">
        <div class="row">
            <h2 class="mb-5 text-center titulo">Gerenciador de eventos</h2>
        </div>

        <div class="row g-3 table-responsive">
            <table class="table table-bordered data-table table-hove">
                <thead> <!--'id','title', 'content','start','end','url'-->
                    <tr style="border-bottom: 2px solid #b56600; background: #f9e2c5;">
                        <th scope="col">#</th>
                        <th scope="col">Título do Evento</th>
                        <th scope="col">Descricao</th>
                        <th scope="col">Inicia em</th>
                        <th scope="col">Termina em</th>
                        <th scope="col">Link</th>
                        <th width="105px">Acao</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>


            <!-- Edit Event Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEventModalLabel">Editar Evento</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editEventForm" action="{{ route('adm.calendario.store') }}" method="post">
                            @csrf

                            <div class="modal-body">
                                <input type="hidden" name="id" id="eventId">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Título do Evento</label>
                                    <input type="text" class="form-control" id="title" name="title" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label">Descrição</label>
                                    <textarea class="form-control" id="content" name="content" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="start" class="form-label">Inicia em</label>
                                    <input type="text" class="form-control" name="start" id="start"  required>
                                </div>
                                <div class="mb-3">
                                    <label for="end" class="form-label">Termina em</label>
                                    <input type="text" class="form-control" name="end" id="end"  required>
                                </div>
                                <div class="mb-3">
                                    <label for="url" class="form-label">Link</label>
                                    <input type="url" class="form-control" id="url" name="url" required>
                                </div>
                            </div>

                            

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary">Salvar Alterações</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
  
            
        </div>
    </div>
    
    @push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> --}}
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

    <script type="text/javascript">
        
        $(document).ready(function() {
            // Inicialização do DataTable com configuração de idioma para português
            var gb_DataTable = $(".data-table").DataTable({
                autoWidth: true,
                order: [0, "ASC"],
                processing: true,
                serverSide: true,
                searchDelay: 2000,
                paging: true,
                ajax: "{{ route('adm.calendario.index') }}",
                iDisplayLength: "10",
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'title', name: 'title' },
                    { data: 'content', name: 'content' },
                    { data: 'start', name: 'start' },
                    { data: 'end', name: 'end' },
                    { data: 'url', name: 'url' },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ],
                lengthMenu: [10, 25, 50, 100],
                language: {
                    "sProcessing": "Processando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "Nenhum resultado encontrado",
                    "sEmptyTable": "Sem dados disponíveis",
                    "sInfo": "Mostrando registros de _START_ até _END_ de um total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando 0 registros de um total de 0",
                    "sInfoFiltered": "(filtrado de um total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Carregando...",
                    "oPaginate": {
                        "sFirst": "Primeiro",
                        "sLast": "Último",
                        "sNext": "Próximo",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                        "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
            });
        });
    </script>


    <script>
        $(document).ready(function() {
            var fpStart, fpEnd;

            // Função para configurar o Flatpickr
            function setupFlatpickr(start, end) {
                if (fpStart) fpStart.destroy();
                if (fpEnd) fpEnd.destroy();

                fpStart = flatpickr("#start", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "d/m/Y H:i",
                    locale: "pt",
                    defaultDate: start,
                    clickOpens: true,
                    allowInput: true
                });

                fpEnd = flatpickr("#end", {
                    enableTime: true,
                    dateFormat: "Y-m-d H:i",
                    altInput: true,
                    altFormat: "d/m/Y H:i",
                    locale: "pt",
                    defaultDate: end,
                    clickOpens: true,
                    allowInput: true
                });
            }

            // Evento de clique no botão de editar
            $(document).on('click', '.edit', function() {
                var id = $(this).data('id');
                var url = "{{ route('adm.calendario.show', ['id' => '_id_']) }}".replace('_id_', id);

                $.get(url, function(response) {
                    if (response.success) {
                        var data = response.data;
                        $('#eventId').val(data.id);
                        $('#title').val(data.title);
                        $('#content').val(data.content);
                        $('#url').val(data.url);

                        setupFlatpickr(data.start, data.end);
                        $('#staticBackdrop').modal({
                            backdrop: 'static',
                            keyboard: false
                        }).modal('show');
                    } else {
                        alert('Erro ao carregar dados do evento.');
                    }
                }).fail(function() {
                    alert('Erro ao acessar os dados do evento.');
                });
            });

            $('#staticBackdrop').on('hidden.bs.modal', function () {
                if (fpStart) fpStart.destroy();
                if (fpEnd) fpEnd.destroy();
            });

            $('#editEventForm').on('submit', function(e) {
                var start = $('#start').val();
                var end = $('#end').val();
                if (!start || !end) {
                    e.preventDefault();
                    alert('Os campos de data e hora são obrigatórios.');
                    return false;
                }
            });
        });
    </script>

    
    



        
    </script>
    

    
    @endpush
@endsection