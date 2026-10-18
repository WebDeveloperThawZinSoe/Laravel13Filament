{{-- ==================== LANDING PAGE STYLES ==================== --}}
{{-- Extracted from original HTML — no changes made --}}

:root {
    --primary: #d4af37;
    --primary-dark: #b8962e;
    --secondary: #f5d76e;
    --gold: #d4af37;
    --gold-light: #f5d76e;
    --gold-dark: #b8962e;
    --dark: #050505;
    --dark-2: #0a0a0a;
    --dark-3: #111111;
    --dark-4: #1a1a1a;
    --glass: rgba(212, 175, 55, 0.04);
    --glass-border: rgba(212, 175, 55, 0.12);
}

* { margin: 0; padding: 0; box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
html { scroll-behavior: smooth; -webkit-text-size-adjust: 100%; }

body {
    font-family: 'Noto Sans Myanmar', sans-serif;
    background: var(--dark);
    color: #e2e8f0;
    line-height: 1.6;
    overflow-x: hidden;
    min-height: 100vh;
    -webkit-font-smoothing: antialiased;
}

::-webkit-scrollbar { width: 6px; }
::-webkit-scrollbar-track { background: var(--dark); }
::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--gold-dark), var(--gold));
    border-radius: 3px;
}

/* ==================== NAVBAR ==================== */
.navbar {
    position: fixed; top: 0; left: 0; right: 0; z-index: 1000;
    padding: 0.9rem 1.5rem;
    display: flex; justify-content: space-between; align-items: center;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    background: transparent;
}
.navbar.scrolled {
    background: rgba(5, 5, 5, 0.96);
    backdrop-filter: blur(24px); -webkit-backdrop-filter: blur(24px);
    padding: 0.55rem 1.5rem;
    box-shadow: 0 4px 40px rgba(0, 0, 0, 0.7);
    border-bottom: 1px solid rgba(212, 175, 55, 0.1);
}
.nav-brand {
    display: flex; align-items: center; gap: 0.7rem;
    text-decoration: none; color: #fff;
    font-size: 1.35rem; font-weight: 800; letter-spacing: 0.3px;
    z-index: 1002; position: relative;
}
.nav-brand .logo-icon {
    width: 42px; height: 42px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    overflow: hidden; transition: all 0.3s ease;
    background: transparent; flex-shrink: 0;
}
.nav-brand .logo-icon img { width: 100%; height: 100%; object-fit: contain; border-radius: 0; }
.nav-brand:hover .logo-icon { transform: scale(1.08); filter: drop-shadow(0 0 15px rgba(212, 175, 55, 0.6)); }
.nav-brand span {
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}
.nav-links { display: flex; list-style: none; gap: 1.75rem; align-items: center; }
.nav-links a {
    color: #888; text-decoration: none; font-size: 0.92rem;
    font-weight: 500; transition: color 0.3s ease; position: relative;
}
.nav-links a:hover { color: var(--gold); }
.nav-links a::after {
    content: ''; position: absolute; bottom: -4px; left: 0;
    width: 0; height: 2px;
    background: linear-gradient(90deg, var(--gold), var(--gold-light));
    transition: width 0.3s ease; border-radius: 2px;
}
.nav-links a:hover::after { width: 100%; }
.nav-cta {
    background: linear-gradient(135deg, var(--gold-dark), var(--gold)) !important;
    color: #000 !important;
    padding: 0.55rem 1.35rem !important;
    border-radius: 50px; font-weight: 700 !important;
    transition: all 0.3s ease !important;
    box-shadow: 0 4px 20px rgba(212, 175, 55, 0.35);
}
.nav-cta:hover { transform: translateY(-2px); box-shadow: 0 8px 35px rgba(212, 175, 55, 0.55); }
.nav-cta::after { display: none !important; }
.mobile-toggle {
    display: none; background: none; border: none;
    color: var(--gold); font-size: 1.5rem; cursor: pointer;
    z-index: 1002; position: relative; width: 44px; height: 44px;
    border-radius: 12px; transition: all 0.3s ease;
}
.mobile-toggle:hover { background: rgba(212, 175, 55, 0.08); }

