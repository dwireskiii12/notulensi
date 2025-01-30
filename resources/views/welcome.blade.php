{{--
<link href='{{ asset('template/css/fullcalendar.css') }}' rel='stylesheet' />
<link href='{{ asset('template/css/fullcalendar.print.css') }}' rel='stylesheet' media='print' />
<script src='{{ asset('template/js/jquery-1.10.2.js') }}' type="text/javascript"></script>
<script src='{{ asset('template/js/jquery-ui.custom.min.js') }}' type="text/javascript"></script>
<script src='{{ asset('template/js/fullcalendar.js') }}' type="text/javascript"></script>
<script>
    $(document).ready(function () {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        /*  className colors

        className: default(transparent), important(red), chill(pink), success(green), info(blue)

        */


        /* initialize the external events
        -----------------------------------------------------------------*/

        $('#external-events div.external-event').each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
                title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 999,
                revert: true, // will cause the event to go back to its
                revertDuration: 0 //  original position after the drag
            });

        });


        /* initialize the calendar
        -----------------------------------------------------------------*/

        var calendar = $('#calendar').fullCalendar({
            header: {
                left: 'title',
                center: 'agendaDay,agendaWeek,month',
                right: 'prev,next today'
            },
            editable: true,
            firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
            selectable: true,
            defaultView: 'month',

            axisFormat: 'h:mm',
            columnFormat: {
                month: 'ddd', // Mon
                week: 'ddd d', // Mon 7
                day: 'dddd M/d', // Monday 9/7
                agendaDay: 'dddd d'
            },
            titleFormat: {
                month: 'MMMM yyyy', // September 2009
                week: "MMMM yyyy", // September 2009
                day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
            },
            allDaySlot: false,
            selectHelper: true,
            select: function (start, end, allDay) {
                var title = prompt('Event Title:');
                if (title) {
                    calendar.fullCalendar('renderEvent', {
                            title: title,
                            start: start,
                            end: end,
                            allDay: allDay
                        },
                        true // make the event "stick"
                    );
                }
                calendar.fullCalendar('unselect');
            },
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },

            events: [{
                    title: 'All Day Event',
                    start: new Date(y, m, 1)
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d - 3, 16, 0),
                    allDay: false,
                    className: 'info'
                },
                {
                    id: 999,
                    title: 'Repeating Event',
                    start: new Date(y, m, d + 4, 16, 0),
                    allDay: false,
                    className: 'info'
                },
                {
                    title: 'Meeting',
                    start: new Date(y, m, d, 10, 30),
                    allDay: false,
                    className: 'important'
                },
                {
                    title: 'Lunch',
                    start: new Date(y, m, d, 12, 0),
                    end: new Date(y, m, d, 14, 0),
                    allDay: false,
                    className: 'important'
                },
                {
                    title: 'Birthday Party',
                    start: new Date(y, m, d + 1, 19, 0),
                    end: new Date(y, m, d + 1, 22, 30),
                    allDay: false,
                },
                {
                    title: 'Click for Google',
                    start: new Date(y, m, 28),
                    end: new Date(y, m, 29),
                    url: 'http://google.com/',
                    className: 'success'
                }
            ],
        });


    });
</script>
<style>
    body {
        margin-top: 40px;
        text-align: center;
        font-size: 14px;
        font-family: "Helvetica Nueue", Arial, Verdana, sans-serif;
        background-color: #DDDDDD;
    }

    #wrap {
        width: 1100px;
        margin: 0 auto;
    }

    #external-events {
        float: left;
        width: 150px;
        padding: 0 10px;
        text-align: left;
    }

    #external-events h4 {
        font-size: 16px;
        margin-top: 0;
        padding-top: 1em;
    }

    .external-event {
        /* try to mimick the look of a real event */
        margin: 10px 0;
        padding: 2px 4px;
        background: #3366CC;
        color: #fff;
        font-size: .85em;
        cursor: pointer;
    }

    #external-events p {
        margin: 1.5em 0;
        font-size: 11px;
        color: #666;
    }

    #external-events p input {
        margin: 0;
        vertical-align: middle;
    }

    #calendar {
        /* 		float: right; */
        margin: 0 auto;
        width: 900px;
        background-color: #FFFFFF;
        border-radius: 6px;
        box-shadow: 0 1px 2px #C3C3C3;
    }
