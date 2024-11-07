function plus(event, button) {
    event.preventDefault();
    let form = button.closest('form');
    let qtyInput = form.querySelector('input[name="qty"]');
    let currentValue = parseInt(qtyInput.value);
    if (currentValue < 99) {
        qtyInput.value = currentValue + 1;
    }
}

function moin(event, button) {
    event.preventDefault();
    let form = button.closest('form');
    let qtyInput = form.querySelector('input[name="qty"]');
    let currentValue = parseInt(qtyInput.value);
    if (currentValue > 0) {
        qtyInput.value = currentValue - 1;
    }
}