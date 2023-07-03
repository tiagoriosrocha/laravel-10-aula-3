<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Netflix Titles</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  </head>
  <body>

    <!------------------------------------------------------------
      ------------------------------------------------------------
      AQUI EU CRIO O MENU SUPERIOR DO SITE UTILIZANDO O ELEMENTO
      NAVBAR DO BOOTSTRAP
      ------------------------------------------------------------
      ------------------------------------------------------------ 
    -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="/">Netflix</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/ordenar/titulo">Título</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/ordenar/diretor">Diretor</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/ordenar/ano">Ano</a>
            </li>
          </ul>
          <form class="d-flex" role="search" action="/buscaportitulo" method="POST">
            {{ csrf_field() }}
            <input class="form-control me-2" name="busca" type="search" placeholder="Buscar por Título" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
        </div>
      </div>
    </nav><!-- FIM DO MENU SUPERIOR -->
    
    
    <!------------------------------------------------------------
      ------------------------------------------------------------
      INÍCIO DO CONTEÚDO DO BOOTSTRAP
      ------------------------------------------------------------
      ------------------------------------------------------------ 
    -->
    <div class="container my-5">
        <!------------------------------------------------------------
          ------------------------------------------------------------
          AQUI EU CRIO UMA LINHA (ROW) DO BOOTSTRAP
          E COLOCO UM TÍTULO DA PÁGINA
          ------------------------------------------------------------
          ------------------------------------------------------------ 
        -->
        <div class="row">
            <div class="col-md-12 mb-5">
                <h1 class="text-center">Netflix Titles</h1>
            </div>
        </div> <!-- FIM DA ROW -->

        <!------------------------------------------------------------
          ------------------------------------------------------------
          AQUI EU CRIO UMA LINHA (ROW) DO BOOTSTRAP
          E COLOCO UM TÍTULO DA PÁGINA
          ------------------------------------------------------------
          ------------------------------------------------------------ 
        -->
        <div class="row">
                  <!-- 
                  AQUI EU SÓ CRIO UM CARD
                  QUE IRÁ OCUPAR TODAS AS 12 COLUNAS DA TELA
                  E IRÁ EXIBIR OS DETALHES DE SOMENTE UM TÍTULO.
                  -->
                  <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <p><span class="badge text-bg-dark ">{{ $umTitulo->ano }}</span> <span class="badge text-bg-success">{{$umTitulo->duracao}}</span></p>
                            <h5 class="card-title text-uppercase text-truncate">{{ $umTitulo->titulo }}</h5>
                            <p class="card-text text-truncate">Diretor: {{$umTitulo->diretor}}</p>
                            <hr>
                            <p class="text-justify" style="height: 120px;">Resumo: {{$umTitulo->resumo}}</p>
                        </div>
                    </div>
                </div>
        </div> <!-- FIM DA ROW -->
        
      </div> <!-- FIM DO CONTENT -->
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="main.js"></script>
  </body>
</html>