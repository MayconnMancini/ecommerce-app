<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
        integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <!-- js Bootstrao -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous">
    </script>


</head>

<body>


        <header>
            <nav class="navbar navbar-expand-md navbar-light bg-light">

                <a class="navbar-brand" href="/">Vendas MS</a>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav ">
                        <li class="nav-item active">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/produtos">Produtos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/vendas/create">Criar nova venda</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <main>
          <div class="container-fluid">
            <div class="row">
              @if (session('msg'))
                <p class="msg">{{ session('msg') }}</p> 
              @endif

              @yield('content')
            </div>
          </div>
        </main>

        <footer>
            <p>Vendas Microservices &copy; 2022</p>
        </footer>

 


</body>

</html>
