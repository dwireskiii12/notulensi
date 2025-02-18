{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notulensi Account</title>
</head>

<body>
    <h4>Selamat Siang, Menginformasikan Bahwasannya anda diundang kedalama Rapat pertemuan sebagi Berikut:</h4>
    <p>Berikut adalah detail akun notulensi Anda:</p>
    <ul>
        <li><strong>Judul Rapat:</strong> {{ $meeting->meeting_theme }}</li>
        <p>Nama: {{ $name }}</p>
        <p>Email: {{ $email }}</p>
        <p>Password: {{ $password }}</p>
        <li><strong>Jadwal Rapat:</strong>{{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('l, d F Y') ?? '' }}  {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('H:i') ?? '' }} WITA -
             {{ \Carbon\Carbon::parse($meeting->end_time)->locale('id')->translatedFormat('H:i') ?? '' }} WITA </li>
    </ul>
    <p>Silakan gunakan informasi di atas untuk masuk dan mulai mencatat hasil rapat.</p>
</body>

</html>
 --}}



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
            background-color: #d4856f;
            border-radius: 0 0 5px 5px;
        }
    </style>

</head>

<body>
    <div class="email-container">
        <div class="header">
            <h2>Informasi Akun Notulensi SIRAPAT</h2>
        </div>
        <div class="content">
            <p>Kepada Yth. Bapak/Ibu {{ $name }},</p>
            <p>Kami mengundang anda sebagai notulensi dalam agenda rapat <strong>"{{ $meeting->meeting_theme }}"</strong> yang akan diadakan
                pada:
                <div class="details">

                    <p><i class="fas fa-calendar icon"></i><strong>Hari/Tanggal :</strong> {{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('l, d F Y') ?? '' }}</p>
                    <p><i class="fas fa-clock icon"></i><strong>Waktu :</strong>{{ \Carbon\Carbon::parse($meeting->start_time)->locale('id')->translatedFormat('H:i') ?? '' }} - {{ \Carbon\Carbon::parse($meeting->end_time)->locale('id')->translatedFormat(' H:i') ?? '' }} WITA</p>
                    <p><i class="fas fa-map-marker-alt icon"></i><strong>Lokasi :</strong> {{ $meeting->rooms ? $meeting->rooms->room_name : 'Ruangan Tidak Ditemukan' }}</p>
                    <p><i class="fas fa-user icon"></i><strong>Pemimpin Rapat :</strong> {{ $meeting->leader ? $meeting->leader->name : 'Pemimpin Tidak Ditemukan' }}</p>
                </div><br>
                Dengan senang hati kami menginformasikan bahwa akun notulensi Anda telah berhasil dibuat. Detail akun
                Anda adalah sebagai berikut:</p>
            <div class="details">
                <p>

                    <i class="fas fa-envelope icon"></i><strong>Email Terdaftar :</strong> {{ $email }}
                </p>
                <p>

                    <i class="fas fa-key icon"></i><strong>Kata Sandi (Password) :</strong> {{ $password }}
                </p>

            </div>
            <p><div class="details"><div class="fas fa-exclamation-triangle icon"></div></i>Kami sarankan untuk segera mengganti kata sandi Anda
                setelah login pertama kali untuk menjaga keamanan akun Anda. Untuk mengakses akun notulensi Anda,
                silakan ikuti langkah-langkah berikut:</p>

            <div class="details">
                <ol>
                    <p>

                        <li><i class="fas fa-globe icon"></i>Kunjungi situs web kami di <a href="{{ url('/') }}">http://sirapat.ac.id/</a>.</li><br>
                    </p>
                    <p>

                        <li><i class="fas fa-user-check icon"></i>Masukkan alamat email dan kata sandi Anda.</li><br>
                    </p>
                    <p>

                        <li>Setelah berhasil login, Anda dapat mulai menggunakan fitur-fitur notulensi yang tersedia.
                        </li>
                    </p>
                </ol>
            </div>

            <p>Jika Anda mengalami kesulitan atau memiliki pertanyaan lebih lanjut, jangan ragu untuk menghubungi tim
                dukungan kami di <a href="dwireski63@gmail.com

                ">dwireski63@gmail.com

                            </a> atau +62 851-7118-9381.</p><br>
            <p>Terima kasih atas perhatian dan kerjasamanya. Kami berharap Anda menikmati kemudahan dalam menggunakan
                layanan notulensi kami.</p>
        </div>
        <div class="footer">


            <p>&copy; 2025 Sirapat. All rights reserved.</p>
        </div>
    </div>
</body>

</html>



