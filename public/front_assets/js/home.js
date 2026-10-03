(function() {
    document.addEventListener('DOMContentLoaded', () => {
        const openMenuBtn = document.getElementById('open-menu-btn');
        const closeMenuBtn = document.getElementById('close-menu-btn');
        const menuBox = document.getElementById('menu-box');
        const body = document.body;

        if (!openMenuBtn || !closeMenuBtn || !menuBox) return;

        let scrollPosition = 0;

        const openMenu = () => {
            scrollPosition = window.pageYOffset;
            body.classList.add('menu-open');
            body.style.overflow = 'hidden';
            menuBox.classList.add('is-open');
            menuBox.scrollTop = 0;
        };

        const closeMenu = () => {
            menuBox.classList.remove('is-open');
            body.classList.remove('menu-open');
            body.style.overflow = '';
            window.scrollTo(0, scrollPosition);
        };

        openMenuBtn.addEventListener('click', openMenu);
        closeMenuBtn.addEventListener('click', closeMenu);

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && menuBox.classList.contains('is-open')) {
                closeMenu();
            }
        });

        const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
        dropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.closest('.dropdown');
                const isActive = dropdown.classList.contains('active');
                document.querySelectorAll('.dropdown').forEach(d => d.classList.remove('active'));
                if (!isActive) dropdown.classList.add('active');
            });
        });

        const menuLinks = menuBox.querySelectorAll('.main-nav a');
        menuLinks.forEach(link => {
            link.addEventListener('click', (e) => {
                if (!e.target.closest('.dropdown-toggle')) closeMenu();
            });
        });
    });
})();

window.addEventListener('pageshow', function(event) {
    if (event.persisted) {
        document.body.style.overflow = '';
        document.documentElement.style.overflow = '';
        document.body.classList.remove('menu-open');
        const menuBox = document.getElementById('menu-box');
        if (menuBox) menuBox.classList.remove('is-open');
    }
});

(function() {
    const scrollTopBtn = document.getElementById("scrollTopBtn");
    if (scrollTopBtn) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 400) scrollTopBtn.classList.add("show");
            else scrollTopBtn.classList.remove("show");
        });
        scrollTopBtn.addEventListener("click", () => {
            window.scrollTo({ top: 0, behavior: "smooth" });
        });
    }
})();

document.addEventListener('DOMContentLoaded', function() {

    if (typeof Swiper !== 'undefined' && document.querySelector(".heroSwiper")) {
        new Swiper(".heroSwiper", {
            loop: true,
            speed: 1500,
            parallax: true,
            effect: 'fade',
            fadeEffect: { crossFade: true },
            autoplay: { delay: 5000, disableOnInteraction: false },
            pagination: { el: ".swiper-pagination-custom", type: "progressbar" },
            navigation: { nextEl: ".swiper-button-next", prevEl: ".swiper-button-prev" },
        });
    }

    if (typeof Swiper !== 'undefined' && document.querySelector('.exploreVideo')) {
        window.mySwiper = new Swiper('.exploreVideo', {
            direction: 'horizontal',
            loop: true,
            navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
            autoplay: { delay: 13000, disableOnInteraction: false },
            breakpoints: {
                0: { slidesPerView: 1 },
                1439: { slidesPerView: 1 },
                1440: { slidesPerView: 3, spaceBetween: 60 }
            },
            on: {
                init: function() { playVideos(this); highlightMiddle(this); },
                slideChangeTransitionStart: function() { pauseAllVideos(this); },
                slideChangeTransitionEnd: function() { playVideos(this); highlightMiddle(this); },
                resize: function() { playVideos(this); highlightMiddle(this); },
                breakpoint: function() { playVideos(this); highlightMiddle(this); }
            }
        });
    }
});

window.highlightMiddle = function(swiper) {
    swiper.slides.forEach(slide => slide.classList.remove('is-middle'));
    const middleIndex = swiper.activeIndex + Math.floor(swiper.params.slidesPerView / 2);
    const middleSlide = swiper.slides[middleIndex];
    if (middleSlide) middleSlide.classList.add('is-middle');
};

window.pauseAllVideos = function(swiper) {
    swiper.slides.forEach(slide => {
        const v = slide.querySelector('video');
        if (v) v.pause();
    });
};