</style>
</head>

<body>
    <div id='wrap'>

        <div id='calendar'></div>

        <div style='clear:both'></div>
    </div>


</body>

</html> --}}
{{-- ini pesan --}}

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undangan Rapat</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            margin: 0 auto;
            padding: 20px;
            max-width: 600px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }

        .header {
            background-color: #905443;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #333333;
        }

        .details {
            margin-top: 20px;
        }

        .details p {
            font-size: 16px;
            margin: 5px 0;
        }

        .details .icon {
            color: #905443;
            margin-right: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #d4856f;
            border-radius: 0 0 5px 5px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="header">
            <h1>Undangan Rapat</h1>
        </div>
        <div class="content">
            <h2>Hallo, Sayang</h2>
            <p>Kami mengundang Anda untuk menghadiri rapat <strong>"sdsdasd"</strong> yang akan diadakan pada:</p>
            <div class="details">
                <p><i class="fas fa-calendar icon"></i><strong>Hari/Tanggal :</strong> Senin, 30 Juni 2024</p>
                <p><i class="fas fa-clock icon"></i><strong>Waktu :</strong> 10:00 - 12:00 WIB</p>
                <p><i class="fas fa-map-marker-alt icon"></i><strong>Lokasi :</strong> Ruang Rapat Lantai 2, Gedung ABC
                </p>
                <p><i class="fas fa-user icon"></i><strong>Pemimpin Rapat :</strong> Bapak Ahmad Santoso</p>
                <p><i class="fas fa-bullseye icon"></i><strong>Judul Rapat:</strong> Evaluasi Kinerja Kuartal Kedua</p>
            </div>
            <p>Agenda rapat meliputi:</p>
            <ul>

                <li>Pemaparan laporan kuartal kedua</li>
                <li>Diskusi strategi pemasaran</li>
                <li>Perencanaan anggaran untuk proyek baru</li>
            </ul>
            <p>Terima kasih,</p>
            <p>Sekertaris Rapat</p>
        </div>
        <div class="footer">
            <p>&copy; 2024 Janameet. All rights reserved.</p>
        </div>
    </div>
</body>

</html>




<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun Notulensi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            margin: 0 auto;
            padding: 20px;
            max-width: 600px;
            border: 1px solid #dddddd;
            border-radius: 5px;
        }

        .header {
            background-color: #d4856f;
            color: white;
            padding: 10px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            padding: 20px;
        }

        .content h2 {
            color: #333333;
        }

        .details {
            margin-top: 20px;
        }

        .details p {
            font-size: 16px;
            margin: 5px 0;
        }

        .details .icon {
            color: #d4856f;
            margin-right: 10px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #e9967a;
            border-radius: 0 0 5px 5px;
        }
    </style>

