// carousel for video all
// class Carousel {
//     constructor(carouselId, prevBtnId, nextBtnId, indicatorClass) {
//         this.carousel = document.getElementById(carouselId);
//         this.items = this.carousel.querySelectorAll('.carousel-item');
//         this.prevBtn = document.getElementById(prevBtnId);
//         this.nextBtn = document.getElementById(nextBtnId);
//         this.indicators = document.querySelectorAll(`.${indicatorClass}`);
//         this.currentIndex = 0;
//         this.itemsPerView = 1;
//         this.intervalId = null;

//         this.init();
//     }

//     updateItemsPerView() {
//         if (window.innerWidth >= 992) {
//             this.itemsPerView = 4; // Show 4 items
//         } else if (window.innerWidth >= 641) {
//             this.itemsPerView = 2; // Show 2 items
//         } else {
//             this.itemsPerView = 1; // Show 1 item
//         }
//     }

//     updateCarousel() {
//         if (!this.items.length) return;
//         const itemWidth = 100 / this.itemsPerView;
//         this.carousel.style.transform = `translateX(-${this.currentIndex * itemWidth}%)`;
//         this.indicators.forEach((indicator, index) => {
//             indicator.classList.toggle('bg-blue-600', index === this.currentIndex);
//             indicator.classList.toggle('bg-gray-400', index !== this.currentIndex);
//         });
//     }

//     goToSlide(index) {
//         const maxIndex = Math.ceil(this.items.length - this.itemsPerView);
//         this.currentIndex = Math.max(0, Math.min(index, maxIndex));
//         this.updateCarousel();
//         this.stopAutoSlide();
//     }

//     stopAutoSlide() {
//         if (this.intervalId) {
//             clearInterval(this.intervalId);
//             this.intervalId = null;
//         }
//     }

//     init() {
//         if (!this.items.length) return;

//         this.updateItemsPerView();
//         this.updateCarousel();

//         this.prevBtn.addEventListener('click', () => {
//             this.goToSlide(this.currentIndex - 1);
//         });

//         this.nextBtn.addEventListener('click', () => {
//             this.goToSlide(this.currentIndex + 1);
//         });

//         this.indicators.forEach((indicator) => {
//             indicator.addEventListener('click', () => {
//                 this.goToSlide(parseInt(indicator.dataset.index));
//             });
//         });

//         window.addEventListener('resize', () => {
//             this.updateItemsPerView();
//             this.goToSlide(this.currentIndex);
//         });
//     }
// }

// // Initialize both carousels
// const carousel1 = new Carousel('carousel1', 'prevBtn1', 'nextBtn1', 'indicator1');
// const carousel2 = new Carousel('carousel2', 'prevBtn2', 'nextBtn2', 'indicator2');
// const carousel3 = new Carousel('carousel3', 'prevBtn3', 'nextBtn3', 'indicator3');
// const carousel4 = new Carousel('carousel4', 'prevBtn4', 'nextBtn4', 'indicator4');


//end carousel for video all

document.querySelectorAll('.dropdown-toggle').forEach(toggle => {
    const dropdown = toggle.parentElement.querySelector('.dropdown-menu');

    toggle.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (!toggle.contains(e.target) && !dropdown.contains(e.target)) {
            dropdown.classList.add('hidden');
        }
    });
});
// const navItems = document.querySelectorAll(".nav-item");
// function closeAllDropdowns(except = null) {
//     navItems.forEach(item => {
//         if (item !== except) {
//             const dropdown = item.querySelector(".dropdown-menu");
//             dropdown.classList.remove("opacity-100", "visible", "translate-y-0");
//             dropdown.classList.add("opacity-0", "invisible", "translate-y-4");
//         }
//     });
// }
// navItems.forEach(item => {
//     const dropdown = item.querySelector(".dropdown-menu");
//     const link = item.querySelector("a");

//     link.addEventListener("click", (e) => {
//         e.preventDefault();
//         const isOpen = dropdown.classList.contains("opacity-100");

