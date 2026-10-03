(function() {
    const openBtn = document.getElementById('open-menu-btn');
    const closeBtn = document.getElementById('close-menu-btn');
    const menuBox = document.getElementById('menu-box');
    const body = document.body;

    if (!openBtn || !closeBtn || !menuBox) return;

    function openMenu() {
        menuBox.classList.add('is-open');
        body.classList.add('menu-open');
        body.style.overflow = 'hidden';
    }

    function closeMenu() {
        menuBox.classList.remove('is-open');
        body.classList.remove('menu-open');
        body.style.overflow = '';
    }

    openBtn.addEventListener('click', openMenu);
    closeBtn.addEventListener('click', closeMenu);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && menuBox.classList.contains('is-open')) {
            closeMenu();
        }
    });

    menuBox.querySelectorAll('.main-nav a').forEach(link => {
        link.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown-toggle')) {
                closeMenu();
            }
        });
    });
})();

document.addEventListener("DOMContentLoaded", () => {
    const dropdownLinks = document.querySelectorAll(".has-dropdown > .menu-item");
    dropdownLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const parentLi = link.closest(".has-dropdown");
            parentLi.classList.toggle("open");
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const subSubLinks = document.querySelectorAll(".has-sub-submenu > .sub-submenu-toggle");
    subSubLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            const parentLi = link.closest(".has-sub-submenu");
            parentLi.classList.toggle("open");
        });
    });
});

document.addEventListener("DOMContentLoaded", () => {
    const selectAll = document.getElementById("selectAll");
    if (selectAll) {
        const checkboxes = document.querySelectorAll(".shareholder-checkbox");
        selectAll.addEventListener("change", () => {
            checkboxes.forEach(cb => { cb.checked = selectAll.checked; });
        });
        checkboxes.forEach(cb => {
            cb.addEventListener("change", () => {
                if (!cb.checked) {
                    selectAll.checked = false;
                } else if (document.querySelectorAll(".shareholder-checkbox:checked").length === checkboxes.length) {
                    selectAll.checked = true;
                }
            });
        });
    }
});
