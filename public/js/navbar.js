// Toggle Sidenav
function toggleSidenav() {
    const sidenav = document.getElementById('sidenav');
    sidenav.classList.toggle('translate-x-0');
}

// Toggle Search Overlay
function toggleSearch() {
    const searchOverlay = document.getElementById('searchOverlay');
    searchOverlay.classList.toggle('hidden');
    if (!searchOverlay.classList.contains('hidden')) {
        document.getElementById('searchInput').focus();
    }
}

// Close search when pressing Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        document.getElementById('searchOverlay').classList.add('hidden');
    }
});

document.addEventListener('DOMContentLoaded', function () {
  const homeUrl = "{{ route('home') }}";
  const homePath = (new URL(homeUrl, window.location.origin)).pathname;
  const nav = document.querySelector('nav');
  const navHeight = nav ? nav.offsetHeight : 0;

  const navLinks = Array.from(document.querySelectorAll('a.nav-link'));
  const navAnchors = Array.from(document.querySelectorAll('a.nav-anchor'));
  const activeClasses = ['text-[#86765a]','font-semibold'];
  const hoverClass = 'hover:text-[#86765a]';

  function clearActive() {
    navLinks.forEach(l => {
      activeClasses.forEach(c => l.classList.remove(c));
      if (!l.classList.contains('transition')) l.classList.add('transition');
      if (!l.classList.contains(hoverClass)) l.classList.add(hoverClass);
    });
  }

  function setActive(link) {
    if (!link) return;
    clearActive();
    activeClasses.forEach(c => link.classList.add(c));
    link.classList.remove(hoverClass);
  }

  // improved scroll: use main if element is inside it, otherwise scroll window/document
  function scrollToHash(hash, smooth = true) {
    const id = hash.replace('#','');
    const el = document.getElementById(id);
    if (!el) return;
    const main = document.querySelector('main');
    // if element is inside main -> scroll main; else scroll window
    if (main && main.contains(el)) {
      const container = main;
      const containerRect = container.getBoundingClientRect();
      const elRect = el.getBoundingClientRect();
      const currentScroll = container.scrollTop;
      const target = currentScroll + (elRect.top - containerRect.top) - navHeight - 8;
      if (smooth && container.scrollTo) {
        container.scrollTo({ top: target, behavior: 'smooth' });
      } else {
        container.scrollTop = target;
      }
    } else {
      // element is outside main; scroll the page
      const elTop = el.getBoundingClientRect().top + window.pageYOffset;
      const target = elTop - navHeight - 8;
      if (smooth && 'scrollTo' in window) {
        window.scrollTo({ top: target, behavior: 'smooth' });
      } else {
        window.scrollTo(0, target);
      }
    }
  }

  function isOnHome() {
    return window.location.pathname.replace(/\/$/,'') === homePath.replace(/\/$/,'');
  }

  // intercept nav anchors only when we're already on home (do smooth scroll)
  navAnchors.forEach(a => {
    a.addEventListener('click', function (e) {
      try {
        const href = a.getAttribute('href') || '';
        const url = new URL(href, window.location.origin);
        const hash = url.hash;
        // if link points to home path and we're already on home -> smooth scroll
        if ((url.pathname.replace(/\/$/,'') === homePath.replace(/\/$/,'') || url.href === homeUrl) && isOnHome()) {
          e.preventDefault();
          if (hash) {
            scrollToHash(hash, true);
            history.replaceState(null, '', hash);
            setActive(a);
          }
        }
        // otherwise let browser navigate to home#hash (on load script will handle scrolling)
      } catch (err) {
        // ignore
      }
    });
  });

  // immediate active on click
  navLinks.forEach(a => {
    a.addEventListener('click', function () {
      setActive(a);
    });
  });

  // Scrollspy using IntersectionObserver (observe sections inside main if exists)
  const sections = Array.from(document.querySelectorAll('section[id]'));
  const observerRoot = document.querySelector('main') || null;
  if ('IntersectionObserver' in window && sections.length) {
    const obs = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const id = entry.target.id;
          const match = navLinks.find(a => (a.getAttribute('href')||'').includes('#'+id));
          if (match) setActive(match);
        }
      });
    }, { threshold: 0.55, root: observerRoot });
    sections.forEach(s => obs.observe(s));
  } else {
    // fallback
    window.addEventListener('scroll', function () {
      let nearest = null, nearestPos = Infinity;
      sections.forEach(s => {
        const rect = s.getBoundingClientRect();
        const pos = Math.abs(rect.top - navHeight);
        if (pos < nearestPos) { nearestPos = pos; nearest = s; }
      });
      if (nearest) {
        const id = nearest.id;
        const match = navLinks.find(a => (a.getAttribute('href')||'').includes('#'+id));
        if (match) setActive(match);
      }
    }, { passive: true });
  }

  // On full page load: if we landed with a hash (from other page), wait for load then scroll
  window.addEventListener('load', function () {
    if (window.location.hash) {
      // longer timeout for heavy pages; adjust if needed
      setTimeout(function () {
        scrollToHash(window.location.hash, true);
        const match = navLinks.find(a => (a.getAttribute('href')||'').includes(window.location.hash));
        if (match) setActive(match);
      }, 250);
    }
  });
});

