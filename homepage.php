<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Outfit:wght@300;500;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* 2) 🌈 Root Style System (Mandatory) */
        :root {
            /* 🌌 Colors */
            --Ml-bg-dark: #050A14;
            --Ml-glass-bg: rgba(255, 255, 255, 0.05);
            --Ml-glass-border: rgba(255, 255, 255, 0.1);
            --Ml-text-light: #FFFFFF;
            --Ml-text-muted: #8F97A5;

            /* 💫 Theme Gradients */
            --Ml-grad-primary: linear-gradient(45deg, #00D2FF, #3A7BD5);
            --Ml-grad-accent: linear-gradient(45deg, #FF6FD8, #B300FF);
            --Ml-grad-gold: linear-gradient(45deg, #FFD700, #FFA500);
            --Ml-grad-dark: linear-gradient(180deg, rgba(5,10,20,0) 0%, #050A14 100%);

            /* 🔤 Typography */
            --Ml-font-heading: "Outfit", sans-serif;
            --Ml-font-body: "Nunito", sans-serif;

            /* 🟣 Radius System */
            --Ml-radius-pill: 999px;
            --Ml-radius-full: 50%;
            --Ml-radius-card: 42px;

            /* 🌟 Glow + Shadows */
            --Ml-glow-primary: 0 0 32px rgba(0, 210, 255, 0.2);
            --Ml-glow-accent: 0 0 38px rgba(179, 0, 255, 0.25);
            --Ml-shadow-glass: 0 8px 32px 0 rgba(0, 0, 0, 0.3);

            /* 🎬 Motion */
            /* fluid physics feel */
            --Ml-ease-fluid: cubic-bezier(0.25, 0.46, 0.45, 0.94); 
        }

        /* Global Reset & Base */
        body {
            background-color: var(--Ml-bg-dark);
            color: var(--Ml-text-light);
            font-family: var(--Ml-font-body);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: var(--Ml-font-heading);
            font-weight: 700;
            margin: 0;
            letter-spacing: -0.02em;
        }

        p {
            line-height: 1.6;
            margin-bottom: 20px;
        }

        a, a:hover, a:focus {
            text-decoration: none;
            color: inherit;
            outline: none;
        }

        /* 3) 🧱 Wrapper Structure Utility */
        .Ml-page-homepage {
            position: relative;
            width: 100%;
            overflow: hidden;
        }

        /* --- Components --- */

        /* Buttons */
        .Ml-btn {
            display: inline-block;
            padding: 14px 36px;
            border-radius: var(--Ml-radius-pill);
            font-family: var(--Ml-font-heading);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 13px;
            border: none;
            cursor: pointer;
            transition: transform 0.3s var(--Ml-ease-fluid), box-shadow 0.3s;
            position: relative;
            overflow: hidden;
            z-index: 5;
        }

        .Ml-btn-primary {
            background: var(--Ml-grad-primary);
            color: white;
            box-shadow: var(--Ml-glow-primary);
        }

        .Ml-btn-accent {
            background: var(--Ml-grad-accent);
            color: white;
            box-shadow: var(--Ml-glow-accent);
        }
        
        .Ml-btn-outline {
            background: transparent;
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
        }
        .Ml-btn-outline:hover {
            background: rgba(255,255,255,0.1);
        }

        /* Gravity Hover Effect Class - SOFTENED */
        .Ml-gravity-target {
            /* Longer duration and fluid bezier for "underwater" feel */
            transition: transform 0.4s var(--Ml-ease-fluid); 
            will-change: transform;
        }

        /* SECTION: Topbar 
        */
        .Ml-wrapper-topbar {
            position: fixed;
            top: 20px;
            left: 0;
            right: 0;
            z-index: 1000;
            padding: 0 20px;
            pointer-events: none; /* Let clicks pass through outside navbar */
        }

        .Ml-navbar {
            pointer-events: auto;
            background: rgba(5, 10, 20, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--Ml-glass-border);
            border-radius: var(--Ml-radius-pill);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1140px;
            margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.4);
        }

        .Ml-brand {
            font-family: var(--Ml-font-heading);
            font-size: 24px;
            font-weight: 700;
            background: var(--Ml-grad-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            letter-spacing: -1px;
        }

        .Ml-nav-links a {
            color: var(--Ml-text-muted);
            margin-left: 25px;
            font-size: 14px;
            font-weight: 600;
            transition: color 0.3s;
        }

        .Ml-nav-links a:hover, .Ml-nav-links a.active {
            color: var(--Ml-text-light);
            text-shadow: 0 0 10px rgba(255,255,255,0.3);
        }

        /* SECTION: Hero 
        */
        .Ml-wrapper-hero {
            position: relative;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 50% 50%, rgba(0, 210, 255, 0.1) 0%, rgba(5, 10, 20, 0) 60%);
            padding-top: 60px;
        }

        .Ml-hero-content {
            text-align: center;
            z-index: 2;
            position: relative;
        }

        .Ml-hero-title {
            font-size: 60px;
            line-height: 1.05;
            margin-bottom: 24px;
            background: linear-gradient(180deg, #fff, #a0a0a0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .Ml-hero-subtitle {
            font-size: 22px;
            color: var(--Ml-text-muted);
            margin-bottom: 48px;
            font-weight: 300;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Floating Orbit Bubbles */
        .Ml-orbit-system {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            overflow: hidden;
        }

        .Ml-planet {
            position: absolute;
            border-radius: var(--Ml-radius-full);
            background-size: cover;
            background-position: center;
            box-shadow: 0 0 40px rgba(0,0,0,0.6);
            border: 1px solid rgba(255,255,255,0.15);
            animation: Ml-float 8s ease-in-out infinite;
            pointer-events: auto;
            cursor: pointer;
            transition: border-color 0.3s, transform 0.4s var(--Ml-ease-fluid);
        }
        
        .Ml-planet:hover {
            border-color: rgba(255,255,255,0.5);
            z-index: 10;
        }

        .Ml-planet::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: 50%;
            box-shadow: inset 0 0 20px rgba(0, 210, 255, 0.2);
        }

        .Ml-planet-1 { width: 90px; height: 90px; top: 20%; left: 15%; animation-delay: 0s; }
        .Ml-planet-2 { width: 140px; height: 140px; top: 15%; right: 18%; animation-delay: 1.5s; border-color: rgba(179, 0, 255, 0.3); }
        .Ml-planet-3 { width: 70px; height: 70px; bottom: 20%; left: 20%; animation-delay: 3s; }
        .Ml-planet-4 { width: 100px; height: 100px; bottom: 22%; right: 15%; animation-delay: 4.5s; border-color: rgba(179, 0, 255, 0.3); }

        @keyframes Ml-float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-30px); }
        }

        /* SECTION: Search (Holographic Pill)
        */
        .Ml-wrapper-search {
            position: relative;
            z-index: 10;
            margin-top: 20px;
        }

        .Ml-search-container {
            background: var(--Ml-glass-bg);
            backdrop-filter: blur(24px);
            border: 1px solid var(--Ml-glass-border);
            border-radius: var(--Ml-radius-pill);
            padding: 12px;
            display: flex;
            align-items: center;
            max-width: 860px;
            margin: 0 auto;
            box-shadow: var(--Ml-shadow-glass);
        }

        .Ml-search-group {
            flex: 1;
            padding: 0 24px;
            border-right: 1px solid rgba(255,255,255,0.08);
            position: relative;
        }

        .Ml-search-group:last-child {
            border-right: none;
            flex: 0 0 auto;
        }

        .Ml-search-label {
            display: block;
            font-size: 10px;
            text-transform: uppercase;
            color: var(--Ml-text-muted);
            letter-spacing: 1.5px;
            margin-bottom: 6px;
			display:none;
        }

        .Ml-search-input {
            width: 100%;
            background: transparent;
            border: none;
            color: var(--Ml-text-light);
            font-size: 18px;
            font-weight: 500;
            font-family: var(--Ml-font-heading);
            cursor: pointer;
        }

        .Ml-search-input:focus {
            outline: none;
        }

        .Ml-search-btn {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            border: none;
            background: var(--Ml-grad-accent);
            color: white;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: var(--Ml-glow-accent);
            cursor: pointer;
        }

        /* Generic Section Header */
        .Ml-section-header {
            text-align: center;
            margin-bottom: 70px;
        }
        
        .Ml-section-label {
            display: inline-block;
            font-size: 11px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: #00D2FF;
            margin-bottom: 15px;
            background: rgba(0, 210, 255, 0.1);
            padding: 5px 12px;
            border-radius: 20px;
        }

        .Ml-section-title {
            font-size: 42px;
            margin-bottom: 15px;
        }

        /* SECTION: How It Works (The Orbit Method)
        */
        .Ml-wrapper-method {
            padding: 70px 0;
            position: relative;
        }

        .Ml-step-card {
            text-align: center;
            padding: 40px 20px;
            position: relative;
        }
        
        .Ml-step-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 30px;
            background: var(--Ml-glass-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #00D2FF;
            border: 1px solid var(--Ml-glass-border);
            box-shadow: var(--Ml-glow-primary);
        }

        .Ml-step-title {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .Ml-step-desc {
            color: var(--Ml-text-muted);
            font-size: 15px;
        }

        /* Connector Line */
        .Ml-step-connector {
            position: absolute;
            top: 80px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: linear-gradient(90deg, rgba(255,255,255,0.05) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0.05) 100%);
            z-index: -1;
            display: none; /* Hidden on mobile */
        }
        @media(min-width: 992px) { .Ml-step-connector { display: block; } }


        /* SECTION: Featured (Constellation Layout)
        */
        .Ml-wrapper-featured {
            padding: 40px 0 60px;
            position: relative;
            background: radial-gradient(circle at 80% 20%, rgba(179, 0, 255, 0.08) 0%, transparent 50%);
        }

        .Ml-card {
            background: rgba(20, 25, 35, 0.4);
            border: 1px solid var(--Ml-glass-border);
            border-radius: var(--Ml-radius-card);
            overflow: hidden;
            position: relative;
            transition: all 0.4s var(--Ml-ease-fluid);
            height: 420px;
            margin-bottom: 30px;
            backdrop-filter: blur(10px);
        }

        /* Offset Layout */
        @media (min-width: 992px) {
            .col-md-4:nth-child(2) .Ml-card {
                margin-top: 60px; 
            }
			.Ml-hero-content {
				bottom: 70px;
			}
        }

        .Ml-card:hover {
            border-color: rgba(0, 210, 255, 0.4);
            box-shadow: var(--Ml-glow-primary);
            transform: translateY(-10px) scale(1.02);
        }

        /* FIX: Member Card Image Dimensions with High Specificity */
        .Ml-wrapper-featured .Ml-card.Ml-gravity-target .Ml-card-img {
            width: 100% !important;
            height: 270px !important; /* Fixed height for consistent grid */
            object-fit: cover !important;
            opacity: 0.7;
            transition: opacity 0.5s;
            display: block !important;
        }

        .Ml-card:hover .Ml-card-img {
            opacity: 0.3 !important;
        }

        .Ml-card-overlay {
            position: absolute;
            bottom: 5;
            left: 0;
            width: 100%;
            padding: 30px;
            background: linear-gradient(0deg, #050A14 10%, transparent 100%);
            transform: translateY(30px);
            transition: transform 0.4s var(--Ml-ease-fluid);
        }

        .Ml-card:hover .Ml-card-overlay {
            transform: translateY(0);
        }

        .Ml-user-name {
            font-size: 26px;
            margin-bottom: 5px;
        }

        .Ml-user-meta {
            background: var(--Ml-grad-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 15px;
            display: block;
        }

        .Ml-tag {
            display: inline-block;
            padding: 6px 14px;
            border-radius: var(--Ml-radius-pill);
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.05);
            font-size: 12px;
            margin-right: 5px;
            color: var(--Ml-text-light);
        }

        /* SECTION: Success Stories (Galaxy Chronicles)
        */
        .Ml-wrapper-stories {
            padding: 100px 0;
            background: rgba(255,255,255,0.02);
        }

        .Ml-story-card {
            background: var(--Ml-bg-dark);
            border: 1px solid var(--Ml-glass-border);
            border-radius: 30px;
            padding: 30px;
            position: relative;
            margin-bottom: 30px;
        }

        .Ml-story-header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .Ml-story-header .Ml-story-avatar {
            width: 60px !important;
            height: 60px !important;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #3A7BD5;
        }

        .Ml-quote {
            font-size: 18px;
            font-style: italic;
            color: var(--Ml-text-muted);
            margin-bottom: 20px;
        }

        .Ml-rating {
            color: #FFD700;
            font-size: 12px;
        }

        /* SECTION: Membership (Cosmic Access) - OPTIMIZED
        */
        .Ml-wrapper-membership {
            padding: 100px 0 120px;
        }

        .Ml-plan-card {
            background: var(--Ml-glass-bg);
            border: 1px solid var(--Ml-glass-border);
            border-radius: 32px;
            padding: 40px 30px;
            text-align: center;
            transition: all 0.4s var(--Ml-ease-fluid);
            position: relative;
            overflow: hidden;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .Ml-plan-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
        }

        /* Featured Card Styling */
        .Ml-plan-card.featured {
            background: linear-gradient(180deg, rgba(179, 0, 255, 0.1) 0%, rgba(5, 10, 20, 0.6) 100%);
            border: 1px solid rgba(179, 0, 255, 0.4);
            box-shadow: 0 10px 40px rgba(179, 0, 255, 0.1);
            transform: scale(1.05); /* Slight default scale */
            z-index: 2;
        }
        
        @media (max-width: 991px) {
            .Ml-plan-card.featured { transform: scale(1); margin-top: 0; margin-bottom: 30px;}
        }

        .Ml-plan-card.featured:hover {
            transform: scale(1.05) translateY(-8px);
            box-shadow: 0 20px 50px rgba(179, 0, 255, 0.25);
        }

        /* Badge for Featured */
        .Ml-plan-badge {
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            background: var(--Ml-grad-accent);
            color: white;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 8px 24px;
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
            box-shadow: 0 4px 20px rgba(179, 0, 255, 0.4);
        }

        .Ml-plan-name {
            font-size: 16px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 20px;
            color: var(--Ml-text-muted);
            margin-top: 10px;
        }

        .Ml-plan-price {
            font-size: 52px;
            font-weight: 700;
            margin-bottom: 30px;
            font-family: var(--Ml-font-heading);
            color: var(--Ml-text-light);
        }
        
        .Ml-plan-price span {
            font-size: 16px;
            color: var(--Ml-text-muted);
            font-weight: 400;
            vertical-align: middle;
        }

        .Ml-plan-features {
            list-style: none;
            padding: 0;
            margin-bottom: 40px;
            text-align: left;
            width: 100%;
            flex-grow: 1; /* Pushes button down */
            border-top: 1px solid rgba(255,255,255,0.05);
            padding-top: 25px;
        }

        .Ml-plan-features li {
            margin-bottom: 18px;
            color: var(--Ml-text-muted);
            font-size: 15px;
            display: flex;
            align-items: center;
        }

        .Ml-plan-features li i {
            color: #00D2FF;
            margin-right: 15px;
            width: 20px;
            text-align: center;
        }
        
        /* Specific glow for featured text */
        .Ml-plan-card.featured .Ml-plan-name {
            color: #E29FFF;
            text-shadow: 0 0 10px rgba(179,0,255,0.3);
        }

        /* SECTION: Footer 
        */
        .Ml-wrapper-footer {
            padding: 80px 0 40px;
            border-top: 1px solid var(--Ml-glass-border);
            background: #020408;
            color: var(--Ml-text-muted);
            font-size: 14px;
        }
        
        .Ml-footer-col h4 {
            color: white;
            margin-bottom: 25px;
            font-size: 18px;
        }

        .Ml-footer-links {
            list-style: none;
            padding: 0;
        }
        
        .Ml-footer-links li {
            margin-bottom: 12px;
        }
        
        .Ml-footer-links a:hover {
            color: #00D2FF;
        }

        .Ml-social-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255,255,255,0.05);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            transition: 0.3s;
        }
        
        .Ml-social-btn:hover {
            background: #00D2FF;
            color: white;
        }

        /* =========================================
           MEMBERS ROW RESPONSIVENESS FIX
           ========================================= */

        /* Tablet View (2 cards per row) */
        @media (min-width: 768px) and (max-width: 991px) {
            .Ml-wrapper-featured .row {
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
            }
            .Ml-wrapper-featured .col-sm-6 {
                width: 50%; /* Ensures exactly 2 cards per line */
                margin-bottom: 30px;
            }
            .Ml-card {
                height: 400px; /* Uniform height for tablet */
                margin-top: 0 !important; /* Removes desktop stagger */
            }
            /* Tablet Image Height Fix */
            .Ml-wrapper-featured .Ml-card.Ml-gravity-target .Ml-card-img {
                height: 220px !important;
            }
        }

        /* Mobile View (1 card per row) */
        @media (max-width: 767px) {
            .Ml-wrapper-hero {
                min-height: 60vh;
            }
            .Ml-hero-title { font-size: 42px; }
            .Ml-planet { display: none; }
            .Ml-search-container { flex-direction: column; border-radius: 30px; padding: 25px; }
            .Ml-search-group { width: 100%; border-right: none; border-bottom: 1px solid rgba(255,255,255,0.1); padding: 15px 0; }
            .Ml-search-btn { width: 100%; border-radius: var(--Ml-radius-pill); margin-top: 20px; }
            .Ml-navbar { padding: 15px; }

            .Ml-wrapper-featured .row {
                display: block; /* Standard stack */
                padding: 0 15px;
            }

            .Ml-wrapper-featured [class*="col-"] {
                width: 100% !important;
                float: none !important;
                clear: both;
                margin-bottom: 20px;
                padding: 0; /* Removes extra padding for full-width feel */
            }

            .Ml-card {
                height: 450px; /* Fixed height for mobile readability */
                margin-top: 0 !important; /* Removes desktop stagger */
                border-radius: 24px; /* Slightly tighter radius for small screens */
            }

            /* Force overlay visibility for touch */
            .Ml-card-overlay {
                transform: translateY(0) !important;
                background: linear-gradient(0deg, #050A14 40%, transparent 100%);
                padding: 25px 20px;
            }

            /* MOBILE Image Height and Width Fix */
            .Ml-wrapper-featured .Ml-card.Ml-gravity-target .Ml-card-img {
                width: 100% !important;
                height: 280px !important; /* Fixed forced height for mobile cards */
                opacity: 0.4; /* Better contrast for mobile text */
            }

            .Ml-user-name {
                font-size: 24px;
            }
            
            .Ml-plan-card { margin-bottom: 30px; }
        }
		.Ml-wrapper-search > .module{
			background:var(--Ml-bg-dark);
			border:none;
		}
		 @media (min-width: 769px) and (max-width: 991px){
    .Ml-plan-card {
        margin-bottom: 35px;
    }
}     
/* ================================
   SELECT2 DARK GLASS THEME (MATCHES Ml DESIGN)
   ================================ */

        /* Dropdown container */
        .select2-drop {
            background: var(--Ml-glass-bg) !important;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--Ml-glass-border) !important;
            border-radius: 20px !important;
            box-shadow: var(--Ml-shadow-glass);
            color: var(--Ml-text-light);
            overflow: hidden;
        }

        /* Search box wrapper */
        .select2-search {
            padding: 12px;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        /* Search input */
        .select2-search input.select2-input {
            width: 100%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 999px;
            padding: 10px 16px;
            color: var(--Ml-text-light);
            font-family: var(--Ml-font-heading);
            font-size: 14px;
            outline: none;
        }

        .select2-search input.select2-input::placeholder {
            color: var(--Ml-text-muted);
        }

        /* Results list */
        .select2-results {
            max-height: 260px;
            overflow-y: auto;
            padding: 6px 0;
        }

        /* Individual option */
        .select2-result {
            padding: 10px 18px;
            font-size: 14px;
            color: var(--Ml-text-muted);
            cursor: pointer;
            transition: background 0.3s var(--Ml-ease-fluid), color 0.3s;
        }

        /* Highlighted / Hovered option */
        .select2-result-selectable.select2-highlighted {
            background: linear-gradient(90deg, rgba(0,210,255,0.15), rgba(179,0,255,0.15));
            color: var(--Ml-text-light);
        }

        /* Selected text inside result */
        .select2-result-label {
            font-family: var(--Ml-font-body);
            font-weight: 500;
        }

        /* Selected value (closed state) */
        .select2-chosen {
            color: var(--Ml-text-light) !important;
            font-family: var(--Ml-font-heading);
            font-size: 15px;
        }

        /* Remove default arrow background bleed */
        .select2-container .select2-choice {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        /* Scrollbar styling */
        .select2-results::-webkit-scrollbar {
            width: 6px;
        }
        .select2-results::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.2);
            border-radius: 6px;
        }
        .select2-results::-webkit-scrollbar-track {
            background: transparent;
        }

    </style>
    <?php
    global $w;

    // Simple query to fetch 4 images from active members
    $res = mysql($w['database'], "SELECT up.file FROM users_data AS ud INNER JOIN users_photo AS up ON ud.user_id = up.user_id WHERE ud.active = '2' AND up.file != '' LIMIT 4");

    $images = [];
    while ($row = mysql_fetch_assoc($res)) {
        $images[] = $row['file'];
    }

    // Result: $images = ['url1.jpg', 'url2.jpg', 'url3.jpg', 'url4.jpg'];
    ?>
    <div class="Ml-page-homepage">

        <div class="Ml-wrapper-hero">
            <div class="Ml-orbit-system">
                <div class="Ml-planet Ml-planet-1 Ml-gravity-target" style="background-image: url('/pictures/profile/<?php echo $images[0];?>');"></div>
                <div class="Ml-planet Ml-planet-2 Ml-gravity-target" style="background-image: url('/pictures/profile/<?php echo $images[1];?>');"></div>
                <div class="Ml-planet Ml-planet-3 Ml-gravity-target" style="background-image: url('/pictures/profile/<?php echo $images[2];?>');"></div>
                <div class="Ml-planet Ml-planet-4 Ml-gravity-target" style="background-image: url('/pictures/profile/<?php echo $images[3];?>');"></div>
            </div>

            <div class="Ml-hero-content container">
                <h1 class="Ml-hero-title"><?php echo strip_tags(replaceChars($w, $wa['custom_130'])); ?></h1>
                <p class="Ml-hero-subtitle"><?php echo strip_tags(replaceChars($w, $wa['custom_131'])); ?></p>
                <div class="Ml-gravity-target">
					<a  href="/modern_listing" class="Ml-btn Ml-btn-primary">Start Matching</a>
                </div>
            </div>
        </div>

        <div class="Ml-wrapper-search">
        <?php 
        if ($pars[0]!= $w['default_search_url']) {
            $list_profession_model = new list_professions();
            $topCategory = $list_profession_model->get($pars[0],'filename');
            if ($topCategory != false){
                $topCategory = (is_object($topCategory))?$topCategory:$topCategory[0];
                $_GET['sid']= $topCategory->profession_id;
            }
            if ($pars[1]!=''){
                $list_services_model = new list_services();
                $sub_where = array(
                array('value' => $pars[1] , 'column' => 'filename', 'logic' => '='),
                array('value' => $_GET['sid'] , 'column' => 'profession_id', 'logic' => '='),
                array('value' => 0 , 'column' => 'master_id', 'logic' => '=')
                );
                $subCategory = $list_services_model->get($sub_where);
                if ($subCategory != false){
                    $subCategory = (is_object($subCategory))?$subCategory:$subCategory[0];
                    $_GET['tid']= $subCategory->service_id;
                }
            }
        }
        ?>
        <div class="module">
            <!-- <h2>%%%find_profession_label%%%</h2> -->
        <form action="/modern_listing" class="website-search"  accept-charset="UTF-8" method="get">

            <div class="form-group field-top-level-filter">
            <label style="color: var(--dc-text-muted)!important;">%%%home_search_dropdown_1%%%</label>
            <select data-placeholder="%%%home_search_default_1%%%" name="sid" id="sid" class="form-control">
                <option value="">%%%all_categories_label%%%</option>
                <?php echo listProfessions($_GET['sid'],"option",$w)?>
            </select>
            </div>

            <div class="form-group field-sub-level-filter">
            <label style="color: var(--dc-text-muted)!important;">%%%home_search_dropdown_2%%%</label>
            <select data-placeholder="%%%home_search_default_2%%%" name="tid" id="tid" class="form-control">
                <option value="">%%%all_categories_label%%%</option>
                <?php 
                echo listServices($_GET['tid'],"list",$w,$_GET['sid'],0,$w['fast_search']);
                ?>
            </select>
            </div>

            <div class="form-group field-location-filter">
            <label style="color: var(--dc-text-muted)!important;">%%%home_search_dropdown_3%%%</label>
            <input type="text" autocomplete="off" placeholder="%%%location_search_default%%%" class="googleSuggest googleLocation form-control" id="location_google_maps_homepage" name="location_value" value="<?php if ($_GET['location_value'] != '') { echo htmlspecialchars($_GET['location_value']); } ?>">
            </div>
            <div class="form-group nomargin field-submit-button">
            <button type="submit" class="dc-btn-gradient">%%%home_search_submit%%%</button>
            </div>    
        </form>
        </div>              </div>

        <div class="Ml-wrapper-method">
            <div class="container">
                <div class="Ml-section-header">
                    <span class="Ml-section-label">How It Works</span>
                    <h2 class="Ml-section-title">The Orbit Method</h2>
                    <p style="color:var(--Ml-text-muted);">Three simple steps to find your center of gravity.</p>
                </div>
                
                <div class="row relative">
                    <div class="Ml-step-connector"></div>
                    
                    <div class="col-md-4">
                        <div class="Ml-step-card Ml-gravity-target">
                            <div class="Ml-step-icon"><i class="fa fa-user-circle-o"></i></div>
                            <h3 class="Ml-step-title">Create Your Star</h3>
                            <p class="Ml-step-desc">Build a profile that glows. Share your vibes, interests, and magnetic traits.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="Ml-step-card Ml-gravity-target">
                            <div class="Ml-step-icon"><i class="fa fa-dot-circle-o"></i></div>
                            <h3 class="Ml-step-title">Enter Orbit</h3>
                            <p class="Ml-step-desc">Our algorithm pulls compatible matches into your view based on mutual gravity.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="Ml-step-card Ml-gravity-target">
                            <div class="Ml-step-icon"><i class="fa fa-comments-o"></i></div>
                            <h3 class="Ml-step-title">Spark Collision</h3>
                            <p class="Ml-step-desc">Break the ice. If the pull is strong, start a conversation and meet in real life.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                        <?php
                    /*
                    * Widget Name: Dynamic Orbit Members
                    */
                    global $Label, $wa, $w;

                    // --- 1. SETTINGS & CONFIGURATION (Logic at the Top) ---
                    $maxItems = $wa['custom_171'] ? $wa['custom_171'] : 3;
                    $onlyActiveMembers = true;
                    $hidePostsWithoutPhotos = true;
                    $memberNameLength = 25;
                    $locationLength = 30;

                    // SQL Construction
                    $sqlSelectParameters = array(
                        "ud.user_id", "ud.filename", "ud.first_name", "ud.last_name",
                        "ud.company", "ud.listing_type", "ud.state_code", "ud.city", 
                        "ud.country_ln", "ud.profession_id", "ud.subscription_id"
                    );

                    $sqlTablesParameters = array("`users_data` AS ud");
                    $sqlWhereParameters = array();
                    $sqlOrderByParameters = array("ud.signup_date DESC"); // Default to newest
                    $sqlLimitParameters = array($maxItems);

                    // Filters
                    if ($onlyActiveMembers) { $sqlWhereParameters[] = "ud.active = '2'"; }

                    // Join for Photos
                    if ($hidePostsWithoutPhotos) {
                        $sqlTablesParameters[] = "INNER JOIN `users_photo` AS up ON up.user_id = ud.user_id";
                        $sqlWhereParameters[] = "up.file != ''";
                    }

                    // Build Query
                    $sql = "SELECT " . implode(", ", $sqlSelectParameters);
                    $sql .= " FROM " . implode(" ", $sqlTablesParameters);
                    if (count($sqlWhereParameters) > 0) { $sql .= " WHERE " . implode(" AND ", $sqlWhereParameters); }
                    $sql .= " GROUP BY ud.user_id";
                    $sql .= " ORDER BY " . implode(", ", $sqlOrderByParameters);
                    $sql .= " LIMIT " . implode(", ", $sqlLimitParameters);

                    $featureResults = mysql($w['database'], $sql);
                    $featureNum = mysql_num_rows($featureResults);
                    ?>

                    <?php if ($featureNum > 0) { ?>
                    <div class="Ml-wrapper-featured">
                        <div class="container">
                            <div class="Ml-section-header">
                                <span class="Ml-section-label"><?php echo $wa['custom_124'] ? $wa['custom_124'] : 'Discover'; ?></span>
                                <h2 class="Ml-section-title"><?php echo $wa['custom_125'] ? $wa['custom_125'] : 'In Your Orbit'; ?></h2>
                                <p style="color: var(--Ml-text-muted);"><?php echo $Label['recent_members_sub_title'] ? $Label['recent_members_sub_title'] : 'Profiles gravitating towards your preferences right now.'; ?></p>
                            </div>

                            <div class="row">
                                <?php 
                                while ($post = mysql_fetch_array($featureResults)) {
                                    // Prepare Member Data
                                    $post = getUser($post['user_id'], $w);
                                    $profileLink = "/" . $post['filename'];
                                    
                                    // Name Logic
                                    $displayName = $post['first_name'] . ' ' . $post['last_name'];
                                    if (strlen($displayName) > $memberNameLength) {
                                        $displayName = mb_substr($displayName, 0, $memberNameLength, 'UTF-8') . '...';
                                    }

                                    // Location/Meta Logic
                                    $city = $post['city'];
                                    $state = $post['state_code'];
                                    $location = ($city && $state) ? $city . ', ' . $state : ($city ? $city : $state);
                                    
                                    // Image Logic
                                    $userPhotoData = getUserPhoto($post['user_id'], $post['listing_type'], $w);
                                    $userPhoto = $userPhotoData['file'];
                                    
                                    // Get Sub-Categories for Tags (limit to 2)
                                    $userTags = getMemberSubCategory($post['user_id'], "sub", "all", 2, "array");
                                ?>
                                <div class="col-md-4 col-sm-6">
                                    <div class="Ml-card Ml-gravity-target">
                                        <a href="<?php echo $profileLink; ?>">
                                            <img src="<?php echo $userPhoto; ?>" alt="<?php echo $displayName; ?>" class="Ml-card-img">
                                        </a>
                                        <div class="Ml-card-overlay">
                                            <h3 class="Ml-user-name"><?php echo $displayName; ?><?php echo $post['age'] ? ', '.$post['age'] : ''; ?></h3>
                    <span class="Ml-user-meta">
                        <?php 
                            $position = $post['position'];
                            echo $location . ' • ' . (strlen($position) > 15 ? substr($position, 0, 15) . '...' : $position);
                        ?>
                    </span>
                        
                        <?php if (!empty($userTags)) { ?>
                        <div class="Ml-tags">
                            <?php foreach ($userTags as $tag) { ?>
                                <span class="Ml-tag"><?php echo $tag['name']; ?></span>
                            <?php } ?>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>

        <div class="text-center" style="margin-top: 60px;">
            <a href="/<?php echo $w['default_search_url']; ?>" class="Ml-btn Ml-btn-accent Ml-gravity-target" style="text-decoration: none; display: inline-block;">
                Explore Galaxy
            </a>
        </div>
    </div>
</div>
        <?php } ?>  <?php
        /*
        * Widget Name: Dynamic Galaxy Chronicles (Stories)
        */
        global $wa, $w;

        // --- 1. SETTINGS & CONFIGURATION ---
        $maxItems = 2; // This line has been changed to specifically limit to 2
        $onlyActiveMembers = ($wa['post_reviews_onlyActiveMembers'] == "0") ? false : true;
        $sortingOrder = $wa['reviews_sort_order'] ? $wa['reviews_sort_order'] : "DESC";

        // Get allowed subscriptions for reviews
        $allowSubscriptions = array();
        $sqlCategoryId = mysql($w['database'], "SELECT subscription_id, data_settings FROM `subscription_types` WHERE data_settings LIKE '%3%'");
        while ($reviewId = mysql_fetch_assoc($sqlCategoryId)) {
            $getReviewId = explode(',', $reviewId['data_settings']);
            if (in_array("3", $getReviewId)) { $allowSubscriptions[] = $reviewId['subscription_id']; }
        }
        $allowSubscriptions = implode(",", $allowSubscriptions);

        // --- 2. SQL CONSTRUCTION ---
        $sqlSelectParameters = array("ur.review_id", "ur.review_title", "ur.review_description", "ur.rating_overall", "ud.user_id", "ud.filename");
        $sqlTablesParameters = array("`users_reviews` AS ur", "`users_data` AS ud", "`subscription_types` AS st");
        $sqlWhereParameters = array(
            "ur.user_id = ud.user_id",
            "ud.subscription_id = st.subscription_id",
            "ur.review_status = 2",
            "st.subscription_id IN (" . $allowSubscriptions . ")"
        );

        if ($onlyActiveMembers) { $sqlWhereParameters[] = "ud.active = '2'"; }

        $sql = "SELECT " . implode(", ", $sqlSelectParameters) . 
            " FROM " . implode(", ", $sqlTablesParameters) . 
            " WHERE " . implode(" AND ", $sqlWhereParameters) . 
            " ORDER BY ur.review_id " . $sortingOrder . 
            " LIMIT " . $maxItems;

        $featureResults = mysql($w['database'], $sql);
        $featureNum = mysql_num_rows($featureResults);
        ?>

<?php if ($featureNum > 0) { ?>
<div class="Ml-wrapper-stories">
    <div class="container">
        <div class="Ml-section-header">
            <span class="Ml-section-label">Testimonials</span>
            <h2 class="Ml-section-title">Galaxy Chronicles</h2>
        </div>
        
        <div class="row slickReviews">
            <?php while ($post = mysql_fetch_array($featureResults)) { 
                // Data Preparation
                $post = array_map('stripslashes', $post);
                $user = getUser($post['user_id'], $w);
                $userPhoto = getUserPhoto($user['user_id'], $user['listing_type'], $w);
                $avatar = $userPhoto['file'];
                $profileLink = "/" . $post['filename'];

                // Rating Logic
                $rating = round($post['rating_overall']);
            ?>
            <div class="col-md-6">
                <a href="<?php echo $profileLink; ?>" style="text-decoration: none; color: inherit;">
                    <div class="Ml-story-card Ml-gravity-target">
                        <div class="Ml-story-header">
                            <img src="<?php echo $avatar; ?>" class="Ml-story-avatar" alt="<?php echo $user['full_name']; ?>">
                            <div>
                                <h4 style="margin:0;"><?php echo $user['full_name']; ?></h4>
                                <div class="Ml-rating">
                                    <?php 
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $rating) {
                                            echo '<i class="fa fa-star"></i>';
                                        } else {
                                            echo '<i class="fa fa-star-o"></i>';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <p class="Ml-quote">"<?php echo mb_strimwidth($post['review_description'], 0, 150, "..."); ?>"</p>
                    </div>
                </a>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

<?php
    // Slider Logic (Optional: keeps the dynamic carousel working if enabled in BD)
    global $featureSliderEnabled, $featureMaxPerRow, $featureSliderClass, $postsCount;
    $postsCount = $featureNum;
    $featureSliderEnabled = $wa['reviews_posts_slider'];
    $featureMaxPerRow = $wa['post_reviews_per_row'] ? $wa['post_reviews_per_row'] : 2;
    $featureSliderClass = '.slickReviews';
    addonController::showWidget('post_carousel_slider', '1a19675a36d28232077972bbdb6bb7fe');
?>
<?php } ?>
 <div class="Ml-wrapper-membership">
            <div class="container">
                <div class="Ml-section-header">
                    <span class="Ml-section-label">Membership</span>
                    <h2 class="Ml-section-title">Cosmic Access</h2>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="Ml-plan-card Ml-gravity-target">
                            <h4 class="Ml-plan-name">Stargazer</h4>
                            <div class="Ml-plan-price">Free</div>
                            <ul class="Ml-plan-features">
                                <li><i class="fa fa-check"></i> Browse Profiles</li>
                                <li><i class="fa fa-check"></i> 5 Swipes / Day</li>
                                <li><i class="fa fa-check"></i> Basic Matching</li>
                                <li style="opacity:0.3;"><i class="fa fa-times"></i> See Who Likes You</li>
                            </ul>
                            <button class="Ml-btn Ml-btn-outline" style="width:100%">Join Free</button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="Ml-plan-card featured Ml-gravity-target">
                            <div class="Ml-plan-badge">Most Popular</div>
                            <h4 class="Ml-plan-name">Voyager</h4>
                            <div class="Ml-plan-price">$12<span>/mo</span></div>
                            <ul class="Ml-plan-features">
                                <li><i class="fa fa-check"></i> Unlimited Browsing</li>
                                <li><i class="fa fa-check"></i> See Who Likes You</li>
                                <li><i class="fa fa-check"></i> 3 Boosts / Week</li>
                                <li><i class="fa fa-check"></i> Advanced Filters</li>
                            </ul>
                            <button class="Ml-btn Ml-btn-accent" style="width:100%">Go Voyager</button>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="Ml-plan-card Ml-gravity-target">
                            <h4 class="Ml-plan-name">Galaxy</h4>
                            <div class="Ml-plan-price">$24<span>/mo</span></div>
                            <ul class="Ml-plan-features">
                                <li><i class="fa fa-check"></i> Everything in Voyager</li>
                                <li><i class="fa fa-check"></i> Priority Messages</li>
                                <li><i class="fa fa-check"></i> Incognito Mode</li>
                                <li><i class="fa fa-check"></i> Dedicated Concierge</li>
                            </ul>
                            <button class="Ml-btn Ml-btn-outline" style="width:100%">Go Galaxy</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
           </div>

 <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            
            // 🌌 Logic: Soft Gravity Hover Effect
            // Reduced strength and increased range for a "floating in water" feel
            
            const gravityStrength = 15; // Reduced from 30 for subtlety
            const range = 600; // Increased range for earlier detection

            $(document).on('mousemove', function(e) {
                // Using requestAnimationFrame for smoother visual updates
                requestAnimationFrame(() => {
                    $('.Ml-gravity-target').each(function() {
                        const $el = $(this);
                        const offset = $el.offset();
                        const width = $el.outerWidth();
                        const height = $el.outerHeight();

                        // Calculate center of element
                        const centerX = offset.left + width / 2;
                        const centerY = offset.top + height / 2;

                        // Calculate distance from cursor to element center
                        const deltaX = e.pageX - centerX;
                        const deltaY = e.pageY - centerY;
                        const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);

                        if (distance < range) {
                            // Calculate pull factor (smoother falloff)
                            const pull = (1 - distance / range) * gravityStrength;
                            
                            // Calculate movement direction
                            const moveX = (deltaX / distance) * pull;
                            const moveY = (deltaY / distance) * pull;

                            $el.css('transform', `translate(${moveX}px, ${moveY}px)`);
                        } else {
                            // Reset
                            $el.css('transform', 'translate(0px, 0px)');
                        }
                    });
                });
            });

            // Reset on mouse leave window
            $(document).on('mouseleave', function() {
                $('.Ml-gravity-target').css('transform', 'translate(0px, 0px)');
            });

        });



    </script>
