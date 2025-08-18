@extends('layouts.app')

@section('title', 'POS System')

@section('content')
<div class="row">
    <!-- Items Section -->
    <div class="col-lg-8">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-shopping-cart me-2"></i>
                    Select Items
                </h5>
            </div>
            <div class="card-body">
                <!-- Search Bar -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                        <input type="text" class="form-control" id="searchInput" placeholder="Search items by name or barcode...">
                    </div>
                </div>

                <!-- Items Grid -->
                <div class="row" id="itemsGrid">
                    @foreach($items as $item)
                    <div class="col-md-4 col-lg-3 mb-3 item-element" 
                         data-name="{{ strtolower($item->name) }}" 
                         data-barcode="{{ strtolower($item->barcode) }}">
                        <div class="card item-card h-100" data-item-id="{{ $item->id }}">
                            <div class="card-body text-center">
                                <i class="fas fa-box fa-2x text-primary mb-2"></i>
                                <h6 class="card-title">{{ $item->name }}</h6>
                                <p class="card-text text-muted small">{{ Str::limit($item->description, 50) }}</p>
                                <p class="card-text">
                                    <strong class="text-success">Rp {{ number_format($item->price, 0, ',', '.') }}</strong>
                                </p>
                                <p class="card-text">
                                    <small class="text-muted">Stock: {{ $item->stock_quantity }}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Cart Section -->
    <div class="col-lg-4">
        <div class="card h-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-receipt me-2"></i>
                    Cart
                </h5>
            </div>
            <div class="card-body d-flex flex-column">
                <!-- Cart Items -->
                <div class="flex-grow-1" style="max-height: 400px; overflow-y: auto;">
                    <div id="cartItems">
                        <div class="text-center text-muted py-4" id="emptyCart">
                            <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                            <p>Your cart is empty</p>
                            <p class="small">Click on items to add them to cart</p>
                        </div>
                    </div>
                </div>

                <!-- Cart Summary -->
                <div class="border-top pt-3 mt-3">
                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span id="subtotal">Rp0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax (10%):</span>
                        <span id="tax">Rp0.00</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total:</strong>
                        <strong id="total">Rp0.00</strong>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <select class="form-select" id="paymentMethod">
                            <option value="cash">Cash</option>
                            <option value="card">Card</option>
                            <option value="digital">Digital Wallet</option>
                        </select>
                    </div>

                    <!-- Cashier Name -->
                    <div class="mb-3">
                        <label class="form-label">Cashier</label>
                        <input type="text" class="form-control" id="cashierName" placeholder="Enter cashier name">
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        <button class="btn btn-gradient btn-lg" id="processPayment" disabled>
                            <i class="fas fa-credit-card me-2"></i>
                            Process Payment
                        </button>
                        <button class="btn btn-outline-secondary" id="clearCart">
                            <i class="fas fa-trash me-2"></i>
                            Clear Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Receipt Modal -->
