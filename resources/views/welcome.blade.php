<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Kitch’o — O ingrediente secreto do seu sucesso.</title>

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>

<body>

    <!-- HEADER -->
    <header class="header">

        <div class="container header-content">

            <a href="{{ url('/') }}" class="logo">

                <div class="logo-icon">
                    <img src="{{ asset('img/logo/kitcho-logo.svg') }}" alt="Kitch’o" >
                </div>

                <div class="logo-text">
                    <strong>Kitch’o</strong>
                    <span>Gestão de restaurantes</span>
                </div>

            </a>


            <nav class="navigation">

                <a
                    href="{{ route('login') }}"
                    class="login-link"
                >
                    Entrar
                </a>

                <a
                    href="{{ route('register') }}"
                    class="register-button"
                >
                    Criar conta
                </a>

            </nav>

        </div>

    </header>


    <!-- HERO -->
    <main>

        <section class="hero">

            <div class="container hero-content">


                <!-- TEXTO -->
                <div class="hero-text">

                    <div class="hero-label">

                        <span class="status-dot"></span>

                        Gestão simples para o seu negócio

                    </div>


                    <h1>

                        O ingrediente
                        <span>secreto</span>
                        do seu sucesso.

                    </h1>


                    <p class="hero-description">

                        Organize seu restaurante, gerencie seus produtos,
                        categorias, mesas e pedidos em um só lugar.

                    </p>


                    <div class="hero-buttons">

                        <a
                            href="{{ route('register') }}"
                            class="primary-button"
                        >
                            Começar agora

                            <span>→</span>
                        </a>


                        <a
                            href="{{ route('login') }}"
                            class="secondary-button"
                        >
                            Já tenho uma conta
                        </a>

                    </div>


                    <div class="features">

                        <div class="feature">
                            <span>✓</span>
                            Produtos
                        </div>

                        <div class="feature">
                            <span>✓</span>
                            Pedidos
                        </div>

                        <div class="feature">
                            <span>✓</span>
                            Mesas
                        </div>

                    </div>

                </div>


                <!-- ILUSTRAÇÃO -->
                <div class="hero-visual">

                    <div class="background-circle"></div>

                    <div class="inner-circle"></div>


                    <!-- CARD -->
                    <div class="restaurant-card">

                        <div class="card-header">

                            <div>

                                <small>
                                    SEU RESTAURANTE
                                </small>

                                <h2>
                                    Tudo sob controle
                                </h2>

                            </div>


                            <div class="card-icon">
                                +
                            </div>

                        </div>


                        <!-- MASCOTE -->
                        <div class="mascot-area">
                            <img src="{{ asset('img/cat/cat1.jpeg') }}" alt="Kitch’o">
                        </div>


                        <!-- INDICADORES -->
                        <div class="card-stats">

                            <div>
                                <small>Produtos</small>
                                <strong>Organizados</strong>
                            </div>

                            <div>
                                <small>Pedidos</small>
                                <strong>Simples</strong>
                            </div>

                            <div>
                                <small>Gestão</small>
                                <strong>Completa</strong>
                            </div>

                        </div>

                    </div>


                    <!-- CARD FLUTUANTE -->
                    <div class="floating-card">

                        <div class="floating-icon">
                            ✓
                        </div>

                        <div>

                            <small>
                                Gestão organizada
                            </small>

                            <strong>
                                Feita para o seu negócio
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    </main>


    <!-- FOOTER -->
    <footer class="site-footer">

    <div class="footer-content">

        <!-- Marca -->
        <div class="footer-brand">
            <div class="footer-logo">
                <img
                    src="{{ asset('img/logo/kitcho-logo.svg') }}"
                    alt="Kitch’o"
                >
            </div>

            <p>
                Gestão simples e inteligente
                para restaurantes.
            </p>
        </div>


        <!-- Gestão -->
        <div class="footer-column">
            <h4>GESTÃO</h4>

            <a href="#">Produtos</a>
            <a href="#">Pedidos</a>
            <a href="#">Mesas</a>
            <a href="#">Categorias</a>
            <a href="#">Funcionários</a>
        </div>


        <!-- Kitch'o -->
        <div class="footer-column">
            <h4>KITCH’O</h4>

            <a href="#">Sobre nós</a>
            <a href="#">Como funciona</a>
            <a href="#">Preços</a>
            <a href="#">Blog</a>
            <a href="#">Contato</a>
        </div>


        <!-- Social -->
        <div class="footer-column footer-social">
            <h4>SOCIAL</h4>

            <a href="#">Instagram</a>
            <a href="#">Facebook</a>
            <a href="#">LinkedIn</a>
            <a href="#">YouTube</a>
        </div>

    </div>


    <div class="footer-bottom">
        <span>
            © {{ date('Y') }} Kitch’o. Todos os direitos reservados.
        </span>

        <div>
            <a href="#">Privacidade</a>
            <a href="#">Termos</a>
        </div>
    </div>

</footer>


</body>

</html>