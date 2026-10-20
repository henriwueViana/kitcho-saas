
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>{{ $establishment->name }} - Cardápio</title>

    <link rel="stylesheet" href="{{ asset('css/cardapio.css') }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>

    {{-- Decoração de fundo --}}

    <div class="menu-background menu-background-one"></div>

    <div class="menu-background menu-background-two"></div>


    <main class="menu-page">

        {{-- =====================================================
             CABEÇALHO
        ====================================================== --}}

        <header class="menu-header">

            <div class="menu-label">

                <span class="menu-label-dot"></span>

                Cardápio

            </div>


            <h1 class="establishment-name">
                {{ $establishment->name }}
            </h1>


            @if ($establishment->address)

                <p class="establishment-address">
                    {{ $establishment->address }}
                </p>

            @endif

        </header>


        {{-- =====================================================
             CARDÁPIO
        ====================================================== --}}

        <div id="menu-container" class="menu-container">

            @forelse ($categories as $category)

                @if ($category->products->isNotEmpty())

                    <section class="category">

                        <div class="category-header">

                            <h2 class="category-title">
                                {{ $category->name }}
                            </h2>

                            <div class="category-line"></div>

                        </div>


                        <div class="products-grid">

                            @foreach ($category->products as $product)

                                <article class="product-card">

                                    {{-- =================================
                                         IMAGEM
                                    ================================== --}}

                                    <div class="product-image">

                                        @if ($product->image_path)

                                            <img
                                                src="{{ asset('storage/' . $product->image_path) }}"
                                                alt="{{ $product->name }}"
                                                loading="lazy"
                                            >

                                        @else

                                            <div class="product-image-placeholder">
                                                🍽
                                            </div>

                                        @endif

                                    </div>


                                    {{-- =================================
                                         CONTEÚDO
                                    ================================== --}}

                                    <div class="product-content">

                                        <div class="product-info">

                                            <h3 class="product-name">
                                                {{ $product->name }}
                                            </h3>


                                            @if ($product->description)

                                                <p class="product-description">
                                                    {{ $product->description }}
                                                </p>

                                            @endif

                                        </div>


                                        <div class="product-bottom">

                                            <p class="product-price">
                                                R$
                                                {{ number_format($product->price, 2, ',', '.') }}
                                            </p>


                                            <div class="quantity-control">

                                                <button
                                                    type="button"
                                                    onclick="decreaseQuantity({{ $product->id }})"
                                                    class="quantity-button"
                                                    aria-label="Remover {{ $product->name }}"
                                                >
                                                    −
                                                </button>


                                                <span
                                                    id="quantity-{{ $product->id }}"
                                                    class="quantity-value"
                                                >
                                                    0
                                                </span>


                                                <button
                                                    type="button"
                                                    onclick="increaseQuantity({{ $product->id }})"
                                                    class="quantity-button"
                                                    aria-label="Adicionar {{ $product->name }}"
                                                >
                                                    +
                                                </button>

                                            </div>

                                        </div>

                                    </div>

                                </article>

                            @endforeach

                        </div>

                    </section>

                @endif

            @empty

                <div class="empty-menu">

                    <h2 class="empty-menu-title">
                        Cardápio indisponível
                    </h2>


                    <p class="empty-menu-text">
                        Este estabelecimento ainda não possui produtos cadastrados.
                    </p>

                </div>

            @endforelse

        </div>

    </main>


    {{-- =========================================================
         BARRA DO CARRINHO
    ========================================================== --}}

    <div
        id="cart-bar"
        class="hidden"
    >

        <div class="cart-bar-inner">

            <div class="cart-summary">

                <p class="cart-summary-label">
                    Seu pedido
                </p>


                <p class="cart-summary-items">

                    <span id="cart-items">
                        0
                    </span>

                    item(ns)

                </p>

            </div>


            <button
                type="button"
                onclick="showCart()"
                class="cart-button"
            >
                Ver carrinho
            </button>

        </div>

    </div>


    {{-- =========================================================
         MODAL DO CARRINHO
    ========================================================== --}}

    <div
        id="cart-modal"
        class="hidden"
    >

        <div class="cart-modal-content">

            {{-- Cabeçalho --}}

            <div class="cart-modal-header">

                <div>

                    <h2 class="cart-modal-title">
                        Seu carrinho
                    </h2>


                    <p class="cart-modal-establishment">
                        {{ $establishment->name }}
                    </p>

                </div>


                <button
                    type="button"
                    onclick="closeCart()"
                    class="close-cart-button"
                    aria-label="Fechar carrinho"
                >
                    ×
                </button>

            </div>


            {{-- Itens --}}

            <div
                id="cart-content"
                class="cart-content"
            >
            </div>


            {{-- Total e ações --}}

            <div class="cart-modal-footer">

                <div class="cart-total-row">

                    <span class="cart-total-label">
                        Total
                    </span>


                    <span
                        id="cart-total"
                        class="cart-total-value"
                    >
                        R$ 0,00
                    </span>

                </div>


                <div class="cart-actions">

                    <button
                        type="button"
                        onclick="closeCart()"
                        class="cart-action cart-action-secondary"
                    >
                        Voltar
                    </button>


                    <button
                        type="button"
                        onclick="continueOrder()"
                        class="cart-action cart-action-primary"
                    >
                        Continuar
                    </button>

                </div>

            </div>

        </div>

    </div>


    <script>
        window.menuData = {
            products: @json($products),
            cartKey: 'cart-{{ $establishment->id }}',
            checkoutUrl: "{{ route('menu.checkout', $establishment->slug) }}",
            tableId: @json($table?->id)
        };
    </script>

    <script src="{{ asset('js/cardapio.js') }}"></script>

</body>
</html>