<div class="modal fade" id="receiptModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-receipt me-2"></i>
                    Receipt
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="receiptContent">
                <!-- Receipt content will be loaded here -->
            </div>
            <div class="modal-footer no-print">
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="fas fa-print me-2"></i>
                    Print Receipt
                </button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    let cart = [];
    
    // IDR formatting function
    function formatIDR(amount) {
        if (isNaN(amount) || amount === null || amount === undefined) {
            return '0';
        }
        return Math.round(Number(amount)).toLocaleString('id-ID');
    }
    
    // CSRF token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Search functionality
    $('#searchInput').on('input', function() {
        const searchTerm = $(this).val().toLowerCase();
        
        $('.item-element').each(function() {
            const itemName = $(this).data('name');
            const itemBarcode = $(this).data('barcode');
            
            if (itemName.includes(searchTerm) || itemBarcode.includes(searchTerm)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Add item to cart
    $('.item-card').on('click', function() {
        const itemId = $(this).data('item-id');
        const itemName = $(this).find('.card-title').text();
        const itemPriceText = $(this).find('.text-success').text().replace('Rp ', '').replace(/\./g, '');
        const itemPrice = parseInt(itemPriceText);
        
        // Check if item already in cart
        const existingItem = cart.find(item => item.id == itemId);
        
        if (existingItem) {
            existingItem.quantity++;
        } else {
            cart.push({
                id: itemId,
                name: itemName,
                price: itemPrice,
                quantity: 1
            });
        }
        
        updateCartDisplay();
    });

    // Update cart display
    function updateCartDisplay() {
        const cartContainer = $('#cartItems');
        
        if (cart.length === 0) {
            cartContainer.html(`
                <div class="text-center text-muted py-4" id="emptyCart">
                    <i class="fas fa-shopping-cart fa-3x mb-3"></i>
                    <p>Your cart is empty</p>
                    <p class="small">Click on items to add them to cart</p>
                </div>
            `);
            $('#processPayment').prop('disabled', true);
        } else {
            let cartHtml = '';
            cart.forEach((item, index) => {
                cartHtml += `
                    <div class="cart-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>${item.name}</strong>
                                <br>
                                <small class="text-muted">Rp ${formatIDR(item.price)} each</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <button class="btn btn-sm btn-outline-secondary me-2 quantity-btn" data-action="decrease" data-index="${index}">-</button>
                                <span class="mx-2">${item.quantity}</span>
                                <button class="btn btn-sm btn-outline-secondary me-2 quantity-btn" data-action="increase" data-index="${index}">+</button>
                                <button class="btn btn-sm btn-outline-danger remove-item" data-index="${index}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        <div class="mt-2">
                            <strong>Total: Rp ${formatIDR(item.price * item.quantity)}</strong>
                        </div>
                    </div>
                `;
            });
            cartContainer.html(cartHtml);
            $('#processPayment').prop('disabled', false);
        }
        
        updateTotals();
    }

    // Handle quantity changes
    $(document).on('click', '.quantity-btn', function() {
        const action = $(this).data('action');
        const index = $(this).data('index');
        
        if (action === 'increase') {
            cart[index].quantity++;
        } else if (action === 'decrease') {
            if (cart[index].quantity > 1) {
                cart[index].quantity--;
            }
        }
        
        updateCartDisplay();
    });

    // Remove item from cart
    $(document).on('click', '.remove-item', function() {
        const index = $(this).data('index');
        cart.splice(index, 1);
        updateCartDisplay();
    });

    // Update totals
    function updateTotals() {
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = subtotal * 0.1; // 10% tax
        const total = subtotal + tax;
        
        $('#subtotal').text('Rp ' + formatIDR(subtotal));
        $('#tax').text('Rp ' + formatIDR(tax));
        $('#total').text('Rp ' + formatIDR(total));
    }

    // Clear cart
    $('#clearCart').on('click', function() {
        cart = [];
        updateCartDisplay();
    });

    // Process payment
    $('#processPayment').on('click', function() {
        if (cart.length === 0) return;
        
        const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const tax = subtotal * 0.1;
        const total = subtotal + tax;
        
        const saleData = {
            items: cart,
            total_amount: total,
            tax_amount: tax,
            payment_method: $('#paymentMethod').val(),
            cashier: $('#cashierName').val() || 'System'
        };
        
        $.post('{{ route("pos.sale") }}', saleData)
            .done(function(response) {
                if (response.success) {
                    // Load receipt
                    loadReceipt(response.sale_id);
                    
                    // Clear cart
                    cart = [];
                    updateCartDisplay();
                    
                    // Show success message
                    alert('Sale processed successfully! Receipt Number: ' + response.receipt_number);
                } else {
                    alert('Error processing sale: ' + (response.message || 'Unknown error'));
                }
            })
            .fail(function(xhr, status, error) {
                console.error('Sale processing failed:', xhr.responseText);
                let errorMessage = 'Error processing sale. Please try again.';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = Object.values(xhr.responseJSON.errors).flat();
                    errorMessage = errors.join(', ');
                }
                
                alert(errorMessage);
            });
    });

    // Load receipt
    function loadReceipt(saleId) {
        $.get(`/pos/receipt/${saleId}`)
            .done(function(response) {
                $('#receiptContent').html(response);
                $('#receiptModal').modal('show');
            });
    }
});
</script>
@endsection
