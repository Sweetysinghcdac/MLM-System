import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();
function toggleChildren(labelEl) {
    const parentNode = labelEl.parentElement;
    const childrenContainer = parentNode.querySelector('.mlm-children-horizontal');
    if (!childrenContainer) return;

    const toggle = labelEl.querySelector('.mlm-toggle');

    if (childrenContainer.style.display === 'none') {
        childrenContainer.style.display = 'flex';
        toggle.textContent = '▾';
    } else {
        childrenContainer.style.display = 'none';
        toggle.textContent = '▸';
    }
}

// Optionally collapse all children initially
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.mlm-children-horizontal').forEach(el => {
        el.style.display = 'flex'; // set 'none' if you want collapsed by default
    });
});
