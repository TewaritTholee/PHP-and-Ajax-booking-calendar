<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>Calendar Booking</title>

    <!-- CSS Component -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fullcalendar.css">
    <link href="css/notosan_font.css" rel="stylesheet">

    <!-- JS Component -->
    <script src="js/jquery.js"></script>
    <script src="js/moment.min.js"></script>
    <script src="js/fullcalendar.js"></script>
    <script src="js/locale_th.js"></script>
    

    <style>
        * {
            font-family: "Noto Sans Thai", sans-serif;
        }
        body {
            padding: 10px;
        }

        #calendar {
            max-width: 1200px;
            margin: 0 auto;
        }

        .fc th {
            background: #007bff;
            color: #fff;
            padding: 10px;
        }

        .fc td {
            padding: 10px;
        }

        .fc-event {
            background-color: #28a745 !important;
            border: none;
            color: white;
        }

        .fc-event:hover {
            background-color: #218838 !important;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2 class="text-center">ปฏิทินจำลองข้อมูลบันทึกการจอง</h2>
        <div id="calendar"></div>
    </div>

    <script>
        $(document).ready(function() {
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay,listMonth'
                },
                locale: 'th',
                editable: true,
                events: 'load.php',
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    var title = prompt("Enter Event Title");
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        $.ajax({
                            url: "insert.php",
                            type: "POST",
                            data: {
                                title: title,
                                start: start,
                                end: end
                            },
                            success: function() {
                                $('#calendar').fullCalendar('refetchEvents');
                                alert("Added Successfully");
                            }
                        });
                    }
                },
                editable: true,
                eventDrop: function(event) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    var id = event.id;
                    $.ajax({
                        url: "update.php",
                        type: "POST",
                        data: {
                            id: id,
                            start: start,
                            end: end
                        },
                        success: function() {
                            $('#calendar').fullCalendar('refetchEvents');
                            alert("Event Updated");
                        }
                    });
                },
                eventClick: function(event) {
                    if (confirm("Are you sure you want to remove it?")) {
                        var id = event.id;
                        $.ajax({
                            url: "delete.php",
                            type: "POST",
                            data: {
                                id: id
                            },
                            success: function() {
                                $('#calendar').fullCalendar('refetchEvents');
                                alert("Event Removed");
                            }
                        });
                    }
                }
            });
        });
    </script>

</body>

</html>