//         // Toggle current dropdown
//         if (isOpen) {
//             dropdown.classList.add("opacity-0", "invisible", "translate-y-4");
//             dropdown.classList.remove("opacity-100", "visible", "translate-y-0");
//         } else {
//             closeAllDropdowns(item);
//             dropdown.classList.remove("opacity-0", "invisible", "translate-y-4");
//             dropdown.classList.add("opacity-100", "visible", "translate-y-0");
//         }
//     });
// });

// // Close dropdowns when clicking outside
// document.addEventListener("click", (e) => {
//     if (!e.target.closest(".nav-item")) {
//         closeAllDropdowns();
//     }
// });
const navItems = document.querySelectorAll(".nav-item");

function closeAllDropdowns(except = null) {
    navItems.forEach(item => {
        if (item !== except) {
            const dropdown = item.querySelector(".dropdown-menu");
            dropdown.classList.remove("opacity-100", "visible", "translate-y-0");
            dropdown.classList.add("opacity-0", "invisible", "translate-y-4");
        }
    });
}

navItems.forEach(item => {
    const dropdown = item.querySelector(".dropdown-menu");

    item.addEventListener('mouseenter', () => {
        closeAllDropdowns(item);
        dropdown.classList.remove("opacity-0", "invisible", "translate-y-4");
        dropdown.classList.add("opacity-100", "visible", "translate-y-0");
    });

    item.addEventListener('mouseleave', () => {
        dropdown.classList.add("opacity-0", "invisible", "translate-y-4");
        dropdown.classList.remove("opacity-100", "visible", "translate-y-0");
    });
});


document.addEventListener('DOMContentLoaded', () => {
    const slides = document.querySelector('.carousel-slides');
    const dots = document.querySelectorAll('.carousel-dot');
    const prevButton = document.querySelector('.carousel-prev');
    const nextButton = document.querySelector('.carousel-next');

    let currentIndex = 0;
    let autoSlideInterval;

    function updateSlide(position) {
        slides.style.transform = `translateX(-${position * 100}%)`;
        dots.forEach(dot => dot.classList.remove('bg-white'));
        dots[currentIndex].classList.add('bg-white');
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % dots.length;
        updateSlide(currentIndex);
    }

    function prevSlide() {
        currentIndex = (currentIndex - 1 + dots.length) % dots.length;
        updateSlide(currentIndex);
    }

    function startAutoSlide() {
        autoSlideInterval = setInterval(nextSlide, 6000);
    }
    nextButton.addEventListener('click', () => {
        nextSlide();
        resetAutoSlide();
    });

    prevButton.addEventListener('click', () => {
        prevSlide();
        resetAutoSlide();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentIndex = index;
            updateSlide(currentIndex);
            resetAutoSlide();
        });
    });

    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    dots[0].classList.add('bg-white');
    startAutoSlide();
});



//change data video by school one to school one

document.addEventListener('DOMContentLoaded', function() {
    const tab1 = document.getElementById('html');
    const tab2 = document.getElementById('css');
    const content1 = document.querySelectorAll('.old-video1');
    const content2 = document.querySelectorAll('.old-video2');
    tab1.addEventListener('change', function() {
        if (this.checked) {
            content1.forEach(el => el.classList.remove('hidden'));
            content2.forEach(el => el.classList.add('hidden'));
        }
    });
    tab2.addEventListener('change', function() {
        if (this.checked) {
            content1.forEach(el => el.classList.add('hidden'));
            content2.forEach(el => el.classList.remove('hidden'));
        }
    });
});
//end change data video by school one to school one

// active class and subject
















// document.addEventListener('DOMContentLoaded', function() {
//     const activeClass = document.getElementById("active-class");
//     const iconClass = document.querySelectorAll(".icon-class");

//     activeClass.addEventListener('click', function() {
//         iconClass.forEach(item => item.classList.toggle('rotate-180'));
//     });
// });


// //end active class and subject
// document.addEventListener('DOMContentLoaded', function() {
//     // Open Offcanvas
//     document.querySelectorAll('.menubar-icon').forEach(icon => {
//         icon.addEventListener('click', function() {
//             document.getElementById('offcanvas').classList.remove('-translate-x-full');
//             document.querySelector('.backdrop').classList.remove('hidden');
//         });
//     });

