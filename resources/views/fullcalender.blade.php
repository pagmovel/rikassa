<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rikassa - Calendário de Eventos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css" rel="stylesheet">
    
    
    <link rel="stylesheet" href="{{ asset('public/css/custom.css')}} ">
    
    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    
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
    <script src="{{ asset('public/js/fullcalendar/index.global.min.js') }}"></script>
    <script src="{{ asset('public/js/bootstrap5/index.global.min.js') }}"></script>
    <script src="{{ asset('public/js/fullcalendar/pt-br.global.min.js') }}"></script>
    
    <script type="text/javascript">
        // $(document).ready(function () {
        
    //     /*------------------------------------------
    //     --------------------------------------------
    //     Get Site URL
    //     --------------------------------------------
    //     --------------------------------------------*/
    //     var SITEURL = "{{ url('/') }}";
        
    //     /*------------------------------------------
    //     --------------------------------------------
    //     CSRF Token Setup
    //     --------------------------------------------
    //     --------------------------------------------*/
    //     $.ajaxSetup({
    //         headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
        
    //     /*------------------------------------------
    //     --------------------------------------------
    //     FullCalender JS Code
    //     --------------------------------------------
    //     --------------------------------------------*/
    //     var calendar = $('#calendar').fullCalendar({
                        
    //                     editable: true,
    //                     events: SITEURL + "/fullcalender",
    //                     displayEventTime: false,
    //                     editable: true,
    //                     eventRender: function (event, element, view) {
    //                         if (event.allDay === 'true') {
    //                                 event.allDay = true;
    //                         } else {
    //                                 event.allDay = false;
    //                         }
    //                     },
    //                     selectable: true,
    //                     selectHelper: true,
    //                     select: function (start, end, allDay) {
    //                         var title = prompt('Event Title:');
    //                         if (title) {
    //                             var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
    //                             var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
    //                             $.ajax({
    //                                 url: SITEURL + "/fullcalenderAjax",
    //                                 data: {
    //                                     title: title,
    //                                     start: start,
    //                                     end: end,
    //                                     type: 'add'
    //                                 },
    //                                 type: "POST",
    //                                 success: function (data) {
    //                                     displayMessage("Event Created Successfully");
    
    //                                     calendar.fullCalendar('renderEvent',
    //                                         {
    //                                             id: data.id,
    //                                             title: title,
    //                                             start: start,
    //                                             end: end,
    //                                             allDay: allDay
    //                                         },true);
    
    //                                     calendar.fullCalendar('unselect');
    //                                 }
    //                             });
    //                         }
    //                     },
    //                     eventDrop: function (event, delta) {
    //                         var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
    //                         var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
    
    //                         $.ajax({
    //                             url: SITEURL + '/fullcalenderAjax',
    //                             data: {
    //                                 title: event.title,
    //                                 start: start,
    //                                 end: end,
    //                                 id: event.id,
    //                                 type: 'update'
    //                             },
    //                             type: "POST",
    //                             success: function (response) {
    //                                 displayMessage("Event Updated Successfully");
    //                             }
    //                         });
    //                     },
    //                     eventClick: function (event) {
    //                         var deleteMsg = confirm("Do you really want to delete?");
    //                         if (deleteMsg) {
    //                             $.ajax({
    //                                 type: "POST",
    //                                 url: SITEURL + '/fullcalenderAjax',
    //                                 data: {
    //                                         id: event.id,
    //                                         type: 'delete'
    //                                 },
    //                                 success: function (response) {
    //                                     calendar.fullCalendar('removeEvents', event.id);
    //                                     displayMessage("Event Deleted Successfully");
    //                                 }
    //                             });
    //                         }
    //                     }
    
    //                 });
    
    //     });
        
    //     /*------------------------------------------
    //     --------------------------------------------
    //     Toastr Success Code
    //     --------------------------------------------
    //     --------------------------------------------*/
    //     function displayMessage(message) {
    //         toastr.success(message, 'Event');
    //     } 
        
    </script>
    <script src="{{ asset('public/js/custom.js') }}" /></script>
  
</body>
</html>