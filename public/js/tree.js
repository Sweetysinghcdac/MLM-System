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

// Optional: collapse all children initially
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.mlm-children-horizontal').forEach(el => {
        el.style.display = 'flex'; // set to 'none' if you want them collapsed by default
    });
});