</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>Informasi Akun Notulensi Janameet</h2>
        </div>
        <div class="content">
            <p>Kepada Yth. [Nama Penerima],</p>
            <p>Kami mengundang anda sebagai notulensi dalam agenda rapat <strong>"sdsdasd"</strong> yang akan diadakan
                pada:
                <div class="details">

                    <p><i class="fas fa-calendar icon"></i><strong>Hari/Tanggal :</strong> Senin, 30 Juni 2024</p>
                    <p><i class="fas fa-clock icon"></i><strong>Waktu :</strong> 10:00 - 12:00 WIB</p>
                    <p><i class="fas fa-map-marker-alt icon"></i><strong>Lokasi :</strong> Ruang Rapat Lantai 2, Gedung
                        ABC</p>
                    <p><i class="fas fa-user icon"></i><strong>Pemimpin Rapat :</strong> Bapak Ahmad Santoso</p>
                </div><br>
                Dengan senang hati kami menginformasikan bahwa akun notulensi Anda telah berhasil dibuat. Detail akun
                Anda adalah sebagai berikut:</p>
            <div class="details">
                <p>

                    <i class="fas fa-envelope icon"></i><strong>Email Terdaftar :</strong> [Email Anda]
                </p>
                <p>

                    <i class="fas fa-key icon"></i><strong>Kata Sandi (Password) :</strong> [Password Anda]
                </p>

            </div>
            <p><div class="details"><div class="fas fa-exclamation-triangle icon"></div></i>Kami sarankan untuk segera mengganti kata sandi Anda
                setelah login pertama kali untuk menjaga keamanan akun Anda. Untuk mengakses akun notulensi Anda,
                silakan ikuti langkah-langkah berikut:</p>

            <div class="details">
                <ol>
                    <p>

                        <li><i class="fas fa-globe icon"></i>Kunjungi situs web kami di <a href="[URL Situs Web]">[URL
                                Situs Web]</a>.</li><br>
                    </p>
                    <p>

                        <li><i class="fas fa-user-check icon"></i>Masukkan nama pengguna dan kata sandi Anda.</li><br>
                    </p>
                    <p>

                        <li>Setelah berhasil login, Anda dapat mulai menggunakan fitur-fitur notulensi yang tersedia.
                        </li>
                    </p>
                </ol>
            </div>

            <p>Jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi tim
                dukungan kami di <a href="mailto:reza.aboy2@gmail.com">reza.aboy2@gmail.com</a> atau +62 822-4156-9190.
            </p> <br>
            <p>Terima kasih atas perhatian dan kerjasamanya. Kami berharap Anda menikmati kemudahan dalam menggunakan
                layanan notulensi kami.</p>
        </div>
        <div class="footer">
            {{-- <p>Salam hormat,<br>
                [Nama Anda]<br>
                Sekertaris Rapat<br>
                Universitas Janabadra<br>
            </p> --}}

            <p>&copy; 2024 Janameet. All rights reserved.</p>
        </div>
    </div>
</body>

