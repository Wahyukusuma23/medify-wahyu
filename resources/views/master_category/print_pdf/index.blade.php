<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
         body {
            font-family: 'Nunito' sans-serif;
            font-size: 12px;
            margin-bottom: 60px;
        }

        .title {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        table.produk {
            width: 100%;
            border-collapse: collapse;
        }

        table.produk, table.produk th, table.produk td {
            border: 1px solid #000;
        }

        table.produk th {
            background: #eee;
            padding: 8px;
        }

        td {
            padding: 6px;
        }
        footer{
            height: 40px;
        }
    </style>
</head>
<body>
    <table style="text-align: left">
        <tr>
            <th>Kode</th>
            <td>:</td>
            <td>{{$data->kode}}</td>
        </tr>
        <tr>
            <th>Nama</th>
            <td>:</td>
            <td>{{$data->name}}</td>
        </tr>
        <tr style="vertical-align: baseline;">
            <td colspan="3">List Produk</td>
        </tr>
    </table>
    <table class="produk">
        <tr>
            <th>Kode</th>
            <th>Nama</th>
        </tr>
        @if ($data->items)
                @foreach ($data->items as $item)
            <tr style="padding-left: 20px;">
                    <td>{{$item->kode}}</td>
                    <td>{{$item->nama}}</td>
            </tr>
                @endforeach
        @else
        <tr>
            <td colspan="2">Belum ada Data</td>
        </tr>
        @endif
    </table>
    <footer class="text-center" style="position: fixed;bottom:-40px;right:0">
        <span>{{date('d-M-Y H:i')}}</span>
    </footer>
</body>
</html>