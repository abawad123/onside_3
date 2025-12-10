<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Restaurant</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS + Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    :root {
        --accent: #ff6b35;
        --muted: #6c757d;
        --card-shadow: 0 8px 20px rgba(18, 18, 18, 0.08);
    }

    body {
        background: linear-gradient(180deg, #fff 0%, #f8fafc 60%);
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
        color: #222;
    }

    /* Header / Hero */
    .hero {
        background: linear-gradient(90deg, rgba(255, 107, 53, 0.08), rgba(255, 107, 53, 0.02));
        border-radius: .75rem;
        padding: 2rem;
        margin: 1.5rem 0;
    }

    .hero h1 {
        font-weight: 700;
        letter-spacing: -0.02em;
    }

    .hero p {
        color: var(--muted);
        margin-bottom: 0;
    }

    /* Category buttons */
    .category-btns .btn {
        border-radius: 50px;
        padding: .45rem .9rem;
        font-weight: 600;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .category-btns .btn:hover {
        transform: translateY(-3px);
        box-shadow: var(--card-shadow);
    }

    .category-btns .btn.active {
        background: var(--accent);
        border-color: var(--accent);
        color: #fff;
    }

    /* Cards */
    .menu-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: transform .25s ease, box-shadow .25s ease;
        box-shadow: var(--card-shadow);
        background: linear-gradient(180deg, #fff, #fff);
    }

    .menu-card:hover {
        transform: translateY(-8px) rotate(-0.2deg);
        box-shadow: 0 18px 40px rgba(18, 18, 18, 0.12);
    }

    .menu-card img {
        height: 200px;
        object-fit: cover;
        width: 100%;
        display: block;
    }

    .price-badge {
        position: absolute;
        top: 12px;
        right: 12px;
        background: rgba(255, 255, 255, 0.95);
        padding: .35rem .6rem;
        border-radius: 8px;
        font-weight: 700;
        color: var(--accent);
        box-shadow: 0 6px 18px rgba(18, 18, 18, 0.06);
    }

    .category-chip {
        display: inline-flex;
        gap: .35rem;
        align-items: center;
        font-size: .8rem;
        color: var(--muted);
    }

    .card-footer-actions .btn {
        border-radius: 8px;
        padding: .4rem .7rem;
    }

    /* Footer */
    footer {
        margin-top: 3rem;
        padding: 2.5rem 0;
        background: linear-gradient(180deg, #0f1724, #071126);
        color: rgba(255, 255, 255, 0.9);
    }

    footer a {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
    }

    footer .muted {
        color: rgba(255, 255, 255, 0.7);
    }

    /* simple animations (fade-up) */
    .fade-up {
        opacity: 0;
        transform: translateY(18px);
        transition: opacity .6s ease, transform .6s ease;
    }

    .fade-up.in-view {
        opacity: 1;
        transform: translateY(0);
    }

    /* responsive tweaks */
    @media (max-width: 576px) {
        .hero {
            padding: 1.25rem;
        }

        .menu-card img {
            height: 160px;
        }
    }
    </style>
</head>

<body>
    <div class="container py-4">
        <!-- Navbar -->
        <nav class="d-flex align-items-center justify-content-between mb-3">
            <div class="d-flex align-items-center gap-3">
                <div class="fs-3 fw-bold text-uppercase" style="color:var(--accent)">Restaurant</div>
                <div class="text-muted">Fresh & Delicious</div>
            </div>

            <div class="d-flex align-items-center gap-2">
                <a href="" class="btn btn-outline-secondary btn-sm d-none d-md-inline">
                    <i class="bi bi-person"></i> Admin
                </a>
                <a href="#" class="btn btn-outline-dark btn-sm position-relative" id="cartBtn">
                    <i class="bi bi-cart"></i> Cart
                    <span id="cartCount"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                        style="font-size:.65rem; transition: transform .18s ease;">0</span>
                </a>

                <script>
                (function() {
                    const key = 'cart_count';
                    const cartCountEl = document.getElementById('cartCount');
                    let count = parseInt(localStorage.getItem(key) || '0', 10);
                    cartCountEl.textContent = count;

                    document.addEventListener('click', function(e) {
                        const anchor = e.target.closest('a, button');
                        if (!anchor) return;

                        // detect the "Add" button by presence of the bag icon inside the clicked control
                        if (anchor.querySelector('.bi-bag-plus') || e.target.classList.contains(
                                'bi-bag-plus')) {
                            e.preventDefault();
                            count = (count || 0) + 1;
                            localStorage.setItem(key, count);
                            cartCountEl.textContent = count;

                            // small pop animation
                            cartCountEl.style.transform = 'scale(1.25)';
                            setTimeout(() => cartCountEl.style.transform = '', 160);
                        }
                    });
                })();
                </script>
            </div>
        </nav>

        <!-- Hero -->
        <section class="hero row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-1">Our Menu — Handpicked meals for every taste</h1>
                <p>Discover chef specials, seasonal dishes and family favorites. Tap any category to filter the menu.
                </p>
            </div>
            <div class="col-md-4 text-md-end mt-3 mt-md-0">
                <a href="#" class="btn btn-lg" style="background:var(--accent); color:#fff; border-radius:10px;">
                    <i class="bi bi-phone me-2"></i> Order Now
                </a>
            </div>
        </section>

        <!-- Categories -->
        <div class="text-center my-4 category-btns">
            @foreach($categories as $category)
            <a href="{{ route('category.filter', $category->id) }}"
                class="btn btn-outline-dark m-1 @if(request()->routeIs('category.filter') && request()->route('id') == $category->id) active @endif">
                {{ $category->name }}
            </a>
            @endforeach
            <a href="{{ route('home') }}" class="btn btn-outline-secondary m-1">Show All</a>
        </div>

        <!-- Menu grid -->
        <div class="row g-4">
            @forelse($meals as $meal)
            <div class="col-12 col-sm-6 col-md-4 fade-up">
                <div class="menu-card position-relative h-100">
                    @if($meal->image)
                    <img src="{{ asset('storage/' . $meal->image) }}" alt="{{ $meal->name }}">
                    @else
                    <img src="https://via.placeholder.com/600x400?text=No+Image" alt="{{ $meal->name }}">
                    @endif

                    <div class="price-badge">${{ number_format($meal->price, 2)}}</div>

                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h5 class="mb-0">{{ $meal->name }}</h5>
                            <div class="text-end">
                                <!-- simple star rating (visual only) -->
                                <div class="text-warning small">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                    <i class="bi bi-star"></i>
                                </div>
                                <div class="category-chip mt-1">
                                    <i class="bi bi-tag-fill text-muted"></i>
                                    <small class="text-muted">{{ $meal->category->name }}</small>
                                </div>
                            </div>
                        </div>

                        <p class="text-muted small mb-3">{{ Str::limit($meal->description, 110)}}</p>

                        <div class="d-flex justify-content-between align-items-center card-footer-actions">
                            <div>
                                <a href="#" class="btn btn-sm btn-outline-primary">
                                    <i class="bi bi-info-circle"></i> Details
                                </a>
                                <a href="#" class="btn btn-sm" style="background:var(--accent); color:#fff;">
                                    <i class="bi bi-bag-plus"></i> Add
                                </a>
                            </div>
                            <div class="text-muted small">Ready in 15-25 min</div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <p class="text-center text-muted">No meals available for this category.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination (optional placeholder) -->
        <div class="d-flex justify-content-center mt-4">
            {{-- If you use pagination: {{ $meals->links() }} --}}
        </div>
    </div>


    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row gy-4">
                <div class="col-md-4">
                    <h5 class="text-white">Restaurant</h5>
                    <p class="muted">Freshly prepared meals & friendly service. Visit us or order online.</p>
                    <div class="mt-2">
                        <a href="#" class="me-2 text-white"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="me-2 text-white"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="me-2 text-white"><i class="bi bi-twitter"></i></a>
                    </div>
                </div>
                <div class="col-md-4">
                    <h6 class="text-white">Contact</h6>
                    <p class="muted mb-1"><i class="bi bi-geo-alt-fill me-2"></i> 123 Food Street, City</p>
                    <p class="muted mb-1"><i class="bi bi-telephone-fill me-2"></i> +1 234 567 890</p>
                    <p class="muted"><i class="bi bi-envelope-fill me-2"></i> hello@restaurant.example</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-white">Opening Hours</h6>
                    <p class="muted mb-1">Mon - Fri: 9:00 - 22:00</p>
                    <p class="muted">Sat - Sun: 10:00 - 23:00</p>
                </div>
            </div>

            <div class="text-center mt-4 muted small">
                © {{ date('Y') }} Restaurant • All rights reserved
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS and small animation script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    // Reveal on scroll: add 'in-view' to .fade-up elements
    (function() {
        const io = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in-view');
                    io.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12
        });

        document.querySelectorAll('.fade-up').forEach(el => io.observe(el));
    })();
    </script>
</body>

</html>