</html>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun Notulensi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .content {
            padding: 20px 0;
        }
        .content p {
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 0.9em;
            color: #666;
        }
        .icon {
            display: inline-block;
            margin-right: 10px;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><span class="icon">&#xf05a;</span>Informasi Akun Notulensi</h2>
        </div>
        <div class="content">
            <p><span class="icon">&#xf007;</span>Kepada Yth. ,</p>
            <p>Kami berharap email ini menemukan Anda dalam keadaan sehat dan baik. Dengan senang hati kami menginformasikan bahwa akun notulensi Anda telah berhasil dibuat. Detail akun Anda adalah sebagai berikut:</p>
            <p><span class="icon">&#xf2bd;</span><strong>Nama Pengguna (Username):</strong> <br>
               <span class="icon">&#xf0e0;</span><strong>Email Terdaftar:</strong> <br>
               <span class="icon">&#xf084;</span><strong>Kata Sandi (Password):</strong> /p>
            <p><span class="icon">&#xf071;</span>Kami sarankan untuk segera mengganti kata sandi Anda setelah login pertama kali untuk menjaga keamanan akun Anda. Untuk mengakses akun notulensi Anda, silakan ikuti langkah-langkah berikut:</p>
            <ol>
                <li><span class="icon">&#xf0ac;</span>Kunjungi situs web kami di <a href="{{ url('/') }}">{{ url('/') }}</a>.</li>
                <li><span class="icon">&#xf2f6;</span>Klik tombol "Login" di pojok kanan atas halaman.</li>
                <li><span class="icon">&#xf2be;</span>Masukkan nama pengguna dan kata sandi Anda.</li>
                <li><span class="icon">&#xf00c;</span>Setelah berhasil login, Anda dapat mulai menggunakan fitur-fitur notulensi yang tersedia.</li>
            </ol>
            <p><span class="icon">&#xf095;</span>Jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi tim dukungan kami di <a href="mailto:support@example.com">support@example.com</a> atau (021) 123-4567.</p>
            <p>Terima kasih atas perhatian dan kerjasamanya. Kami berharap Anda menikmati kemudahan dalam menggunakan layanan notulensi kami.</p>
        </div>
        <div class="footer">
            <p><span class="icon">&#xf4c6;</span>Salam hormat,<br>
            [Nama Anda]<br>
            [Posisi Anda]<br>
            [Nama Perusahaan atau Organisasi]<br>
            [Kontak Informasi]</p>
        </div>
    </div>
    <style>
        @font-face {
            font-family: 'FontAwesome';
            src: url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/webfonts/fa-solid-900.woff2') format('woff2'),
                 url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/webfonts/fa-solid-900.woff') format('woff');
            font-weight: 900;
            font-style: normal;
        }
        .icon {
            font-family: 'FontAwesome' !important;
            font-weight: 900;
            font-style: normal;
        }
    </style>
</body>
</html>






{{--



<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Akun Notulensi</title>
    <style>
        @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #ddd;
        }
        .content {
            padding: 20px 0;
        }
        .content p {
            line-height: 1.6;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            font-size: 0.9em;
            color: #666;
        }
        .icon {
            display: inline-block;
            margin-right: 10px;
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2><i class="fas fa-info-circle icon"></i>Informasi Akun Notulensi</h2>
        </div>
        <div class="content">
            <p><i class="fas fa-user icon"></i>Kepada Yth. [Nama Penerima],</p>
            <p>Kami berharap email ini menemukan Anda dalam keadaan sehat dan baik. Dengan senang hati kami menginformasikan bahwa akun notulensi Anda telah berhasil dibuat. Detail akun Anda adalah sebagai berikut:</p>
            <p><i class="fas fa-user-circle icon"></i><strong>Nama Pengguna (Username):</strong> [Nama Pengguna Anda]
               <i class="fas fa-envelope icon"></i><strong>Email Terdaftar:</strong> [Email Anda]
               <i class="fas fa-key icon"></i><strong>Kata Sandi (Password):</strong> [Password Anda]</p>
            <p><i class="fas fa-exclamation-triangle icon"></i>Kami sarankan untuk segera mengganti kata sandi Anda setelah login pertama kali untuk menjaga keamanan akun Anda. Untuk mengakses akun notulensi Anda, silakan ikuti langkah-langkah berikut:</p>
            <ol>
                <li><i class="fas fa-globe icon"></i>Kunjungi situs web kami di <a href="[URL Situs Web]">[URL Situs Web]</a>.</li>
                <li><i class="fas fa-sign-in-alt icon"></i>Klik tombol "Login" di pojok kanan atas halaman.</li>
                <li><i class="fas fa-user-check icon"></i>Masukkan nama pengguna dan kata sandi Anda.</li>
                <li><i class="fas fa-check icon"></i>Setelah berhasil login, Anda dapat mulai menggunakan fitur-fitur notulensi yang tersedia.</li>
            </ol>
            <p><i class="fas fa-headset icon"></i>Jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi tim dukungan kami di <a href="mailto:[Email Dukungan]">[Email Dukungan]</a> atau [Nomor Telepon Dukungan].</p>
            <p>Terima kasih atas perhatian dan kerjasamanya. Kami berharap Anda menikmati kemudahan dalam menggunakan layanan notulensi kami.</p>
        </div>
        <div class="footer">
            <p><i class="fas fa-handshake icon"></i>Salam hormat,<br>
            [Nama Anda]<br>
            [Posisi Anda]<br>
            [Nama Perusahaan atau Organisasi]<br>
            [Kontak Informasi]</p>
        </div>
    </div>
</body>
</html> --}}
