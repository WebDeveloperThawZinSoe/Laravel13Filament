<!DOCTYPE html>
<html lang="my">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>{{ $get('brand', 'site_name', 'title', 'ပေါက်ပျော်') }} - Myanmar's #1 Trusted Betting Agent</title>
    <meta name="description" content="{{ $get('brand', 'site_name', 'title', 'ပေါက်ပျော်') }} - Myanmar နိုင်ငံ၏ အယုံကြည်ဆုံး၊ လုံခြုံဆုံး Online Betting Agent">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Myanmar:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        /* ... [သင့် CSS အားလုံး ဒီအတိုင်း ထည့်ပါ — ပြောင်းစရာ မလိုပါ] ... */
        @include('partials.landing-styles')
    </style>
</head>
<body>

    {{-- Navigation --}}
    <div class="nav-overlay" id="navOverlay"></div>
    <nav class="navbar" id="navbar">
        <a href="#home" class="nav-brand">
            <div class="logo-icon">
                <img src="{{ $get('brand', 'site_logo', 'image_url', 'https://pautpyaw.com/logo.png') }}"
                     alt="{{ $get('brand', 'site_name', 'title', 'ပေါက်ပျော်') }} Logo"
                     id="navLogo"
                     onerror="this.style.display='none'">
            </div>
            <span>{{ $get('brand', 'site_name', 'title', 'ပေါက်ပျော်') }}</span>
        </a>
        <ul class="nav-links" id="navLinks">
            <li><a href="#home">မူလစာမျက်နှာ</a></li>
            <li><a href="#services">ဝန်ဆောင်မှုများ</a></li>
            <li><a href="#how-to-join">အဖွဲ့ဝင်နည်း</a></li>
            <li><a href="#promotions">ပရိုမိုးရှင်း</a></li>
            <li><a href="#agent">Agent လျှောက်ရန်</a></li>
            <li><a href="#contact" class="nav-cta">ဆက်သွယ်ရန်</a></li>
        </ul>
        <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle Menu">
            <i class="fas fa-bars"></i>
        </button>
    </nav>

    {{-- Hero Section --}}
    <section class="hero" id="home">
        <div class="hero-particles" id="particles"></div>
        <div class="hero-content">
            @php
                $badge = $find('hero', 'badge');
                $heroTitle = $find('hero', 'title');
                $heroDesc = $find('hero', 'description');
                $btnPrimary = $find('hero', 'btn_primary');
                $btnSecondary = $find('hero', 'btn_secondary');
            @endphp

            <div class="hero-badge">
                <i class="{{ $badge['icon'] ?? 'fas fa-shield-alt' }}"></i>
                <span>{{ $badge['title'] ?? "Myanmar's #1 Trusted Agent" }}</span>
            </div>

            <h1>
                <span>{{ $heroTitle['title'] ?? 'ပေါက်ပျော်' }}</span>
                <span class="highlight">{{ $heroTitle['subtitle'] ?? 'Premium Betting Agent' }}</span>
            </h1>

            <p>{{ $heroDesc['content'] ?? '' }}</p>

            <div class="hero-buttons">
                <a href="{{ $btnPrimary['link_url'] ?? 'https://t.me/PautPyaw' }}"
                   target="{{ str_starts_with($btnPrimary['link_url'] ?? '#', '#') ? '_self' : '_blank' }}"
                   rel="noopener" class="btn btn-primary">
                    <i class="{{ $btnPrimary['icon'] ?? 'fab fa-telegram' }}"></i>
                    {{ $btnPrimary['link_text'] ?? 'ဆက်သွယ်ရန်' }}
                </a>
                <a href="{{ $btnSecondary['link_url'] ?? '#how-to-join' }}" class="btn btn-outline">
                    <i class="{{ $btnSecondary['icon'] ?? 'fas fa-user-plus' }}"></i>
                    {{ $btnSecondary['link_text'] ?? 'အဖွဲ့ဝင်နည်း သိရှိရန်' }}
                </a>
            </div>

            {{-- Stats --}}
            <div class="hero-stats" id="heroStats">
                @foreach($data['stats'] ?? [] as $stat)
                    @php
                        $isMember = ($stat['item_key'] ?? '') === 'stat_members';
                        $rawValue = $stat['value'] ?? '';
                        $extra = $stat['extra_value'] ?? '';
                        if ($isMember && is_numeric($rawValue)) {
                            $displayValue = number_format((int) $rawValue) . $extra;
                        } else {
                            $displayValue = $rawValue . $extra;
                        }
                        $dataTarget = (!$isMember && is_numeric($rawValue)) ? (int) $rawValue : null;
                    @endphp
                    <div class="stat-item">
                        <div class="stat-icon">{{ $stat['icon'] ?? '' }}</div>
                        <div class="stat-value"
                             @if($isMember) id="memberCounter" @endif
                             @if($dataTarget !== null) data-target="{{ $dataTarget }}" @endif>
                            {{ $displayValue }}
                        </div>
                        <div class="stat-label">{{ $stat['title'] ?? '' }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Services --}}
    <section id="services">
        <div class="section-header">
            <div class="section-badge">Our Services</div>
            <h2 class="section-title">ဝန်ဆောင်မှုများ</h2>
            <p class="section-subtitle">ပေါက်ပျော်မှ ကမ်းလှမ်းသောဝန်ဆောင်မှုများ</p>
        </div>
        <div class="services-grid">
            @foreach($data['services'] ?? [] as $service)
                <div class="service-card">
                    <div class="service-icon">
                        <i class="{{ $service['icon'] ?? 'fas fa-dice' }}"></i>
                    </div>
                    <h3>{{ $service['title'] ?? '' }}</h3>
                    <p>{{ $service['content'] ?? '' }}</p>
                    <a href="{{ $service['link_url'] ?? 'https://t.me/PautPyaw' }}"
                       target="_blank" rel="noopener" class="btn-sm">
                        {{ $service['link_text'] ?? 'အကောင့်ဖွင့်ရန်' }}
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Steps --}}
    <section id="how-to-join">
        <div class="section-header">
            <div class="section-badge">Get Started</div>
            <h2 class="section-title">အဖွဲ့ဝင်နည်း</h2>
            <p class="section-subtitle">လွယ်ကူသောအဆင့် ၄ ဆင့်မျှဖြင့် စတင်ပါ</p>
        </div>
        <div class="steps-container">
            @foreach($data['steps'] ?? [] as $step)
                <div class="step-card">
                    <div class="step-number">{{ $step['value'] ?? '' }}</div>
                    <div class="step-icon">
                        <i class="{{ $step['icon'] ?? 'fas fa-dice' }}"></i>
                    </div>
                    <h3>{{ $step['title'] ?? '' }}</h3>
                    <p>{{ $step['content'] ?? '' }}</p>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Promotions --}}
    <section id="promotions">
        <div class="section-header">
            <div class="section-badge">Special Offers</div>
            <h2 class="section-title">ပရိုမိုးရှင်းများ</h2>
            <p class="section-subtitle">ပေါက်ပျော်မှ အထူးကံစမ်းမှုများ</p>
        </div>
        <div class="promo-grid">
            @foreach($data['promotions'] ?? [] as $i => $promo)
                @php
                    $isFeatured = $i === 0 || ($promo['link_text'] ?? '') === 'HOT';
                @endphp
                <div class="promo-card {{ $isFeatured ? 'featured' : '' }}">
                    @if($isFeatured)
                        <span class="promo-badge">HOT</span>
                    @endif
                    <div class="promo-icon">{{ $promo['icon'] ?? '🎁' }}</div>
                    <div class="promo-value">{{ $promo['value'] ?? '' }}</div>
                    <h3>{{ $promo['title'] ?? '' }}</h3>
                    <p>{{ $promo['content'] ?? '' }}</p>
                    @if(!empty($promo['extra_value']))
                        <span class="promo-tag">{{ $promo['extra_value'] }}</span>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    {{-- Testimonials --}}
    <section id="testimonials">
        <div class="section-header">
            <div class="section-badge">Reviews</div>
            <h2 class="section-title">Member တို့၏ သက်သေ</h2>
            <p class="section-subtitle">ကျွန်ုပ်တို့၏ Member များ၏ စစ်မှန်သောအတွေ့အကြုံများ</p>
        </div>
        <div class="testimonials-grid">
            @foreach($data['testimonials'] ?? [] as $t)
                @php
                    $rating = (int) ($t['value'] ?? 5);
                    $avatar = $t['extra_value'] ?? mb_substr($t['title'] ?? 'A', 0, 1);
                @endphp
                <div class="testimonial-card">
                    <div class="testimonial-stars">{{ str_repeat('★', $rating) }}</div>
                    <p>"{{ $t['content'] ?? '' }}"</p>
                    <div class="testimonial-author">
                        <div class="author-avatar">{{ $avatar }}</div>
                        <div class="author-info">
                            <h4>{{ $t['title'] ?? '' }}</h4>
                            <span>{{ $t['subtitle'] ?? '' }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Agent --}}
    <section id="agent">
        <div class="agent-content">
            <div class="section-header">
                <div class="section-badge">JOIN US</div>
                <h2 class="section-title">Agent လျှောက်ရန်</h2>
                <p class="section-subtitle">ကြိုးစားလိုသော Agent များကို ပေါက်ပျော်မှ အမြဲကြိုဆိုလျှက်ပါ</p>
            </div>

            <div class="agent-features">
                @foreach($data['agent'] ?? [] as $feature)
                    @if(str_starts_with($feature['item_key'] ?? '', 'agent_feature_'))
                        <div class="agent-feature">
                            <i class="{{ $feature['icon'] ?? 'fas fa-star' }}"></i>
                            <h3>{{ $feature['title'] ?? '' }}</h3>
                            <p>{{ $feature['content'] ?? '' }}</p>
                        </div>
                    @endif
                @endforeach
            </div>

            <p style="color: #888; margin-bottom: 1.5rem; padding: 0 0.5rem;">
                Agent ဖြစ်လိုပါက အောက်ပါ Channel များမှ ဆက်သွယ်ပေးပါ
            </p>

            <div class="agent-buttons">
                @foreach($data['agent'] ?? [] as $btn)
                    @if(str_starts_with($btn['item_key'] ?? '', 'agent_btn_'))
                        @php
                            $cls = str_contains($btn['item_key'], 'telegram')
                                ? 'btn-telegram'
                                : (str_contains($btn['item_key'], 'viber') ? 'btn-viber' : 'btn-primary');
                        @endphp
                        <a href="{{ $btn['link_url'] ?? '#' }}"
                           target="_blank" rel="noopener"
                           class="btn {{ $cls }}">
                            <i class="{{ $btn['icon'] ?? 'fas fa-link' }}"></i>
                            {{ $btn['link_text'] ?? '' }}
                        </a>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- Contact --}}
    <section id="contact">
        <div class="section-header">
            <div class="section-badge">Contact Us</div>
            <h2 class="section-title">ဆက်သွယ်ရန်</h2>
            <p class="section-subtitle">၂၄ နာရီ ၇ ရက် ကျွန်ုပ်တို့ အမြဲအဆင်သင့်</p>
        </div>

        <div class="contact-grid">
            @foreach($data['contact'] ?? [] as $c)
                @if(str_starts_with($c['item_key'] ?? '', 'contact_'))
                    <a href="{{ $c['link_url'] ?? '#' }}"
                       @if(str_starts_with($c['link_url'] ?? '', 'http')) target="_blank" rel="noopener" @endif
                       class="contact-card">
                        <i class="{{ $c['icon'] ?? 'fas fa-phone' }}"
                           style="color: {{ str_contains($c['item_key'], 'telegram') ? '#0088cc' : '#d4af37' }};"></i>
                        <h3>{{ $c['title'] ?? '' }}</h3>
                        <p>{{ $c['content'] ?? '' }}</p>
                    </a>
                @endif
            @endforeach
        </div>

        <div class="payment-methods">
            <h3><i class="fas fa-money-bill-wave"></i> ငွေပေးချေမှု နည်းလမ်းများ</h3>
            <div class="payment-icons">
                @foreach($data['contact'] ?? [] as $p)
                    @if(str_starts_with($p['item_key'] ?? '', 'payment_'))
                        <span class="payment-icon">{{ $p['title'] ?? '' }}</span>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer>
        <div class="footer-content">
            <div class="footer-brand">
                <h3>
                    <span class="logo-icon-sm">
                        <img src="{{ $get('brand', 'site_logo', 'image_url', 'https://pautpyaw.com/logo.png') }}"
                             alt="{{ $get('brand', 'site_name', 'title', 'ပေါက်ပျော်') }}"
                             onerror="this.style.display='none'">
                    </span>
                    <span style="background: linear-gradient(135deg, var(--gold), var(--gold-light)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">
                        {{ $get('brand', 'site_name', 'title', 'ပေါက်ပျော်') }}
                    </span>
                </h3>
                <p>{{ $get('brand', 'site_tagline', 'content', "Myanmar's Premium Betting Agent") }}</p>
            </div>

            <div class="footer-links">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#home">မူလစာမျက်နှာ</a></li>
                    <li><a href="#services">ဝန်ဆောင်မှုများ</a></li>
                    <li><a href="#how-to-join">အဖွဲ့ဝင်နည်း</a></li>
                </ul>
            </div>

            <div class="footer-links">
                <h4>Services</h4>
                <ul>
                    @foreach($data['services'] ?? [] as $s)
                        <li><a href="#services">{{ $s['title'] ?? '' }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="footer-links">
                <h4>Support</h4>
                <ul>
                    @foreach($data['contact'] ?? [] as $c)
                        @if(str_starts_with($c['item_key'] ?? '', 'contact_'))
                            <li>
                                <a href="{{ $c['link_url'] ?? '#' }}"
                                   @if(str_starts_with($c['link_url'] ?? '', 'http')) target="_blank" rel="noopener" @endif>
                                    {{ $c['title'] ?? '' }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>
                &copy; {{ $year }}
                {{ $get('brand', 'site_name', 'title', 'ပေါက်ပျော်') }} Agent. All Rights Reserved.
            </p>
            <div class="footer-badges">
                @foreach($data['footer'] ?? [] as $b)
                    @if(str_starts_with($b['item_key'] ?? '', 'footer_badge_'))
                        <span>{{ $b['value'] ?? '' }}</span>
                    @endif
                @endforeach
            </div>
        </div>
    </footer>

    {{-- Floating CTA --}}
    <a href="{{ $get('hero', 'btn_primary', 'link_url', 'https://t.me/PautPyaw') }}"
       target="_blank" rel="noopener" class="floating-cta">
        <i class="fab fa-telegram"></i>
    </a>

    <script>
    // =====================================================
    // NAV / UI (API call မလိုတော့ပါ)
    // =====================================================
    (function () {
        const $  = (sel, ctx = document) => ctx.querySelector(sel);
        const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));

        function initNav() {
            const navbar = $('#navbar');
            const mobileToggle = $('#mobileToggle');
            const navLinks = $('#navLinks');
            const navOverlay = $('#navOverlay');
            const body = document.body;

            window.addEventListener('scroll', () => {
                navbar.classList.toggle('scrolled', window.scrollY > 50);
            }, { passive: true });

            const openMenu = () => {
                navLinks.classList.add('active');
                navOverlay.classList.add('active');
                body.classList.add('menu-open');
                const icon = mobileToggle.querySelector('i');
                icon.classList.replace('fa-bars', 'fa-times');
            };
            const closeMenu = () => {
                navLinks.classList.remove('active');
                navOverlay.classList.remove('active');
                body.classList.remove('menu-open');
                const icon = mobileToggle.querySelector('i');
                icon.classList.replace('fa-times', 'fa-bars');
            };
            mobileToggle.addEventListener('click', () => {
                navLinks.classList.contains('active') ? closeMenu() : openMenu();
            });
            navOverlay.addEventListener('click', closeMenu);
            navLinks.querySelectorAll('a').forEach(a => a.addEventListener('click', closeMenu));
            document.addEventListener('keydown', e => e.key === 'Escape' && closeMenu());

            // Smooth scroll
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href === '#') return;
                    const target = document.querySelector(href);
                    if (!target) return;
                    e.preventDefault();
                    const navHeight = navbar.offsetHeight;
                    const top = target.getBoundingClientRect().top + window.pageYOffset - navHeight;
                    window.scrollTo({ top, behavior: 'smooth' });
                });
            });
        }

        let countersAnimated = false;
        function animateCounters() {
            if (countersAnimated) return;
            countersAnimated = true;
            $$('.stat-value[data-target]').forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;
                const interval = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        counter.textContent = target.toLocaleString() + '+';
                        clearInterval(interval);
                    } else {
                        counter.textContent = Math.floor(current).toLocaleString();
                    }
                }, 16);
            });
        }

        function animateMemberCounter() {
            const memberEl = $('#memberCounter');
            if (!memberEl) return;
            const raw = memberEl.textContent.replace(/[^0-9]/g, '');
            let current = parseInt(raw) || 50000;
            setInterval(() => {
                current += Math.floor(Math.random() * 3) + 1;
                memberEl.textContent = current.toLocaleString() + '+';
            }, 2500);
        }

        function initUIEffects() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        if (entry.target.classList.contains('hero-stats')) animateCounters();
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });

            $$('.service-card, .step-card, .promo-card, .testimonial-card, .contact-card, .agent-feature').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(30px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
            const heroStats = $('.hero-stats');
            if (heroStats) observer.observe(heroStats);

            animateMemberCounter();
            createParticles();
        }

        function createParticles() {
            const container = $('#particles');
            if (!container) return;
            const count = window.innerWidth < 768 ? 15 : 25;
            for (let i = 0; i < count; i++) {
                const p = document.createElement('div');
                p.className = 'particle';
                p.style.left = Math.random() * 100 + '%';
                p.style.animationDelay = Math.random() * 15 + 's';
                p.style.animationDuration = (10 + Math.random() * 12) + 's';
                const size = (2 + Math.random() * 3) + 'px';
                p.style.width = size;
                p.style.height = size;
                container.appendChild(p);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            initNav();
            initUIEffects();
        });
    })();
    </script>

</body>
</html>