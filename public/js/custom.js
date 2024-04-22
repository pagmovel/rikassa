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

        // permiti selecionar o evento
        // select: function(arg) {
        //     var title = prompt('Event Title:');
        //     if (title) {
        //         calendar.addEvent({
        //         title: title,
        //         start: arg.start,
        //         end: arg.end,
        //         allDay: arg.allDay
        //         })
        //     }
        //     calendar.unselect()
        // },

        // Permite clicar no evento
        // eventClick: function(arg) {
        //     if (confirm('Are you sure you want to delete this event?')) {
        //         arg.event.remove()
        //     }
        // },

        // Permitir arrastar evento pelo calendário
        editable: true,

        // Número máximo de eventos em um determinado dia, se for true, o número
        // de eventos será limitado à altura da célula do dia
        dayMaxEvents: true, // allow "more" link when too many events

        
        events: '/calendario/list',
        
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