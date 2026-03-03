import './bootstrap';

const syncPresetButtons = () => {
    document.querySelectorAll('[data-donation-widget]').forEach((widget) => {
        const amountInput = widget.querySelector('[data-amount-input]');
        const buttons = widget.querySelectorAll('[data-amount-trigger]');

        buttons.forEach((button) => {
            button.addEventListener('click', () => {
                if (!amountInput) return;

                amountInput.value = button.dataset.amountTrigger ?? '';

                buttons.forEach((item) => item.classList.remove('preset-chip-active'));
                button.classList.add('preset-chip-active');
            });
        });

        amountInput?.addEventListener('input', () => {
            buttons.forEach((button) => {
                button.classList.toggle(
                    'preset-chip-active',
                    button.dataset.amountTrigger === amountInput.value,
                );
            });
        });
    });
};

const bindMobileMenu = () => {
    const toggle = document.querySelector('[data-menu-toggle]');
    const panel = document.querySelector('[data-menu-panel]');

    if (!toggle || !panel) return;

    toggle.addEventListener('click', () => {
        const hidden = panel.hasAttribute('hidden');
        panel.toggleAttribute('hidden');
        toggle.setAttribute('aria-expanded', String(hidden));
    });
};

document.addEventListener('DOMContentLoaded', () => {
    syncPresetButtons();
    bindMobileMenu();
});
