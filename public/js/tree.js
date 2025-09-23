// public/js/tree.js
document.addEventListener('DOMContentLoaded', function () {
    // find all toggle handles
    document.querySelectorAll('.mlm-node-label').forEach(function (label) {
        // click or Enter/Space toggles
        label.addEventListener('click', toggleNode);
        label.addEventListener('keydown', function (e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                toggleNode.call(this, e);
            }
        });
    });

    function toggleNode(e) {
        const label = e.currentTarget || this;
        const li = label.closest('.mlm-node');
        if (!li) return;
        const childrenContainer = li.querySelector('.mlm-children');
        const toggle = label.querySelector('.mlm-toggle');
        if (!childrenContainer) {
            // no children to expand/collapse
            if (toggle) {
                toggle.textContent = '•';
            }
            return;
        }

        const isHidden = childrenContainer.style.display === 'none' || getComputedStyle(childrenContainer).display === 'none';
        if (isHidden) {
            childrenContainer.style.display = '';
            if (toggle) toggle.textContent = '▾'; // down arrow
            label.setAttribute('aria-expanded', 'true');
        } else {
            childrenContainer.style.display = 'none';
            if (toggle) toggle.textContent = '▸'; // right arrow
            label.setAttribute('aria-expanded', 'false');
        }
    }

    // initialize: collapse deeper levels (optional)
    document.querySelectorAll('.mlm-children').forEach(function (el, idx) {
        // collapse nested levels after the first level
        const depth = getDepth(el);
        if (depth > 1) el.style.display = 'none'; // collapse level >=2
        // update toggles for those without children
        const parentLabel = el.parentElement.querySelector('.mlm-node-label');
        if (parentLabel && !el.querySelector('.mlm-children')) {
            const t = parentLabel.querySelector('.mlm-toggle');
            if (t) t.textContent = '▾';
        }
    });

    function getDepth(el) {
        let d = 0;
        let cur = el;
        while (cur && cur.closest) {
            cur = cur.closest('.mlm-children');
            if (cur) d++;
            else break;
        }
        return d;
    }
});
