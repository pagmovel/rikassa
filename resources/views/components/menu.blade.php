<div>
   
    <style>
        img[Attributes Style] {
            width: 178px;
            aspect-ratio: auto 178 / 145;
            height: 145px;
        }

        .nav-link {
            color: #94580a !important;
            fill: #94580a !important;
        }

        .navbar-nav {
            font-size: 18px !important;
            font-weight: 400 !important;
        }

        .bg-light {
            --bs-bg-opacity: 1;
            background-color: unset !important;
        }

        /* Estilo para o link ativo com sublinhado */
        .underline-active {
            border-bottom: 3px solid #94580a; /* Cor e espessura da borda */
            padding-bottom: 5px; /* Espaçamento entre o texto e a borda */
        }

        /* Para manter a borda ao passar o mouse */
        .nav-link:hover {
            border-bottom: 3px solid #94580a; /* Cor e espessura da borda */
            padding-bottom: 5px; /* Espaçamento entre o texto e a borda */
        }

        .container-fluid {
            display: flex;
            justify-content: space-between; /* Distribui o espaço entre os elementos */
            align-items: center; /* Alinha verticalmente */
        }

        .navbar-toggler {
            order: 2; /* Posiciona o toggler à direita */
            color: rgb(131 74 14);
        }

        .navbar-brand {
            order: 1; /* Mantém a logo no centro visualmente */
            flex-grow: 1; /* Permite que a logo cresça se necessário para manter o alinhamento */
        }

        .collapse {
            order: 3; /* O menu colapsado segue o toggler */
            flex-basis: 100%; /* Permite que o menu use toda a largura quando expandido */
        }

        
    </style>

    <div class="row">
        <div class="col"></div>

        <div class="col-9">
            <nav class="mb-5 navbar navbar-expand-lg bg-light">
                <div class="container-fluid align-items-center">
                {{-- <a class="navbar-brand" href="{{ env('APP_URL_WP') }}">
                    <img src="{{ env('APP_LOGO')}}" width="179" height="74" alt="LOGO RIKASSA">
                </a> --}}

                <x-logo />
            
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                    <a class="underline-active nav-link active" aria-current="page" href="{{ env('APP_URL_WP') }}"><i class="bi bi-arrow-left"></i> Voltar para a Home</a>
                    </div>
                </div>
            </nav>
            {{-- <nav class="mb-5 navbar navbar-expand-lg bg-light">
                <div class="container-fluid d-flex justify-content-between align-items-center">
                    <a class="navbar-brand" href="{{ env('APP_URL_WP') }}">
                        <img src="{{ env('APP_LOGO')}}" width="179" height="74" alt="Logo Rikassa">
                    </a>
            
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
            
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                        <div class="navbar-nav ms-auto">
                            <a class="underline-active nav-link active" aria-current="page" href="{{ env('APP_URL_WP') }}"><i class="bi bi-arrow-left"></i> Voltar para a Home</a>
                        </div>
                    </div>
                </div>
            </nav> --}}
            
        </div>
        
        <div class="col"></div>
    </div>

</div>