//     // Close Offcanvas
//     document.querySelectorAll('.close-offcanvas').forEach(btn => {
//         btn.addEventListener('click', function() {
//             document.getElementById('offcanvas').classList.add('-translate-x-full');
//             document.querySelector('.backdrop').classList.add('hidden');
//         });
//     });

//     // Close when clicking backdrop
//     document.querySelector('.backdrop').addEventListener('click', function() {
//         document.getElementById('offcanvas').classList.add('-translate-x-full');
//         this.classList.add('hidden');
//     });

//     // Dropdown toggle for mobile menu
//     document.querySelectorAll('.offcanvas-dropdown-toggle').forEach(item => {
//         item.addEventListener('click', (e) => {
//             e.preventDefault();
//             const submenu = item.nextElementSibling;
//             const icon = item.querySelector('svg');
//             submenu.classList.toggle('hidden');
//             icon.classList.toggle('rotate-180');
//         });
//     });
// });



















// carousel home page
//  document.addEventListener('DOMContentLoaded', () => {
//     // Main Carousel
//     const slidesData = [
//         { image: 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e' },
//         { image: 'https://images.unsplash.com/photo-1519681393784-d120267933ba' },
//         { image: 'https://images.unsplash.com/photo-1472214103451-9374bd1c798e' },
//         { image: 'https://images.unsplash.com/photo-1440684362195-4d31e3e6d60b' },
//         { image: 'https://images.unsplash.com/photo-1505765050516-f72dcac1c60e' }
//     ];

//     let currentSlide = 0;
//     const carousel = document.getElementById('carousel');
//     const dotsContainer = document.getElementById('dots');
//     let autoSlideInterval;

//     function createSlides() {
//         slidesData.forEach((slide, index) => {
//             const slideElement = document.createElement('div');
//             slideElement.className = 'carousel-slide';
//             slideElement.innerHTML = `
//                 <img src="${slide.image}" alt="Slide ${index + 1}">
//                 <div class="overlay"></div>
//             `;
//             carousel.appendChild(slideElement);

//             const dot = document.createElement('span');
//             dot.className = 'dot';
//             dot.addEventListener('click', () => goToSlide(index));
//             dotsContainer.appendChild(dot);
//         });
//         updateCarousel();
//         startAutoSlide();
//     }

//     function updateDots() {
//         const dots = document.querySelectorAll('.dot');
//         const slides = document.querySelectorAll('.carousel-slide');
//         dots.forEach((dot, index) => {
//             dot.classList.toggle('active', index === currentSlide);
//         });
//         slides.forEach((slide, index) => {
//             slide.classList.toggle('active', index === currentSlide);
//         });
//     }

//     function moveSlide(direction) {
//         currentSlide += direction;
//         if (currentSlide >= slidesData.length) {
//             currentSlide = 0;
//         } else if (currentSlide < 0) {
//             currentSlide = slidesData.length - 1;
//         }
//         updateCarousel();
//     }

//     function goToSlide(index) {
//         currentSlide = index;
//         updateCarousel();
//     }

//     function updateCarousel() {
//         carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
//         updateDots();
//         resetAutoSlide();
//     }

//     function startAutoSlide() {
//         autoSlideInterval = setInterval(() => {
//             moveSlide(1);
//         }, 8000);
//     }

//     function resetAutoSlide() {
//         clearInterval(autoSlideInterval);
//         startAutoSlide();
//     }

//     createSlides();

//     document.querySelector('.carousel-button.prev').addEventListener('click', () => moveSlide(-1));
//     document.querySelector('.carousel-button.next').addEventListener('click', () => moveSlide(1));

//     // School Product Carousel
//     const carouselSchool = document.getElementById('carousel-school');
//     const prevButtonSchool = document.getElementById('prev-school');
//     const nextButtonSchool = document.getElementById('next-school');
//     const productCards = carouselSchool.querySelectorAll('.product-card-school');
//     const cardWidthSchool = productCards[0].offsetWidth; // Width of a single card
//     const cardMargin = parseInt(window.getComputedStyle(productCards[0]).marginRight); // Margin between cards
//     const totalCardWidth = cardWidthSchool + cardMargin; // Total width of a card including margin
//     let currentPositionSchool = 0;

