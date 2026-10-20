
const products = window.menuData.products;
const cart = {};

const cartKey = window.menuData.cartKey;


// =====================================================
// ADICIONAR
// =====================================================

function increaseQuantity(productId) {
    cart[productId] = (cart[productId] || 0) + 1;

    updateQuantity(productId);
    updateCart();
}


// =====================================================
// REMOVER
// =====================================================

function decreaseQuantity(productId) {
    if (!cart[productId]) {
        return;
    }

    cart[productId]--;

    if (cart[productId] <= 0) {
        delete cart[productId];
    }

    updateQuantity(productId);
    updateCart();
}


// =====================================================
// ATUALIZAR QUANTIDADE
// =====================================================

function updateQuantity(productId) {
    const element = document.getElementById(
        `quantity-${productId}`
    );

    if (!element) {
        return;
    }

    element.textContent = cart[productId] || 0;
}


// =====================================================
// ATUALIZAR CARRINHO
// =====================================================

function updateCart() {
    const totalItems = Object.values(cart)
        .reduce(
            (total, quantity) => total + quantity,
            0
        );

    sessionStorage.setItem(
        cartKey,
        JSON.stringify(cart)
    );

    const cartBar = document.getElementById('cart-bar');
    const cartItems = document.getElementById('cart-items');

    cartItems.textContent = totalItems;

    if (totalItems > 0) {
        cartBar.classList.remove('hidden');
    } else {
        cartBar.classList.add('hidden');
    }
}


// =====================================================
// ABRIR CARRINHO
// =====================================================

function showCart() {
    renderCart();

    const modal = document.getElementById('cart-modal');

    modal.classList.remove('hidden');

    document.body.style.overflow = 'hidden';
}


// =====================================================
// FECHAR CARRINHO
// =====================================================

function closeCart() {
    const modal = document.getElementById('cart-modal');

    modal.classList.add('hidden');

    document.body.style.overflow = '';
}


// =====================================================
// RENDERIZAR CARRINHO
// =====================================================

function renderCart() {
    const content = document.getElementById('cart-content');

    const totalElement = document.getElementById('cart-total');

    content.innerHTML = '';

    let total = 0;

    Object.entries(cart).forEach(
        ([productId, quantity]) => {

            const product = products.find(
                product =>
                    product.id === Number(productId)
            );

            if (!product) {
                return;
            }

            const subtotal = product.price * quantity;

            total += subtotal;

            const item = document.createElement('div');

            item.className = 'cart-item';

            item.innerHTML = `
                <div>
                    <p class="cart-item-name">
                        ${product.name}
                    </p>

                    <p class="cart-item-price">
                        R$ ${formatPrice(product.price)} cada
                    </p>
                </div>

                <div class="cart-item-controls">

                    <button
                        type="button"
                        onclick="decreaseFromCart(${product.id})"
                        class="cart-quantity-button"
                        aria-label="Remover item"
                    >
                        −
                    </button>

                    <span class="cart-quantity">
                        ${quantity}
                    </span>

                    <button
                        type="button"
                        onclick="increaseFromCart(${product.id})"
                        class="cart-quantity-button"
                        aria-label="Adicionar item"
                    >
                        +
                    </button>

                </div>

                <p class="cart-item-total">
                    R$ ${formatPrice(subtotal)}
                </p>
            `;

            content.appendChild(item);
        }
    );

    if (Object.keys(cart).length === 0) {
        content.innerHTML = `
            <div class="empty-cart">
                Seu carrinho está vazio.
            </div>
        `;
    }

    totalElement.textContent =
        `R$ ${formatPrice(total)}`;
}


// =====================================================
// AUMENTAR PELO CARRINHO
// =====================================================

function increaseFromCart(productId) {
    increaseQuantity(productId);

    renderCart();
}


// =====================================================
// DIMINUIR PELO CARRINHO
// =====================================================

function decreaseFromCart(productId) {
    decreaseQuantity(productId);

    if (Object.keys(cart).length === 0) {
        closeCart();
        return;
    }

    renderCart();
}


// =====================================================
// FORMATAR PREÇO
// =====================================================

function formatPrice(value) {
    return Number(value).toLocaleString(
        'pt-BR',
        {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }
    );
}


// =====================================================
// CONTINUAR PEDIDO
// =====================================================

function continueOrder() {
    if (Object.keys(cart).length === 0) {
        return;
    }

    const checkoutUrl = new URL(
        window.menuData.checkoutUrl,
        window.location.origin
    );

    if (window.menuData.tableId) {
        checkoutUrl.searchParams.set(
            'table',
            window.menuData.tableId
        );
    }

    window.location.href =
        checkoutUrl.toString();
}


// =====================================================
// CLICAR FORA DO MODAL
// =====================================================

const cartModal =
    document.getElementById('cart-modal');

if (cartModal) {
    cartModal.addEventListener(
        'click',
        function (event) {
            if (event.target === this) {
                closeCart();
            }
        }
    );
}


// =====================================================
// RECUPERAR CARRINHO
// =====================================================

const savedCart =
    sessionStorage.getItem(cartKey);

if (savedCart) {
    try {
        const saved =
            JSON.parse(savedCart);

        Object.assign(
            cart,
            saved
        );

        Object.keys(cart).forEach(
            productId => {
                updateQuantity(productId);
            }
        );

        updateCart();

    } catch (error) {

        sessionStorage.removeItem(cartKey);

        console.error(
            'Erro ao recuperar o carrinho:',
            error
        );
    }
}