document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        // initialDate: '2023-01-12',
        locale: 'pt-br',

        initialDate: new Date(),

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

        
        events: [
        {
            title: 'All Day Event',
            start: '2023-01-01'
        },
        {
            title: 'Long Event',
            start: '2023-01-07',
            end: '2023-01-10'
        },
        {
            groupId: 999,
            title: 'Repeating Event',
            start: '2023-01-09T16:00:00'
        },
        {
            groupId: 999,
            title: 'Repeating Event',
            start: '2023-01-16T16:00:00'
        },
        {
            title: 'Conference',
            start: '2023-01-11',
            end: '2023-01-13'
        },
        {
            title: 'Meeting',
            start: '2023-01-12T10:30:00',
            end: '2023-01-12T12:30:00'
        },
        {
            title: 'Lunch',
            start: '2023-01-12T12:00:00'
        },
        {
            title: 'Meeting',
            start: '2023-01-12T14:30:00'
        },
        {
            title: 'Happy Hour',
            start: '2023-01-12T17:30:00'
        },
        {
            title: 'Dinner',
            start: '2023-01-12T20:00:00'
        },
        {
            title: 'Birthday Party',
            start: '2023-01-13T07:00:00'
        },
        {
            title: 'Click for Google',
            url: 'http://google.com/',
            start: '2023-01-28'
        }
        ]
    });

    calendar.render();
  });