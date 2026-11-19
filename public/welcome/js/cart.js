/* ==========================================
   Shopping Cart Management System
   ========================================== */

// Cart storage functions
const Cart = {
    // Get cart from localStorage
    get: function() {
        const cart = localStorage.getItem('shoppingCart');
        return cart ? JSON.parse(cart) : [];
    },

    // Save cart to localStorage
    save: function(cart) {
        localStorage.setItem('shoppingCart', JSON.stringify(cart));
        this.updateCartCount();
    },

    // Add item to cart
    add: function(product) {
        let cart = this.get();
        const existingItem = cart.find(item => item.id === product.id);

        if (existingItem) {
            existingItem.quantity += product.quantity;
        } else {
            cart.push(product);
        }

        this.save(cart);
        this.showNotification('Product added to cart successfully!', 'success');
    },

    // Remove item from cart
    remove: function(productId) {
        let cart = this.get();
        cart = cart.filter(item => item.id !== productId);
        this.save(cart);
        this.showNotification('Product removed from cart', 'info');
    },

    // Update item quantity
    updateQuantity: function(productId, quantity) {
        let cart = this.get();
        const item = cart.find(item => item.id === productId);
        
        if (item) {
            item.quantity = parseInt(quantity);
            if (item.quantity <= 0) {
                this.remove(productId);
            } else {
                this.save(cart);
            }
        }
    },

    // Clear entire cart
    clear: function() {
        localStorage.removeItem('shoppingCart');
        this.updateCartCount();
    },

    // Get cart item count
    getCount: function() {
        const cart = this.get();
        return cart.reduce((total, item) => total + item.quantity, 0);
    },

    // Update cart count in header
    updateCartCount: function() {
        const count = this.getCount();
        $('.cart-count').text(count);
        
        if (count > 0) {
            $('.cart-count').show();
        } else {
            $('.cart-count').hide();
        }
    },

    // Calculate cart totals
    calculateTotals: function() {
        const cart = this.get();
        let subtotal = 0;

        cart.forEach(item => {
            subtotal += item.price * item.quantity;
        });

        // Get shipping cost
        const shippingCost = parseFloat($('input[name="shippingMethod"]:checked').val() || 0);

        // Get discount
        const discount = parseFloat(localStorage.getItem('cartDiscount') || 0);

        // Calculate tax (10%)
        const tax = (subtotal - discount) * 0.10;

        // Calculate total
        const total = subtotal + shippingCost - discount + tax;

        return {
            subtotal: subtotal,
            shipping: shippingCost,
            discount: discount,
            tax: tax,
            total: total
        };
    },

    // Show notification
    showNotification: function(message, type = 'success') {
        const notification = $(`
            <div class="cart-notification ${type}">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'}"></i>
                <span>${message}</span>
            </div>
        `);

        $('body').append(notification);
        
        setTimeout(() => {
            notification.addClass('show');
        }, 100);

        setTimeout(() => {
            notification.removeClass('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
};

/* ==================== Global Add to Cart Function ==================== */
// Function for product listing pages (products.html, index.html, etc.)
function addToCart(productId, productName, productPrice, event) {
    // Try to get the product image from the card
    let productImage = 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=800&h=600&fit=crop'; // Default
    
    if (event) {
        const button = event.target.closest('button');
        const card = button ? button.closest('.product-card') : null;
        const imgElement = card ? card.querySelector('.product-image img') : null;
        
        if (imgElement) {
            productImage = imgElement.src;
        }
    }

    const product = {
        id: 'product-' + productId,
        name: productName,
        price: parseFloat(productPrice),
        quantity: 1,
        image: productImage,
        color: null
    };

    Cart.add(product);
}

// Initialize cart on page load
$(document).ready(function() {
    Cart.updateCartCount();

    // Product Details Page
    if ($('#addToCartBtn').length) {
        initProductDetails();
    }

    // Cart Page
    if ($('#cartItemsContainer').length) {
        initCartPage();
    }

    // Checkout Page
    if ($('#checkoutForm').length) {
        initCheckoutPage();
    }

    // Order Success Page
    if ($('.order-success-section').length) {
        initOrderSuccessPage();
    }
});

/* ==================== Product Details Page Functions ==================== */
function initProductDetails() {
    // Thumbnail image switching
    $('.thumbnail').click(function() {
        const newSrc = $(this).attr('src').replace('150x150', '800x600');
        $('#mainProductImage').attr('src', newSrc);
        $('.thumbnail').removeClass('active');
        $(this).addClass('active');
    });

    // Color selection
    $('.color-option').click(function() {
        $('.color-option').removeClass('active');
        $(this).addClass('active');
    });

    // Quantity controls
    $('#increaseQty').click(function() {
        const input = $('#quantity');
        const currentVal = parseInt(input.val());
        const max = parseInt(input.attr('max'));
        if (currentVal < max) {
            input.val(currentVal + 1);
        }
    });

    $('#decreaseQty').click(function() {
        const input = $('#quantity');
        const currentVal = parseInt(input.val());
        const min = parseInt(input.attr('min'));
        if (currentVal > min) {
            input.val(currentVal - 1);
        }
    });

    // Add to cart button
    $('#addToCartBtn').click(function() {
        const product = {
            id: 'product-' + Date.now(),
            name: $('#productName').text(),
            price: parseFloat($('#productPrice').text().replace('৳', '').replace(/,/g, '')),
            quantity: parseInt($('#quantity').val()),
            image: $('#mainProductImage').attr('src'),
            color: $('.color-option.active').data('color') || 'black'
        };

        Cart.add(product);
    });

    // Buy now button
    $('#buyNowBtn').click(function() {
        $('#addToCartBtn').click();
        setTimeout(() => {
            window.location.href = 'checkout.html';
        }, 500);
    });

    // Wishlist button
    $('.btn-wishlist').click(function() {
        $(this).toggleClass('active');
        const icon = $(this).find('i');
        
        if ($(this).hasClass('active')) {
            icon.removeClass('far').addClass('fas');
            Cart.showNotification('Added to wishlist', 'success');
        } else {
            icon.removeClass('fas').addClass('far');
            Cart.showNotification('Removed from wishlist', 'info');
        }
    });
}

/* ==================== Cart Page Functions ==================== */
function initCartPage() {
    renderCartItems();

    // Shipping method change
    $('.shipping-method').change(function() {
        updateCartTotals();
    });

    // Clear cart button
    $('#clearCartBtn').click(function() {
        if (confirm('Are you sure you want to clear your cart?')) {
            Cart.clear();
            renderCartItems();
        }
    });

    // Apply coupon button
    $('#applyCouponBtn').click(function() {
        const couponCode = $('#couponCode').val().trim().toUpperCase();
        
        if (couponCode === 'SAVE10') {
            const totals = Cart.calculateTotals();
            const discount = totals.subtotal * 0.10;
            localStorage.setItem('cartDiscount', discount);
            $('#couponMessage').html('<div class="alert alert-success">Coupon applied! You saved $' + discount.toFixed(2) + '</div>');
            updateCartTotals();
        } else if (couponCode === 'SAVE20') {
            const totals = Cart.calculateTotals();
            const discount = totals.subtotal * 0.20;
            localStorage.setItem('cartDiscount', discount);
            $('#couponMessage').html('<div class="alert alert-success">Coupon applied! You saved ৳' + discount.toFixed(0) + '</div>');
            updateCartTotals();
        } else {
            $('#couponMessage').html('<div class="alert alert-danger">Invalid coupon code</div>');
        }
    });

    // Proceed to checkout button
    $('#proceedToCheckoutBtn').click(function() {
        const cart = Cart.get();
        if (cart.length === 0) {
            alert('Your cart is empty!');
            return;
        }
        window.location.href = 'checkout.html';
    });
}

function renderCartItems() {
    const cart = Cart.get();
    const container = $('#cartItemsContainer');
    
    if (cart.length === 0) {
        $('#emptyCartMessage').show();
        $('#cartContent').hide();
        return;
    }

    $('#emptyCartMessage').hide();
    $('#cartContent').show();

    container.empty();

    cart.forEach(item => {
        const row = `
            <tr data-product-id="${item.id}">
                <td class="cart-item-product">
                    <img src="${item.image}" alt="${item.name}">
                    <div class="product-details">
                        <h5>${item.name}</h5>
                        ${item.color ? `<small>Color: ${item.color}</small>` : ''}
                    </div>
                </td>
                <td class="cart-item-price">৳${item.price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</td>
                <td class="cart-item-quantity">
                    <div class="quantity-control">
                        <button class="qty-btn decrease-qty" data-id="${item.id}">-</button>
                        <input type="number" value="${item.quantity}" min="1" max="10" class="qty-input" data-id="${item.id}">
                        <button class="qty-btn increase-qty" data-id="${item.id}">+</button>
                    </div>
                </td>
                <td class="cart-item-subtotal">৳${(item.price * item.quantity).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</td>
                <td class="cart-item-remove">
                    <button class="btn btn-sm btn-danger remove-item" data-id="${item.id}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
        `;
        container.append(row);
    });

    // Attach event handlers
    $('.decrease-qty').click(function() {
        const id = $(this).data('id');
        const input = $(`.qty-input[data-id="${id}"]`);
        const newQty = parseInt(input.val()) - 1;
        if (newQty > 0) {
            Cart.updateQuantity(id, newQty);
            renderCartItems();
        }
    });

    $('.increase-qty').click(function() {
        const id = $(this).data('id');
        const input = $(`.qty-input[data-id="${id}"]`);
        const newQty = parseInt(input.val()) + 1;
        if (newQty <= 10) {
            Cart.updateQuantity(id, newQty);
            renderCartItems();
        }
    });

    $('.qty-input').change(function() {
        const id = $(this).data('id');
        const newQty = parseInt($(this).val());
        Cart.updateQuantity(id, newQty);
        renderCartItems();
    });

    $('.remove-item').click(function() {
        const id = $(this).data('id');
        if (confirm('Remove this item from cart?')) {
            Cart.remove(id);
            renderCartItems();
        }
    });

    updateCartTotals();
}

function updateCartTotals() {
    const totals = Cart.calculateTotals();

    $('#cartSubtotal').text('৳' + totals.subtotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#shippingCost').text('৳' + totals.shipping.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#taxAmount').text('৳' + totals.tax.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#cartTotal').text('৳' + totals.total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));

    if (totals.discount > 0) {
        $('#discountRow').show();
        $('#discountAmount').text('-৳' + totals.discount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    } else {
        $('#discountRow').hide();
    }
}

/* ==================== Checkout Page Functions ==================== */
function initCheckoutPage() {
    // Check if cart is empty
    const cart = Cart.get();
    if (cart.length === 0) {
        alert('Your cart is empty!');
        window.location.href = 'products.html';
        return;
    }

    renderCheckoutItems();

    // Same as billing address checkbox
    $('#sameAsBilling').change(function() {
        if ($(this).is(':checked')) {
            $('#shippingAddressFields').slideUp();
        } else {
            $('#shippingAddressFields').slideDown();
        }
    });

    // Payment method toggle (for Cash on Delivery only)
    $('input[name="paymentMethod"]').change(function() {
        const method = $(this).val();
        $('.payment-details').hide();
        // No additional details needed for cash on delivery
    });

    // Form submission
    $('#checkoutForm').submit(function(e) {
        e.preventDefault();

        // Validate terms checkbox
        if (!$('#termsAccepted').is(':checked')) {
            alert('Please accept the terms and conditions');
            return;
        }

        // Show loading state
        const btn = $('#placeOrderBtn');
        const originalText = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin"></i> Processing...').prop('disabled', true);

        // Simulate order processing
        setTimeout(() => {
            // Save order data
            const orderData = {
                orderNumber: 'MCO-2024-' + Math.floor(Math.random() * 100000).toString().padStart(5, '0'),
                date: new Date().toLocaleDateString(),
                customer: {
                    name: $('#firstName').val() + ' ' + $('#lastName').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    address: $('#address').val() + ', ' + $('#city').val() + ', ' + $('#district').val() + ', Bangladesh'
                },
                items: Cart.get(),
                totals: Cart.calculateTotals(),
                paymentMethod: $('input[name="paymentMethod"]:checked').val()
            };

            localStorage.setItem('lastOrder', JSON.stringify(orderData));

            // Clear cart
            Cart.clear();
            localStorage.removeItem('cartDiscount');

            // Redirect to success page
            window.location.href = 'order-success.html';
        }, 2000);
    });
}

function renderCheckoutItems() {
    const cart = Cart.get();
    const container = $('#checkoutOrderItems');

    container.empty();

    cart.forEach(item => {
        const itemHtml = `
            <div class="checkout-item">
                <img src="${item.image}" alt="${item.name}">
                <div class="item-details">
                    <h6>${item.name}</h6>
                    <p>Qty: ${item.quantity} × ৳${item.price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</p>
                </div>
                <div class="item-total">
                    ৳${(item.price * item.quantity).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                </div>
            </div>
        `;
        container.append(itemHtml);
    });

    updateCheckoutTotals();
}

function updateCheckoutTotals() {
    const totals = Cart.calculateTotals();

    $('#checkoutSubtotal').text('৳' + totals.subtotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#checkoutShipping').text('৳' + totals.shipping.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#checkoutTax').text('৳' + totals.tax.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#checkoutTotal').text('৳' + totals.total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));

    if (totals.discount > 0) {
        $('#checkoutDiscountRow').show();
        $('#checkoutDiscount').text('-৳' + totals.discount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    }
}

/* ==================== Order Success Page Functions ==================== */
function initOrderSuccessPage() {
    const orderData = JSON.parse(localStorage.getItem('lastOrder'));

    if (!orderData) {
        // No order data, redirect to products
        window.location.href = 'products.html';
        return;
    }

    // Display order information
    $('#orderNumber').text(orderData.orderNumber);
    $('#orderDate').text(orderData.date);
    $('#orderTotalAmount').text('৳' + orderData.totals.total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#customerEmail').text(orderData.customer.email);
    $('#customerName').text(orderData.customer.name);
    $('#customerAddress').html(orderData.customer.address);
    $('#customerPhone').text(orderData.customer.phone);

    // Display ordered items
    const itemsList = $('#orderedItemsList');
    itemsList.empty();

    orderData.items.forEach(item => {
        const row = `
            <tr>
                <td>
                    <div class="d-flex align-items-center">
                        <img src="${item.image}" alt="${item.name}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px; margin-right: 15px;">
                        <div>
                            <strong>${item.name}</strong>
                            ${item.color ? `<br><small>Color: ${item.color}</small>` : ''}
                        </div>
                    </div>
                </td>
                <td>৳${item.price.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</td>
                <td>${item.quantity}</td>
                <td>৳${(item.price * item.quantity).toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</td>
            </tr>
        `;
        itemsList.append(row);
    });

    // Display totals
    $('#orderSubtotal').text('৳' + orderData.totals.subtotal.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#orderShipping').text('৳' + orderData.totals.shipping.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#orderTax').text('৳' + orderData.totals.tax.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    $('#orderTotal').text('৳' + orderData.totals.total.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));

    if (orderData.totals.discount > 0) {
        $('#orderDiscountRow').show();
        $('#orderDiscount').text('-৳' + orderData.totals.discount.toFixed(0).replace(/\B(?=(\d{3})+(?!\d))/g, ','));
    }

    // Display payment method
    let paymentMethodText = 'Cash on Delivery';
    if (orderData.paymentMethod === 'cash_on_delivery') {
        paymentMethodText = 'Cash on Delivery';
    }
    $('#paymentMethod').text(paymentMethodText);

    // Clear order data after displaying (optional)
    // localStorage.removeItem('lastOrder');
}