window.playVideos = function(swiper) {
    pauseAllVideos(swiper);
    if (swiper.params.slidesPerView >= 3) {
        const startIndex = swiper.activeIndex;
        const slidesPerView = swiper.params.slidesPerView;
        for (let i = startIndex; i < startIndex + slidesPerView; i++) {
            const slide = swiper.slides[i];
            if (slide) {
                const v = slide.querySelector('video');
                if (v) { v.muted = true; v.playsInline = true; v.play().catch(() => {}); }
            }
        }
    } else {
        const activeSlide = swiper.slides[swiper.activeIndex];
        if (activeSlide) {
            const v = activeSlide.querySelector('video');
            if (v) { v.muted = true; v.playsInline = true; v.play().catch(() => {}); }
        }
    }
};

document.addEventListener('visibilitychange', () => {
    if (window.mySwiper) {
        if (document.hidden) pauseAllVideos(window.mySwiper);
        else playVideos(window.mySwiper);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const videoSelectors = document.querySelectorAll('.video-selector');
    const mainWrapper = document.getElementById('mainVideoWrapper');
    const mainTitle = document.getElementById('mainVideoTitle');
    if (!mainWrapper || !mainTitle) return;

    videoSelectors.forEach(item => {
        item.addEventListener('click', function() {
            const url = this.getAttribute('data-url');
            const title = this.getAttribute('data-title');
            const type = this.getAttribute('data-type');
            videoSelectors.forEach(v => v.classList.remove('active-video'));
            this.classList.add('active-video');
            if (type == "3") {
                mainWrapper.innerHTML = `<video id="videoPlayer" src="${url}" controls autoplay></video>`;
            } else {
                const autoplayUrl = url.includes('?') ? `${url}&autoplay=1` : `${url}?autoplay=1`;
                mainWrapper.innerHTML = `<iframe id="videoPlayer" src="${autoplayUrl}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
            }
            mainTitle.innerText = title;
            mainWrapper.scrollIntoView({ behavior: 'smooth', block: 'center' });
        });
    });
});

window.addEventListener('load', function () {
    if (typeof Swiper === 'undefined') return;
    let swiperVideo = null, swiperBg = null;

    if (document.querySelector('.swiper-container-video')) {
        swiperVideo = new Swiper('.swiper-container-video', {
            loop: true,
            autoplay: { delay: 3000, disableOnInteraction: false },
            speed: 2000,
            effect: 'slide',
            direction: 'horizontal',
            on: {
                init: function() {
                    const initialSlide = this.slides[this.activeIndex];
                    const initialVideo = initialSlide.querySelector('video');
                    if (initialVideo) initialVideo.play().catch(() => {});
                },
                slideChangeTransitionEnd: function() {
                    document.querySelectorAll('.video-slide video').forEach(video => {
                        video.pause();
                        video.currentTime = 0;
                    });
                    const activeSlide = this.slides[this.activeIndex];
                    const activeVideo = activeSlide.querySelector('video');
                    if (activeVideo) activeVideo.play().catch(() => {});
                }
            }
        });
    }

    if (document.querySelector('.swiper-container-bg')) {
        swiperBg = new Swiper('.swiper-container-bg', {
            loop: true,
            autoplay: { delay: 3000, disableOnInteraction: false },
            speed: 2000,
            effect: 'slide',
            direction: 'vertical',
            pagination: { el: '.custom-pagination', clickable: true, renderBullet: (i, cn) => `<span class="${cn}"></span>` },
            a11y: { scrollOnFocus: false },
            on: {
                init: function() { updateTextContentWithFade(this.realIndex); },
                slideChange: function() {
                    if (swiperVideo) swiperVideo.slideToLoop(this.realIndex);
                    updateTextContentWithFade(this.realIndex);
                }
            }
        });
    }

    const prevBtn = document.getElementById('prev-btn');
    const nextBtn = document.getElementById('next-btn');
    if (prevBtn && swiperBg) {
        prevBtn.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopImmediatePropagation();
            swiperBg.slidePrev();
            if (document.activeElement) document.activeElement.blur();
        });
    }
    if (nextBtn && swiperBg) {
        nextBtn.addEventListener('click', (event) => {
            event.preventDefault();
            event.stopImmediatePropagation();
            swiperBg.slideNext();
            if (document.activeElement) document.activeElement.blur();
        });
    }
});

const projectData = [
    { title: "Together, let's build a brighter tomorrow for our children" },
    { title: "Slider 2" },
    { title: "Slider 3" },
];
const textContentEl = document.getElementById('text-content');
const titleText = document.getElementById('title-text');
const CONTENT_SWAP_DELAY = 500;

function updateTextContentWithFade(index) {
    if (!textContentEl || !titleText) return;
    const data = projectData[index];
    textContentEl.classList.add('content-fading-out');
    setTimeout(() => {
        titleText.textContent = data.title;
        textContentEl.classList.remove('content-fading-out');
    }, CONTENT_SWAP_DELAY);
}

document.addEventListener('DOMContentLoaded', function () {
    const image = document.querySelector('.lets-connect-image img');
    const section = document.querySelector('.lets-connerct-area');
    if (image && section) {

        if (window.matchMedia('(max-width: 991px)').matches) {
            image.classList.remove('image-contracted');
            image.classList.add('image-expanded');
            return;
        }
        image.classList.add('image-contracted');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    image.classList.remove('image-contracted');
                    image.classList.add('image-expanded');
                } else {
                    image.classList.remove('image-expanded');
                    image.classList.add('image-contracted');
                }
            });
        }, { threshold: 0 });
        observer.observe(section);
    }
});

window.initializeCustomSelect = function(baseId) {
    const wrapper = document.getElementById(baseId + 'SelectWrapper');
    const header = document.getElementById(baseId + 'SelectHeader');
    const dropdown = document.getElementById(baseId + 'SelectDropdown');
    const selectedValueSpan = document.getElementById(baseId + 'SelectedValue');
    const iconSpan = document.getElementById(baseId + 'SelectIcon');
    if (!wrapper || !header || !dropdown) return;
    const options = dropdown.querySelectorAll('.option');
    let isDropdownOpen = false;
    function closeAllOtherDropdowns() {
        document.querySelectorAll('.select-dropdown.open').forEach(d => {
            const siblingHeader = d.previousElementSibling;
            const siblingIcon = siblingHeader?.querySelector('.icon');
            if (d !== dropdown) {
                d.classList.remove('open');
                siblingHeader?.classList.remove('active');
                if (siblingIcon) siblingIcon.textContent = '+';
            }
        });
    }
    function toggleDropdown(forceClose = false) {
        if (forceClose) isDropdownOpen = false;
        else isDropdownOpen = !isDropdownOpen;
        if (isDropdownOpen) {
            closeAllOtherDropdowns();
            dropdown.classList.add('open');
            if (iconSpan) iconSpan.textContent = 'x';
            header.classList.add('active');
        } else {
            dropdown.classList.remove('open');
            if (iconSpan) iconSpan.textContent = '+';
            header.classList.remove('active');
        }
    }
    header.addEventListener('click', (event) => { event.stopPropagation(); toggleDropdown(); });
    options.forEach(option => {
        option.addEventListener('click', (event) => {
            const newValue = event.target.getAttribute('data-value');
            if (selectedValueSpan) {
                selectedValueSpan.textContent = newValue;
                selectedValueSpan.removeAttribute('data-placeholder');
            }
            options.forEach(opt => opt.classList.remove('selected'));
            event.target.classList.add('selected');
            toggleDropdown(true);
        });
    });
    document.addEventListener('click', (event) => {
        if (isDropdownOpen && !wrapper.contains(event.target)) toggleDropdown(true);
    });
    const initialSelectedOption = dropdown.querySelector('.option.selected');
    if (initialSelectedOption && selectedValueSpan) {
        selectedValueSpan.textContent = initialSelectedOption.getAttribute('data-value');
        selectedValueSpan.removeAttribute('data-placeholder');
    }
};

window.openCity = function(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) tabcontent[i].style.display = "none";
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) tablinks[i].className = tablinks[i].className.replace(" active", "");
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
};
if (document.getElementById("dhaka")) document.getElementById("dhaka").style.display = "block";