<script>document.addEventListener("DOMContentLoaded", function() {
    // 1. Select the main form and apply the container/gravity classes
    const searchForm = document.querySelector('form.website-search');
    if (!searchForm) return;

    // Wrap the inner content of the form to create the Ml-search-container
    const formInner = searchForm.innerHTML;
    searchForm.innerHTML = `<div class="Ml-search-container Ml-gravity-target">${formInner}</div>`;
    searchForm.classList.add('Ml-custom-integration');

    const container = searchForm.querySelector('.Ml-search-container');
    const formGroups = searchForm.querySelectorAll('.form-group');

    formGroups.forEach((group) => {
        // 2. Add the search group class
        group.classList.add('Ml-search-group');

        // 3. Style the labels and inputs
        const label = group.querySelector('label');
        const input = group.querySelector('input, select');
        const button = group.querySelector('button');

        if (label) {
            label.className = 'Ml-search-label';
            // Optional: Map specific BD labels to your design labels
            if (label.innerText.includes('What do you need')) label.innerText = "I'm looking for";
            if (label.innerText.includes('Search by location')) label.innerText = "Near";
            if (label.innerText.includes('Specializing in')) label.innerText = "Vibe";
        }

        if (input) {
            input.className = 'Ml-search-input';
            // Remove BD specific processing IDs if necessary for styling
            input.removeAttribute('fdprocessedid');
        }

        // 4. Transform the Submit Button
        if (button) {
            button.className = 'Ml-search-btn';
            button.innerHTML = '<i class="fa fa-search"></i>';
            button.removeAttribute('fdprocessedid');
        }
    });

    // 5. Clean up: Remove BD default Bootstrap classes that might conflict
    const elementsToRemove = searchForm.querySelectorAll('.form-group, .form-control, .nomargin');
    elementsToRemove.forEach(el => {
        el.classList.remove('form-group', 'form-control', 'nomargin');
    });
});</script>