//     function updateCarouselSchool() {
//         carouselSchool.style.transform = `translateX(-${currentPositionSchool}px)`;
//         prevButtonSchool.disabled = currentPositionSchool <= 0;
//         nextButtonSchool.disabled = currentPositionSchool >= (productCards.length * totalCardWidth - carouselSchool.clientWidth);
//     }

//     function scrollSchool(direction) {
//         currentPositionSchool += direction * totalCardWidth;
//         if (currentPositionSchool < 0) {
//             currentPositionSchool = 0;
//         } else if (currentPositionSchool > (productCards.length * totalCardWidth - carouselSchool.clientWidth)) {
//             currentPositionSchool = productCards.length * totalCardWidth - carouselSchool.clientWidth;
//         }
//         updateCarouselSchool();
//     }

//     prevButtonSchool.addEventListener('click', () => scrollSchool(-1));
//     nextButtonSchool.addEventListener('click', () => scrollSchool(1));

//     // Touch swipe handling for school carousel
//     let touchStartX = 0;
//     carouselSchool.addEventListener('touchstart', (e) => {
//         touchStartX = e.touches[0].clientX;
//     });

//     carouselSchool.addEventListener('touchend', (e) => {
//         const touchEndX = e.changedTouches[0].clientX;
//         const diff = touchStartX - touchEndX;
//         if (Math.abs(diff) > 50) {
//             scrollSchool(diff > 0 ? 1 : -1);
//         }
//     });

//     updateCarouselSchool();
// });

// //end carousel home page


document.addEventListener('DOMContentLoaded', () => {
    let currentSlide = 0;
    const carousel = document.getElementById('carousel');
    const dotsContainer = document.getElementById('dots');
    const slides = document.querySelectorAll('.carousel-slide');
    let autoSlideInterval;

    // Create dots dynamically based on the number of slides
    function createDots() {
        slides.forEach((_, index) => {
            const dot = document.createElement('span');
            dot.className = 'dot';
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });
        updateDots();
    }

    // Update active slide and dots
    function updateDots() {
        const dots = document.querySelectorAll('.dot');
        dots.forEach((dot, index) => {
            dot.classList.toggle('active', index === currentSlide);
        });
        slides.forEach((slide, index) => {
            slide.classList.toggle('active', index === currentSlide);
        });
    }

    // Move to the next or previous slide
    function moveSlide(direction) {
        currentSlide += direction;
        if (currentSlide >= slides.length) {
            currentSlide = 0;
        } else if (currentSlide < 0) {
            currentSlide = slides.length - 1;
        }
        updateCarousel();
    }

    // Go to a specific slide
    function goToSlide(index) {
        currentSlide = index;
        updateCarousel();
    }

    // Update carousel position and reset autoplay
    function updateCarousel() {
        carousel.style.transform = `translateX(-${currentSlide * 100}%)`;
        updateDots();
        resetAutoSlide();
    }

    // Start autoplay
    function startAutoSlide() {
        autoSlideInterval = setInterval(() => {
            moveSlide(1);
        }, 8000); // 8 seconds
    }

    // Reset autoplay when user interacts
    function resetAutoSlide() {
        clearInterval(autoSlideInterval);
        startAutoSlide();
    }

    // Initialize the carousel
    createDots();
    startAutoSlide();

    // Add event listeners for navigation buttons
    document.querySelector('.carousel-button.prev').addEventListener('click', () => moveSlide(-1));
    document.querySelector('.carousel-button.next').addEventListener('click', () => moveSlide(1));
});
























