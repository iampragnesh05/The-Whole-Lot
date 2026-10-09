document.addEventListener("DOMContentLoaded", () => {
  // 1. Navigation Active State Handling
  const path = (location.pathname.split("/").pop() || "index.php").toLowerCase();
  document.querySelectorAll(".nav a").forEach(a => {
    const href = (a.getAttribute("href") || "").toLowerCase();
    const cleanPath = path.replace(".php", "").replace(".html", "") || "index";
    const cleanHref = href.replace(".php", "").replace(".html", "") || "index";
    if (href === path || cleanPath === cleanHref || (path === "" && cleanHref === "index")) {
      a.classList.add("active");
      a.setAttribute("aria-current", "page");
    }
  });

  // 2. Header Scroll Shadow & Blur Effect
  const header = document.querySelector(".header");
  if (header) {
    const checkHeader = () => {
      if (window.scrollY > 20) {
        header.classList.add("scrolled");
      } else {
        header.classList.remove("scrolled");
      }
    };
    window.addEventListener("scroll", checkHeader, { passive: true });
    checkHeader();
  }

  // Mobile Navigation Drawer Toggle
  const mobileNavToggle = document.getElementById("mobileNavToggle");
  const mobileNavDrawer = document.getElementById("mobileNavDrawer");
  if (mobileNavToggle && mobileNavDrawer) {
    mobileNavToggle.addEventListener("click", () => {
      const isOpen = mobileNavToggle.classList.toggle("is-open");
      mobileNavDrawer.classList.toggle("is-open");
      mobileNavToggle.setAttribute("aria-expanded", isOpen ? "true" : "false");
    });

    mobileNavDrawer.querySelectorAll("a").forEach(link => {
      link.addEventListener("click", () => {
        mobileNavToggle.classList.remove("is-open");
        mobileNavDrawer.classList.remove("is-open");
        mobileNavToggle.setAttribute("aria-expanded", "false");
      });
    });
  }

  // 3. Scroll Reveal Animation via IntersectionObserver
  const revealElements = document.querySelectorAll(
    ".reveal, .reveal-fade, .reveal-scale, .reveal-left, .reveal-right, .stagger-parent, .hero-copy, .section, .ecosystem-card, .service-block, .step, .card, .signal-grid > article, .category-grid > article, .lab-item"
  );

  if ("IntersectionObserver" in window) {
    const revealObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("revealed");
          
          // If the element has a custom delay attribute
          const delay = entry.target.getAttribute("data-delay");
          if (delay) {
            entry.target.style.transitionDelay = `${delay}ms`;
          }
          
          observer.unobserve(entry.target);
        }
      });
    }, {
      root: null,
      threshold: 0.12,
      rootMargin: "0px 0px -40px 0px"
    });

    revealElements.forEach(el => {
      if (!el.classList.contains("reveal") && 
          !el.classList.contains("reveal-fade") && 
          !el.classList.contains("reveal-scale") && 
          !el.classList.contains("reveal-left") && 
          !el.classList.contains("reveal-right") && 
          !el.classList.contains("stagger-parent")) {
        el.classList.add("reveal");
      }
      revealObserver.observe(el);
    });
  } else {
    // Fallback if IntersectionObserver is not supported
    revealElements.forEach(el => el.classList.add("revealed"));
  }

  // 4. Subtle Parallax Effect on Hero Collage Elements
  const heroArt = document.querySelector(".hero-art");
  if (heroArt && window.matchMedia("(prefers-reduced-motion: no-preference)").matches) {
    const photos = heroArt.querySelectorAll(".hero-photo");
    const pinkSheet = heroArt.querySelector(".pink-sheet");
    const tape = heroArt.querySelector(".tape");

    window.addEventListener("scroll", () => {
      const scrollY = window.scrollY;
      if (scrollY < window.innerHeight) {
        if (photos[0]) photos[0].style.transform = `translateY(${scrollY * 0.08}px)`;
        if (photos[1]) photos[1].style.transform = `translateY(${scrollY * -0.06}px)`;
        if (photos[2]) photos[2].style.transform = `translateY(${scrollY * 0.1}px)`;
        if (photos[3]) photos[3].style.transform = `translateY(${scrollY * -0.04}px)`;
        if (pinkSheet) pinkSheet.style.transform = `translateY(${scrollY * 0.05}px) rotate(-2deg)`;
        if (tape) tape.style.transform = `translateY(${scrollY * -0.07}px) rotate(-3deg)`;
      }
    }, { passive: true });
  }

  // 5. Contact Form Auto-Select & Mailto Fallback
  // 5. Contact Form Auto-Select & Mailto Fallback
  const form = document.querySelector("#contact-form");
  if (form) {
    const requestedType = new URLSearchParams(location.search).get("type");
    if (requestedType) {
      const select = form.querySelector('[name="type"]');
      if (select) {
        const match = [...select.options].find(o => o.text.toLowerCase().includes(requestedType.toLowerCase()));
        if (match) select.value = match.value;
      }
    }
    form.addEventListener("submit", e => {
      // Native PHP handler is used on Hostinger server. If opened locally via file:, fall back to email.
      if (location.protocol === "file:") {
        e.preventDefault();
        const data = new FormData(form);
        const subject = encodeURIComponent(`The Whole Lot enquiry — ${data.get("type") || "Website"}`);
        const body = encodeURIComponent(`Name: ${data.get("name") || ""}\nEmail: ${data.get("email") || ""}\nOrganisation: ${data.get("organisation") || ""}\nType: ${data.get("type") || ""}\n\n${data.get("message") || ""}`);
        location.href = `mailto:hello@thewholelotmedia.com?subject=${subject}&body=${body}`;
      }
    });
  }

  // 6. Services Practices ScrollSpy Navigation & Smooth Scrolling
  const practiceSidebar = document.querySelector(".services-practices-sidebar");
  const practiceNavLinks = document.querySelectorAll(".practice-nav-link");
  const practiceBlocks = document.querySelectorAll(".practice-block");

  if (practiceBlocks.length > 0 && practiceNavLinks.length > 0) {
    let isClickScrolling = false;
    let clickScrollTimer = null;

    const updateActivePractice = () => {
      if (isClickScrolling) return;

      const triggerY = window.scrollY + 180;
      let currentActiveId = "";

      practiceBlocks.forEach(block => {
        const top = block.offsetTop;
        const height = block.offsetHeight;
        if (triggerY >= top && triggerY < top + height) {
          currentActiveId = block.id;
        }
      });

      if (!currentActiveId) {
        if (window.scrollY + window.innerHeight >= document.documentElement.scrollHeight - 100) {
          const last = practiceBlocks[practiceBlocks.length - 1];
          currentActiveId = last ? last.id : "";
        } else if (practiceBlocks[0] && triggerY >= practiceBlocks[0].offsetTop) {
          const last = practiceBlocks[practiceBlocks.length - 1];
          if (triggerY >= last.offsetTop) {
            currentActiveId = last.id;
          }
        }
      }

      if (currentActiveId) {
        practiceNavLinks.forEach(link => {
          const href = link.getAttribute("href");
          if (href === `#${currentActiveId}`) {
            link.classList.add("active");
            if (window.innerWidth <= 980) {
              link.scrollIntoView({ behavior: "smooth", block: "nearest", inline: "center" });
            }
          } else {
            link.classList.remove("active");
          }
        });
      }
    };

    window.addEventListener("scroll", updateActivePractice, { passive: true });
    updateActivePractice();

    practiceNavLinks.forEach(link => {
      link.addEventListener("click", (e) => {
        const href = link.getAttribute("href");
        if (href && href.startsWith("#")) {
          const targetEl = document.querySelector(href);
          if (targetEl) {
            e.preventDefault();
            isClickScrolling = true;
            clearTimeout(clickScrollTimer);

            practiceNavLinks.forEach(l => l.classList.remove("active"));
            link.classList.add("active");

            const offset = window.innerWidth <= 980 ? 120 : 100;
            const targetPos = targetEl.getBoundingClientRect().top + window.pageYOffset - offset;

            window.scrollTo({
              top: targetPos,
              behavior: "smooth"
            });

            // Update URL hash without jumping
            if (history.pushState) {
              history.pushState(null, null, href);
            }

            clickScrollTimer = setTimeout(() => {
              isClickScrolling = false;
              updateActivePractice();
            }, 800);
          }
        }
      });
    });
  }
});

