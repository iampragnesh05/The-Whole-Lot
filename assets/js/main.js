/**
 * The Whole Lot — Motion & Interaction System
 * Pure Vanilla JavaScript
 */

(function () {
  'use strict';

  // Mark JS as active
  document.documentElement.classList.add('js');

  const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  document.addEventListener('DOMContentLoaded', () => {
    initHeader();
    initMobileMenu();
    initHomeHero();
    initScrollObservables();
    initParallax();
    initWEWN();
    initAboutChain();
    initFoundersLabAnimation();
    initContactForm();
    initReadingProgress();
  });

  /* --------------------------------------------------------------------------
     1. Header & Navigation
     -------------------------------------------------------------------------- */
  function initHeader() {
    const header = document.querySelector('.header');
    if (!header) return;

    let lastScrollY = window.scrollY;
    let ticking = false;

    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          const currentScrollY = window.scrollY;

          // Height shrink after 80px
          if (currentScrollY > 80) {
            header.classList.add('scrolled');
          } else {
            header.classList.remove('scrolled');
          }

          // Mobile hide on scroll down, show on scroll up
          if (window.innerWidth < 1024) {
            if (currentScrollY > 120 && currentScrollY > lastScrollY && !document.body.classList.contains('menu-open')) {
              header.classList.add('header-hidden');
            } else {
              header.classList.remove('header-hidden');
            }
          } else {
            header.classList.remove('header-hidden');
          }

          lastScrollY = currentScrollY;
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });

    // Desktop Initiatives Dropdown
    const dropdownToggle = document.querySelector('.nav-dropdown-toggle');
    const dropdownMenu = document.querySelector('.nav-dropdown-menu');
    const dropdownWrap = document.querySelector('.nav-dropdown-wrapper');

    if (dropdownToggle && dropdownMenu && dropdownWrap) {
      let hoverTimeout;

      const openDropdown = () => {
        clearTimeout(hoverTimeout);
        dropdownToggle.setAttribute('aria-expanded', 'true');
        dropdownMenu.classList.add('is-open');
      };

      const closeDropdown = () => {
        dropdownToggle.setAttribute('aria-expanded', 'false');
        dropdownMenu.classList.remove('is-open');
      };

      // Hover with 150ms delay
      dropdownWrap.addEventListener('mouseenter', () => {
        if (window.innerWidth >= 1024) {
          hoverTimeout = setTimeout(openDropdown, 150);
        }
      });

      dropdownWrap.addEventListener('mouseleave', () => {
        if (window.innerWidth >= 1024) {
          clearTimeout(hoverTimeout);
          closeDropdown();
        }
      });

      // Click / Enter toggle
      dropdownToggle.addEventListener('click', (e) => {
        e.preventDefault();
        const isOpen = dropdownToggle.getAttribute('aria-expanded') === 'true';
        if (isOpen) closeDropdown();
        else openDropdown();
      });

      // Esc key closes
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
          closeDropdown();
        }
      });

      // Outside click closes
      document.addEventListener('click', (e) => {
        if (!dropdownWrap.contains(e.target)) {
          closeDropdown();
        }
      });
    }
  }

  /* --------------------------------------------------------------------------
     2. Mobile Menu (Clip-Path & Focus Trap)
     -------------------------------------------------------------------------- */
  function initMobileMenu() {
    const toggleBtn = document.querySelector('.menu-toggle');
    const overlay = document.querySelector('.mobile-overlay');
    const closeBtn = document.querySelector('.mobile-overlay-close');
    if (!toggleBtn || !overlay) return;

    const openMenu = () => {
      document.body.classList.add('menu-open');
      overlay.classList.add('is-open');
      toggleBtn.setAttribute('aria-expanded', 'true');
      overlay.setAttribute('aria-hidden', 'false');
      closeBtn && closeBtn.focus();
    };

    const closeMenu = () => {
      document.body.classList.remove('menu-open');
      overlay.classList.remove('is-open');
      toggleBtn.setAttribute('aria-expanded', 'false');
      overlay.setAttribute('aria-hidden', 'true');
      toggleBtn.focus();
    };

    toggleBtn.addEventListener('click', openMenu);
    closeBtn && closeBtn.addEventListener('click', closeMenu);

    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape' && overlay.classList.contains('is-open')) {
        closeMenu();
      }
    });
  }

  /* --------------------------------------------------------------------------
     3. Home Hero Load Animation
     -------------------------------------------------------------------------- */
  function initHomeHero() {
    const hero = document.querySelector('.home-hero');
    if (!hero) return;

    // Trigger orchestrated entry
    window.requestAnimationFrame(() => {
      setTimeout(() => {
        document.documentElement.classList.add('hero-ready');
      }, 50);
    });
  }

  /* --------------------------------------------------------------------------
     4. Intersection Observers (Reveals, SVG paths, Strata)
     -------------------------------------------------------------------------- */
  function initScrollObservables() {
    if (prefersReducedMotion) {
      document.querySelectorAll('[data-reveal]').forEach(el => el.classList.add('is-revealed'));
      document.querySelectorAll('.curious-path, .strike-path').forEach(p => p.classList.add('is-drawn'));
      return;
    }

    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-revealed');

          // SVG pink underlines and strikes
          const svgPath = entry.target.querySelector('.curious-path, .strike-path');
          if (svgPath) svgPath.classList.add('is-drawn');

          // Strata layers separation
          if (entry.target.classList.contains('strata-stack')) {
            entry.target.classList.add('is-separated');
          }

          obs.unobserve(entry.target);
        }
      });
    }, { threshold: 0.2, rootMargin: '0px 0px -8% 0px' });

    document.querySelectorAll('[data-reveal], .curious-section, .strata-stack, .strike-through').forEach(el => {
      observer.observe(el);
    });

    // Curious questions viewport center fading
    const questions = document.querySelectorAll('.curious-q-item');
    if (questions.length) {
      window.addEventListener('scroll', () => {
        const vhCenter = window.innerHeight / 2;
        questions.forEach(q => {
          const rect = q.getBoundingClientRect();
          const qCenter = rect.top + rect.height / 2;
          const dist = Math.abs(vhCenter - qCenter);
          if (dist < 180) {
            q.classList.add('in-focus');
          } else {
            q.classList.remove('in-focus');
          }
        });
      }, { passive: true });
    }
  }

  /* --------------------------------------------------------------------------
     5. Parallax Engine (rAF Throttled, Desktop Only)
     -------------------------------------------------------------------------- */
  function initParallax() {
    const isDesktop = window.matchMedia('(min-width: 1024px) and (pointer: fine)').matches;
    if (!isDesktop || prefersReducedMotion) return;

    const parallaxElements = document.querySelectorAll('[data-parallax]');
    if (!parallaxElements.length) return;

    let ticking = false;

    window.addEventListener('scroll', () => {
      if (!ticking) {
        window.requestAnimationFrame(() => {
          const scrollY = window.scrollY;
          parallaxElements.forEach(el => {
            const speed = parseFloat(el.getAttribute('data-parallax')) || 0;
            const rect = el.getBoundingClientRect();
            if (rect.top < window.innerHeight && rect.bottom > 0) {
              const offset = ((rect.top - window.innerHeight / 2) / (window.innerHeight / 2)) * speed;
              el.style.transform = `translate3d(0, ${offset.toFixed(1)}px, 0)`;
            }
          });
          ticking = false;
        });
        ticking = true;
      }
    }, { passive: true });
  }

  /* --------------------------------------------------------------------------
     6. Ground Signal WEWN Component
     -------------------------------------------------------------------------- */
  function initWEWN() {
    const wewnComponent = document.querySelector('.wewn-component');
    if (!wewnComponent) return;

    // Check URL param ?wewn=brand
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('wewn') === 'brand') {
      wewnComponent.classList.remove('wewn--reference');
      wewnComponent.classList.add('wewn--brand');
    }

    const buttons = wewnComponent.querySelectorAll('.wewn-col-btn');
    buttons.forEach(btn => {
      btn.addEventListener('click', () => {
        const isExpanded = btn.getAttribute('aria-expanded') === 'true';

        // Close all
        buttons.forEach(b => b.setAttribute('aria-expanded', 'false'));

        // Toggle clicked
        if (!isExpanded) {
          btn.setAttribute('aria-expanded', 'true');
        }
      });
    });
  }

  /* --------------------------------------------------------------------------
     7. About Page Animated Concept Chain
     -------------------------------------------------------------------------- */
  function initAboutChain() {
    const chain = document.querySelector('.about-chain');
    if (!chain) return;

    const nodes = chain.querySelectorAll('.about-chain-node, .about-chain-arrow');
    const observer = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting) {
        nodes.forEach((node, idx) => {
          setTimeout(() => {
            node.classList.add('is-active');
          }, idx * 220);
        });
        observer.disconnect();
      }
    }, { threshold: 0.3 });

    observer.observe(chain);
  }

  /* --------------------------------------------------------------------------
     8. Founders Lab Staggered Problem Animation
     -------------------------------------------------------------------------- */
  function initFoundersLabAnimation() {
    const strip = document.querySelector('.founders-problem-strip');
    if (!strip) return;

    const words = strip.querySelectorAll('.founders-problem-word');
    const strikePath = strip.querySelector('.strike-path');

    const observer = new IntersectionObserver((entries) => {
      if (entries[0].isIntersecting) {
        words.forEach((w, idx) => {
          setTimeout(() => {
            w.classList.add('is-visible');
          }, idx * 100);
        });

        // Strike through after all words appear
        setTimeout(() => {
          if (strikePath) strikePath.classList.add('is-drawn');
        }, words.length * 100 + 150);

        observer.disconnect();
      }
    }, { threshold: 0.3 });

    observer.observe(strip);
  }

  /* --------------------------------------------------------------------------
     9. Contact Form & Quick Triggers
     -------------------------------------------------------------------------- */
  function initContactForm() {
    const form = document.querySelector('#contact-form');
    const triggerCards = document.querySelectorAll('.contact-card-btn');

    // Type preselection from URL
    const urlParams = new URLSearchParams(window.location.search);
    const requestedType = urlParams.get('type');
    const typeSelect = document.querySelector('#type');

    if (typeSelect && requestedType) {
      const match = [...typeSelect.options].find(opt =>
        opt.text.toLowerCase().includes(requestedType.toLowerCase()) ||
        opt.value.toLowerCase().includes(requestedType.toLowerCase())
      );
      if (match) {
        typeSelect.value = match.value;
      }
    }

    // Trigger cards interaction
    if (triggerCards.length && typeSelect) {
      triggerCards.forEach(card => {
        card.addEventListener('click', () => {
          const typeVal = card.getAttribute('data-type');
          if (typeVal) {
            typeSelect.value = typeVal;
          }
          triggerCards.forEach(c => c.classList.remove('active'));
          card.classList.add('active');

          // Scroll to form and focus name
          form && form.scrollIntoView({ behavior: 'smooth', block: 'center' });
          const nameInput = document.querySelector('#name');
          nameInput && setTimeout(() => nameInput.focus(), 400);
        });
      });
    }

    // Client-side validation on blur
    if (form) {
      const inputs = form.querySelectorAll('input[required], textarea[required]');
      inputs.forEach(input => {
        input.addEventListener('blur', () => validateField(input));
        input.addEventListener('input', () => {
          if (input.classList.contains('has-error')) validateField(input);
        });
      });

      form.addEventListener('submit', (e) => {
        let isValid = true;
        inputs.forEach(input => {
          if (!validateField(input)) isValid = false;
        });

        if (!isValid) {
          e.preventDefault();
          return;
        }

        const submitBtn = form.querySelector('button[type="submit"]');
        if (submitBtn) {
          submitBtn.disabled = true;
          submitBtn.textContent = 'Sending…';
        }
      });
    }

    function validateField(input) {
      const errorEl = document.querySelector(`#error-${input.id}`);
      let message = '';

      if (!input.value.trim()) {
        message = 'This field is required.';
      } else if (input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value.trim())) {
        message = 'Please enter a valid email address.';
      }

      if (message) {
        input.classList.add('has-error');
        input.setAttribute('aria-invalid', 'true');
        if (errorEl) errorEl.textContent = message;
        return false;
      } else {
        input.classList.remove('has-error');
        input.removeAttribute('aria-invalid');
        if (errorEl) errorEl.textContent = '';
        return true;
      }
    }
  }

  /* --------------------------------------------------------------------------
     10. Reading Progress Bar (Article Template)
     -------------------------------------------------------------------------- */
  function initReadingProgress() {
    const progressBar = document.querySelector('.reading-progress-bar');
    if (!progressBar) return;

    window.addEventListener('scroll', () => {
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;
      const progress = (window.scrollY / docHeight) * 100;
      progressBar.style.width = `${Math.min(100, Math.max(0, progress))}%`;
    }, { passive: true });
  }

})();