function normalizeSearchValue(value) {
  return (value || '')
    .toString()
    .toLowerCase()
    .replace(/[\s_-]+/g, '');
}

function closeSearchDropdown() {
  const searchInput = document.querySelector('input[x-model="searchQuery"]');
  if (searchInput) {
    searchInput.value = '';
    searchInput.dispatchEvent(new Event('input'));
  }
}

function selectMenuSearchItem(url) {
  closeSearchDropdown();
  window.location.href = url;
}

function searchMenus() {
  const searchInput = document.querySelector('input[x-model="searchQuery"]');
  const searchQuery = normalizeSearchValue(searchInput ? searchInput.value : '');
  const resultsContainer = document.getElementById('searchResults');

  if (searchQuery.length === 0) {
    resultsContainer.innerHTML = '';
    return;
  }

  const results = (window.menuSearchItems || []).filter(item => {
    const name = normalizeSearchValue(item.name);
    const category = normalizeSearchValue(item.category);
    const description = normalizeSearchValue(item.description);
    const slug = normalizeSearchValue(item.slug);

    return name.includes(searchQuery) ||
      category.includes(searchQuery) ||
      description.includes(searchQuery) ||
      slug.includes(searchQuery);
  });

  if (results.length === 0) {
    resultsContainer.innerHTML = `
      <div class="py-3 px-4 text-gray-500 text-sm">
        Tidak ada menu yang ditemukan
      </div>
    `;
    return;
  }

  resultsContainer.innerHTML = results.map(item => `
    <button type="button" class="w-full text-left py-2 px-4 hover:bg-gray-50 cursor-pointer" data-menu-url="${item.url}">
      <div class="font-medium text-gray-800">${item.name}</div>
      <div class="text-sm text-gray-500">${item.category}</div>
      <div class="text-xs text-gray-400">${item.description}</div>
    </button>
  `).join('');
  
  // Attach click handlers to all menu search result buttons
  document.querySelectorAll('[data-menu-url]').forEach(btn => {
    btn.addEventListener('click', function(e) {
      e.preventDefault();
      selectMenuSearchItem(this.getAttribute('data-menu-url'));
    });
  });
}

// Cart Management
document.addEventListener('alpine:init', () => {
  Alpine.data('cart', () => ({
    isOpen: false,
    items: [],
    
    init() {
      // Load cart from localStorage
      const savedCart = localStorage.getItem('cart');
      if (savedCart) {
        this.items = JSON.parse(savedCart);
      }
      
      // Listen for add to cart events
      window.addEventListener('add-to-cart', (e) => {
        this.addItem(e.detail);
      });
    },

    get itemCount() {
      return this.items.reduce((sum, item) => sum + item.quantity, 0);
    },

    get total() {
      return this.items.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    },

    toggleCart() {
      this.isOpen = !this.isOpen;
    },

    addItem(item) {
      const existingItem = this.items.find(i => i.id === item.id);
      if (existingItem) {
        existingItem.quantity += 1;
      } else {
        this.items.push({
          ...item,
          quantity: 1
        });
      }
      this.saveCart();
      this.isOpen = true; // Show cart when adding items
    },

    incrementItem(item) {
      item.quantity += 1;
      this.saveCart();
    },

    decrementItem(item) {
      if (item.quantity > 1) {
        item.quantity -= 1;
      } else {
        this.removeItem(item);
      }
      this.saveCart();
    },

    removeItem(item) {
      const index = this.items.indexOf(item);
      if (index > -1) {
        this.items.splice(index, 1);
      }
      this.saveCart();
    },

    saveCart() {
      localStorage.setItem('cart', JSON.stringify(this.items));
    },

    formatPrice(price) {
      return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR',
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
      }).format(price);
    }
  }));
});

// Example of programmatically adding an item to the cart
document.querySelectorAll('.add-to-cart-button').forEach(button => {
  button.addEventListener('click', function () {
    const itemId = this.getAttribute('data-item-id');
    const itemName = this.getAttribute('data-item-name');
    const itemPrice = parseFloat(this.getAttribute('data-item-price'));
    const itemCategory = this.getAttribute('data-item-category');
    const itemImage = this.getAttribute('data-item-image');

    // Dispatch the add-to-cart event with item details
    document.dispatchEvent(new CustomEvent('add-to-cart', {
      detail: {
        id: itemId,
        name: itemName,
        price: itemPrice,
        category: itemCategory,
        image: itemImage
      }
    }));
  });
});