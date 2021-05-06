<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="img/favicon.png">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">

    <title>{{$titulo}} - App CPC</title>

    <style>
        .btn-indigo, .page-item.active .page-link {
            background:#593066 ;
            border-color:#593066 ;
            color: white
        }
        .btn-indigo:hover {
            background:#593066 ;
            border-color:#593066 ;
            opacity: .9;
            color: white

        }
        .text-indigo{color: #593066;}
        .page-item .page-link {
            color: #593066;
        }

        @if($current == 'categorias')
        .btn-slateblue, .page-item.active .page-link {
            background:#008B8B ;
            border-color:#008B8B ;
            color: white
        }
        .text-slateblue {
            color: #008B8B
        }
        .btn-slateblue:hover {
            background:#008B8B ;
            border-color:#008B8B ;
            opacity: .9;
            color: white
        }
        .page-item .page-link {
            color: #008B8B;
        }
        @endif
        
    </style>
</head>
<body class="bg-white">

    @component('components.navbar', ['current'=>$current])
    @endcomponent

    <div class="container">
        @yield('content')
    </div>

    <footer>
        <div class="container mt-5 pt-3 text-center text-md-right">
            <p>&copy; 2021 - App CPC<br><span class="text-muted">Desenvolvido por</span> <a href="https://github.com/EdivandroLima" target="_blank" class="text-muted"><u>Edivandro Lima</u></a></p>
        </div>
    </footer>
   
    <script src="{{asset('js/app.js')}}"></script>
    @yield('script')
</body>
</html>