/* ==================== HERO ==================== */
.hero {
    min-height: 100vh; min-height: 100svh;
    display: flex; align-items: center; justify-content: center;
    text-align: center; padding: 7rem 1.5rem 3rem;
    position: relative; background: var(--dark); overflow: hidden;
}
.hero::before {
    content: ''; position: absolute; top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(ellipse at 30% 50%, rgba(212, 175, 55, 0.08) 0%, transparent 55%),
                radial-gradient(ellipse at 70% 50%, rgba(212, 175, 55, 0.05) 0%, transparent 55%);
    animation: heroGlow 18s ease-in-out infinite alternate;
}
@keyframes heroGlow {
    0% { transform: translate(0, 0) scale(1); }
    100% { transform: translate(-3%, -3%) scale(1.06); }
}
.hero-particles {
    position: absolute; top: 0; left: 0; right: 0; bottom: 0;
    overflow: hidden; pointer-events: none;
}
.particle {
    position: absolute; width: 3px; height: 3px;
    background: var(--gold); border-radius: 50%;
    opacity: 0.25; animation: float 15s infinite;
}
@keyframes float {
    0%, 100% { transform: translateY(100vh) rotate(0deg); opacity: 0; }
    10% { opacity: 0.35; }
    90% { opacity: 0.35; }
    100% { transform: translateY(-100vh) rotate(720deg); opacity: 0; }
}
.hero-content { position: relative; z-index: 1; max-width: 850px; width: 100%; }
.hero-badge {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.15), rgba(212, 175, 55, 0.05));
    border: 1px solid rgba(212, 175, 55, 0.35);
    color: var(--gold-light); padding: 0.5rem 1.15rem;
    border-radius: 50px; font-size: 0.82rem; font-weight: 600;
    margin-bottom: 1.35rem; backdrop-filter: blur(10px);
    animation: badgePulse 3s ease-in-out infinite;
}
@keyframes badgePulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(212, 175, 55, 0.2); }
    50% { box-shadow: 0 0 0 8px rgba(212, 175, 55, 0); }
}
.hero h1 {
    font-size: clamp(1.85rem, 6vw, 3.8rem);
    font-weight: 900; color: #fff; line-height: 1.2;
    margin-bottom: 1rem;
    text-shadow: 0 4px 40px rgba(0, 0, 0, 0.5); word-break: break-word;
}
.hero h1 .highlight {
    background: linear-gradient(135deg, var(--gold), var(--gold-light), #fef3c7);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text;
    filter: drop-shadow(0 0 30px rgba(212, 175, 55, 0.35));
    display: inline-block;
}
.hero p {
    font-size: clamp(0.92rem, 2.5vw, 1.15rem);
    color: #888; max-width: 620px; margin: 0 auto 1.75rem;
    line-height: 1.7; padding: 0 0.5rem;
}
.hero-buttons {
    display: flex; gap: 0.85rem; justify-content: center;
    flex-wrap: wrap; margin-bottom: 2.5rem; padding: 0 0.5rem;
}
.btn {
    padding: 0.9rem 1.9rem; border-radius: 50px;
    font-size: clamp(0.88rem, 2.2vw, 1rem); font-weight: 600;
    text-decoration: none;
    transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
    display: inline-flex; align-items: center; justify-content: center;
    gap: 0.5rem; position: relative; overflow: hidden;
    cursor: pointer; border: none; white-space: nowrap;
}
.btn-primary {
    background: linear-gradient(135deg, var(--gold-dark), var(--gold), var(--gold-light));
    color: #000; box-shadow: 0 4px 25px rgba(212, 175, 55, 0.4); font-weight: 700;
}
.btn-primary::before {
    content: ''; position: absolute; top: 0; left: -100%;
    width: 100%; height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
    transition: left 0.5s ease;
}
.btn-primary:hover::before { left: 100%; }
.btn-primary:hover { transform: translateY(-3px); box-shadow: 0 12px 40px rgba(212, 175, 55, 0.6); }
.btn-outline {
    background: transparent; border: 2px solid rgba(212, 175, 55, 0.3);
    color: var(--gold-light); backdrop-filter: blur(10px);
}
.btn-outline:hover {
    border-color: var(--gold); color: var(--gold);
    transform: translateY(-3px); box-shadow: 0 8px 30px rgba(212, 175, 55, 0.25);
}

/* Stats */
.hero-stats {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 0.75rem; max-width: 720px; margin: 0 auto; padding: 0 0.5rem;
}
.stat-item {
    text-align: center; padding: 1.1rem 0.5rem;
    background: var(--glass); border: 1px solid var(--glass-border);
    border-radius: 16px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px); position: relative; overflow: hidden;
}
.stat-item::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
    height: 2px; background: linear-gradient(90deg, transparent, var(--gold), transparent);
    opacity: 0; transition: opacity 0.4s ease;
}
.stat-item:hover::before { opacity: 1; }
.stat-item:hover {
    background: rgba(212, 175, 55, 0.06);
    border-color: rgba(212, 175, 55, 0.25);
    transform: translateY(-6px); box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
}
.stat-icon { font-size: clamp(1.3rem, 4vw, 2rem); margin-bottom: 0.35rem; line-height: 1; }
.stat-value {
    font-size: clamp(1.1rem, 3.5vw, 2rem); font-weight: 800;
    color: var(--gold); text-shadow: 0 0 30px rgba(212, 175, 55, 0.25);
    line-height: 1.2; word-break: break-word;
}
.stat-label { font-size: clamp(0.62rem, 1.8vw, 0.85rem); color: #777; line-height: 1.3; }

/* ==================== SECTION STYLES ==================== */
section { padding: 4rem 1.5rem; position: relative; }
.section-header { text-align: center; margin-bottom: 2.5rem; }
.section-badge {
    display: inline-flex; align-items: center; gap: 0.5rem;
    background: rgba(212, 175, 55, 0.08);
    border: 1px solid rgba(212, 175, 55, 0.2);
    color: var(--gold); padding: 0.35rem 1rem;
    border-radius: 50px; font-size: 0.78rem; font-weight: 600;
    margin-bottom: 0.85rem; letter-spacing: 0.5px;
}
.section-title {
    font-size: clamp(1.5rem, 5vw, 2.6rem); font-weight: 800;
    color: #fff; margin-bottom: 0.6rem; line-height: 1.25;
}
.section-subtitle {
    color: #777; font-size: clamp(0.88rem, 2.3vw, 1.1rem);
    max-width: 520px; margin: 0 auto; padding: 0 0.5rem;
}

/* ==================== SERVICES ==================== */
#services { background: var(--dark-2); }
.services-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem; max-width: 1200px; margin: 0 auto;
}
.service-card {
    background: var(--glass); border: 1px solid var(--glass-border);
    border-radius: 20px; padding: 1.75rem 1.5rem;
    transition: all 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative; overflow: hidden; backdrop-filter: blur(10px);
}
.service-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold-light));
    transform: scaleX(0);
    transition: transform 0.45s cubic-bezier(0.4, 0, 0.2, 1);
}
.service-card::after {
    content: ''; position: absolute; bottom: -50%; right: -50%;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.06), transparent 70%);
    opacity: 0; transition: opacity 0.45s ease; pointer-events: none;
}
.service-card:hover::before { transform: scaleX(1); }
.service-card:hover::after { opacity: 1; }
.service-card:hover {
    transform: translateY(-8px);
    border-color: rgba(212, 175, 55, 0.3);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.6), 0 0 0 1px rgba(212, 175, 55, 0.1);
}
.service-icon {
    width: 58px; height: 58px; border-radius: 16px;
    display: flex; align-items: center; justify-content: center;
    font-size: 1.5rem; margin-bottom: 1.15rem;
    position: relative; z-index: 1; transition: transform 0.3s ease;
    background: rgba(212, 175, 55, 0.1); color: var(--gold);
}
.service-card:hover .service-icon { transform: scale(1.1) rotate(-3deg); }
.service-card h3 {
    color: #fff; font-size: clamp(1.05rem, 3vw, 1.2rem);
    margin-bottom: 0.45rem; position: relative; z-index: 1;
}
.service-card p {
    color: #888; font-size: clamp(0.82rem, 2.2vw, 0.92rem);
    margin-bottom: 1.15rem; position: relative; z-index: 1; line-height: 1.6;
}
.service-card .btn-sm {
    display: inline-flex; align-items: center; gap: 0.45rem;
    background: rgba(212, 175, 55, 0.08); color: var(--gold);
    padding: 0.5rem 1rem; border-radius: 10px;
    text-decoration: none; font-size: 0.82rem; font-weight: 600;
    transition: all 0.35s ease; position: relative; z-index: 1;
    border: 1px solid rgba(212, 175, 55, 0.15);
}
.service-card .btn-sm:hover {
    background: linear-gradient(135deg, var(--gold-dark), var(--gold));
    color: #000; border-color: transparent;
    transform: translateX(5px); box-shadow: 0 4px 20px rgba(212, 175, 55, 0.4);
}
.service-card .btn-sm i { transition: transform 0.3s ease; }
.service-card .btn-sm:hover i { transform: translateX(3px); }

