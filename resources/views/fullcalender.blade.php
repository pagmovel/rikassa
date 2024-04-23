<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rikassa - Calendário de Eventos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    
    @if (env('APP_ENV')=='local')
        <?php $caminho = ''; ?>
    @else
        <?php $caminho = '/public/'; ?>
    @endif
    
    <link rel="stylesheet" href="{{ asset($caminho.'css/custom.css')}} ">

    
</head>
<body>
    
    <div class="container">
        <div class="d-flex justify-content-center">            
            <h2 class="titulo ">Calendário de Eventos</h2>
        </div>
        <div id='calendar'></div>
    </div>


    <!-- Modal Visualizar-->
    <div class="modal fade" id="visualizarModal" tabindex="-1" aria-labelledby="visualizarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="visualizarModalLabel">Visualizar o Evento</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <dl class="row">

                        <dt class="col-sm-3">ID:</dt>
                        <dd class="col-sm-9" id="visualizar_id"></dd>
                        
                        <dt class="col-sm-3">Titulo:</dt>
                        <dd class="col-sm-9" id="visualizar_title"></dd>
                        
                        <dt class="col-sm-3">Início:</dt>
                        <dd class="col-sm-9" id="visualizar_start"></dd>
                        
                        <dt class="col-sm-3">Fim:</dt>
                        <dd class="col-sm-9" id="visualizar_end"></dd>
                        
                    </dl>
                </div>
                
            </div>
        </div>
    </div>


  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="{{ asset($caminho.'js/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset($caminho.'js/bootstrap5/index.global.min.js') }}"></script>
    <script src="{{ asset($caminho.'js/fullcalendar/pt-br.global.min.js') }}"></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
    
        var calendar = new FullCalendar.Calendar(calendarEl, {
    
            themeSystem: 'bootstrap5',
    
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            // initialDate: '2023-01-12',
            locale: 'pt-br',
    
            // initialDate: new Date(),
    
            // Permitir clicar nos nomes dos dias da semana
            navLinks: true, 
    
            // Permitir clicar e arrastar o mouse sobre um ou vários dias no calendário
            selectable: true,
    
            // Indicar visualmente a árera que será selecionada antes que o usuário
            // solte o botão para confirmar a seleção
            selectMirror: true,
    
            
    
            // Permitir arrastar evento pelo calendário
            editable: true,
    
            // Número máximo de eventos em um determinado dia, se for true, o número
            // de eventos será limitado à altura da célula do dia
            dayMaxEvents: true, // allow "more" link when too many events
    
            
           events: "{{env('APP_URL')}}/calendario/list",
        //    events: 'http://rikassa.exatamentepublicidade.com.br/calendario/list',
            
            
            eventClick: function (info) {
                // receber o SELETOR da janela modal
                const visualizarModal = new bootstrap.Modal(document.getElementById("visualizarModal"));
    
                // Enviar dados para o modal
                document.getElementById("visualizar_id").innerText = info.event.id;
                document.getElementById("visualizar_title").innerText = info.event.title;
                document.getElementById("visualizar_start").innerText = info.event.start.toLocaleString();
                document.getElementById("visualizar_end").innerText = info.event.end.toLocaleString();
    
                // Abrir a janela modal
                visualizarModal.show();
    
            },
        });
    
        calendar.render();
    });
        
    </script>

  
</body>
</html>