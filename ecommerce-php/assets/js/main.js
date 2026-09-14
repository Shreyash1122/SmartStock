const quantityInput = document.querySelector('#quantity');
const quantityButtons = document.querySelectorAll('.quantity-button');
const confirmButtons = document.querySelectorAll('[data-confirm]');

quantityButtons.forEach((button) => {
    button.addEventListener('click', () => {
        if (!quantityInput) {
            return;
        }

        const current = Number(quantityInput.value) || 1;
        if (button.dataset.action === 'increase') {
            quantityInput.value = current + 1;
            return;
        }

        quantityInput.value = Math.max(1, current - 1);
    });
});

confirmButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        const message = button.getAttribute('data-confirm');
        if (message && !window.confirm(message)) {
            event.preventDefault();
        }
    });
});