/* ==================== STEPS ==================== */
#how-to-join { background: var(--dark); }
.steps-container {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem; max-width: 1050px; margin: 0 auto;
}
.step-card {
    text-align: center; padding: 1.85rem 1.25rem;
    background: var(--glass); border: 1px solid var(--glass-border);
    border-radius: 20px; position: relative;
    transition: all 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
}
.step-card:hover {
    border-color: rgba(212, 175, 55, 0.3);
    transform: translateY(-8px); box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5);
}
.step-number {
    font-size: clamp(2.2rem, 7vw, 3.2rem); font-weight: 900;
    color: rgba(212, 175, 55, 0.1); line-height: 1;
    margin-bottom: 0.85rem; transition: color 0.4s ease;
}
.step-card:hover .step-number { color: rgba(212, 175, 55, 0.2); }
.step-icon {
    width: 54px; height: 54px; border-radius: 50%;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold));
    display: flex; align-items: center; justify-content: center;
    font-size: 1.25rem; margin: 0 auto 0.85rem; color: #000;
    box-shadow: 0 6px 25px rgba(212, 175, 55, 0.4); transition: transform 0.4s ease;
}
.step-card:hover .step-icon { transform: scale(1.1) rotate(5deg); }
.step-card h3 { color: #fff; font-size: clamp(0.98rem, 2.8vw, 1.1rem); margin-bottom: 0.45rem; }
.step-card p { color: #888; font-size: clamp(0.8rem, 2.1vw, 0.9rem); line-height: 1.5; }

/* ==================== PROMOTIONS ==================== */
#promotions { background: var(--dark-2); }
.promo-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem; max-width: 1150px; margin: 0 auto;
}
.promo-card {
    background: linear-gradient(145deg, rgba(212, 175, 55, 0.04), rgba(212, 175, 55, 0.01));
    border: 1px solid var(--glass-border); border-radius: 20px;
    padding: 1.85rem 1.25rem; text-align: center;
    position: relative; overflow: hidden;
    transition: all 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
}
.promo-card.featured {
    border-color: rgba(212, 175, 55, 0.4);
    background: linear-gradient(145deg, rgba(212, 175, 55, 0.1), rgba(212, 175, 55, 0.02));
    box-shadow: 0 0 40px rgba(212, 175, 55, 0.08);
}
.promo-card::before {
    content: ''; position: absolute; top: -50%; left: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle, rgba(212, 175, 55, 0.05), transparent 60%);
    opacity: 0; transition: opacity 0.5s ease; pointer-events: none;
}
.promo-card:hover::before { opacity: 1; }
.promo-card:hover { transform: translateY(-8px); box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5); }
.promo-badge {
    position: absolute; top: 12px; right: 12px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff; padding: 0.25rem 0.7rem; border-radius: 50px;
    font-size: 0.65rem; font-weight: 700; text-transform: uppercase;
    letter-spacing: 0.5px; box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
    animation: hotPulse 2s ease-in-out infinite;
}
@keyframes hotPulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}
.promo-icon {
    font-size: clamp(2rem, 6vw, 2.8rem); margin-bottom: 0.85rem;
    filter: drop-shadow(0 4px 10px rgba(0, 0, 0, 0.5)); line-height: 1;
}
.promo-value {
    font-size: clamp(1.7rem, 5.5vw, 2.6rem); font-weight: 900;
    background: linear-gradient(135deg, var(--gold), var(--gold-light));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
    background-clip: text; margin-bottom: 0.2rem;
    filter: drop-shadow(0 0 25px rgba(212, 175, 55, 0.25)); line-height: 1.15;
}
.promo-card h3 { color: #fff; font-size: clamp(0.95rem, 2.8vw, 1.1rem); margin-bottom: 0.45rem; }
.promo-card p { color: #888; font-size: clamp(0.78rem, 2.1vw, 0.9rem); margin-bottom: 0.95rem; line-height: 1.5; }
.promo-tag {
    display: inline-block; background: rgba(212, 175, 55, 0.08);
    color: var(--gold-light); padding: 0.3rem 0.8rem;
    border-radius: 50px; font-size: 0.75rem; font-weight: 600;
    border: 1px solid rgba(212, 175, 55, 0.15);
}

/* ==================== TESTIMONIALS ==================== */
#testimonials { background: var(--dark); }
.testimonials-grid {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem; max-width: 1200px; margin: 0 auto;
}
.testimonial-card {
    background: var(--glass); border: 1px solid var(--glass-border);
    border-radius: 20px; padding: 1.75rem 1.5rem;
    transition: all 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px); position: relative; overflow: hidden;
}
.testimonial-card::before {
    content: '"'; position: absolute; top: 8px; right: 16px;
    font-size: 3.5rem; color: rgba(212, 175, 55, 0.06);
    font-family: Georgia, serif; line-height: 1;
}
.testimonial-card:hover {
    border-color: rgba(212, 175, 55, 0.25);
    transform: translateY(-6px); box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5);
}
.testimonial-stars { color: var(--gold); margin-bottom: 0.75rem; font-size: 0.85rem; letter-spacing: 2px; }
.testimonial-card p {
    color: #aaa; font-size: clamp(0.82rem, 2.2vw, 0.9rem);
    margin-bottom: 1.15rem; font-style: italic;
    line-height: 1.7; position: relative; z-index: 1;
}
.testimonial-author { display: flex; align-items: center; gap: 0.7rem; }
.author-avatar {
    width: 40px; height: 40px; border-radius: 50%;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold));
    display: flex; align-items: center; justify-content: center;
    font-weight: 700; color: #000; font-size: 0.95rem;
    box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3); flex-shrink: 0;
}
.author-info h4 { color: #fff; font-size: clamp(0.82rem, 2.2vw, 0.9rem); line-height: 1.3; }
.author-info span { color: #777; font-size: clamp(0.68rem, 1.9vw, 0.78rem); }

/* ==================== AGENT ==================== */
#agent { background: linear-gradient(135deg, var(--dark-2), var(--dark)); }
.agent-content { max-width: 850px; margin: 0 auto; text-align: center; }
.agent-features {
    display: grid; grid-template-columns: repeat(4, 1fr);
    gap: 1.25rem; margin: 2rem 0;
}
.agent-feature {
    padding: 1.5rem 0.85rem; background: var(--glass);
    border: 1px solid var(--glass-border); border-radius: 18px;
    transition: all 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
}
.agent-feature:hover {
    border-color: rgba(212, 175, 55, 0.3);
    transform: translateY(-6px); box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
}
.agent-feature i {
    font-size: 1.7rem; color: var(--gold);
    margin-bottom: 0.75rem; transition: transform 0.3s ease;
}
.agent-feature:hover i { transform: scale(1.15); }
.agent-feature h3 { color: #fff; font-size: clamp(0.88rem, 2.5vw, 0.95rem); margin-bottom: 0.3rem; }
.agent-feature p { color: #888; font-size: clamp(0.75rem, 2vw, 0.85rem); line-height: 1.5; }
.agent-buttons { display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; }
.btn-telegram {
    background: linear-gradient(135deg, #0088cc, #0066aa);
    color: #fff; box-shadow: 0 4px 20px rgba(0, 136, 204, 0.35);
}
.btn-telegram:hover { transform: translateY(-3px); box-shadow: 0 12px 35px rgba(0, 136, 204, 0.5); }
.btn-viber {
    background: linear-gradient(135deg, #7360f2, #5a4bd1);
    color: #fff; box-shadow: 0 4px 20px rgba(115, 96, 242, 0.35);
}
.btn-viber:hover { transform: translateY(-3px); box-shadow: 0 12px 35px rgba(115, 96, 242, 0.5); }

/* ==================== CONTACT ==================== */
#contact { background: var(--dark-2); }
.contact-grid {
    display: grid; grid-template-columns: repeat(2, 1fr);
    gap: 1.25rem; max-width: 700px; margin: 0 auto 2rem;
}
.contact-card {
    text-align: center; padding: 1.85rem 1.25rem;
    background: var(--glass); border: 1px solid var(--glass-border);
    border-radius: 20px; text-decoration: none;
    transition: all 0.45s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px); display: block;
}
.contact-card:hover {
    border-color: var(--gold); transform: translateY(-8px);
    box-shadow: 0 20px 45px rgba(0, 0, 0, 0.5), 0 0 0 1px rgba(212, 175, 55, 0.15);
}
.contact-card i {
    font-size: clamp(1.8rem, 5vw, 2.2rem); margin-bottom: 0.85rem;
    transition: transform 0.3s ease; display: block;
}
.contact-card:hover i { transform: scale(1.15); }
.contact-card h3 { color: #fff; margin-bottom: 0.3rem; font-size: clamp(0.98rem, 2.8vw, 1.1rem); }
.contact-card p { color: #888; font-size: clamp(0.82rem, 2.2vw, 0.9rem); word-break: break-all; }
.payment-methods {
    text-align: center; padding: 1.85rem 1.5rem;
    background: var(--glass); border: 1px solid var(--glass-border);
    border-radius: 20px; max-width: 650px; margin: 0 auto;
    backdrop-filter: blur(10px);
}
.payment-methods h3 { color: #fff; margin-bottom: 1.1rem; font-size: clamp(1rem, 2.8vw, 1.15rem); }
.payment-icons { display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap; }
.payment-icon {
    padding: 0.7rem 1.2rem;
    background: rgba(212, 175, 55, 0.04);
    border: 1px solid rgba(212, 175, 55, 0.12);
    border-radius: 12px; color: #888;
    font-size: clamp(0.78rem, 2.1vw, 0.9rem); font-weight: 600;
    transition: all 0.35s ease; cursor: default;
}
.payment-icon:hover {
    border-color: var(--gold); color: var(--gold);
    transform: translateY(-3px); box-shadow: 0 8px 25px rgba(212, 175, 55, 0.15);
}

/* ==================== FOOTER ==================== */
footer {
    background: var(--dark); padding: 3rem 1.5rem 1.25rem;
    border-top: 1px solid rgba(212, 175, 55, 0.08);
}
.footer-content {
    max-width: 1050px; margin: 0 auto;
    display: grid; grid-template-columns: 2fr 1fr 1fr 1fr;
    gap: 2rem; margin-bottom: 2rem;
}
.footer-brand h3 {
    color: #fff; font-size: 1.35rem; margin-bottom: 0.65rem;
    display: flex; align-items: center; gap: 0.6rem;
}
.footer-brand h3 .logo-icon-sm {
    width: 38px; height: 38px; border-radius: 10px;
    overflow: hidden; display: inline-flex;
    align-items: center; justify-content: center;
    background: transparent; flex-shrink: 0;
}
.footer-brand h3 .logo-icon-sm img { width: 100%; height: 100%; object-fit: contain; }
.footer-brand p { color: #777; font-size: 0.88rem; line-height: 1.6; }
.footer-links h4 { color: var(--gold); margin-bottom: 1rem; font-size: 0.98rem; }
.footer-links ul { list-style: none; }
.footer-links li { margin-bottom: 0.5rem; }
.footer-links a {
    color: #777; text-decoration: none; font-size: 0.88rem;
    transition: all 0.3s ease; display: inline-block;
}
.footer-links a:hover { color: var(--gold); padding-left: 5px; }
.footer-bottom {
    max-width: 1050px; margin: 0 auto; padding-top: 1.5rem;
    border-top: 1px solid rgba(212, 175, 55, 0.06);
    display: flex; justify-content: space-between;
    align-items: center; flex-wrap: wrap; gap: 1rem;
}
.footer-bottom p { color: #555; font-size: 0.82rem; text-align: center; }
.footer-badges { display: flex; gap: 0.6rem; flex-wrap: wrap; justify-content: center; }
.footer-badges span {
    background: rgba(212, 175, 55, 0.06); color: var(--gold);
    padding: 0.3rem 0.75rem; border-radius: 8px;
    font-size: 0.7rem; font-weight: 600;
    border: 1px solid rgba(212, 175, 55, 0.12);
}

/* ==================== FLOATING CTA ==================== */
.floating-cta {
    position: fixed; bottom: 1.5rem; right: 1.5rem;
    z-index: 999; width: 58px; height: 58px; border-radius: 50%;
    background: linear-gradient(135deg, var(--gold-dark), var(--gold), var(--gold-light));
    display: flex; align-items: center; justify-content: center;
    box-shadow: 0 8px 30px rgba(212, 175, 55, 0.5);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    text-decoration: none; animation: floatPulse 3s ease-in-out infinite;
}
@keyframes floatPulse {
    0%, 100% { box-shadow: 0 8px 30px rgba(212, 175, 55, 0.5); }
    50% { box-shadow: 0 8px 30px rgba(212, 175, 55, 0.5), 0 0 0 12px rgba(212, 175, 55, 0.08); }
}
.floating-cta:hover {
    transform: scale(1.12);
    box-shadow: 0 12px 45px rgba(212, 175, 55, 0.7); animation: none;
}
.floating-cta i { color: #000; font-size: 1.4rem; }

/* ==================== LOADING OVERLAY ==================== */
.loading-overlay {
    position: fixed; inset: 0;
    background: var(--dark); z-index: 9999;
    display: flex; align-items: center; justify-content: center;
    flex-direction: column; gap: 1rem;
    transition: opacity 0.5s ease, visibility 0.5s ease;
}
.loading-overlay.hidden { opacity: 0; visibility: hidden; }
.loading-spinner {
    width: 48px; height: 48px;
    border: 3px solid rgba(212, 175, 55, 0.15);
    border-top-color: var(--gold);
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}
@keyframes spin { to { transform: rotate(360deg); } }
.loading-text {
    color: var(--gold); font-size: 0.9rem;
    font-weight: 600; letter-spacing: 1px;
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1024px) {
    .services-grid { grid-template-columns: repeat(2, 1fr); }
    .promo-grid { grid-template-columns: repeat(2, 1fr); }
    .testimonials-grid { grid-template-columns: repeat(2, 1fr); }
    .steps-container { grid-template-columns: repeat(2, 1fr); }
    .agent-features { grid-template-columns: repeat(2, 1fr); }
    .footer-content { grid-template-columns: repeat(2, 1fr); }
    .hero-stats { grid-template-columns: repeat(4, 1fr); }
}
@media (max-width: 900px) {
    .mobile-toggle { display: flex; align-items: center; justify-content: center; }
    .nav-links {
        position: fixed; top: 0; right: -100%;
        width: min(85vw, 340px); height: 100vh; height: 100dvh;
        background: linear-gradient(160deg, #0a0a0a 0%, #111111 100%);
        backdrop-filter: blur(30px); -webkit-backdrop-filter: blur(30px);
        flex-direction: column; justify-content: center; align-items: center;
        gap: 1.5rem; z-index: 1001;
        transition: right 0.45s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: -20px 0 60px rgba(0, 0, 0, 0.8);
        border-left: 1px solid rgba(212, 175, 55, 0.15);
        padding: 2rem 1.5rem; overflow-y: auto;
    }
    .nav-links::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--gold-dark), var(--gold), var(--gold-light));
    }
    .nav-links.active { right: 0; }
    .nav-links li {
        width: 100%; text-align: center;
        opacity: 0; transform: translateX(30px);
        transition: opacity 0.4s ease, transform 0.4s ease;
    }
    .nav-links.active li { opacity: 1; transform: translateX(0); }
    .nav-links.active li:nth-child(1) { transition-delay: 0.1s; }
    .nav-links.active li:nth-child(2) { transition-delay: 0.15s; }
    .nav-links.active li:nth-child(3) { transition-delay: 0.2s; }
    .nav-links.active li:nth-child(4) { transition-delay: 0.25s; }
    .nav-links.active li:nth-child(5) { transition-delay: 0.3s; }
    .nav-links.active li:nth-child(6) { transition-delay: 0.35s; }
    .nav-links a {
        font-size: 1.1rem; font-weight: 600;
        display: block; padding: 0.85rem 1rem;
        border-radius: 12px; transition: all 0.3s ease; color: #bbb;
    }
    .nav-links a::after { display: none; }
    .nav-links a:hover, .nav-links a:active {
        color: var(--gold); background: rgba(212, 175, 55, 0.08);
    }
    .nav-cta {
        margin-top: 0.5rem; font-size: 1rem !important;
        padding: 0.85rem 2rem !important;
        display: inline-block !important; width: auto !important;
    }
    .nav-overlay {
        position: fixed; top: 0; left: 0; right: 0; bottom: 0;
        background: rgba(0, 0, 0, 0.7); backdrop-filter: blur(4px);
        z-index: 1000; opacity: 0; visibility: hidden;
        transition: all 0.4s ease;
    }
    .nav-overlay.active { opacity: 1; visibility: visible; }
    .hero-stats { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    section { padding: 3.5rem 1rem; }
    .navbar { padding: 0.75rem 1rem; }
    .navbar.scrolled { padding: 0.5rem 1rem; }
    .nav-brand { font-size: 1.15rem; gap: 0.55rem; }
    .nav-brand .logo-icon { width: 38px; height: 38px; }
    .hero { padding: 6rem 1rem 2.5rem; }
    .hero-badge { font-size: 0.72rem; padding: 0.4rem 0.95rem; margin-bottom: 1.1rem; }
    .hero-buttons { flex-direction: column; align-items: stretch; gap: 0.7rem; padding: 0; }
    .hero-buttons .btn { width: 100%; padding: 0.85rem 1.5rem; }
    .hero-stats { grid-template-columns: repeat(2, 1fr); gap: 0.6rem; padding: 0; }
    .stat-item { padding: 0.95rem 0.4rem; border-radius: 14px; }
    .services-grid, .promo-grid, .testimonials-grid,
    .steps-container, .agent-features {
        grid-template-columns: 1fr; gap: 1rem;
    }
    .service-card { padding: 1.5rem 1.25rem; }
    .step-card { padding: 1.6rem 1.1rem; }
    .promo-card { padding: 1.6rem 1.1rem; }
    .testimonial-card { padding: 1.5rem 1.25rem; }
    .agent-feature { padding: 1.35rem 0.85rem; }
    .contact-grid { grid-template-columns: 1fr; gap: 1rem; }
    .contact-card { padding: 1.6rem 1.1rem; }
    .agent-buttons { flex-direction: column; align-items: stretch; }
    .agent-buttons .btn { width: 100%; }
    .footer-content { grid-template-columns: 1fr; gap: 1.75rem; text-align: center; }
    .footer-brand h3 { justify-content: center; }
    .footer-brand p { text-align: center; }
    .footer-bottom { flex-direction: column; text-align: center; gap: 0.85rem; }
    .floating-cta { width: 52px; height: 52px; bottom: 1.1rem; right: 1.1rem; }
    .floating-cta i { font-size: 1.25rem; }
    .section-header { margin-bottom: 2rem; }
    .payment-icons { gap: 0.55rem; }
    .payment-icon { padding: 0.6rem 1rem; font-size: 0.78rem; }
}
@media (max-width: 380px) {
    .hero-stats { grid-template-columns: 1fr 1fr; }
    .stat-value { font-size: 1rem; }
    .stat-label { font-size: 0.6rem; }
    .nav-brand { font-size: 1.05rem; }
    .nav-brand .logo-icon { width: 34px; height: 34px; }
    .hero-badge { font-size: 0.68rem; }
}
@media (max-height: 500px) and (orientation: landscape) {
    .hero { min-height: auto; padding: 6rem 1rem 3rem; }
    .hero h1 { font-size: 1.8rem; }
    .hero-stats { grid-template-columns: repeat(4, 1fr); }
}
body.menu-open { overflow: hidden; }