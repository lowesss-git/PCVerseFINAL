// Checkout functionality
document.addEventListener('DOMContentLoaded', function() {
    updateOrderSummary();
    
    // Set default payment method
    selectPayment('credit-card');
    
    // Handle form submission
    document.getElementById('checkout-form').addEventListener('submit', function(e) {
        e.preventDefault();
        processOrder();
    });
});

function selectPayment(method) {
    // Remove selected class from all payment methods
    document.querySelectorAll('.payment-method').forEach(pm => {
        pm.classList.remove('selected');
    });
    
    // Add selected class to clicked method
    event.currentTarget.classList.add('selected');
    
    // Set the hidden input value
    document.getElementById('payment-method').value = method;
}

function updateOrderSummary() {
    const orderItems = document.getElementById('order-items');
    const orderTotal = document.getElementById('order-total');
    
    if (cart.items.length === 0) {
        orderItems.innerHTML = '<p>No items in cart</p>';
        orderTotal.textContent = '0.00';
        return;
    }
    
    let itemsHTML = '';
    let total = 0;
    
    cart.items.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        itemsHTML += `
            <div class="order-item">
                <div>
                    <strong>${item.name}</strong>
                    <div>Qty: ${item.quantity} × ₱${item.price.toFixed(2)}</div>
                </div>
                <div>₱${itemTotal.toFixed(2)}</div>
            </div>
        `;
    });
    
    // Add shipping fee
    const shippingFee = 150;
    itemsHTML += `
        <div class="order-item">
            <div><strong>Shipping Fee</strong></div>
            <div>₱${shippingFee.toFixed(2)}</div>
        </div>
    `;
    
    total += shippingFee;
    
    orderItems.innerHTML = itemsHTML;
    orderTotal.textContent = total.toFixed(2);
}

function processOrder() {
    const form = document.getElementById('checkout-form');
    const formData = new FormData(form);
    
    // Basic validation
    const requiredFields = ['firstName', 'lastName', 'email', 'phone', 'address', 'city', 'zipCode', 'payment-method'];
    let isValid = true;
    
    requiredFields.forEach(field => {
        const value = document.getElementById(field) ? document.getElementById(field).value : formData.get(field);
        if (!value) {
            isValid = false;
        }
    });
    
    if (!isValid) {
        alert('Please fill in all required fields.');
        return;
    }
    
    if (cart.items.length === 0) {
        alert('Your cart is empty!');
        return;
    }
    
    // Show loading state
    const submitBtn = form.querySelector('button[type="submit"]');
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Processing...';
    submitBtn.disabled = true;
    
    // Simulate order processing
    setTimeout(() => {
        // Generate order number
        const orderNumber = 'PCV' + Date.now();
        
        // Save order to localStorage (in a real app, this would go to a server)
        const order = {
            orderNumber: orderNumber,
            items: cart.items,
            total: parseFloat(document.getElementById('order-total').textContent),
            customer: {
                firstName: document.getElementById('firstName').value,
                lastName: document.getElementById('lastName').value,
                email: document.getElementById('email').value,
                phone: document.getElementById('phone').value,
                address: document.getElementById('address').value,
                city: document.getElementById('city').value,
                zipCode: document.getElementById('zipCode').value
            },
            paymentMethod: document.getElementById('payment-method').value,
            date: new Date().toISOString()
        };
        
        // Save order (in real app, send to server)
        const orders = JSON.parse(localStorage.getItem('pcverse-orders')) || [];
        orders.push(order);
        localStorage.setItem('pcverse-orders', JSON.stringify(orders));
        
        // Clear cart
        cart.clearCart();
        
        // Redirect to order confirmation
        window.location.href = `orderconfirm.php?order=${orderNumber}`;
        
    }, 2000);
}