document.addEventListener('DOMContentLoaded', () => {
    const carousel = document.getElementById('carousel-choose-school');
    const prevButton = document.getElementById('prev-choose-school');
    const nextButton = document.getElementById('next-choose-school');
    const wrapper = document.querySelector('.carousel-wrapper');
    const cards = carousel.querySelectorAll('.product-card-school');
    const cardWidth = cards[0].offsetWidth + 21; // Card width + margin (mr-[21px])
    let currentIndex = 0;

    // Calculate how many cards are visible in the wrapper
    const getVisibleCards = () => {
        const wrapperWidth = wrapper.offsetWidth;
        return Math.floor(wrapperWidth / cardWidth);
    };

    // Function to update carousel position and button states
    function updateCarousel() {
        const maxIndex = Math.max(0, cards.length - getVisibleCards());
        // Ensure currentIndex stays within bounds
        currentIndex = Math.min(Math.max(currentIndex, 0), maxIndex);
        carousel.style.transform = `translateX(-${currentIndex * cardWidth}px)`;
        // Update button states
        prevButton.disabled = currentIndex === 0;
        nextButton.disabled = currentIndex >= maxIndex;
    }

    // Next button click
    nextButton.addEventListener('click', () => {
        const maxIndex = Math.max(0, cards.length - getVisibleCards());
        if (currentIndex < maxIndex) {
            currentIndex++;
            carousel.style.transition = 'transform 0.3s ease-in-out';
            updateCarousel();
        }
    });

    // Previous button click
    prevButton.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            carousel.style.transition = 'transform 0.3s ease-in-out';
            updateCarousel();
        }
    });

    // Handle window resize to recalculate card width and visible cards
    window.addEventListener('resize', () => {
        const newCardWidth = cards[0].offsetWidth + 21;
        cardWidth = newCardWidth;
        updateCarousel();
    });

    // Initialize carousel
    updateCarousel();

});



function showPassword() {
    const textPassword = document.getElementById('txtPassword');
    const iconShowPasswordjs = document.getElementById('iconShowPassword');
    const iconHiddenPasswordjs = document.getElementById('iconHiddenPassword');

    if (textPassword.type === "password") {
        textPassword.type = "text";
        iconShowPasswordjs.classList.remove('hidden');
        iconHiddenPasswordjs.classList.add('hidden');

    } else {
        textPassword.type = "password";
        iconShowPasswordjs.classList.add('hidden');
        iconHiddenPasswordjs.classList.remove('hidden');
    }
}


function showPasswordConfirm() {
    const textPasswordConfirm = document.getElementById('txtPasswordConfirm');
    const iconShowPasswordjsConfirm = document.getElementById('iconShowPasswordConfirm');
    const iconHiddenPasswordjsConfirm = document.getElementById('iconHiddenPasswordConfirm');

    if (textPasswordConfirm.type === "password") {
        textPasswordConfirm.type = "text";
        iconShowPasswordjsConfirm.classList.remove('hidden');
        iconHiddenPasswordjsConfirm.classList.add('hidden');

    } else {
        textPasswordConfirm.type = "password";
        iconShowPasswordjsConfirm.classList.add('hidden');
        iconHiddenPasswordjsConfirm.classList.remove('hidden');
    }
}
















// javascript for action siderbar on dashboard

// const activeNavbar = document.getElementById("btnActiveNavbar");
// const dashboardSiderbar = document.getElementById("dashboard-siderbar");

// activeNavbar.addEventListener('click',function(){
//     // alert("fsdfd");
//   dashboardSiderbar.classList.remove('hidden');
//   dashboardSiderbar.classList.remove('sticky'); // Corrected this line
//   dashboardSiderbar.classList.remove('h-screen');
//   dashboardSiderbar.classList.add('w-64');
//   dashboardSiderbar.classList.add('bg-white');


// })

const dashboardSiderbar = document.getElementById("dashboard-siderbar");
  document.getElementById('btnActiveNavbar').addEventListener('click', function () {

        dashboardSiderbar.classList.toggle('-translate-x-full');
        dashboardSiderbar.classList.toggle('translate-x-0');
});
  document.getElementById('btnCloseNavbar').addEventListener('click', function () {

        dashboardSiderbar.classList.toggle('translate-x-0');
        dashboardSiderbar.classList.toggle('-translate-x-full');
});
  window.addEventListener('resize', () => {
        if (window.innerWidth >= 1024) {
            // Ensure sidebar is hidden on larger screens
            if (dashboardSiderbar.classList.contains('translate-x-0')) {
                dashboardSiderbar.classList.remove('translate-x-0');
                dashboardSiderbar.classList.add('-translate-x-full');
            }
        }
    });

