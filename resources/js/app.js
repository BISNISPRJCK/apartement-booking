// Toggle FAQ
window.toggleFaq = function (id) {
    const answer = document.getElementById("faq-answer-" + id);
    const icon = document.getElementById("faq-icon-" + id);

    if (answer.style.display === "none" || !answer.style.display) {
        answer.style.display = "block";
        icon.classList.add("active");
    } else {
        answer.style.display = "none";
        icon.classList.remove("active");
    }
};

// Auto-hide alerts
document.addEventListener("DOMContentLoaded", function () {
    // Auto-hide success alerts
    const alerts = document.querySelectorAll(".alert");
    alerts.forEach((alert) => {
        setTimeout(() => {
            alert.style.opacity = "0";
            setTimeout(() => {
                alert.style.display = "none";
            }, 300);
        }, 5000);
    });

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // Navbar active state
    const currentPath = window.location.pathname;
    const navLinks = document.querySelectorAll(".nav-menu li a");

    navLinks.forEach((link) => {
        if (link.getAttribute("href") === currentPath) {
            link.parentElement.classList.add("active");
        }
    });
});

// Search form submission
document.querySelector(".search-box")?.addEventListener("submit", function (e) {
    e.preventDefault();
    const searchInput = this.querySelector(".search-input");
    if (searchInput.value.trim()) {
        window.location.href = `/property?search=${encodeURIComponent(searchInput.value.trim())}`;
    }
});

// Property card hover effect
document.querySelectorAll(".package-card").forEach((card) => {
    card.addEventListener("mouseenter", function () {
        this.style.transform = "translateY(-5px)";
    });

    card.addEventListener("mouseleave", function () {
        this.style.transform = "translateY(0)";
    });
});

// Lazy loading images
if ("IntersectionObserver" in window) {
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove("lazy");
                imageObserver.unobserve(img);
            }
        });
    });

    document.querySelectorAll("img[data-src]").forEach((img) => {
        imageObserver.observe(img);
    });
}
