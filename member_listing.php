<?php
global $subscription;
?>
<?php 
// 1. PREPARE DATA (From your dynamic snippet)
if ($pars[0] != $w['default_search_url']) {
    $list_profession_model = new list_professions();
    $topCategory = $list_profession_model->get($pars[0], 'filename');
    if ($topCategory != false) {
        $topCategory = (is_object($topCategory)) ? $topCategory : $topCategory[0];
        $_GET['sid'] = $topCategory->profession_id;
    }
    if ($pars[1] != '') {
        $list_services_model = new list_services();
        $sub_where = array(
            array('value' => $pars[1], 'column' => 'filename', 'logic' => '='),
            array('value' => $_GET['sid'], 'column' => 'profession_id', 'logic' => '='),
            array('value' => 0, 'column' => 'master_id', 'logic' => '=')
        );
        $subCategory = $list_services_model->get($sub_where);
        if ($subCategory != false) {
            $subCategory = (is_object($subCategory)) ? $subCategory : $subCategory[0];
            $_GET['tid'] = $subCategory->service_id;
        }
    }
}
?>  
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>?</text></svg>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Outfit:wght@300;500;700;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 3.4.1 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
    <!-- FontAwesome 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">-->

    <style>
        /* --- ROOT VARIABLES --- */
        :root {
            --Ml-bg-dark: #050A14; 
            --Ml-text-light: #EAEAEA;
            --Ml-text-muted: #8892B0;
            --Ml-accent-cyan: #00F0FF;
            --Ml-accent-purple: #BC13FE;
            --Ml-accent-gold: #FFD700;
            --Ml-accent-green: #00FF94;
            
            --Ml-font-heading: "Outfit", sans-serif;
            --Ml-font-body: "Nunito", sans-serif;
            
            --Ml-ease-tech: cubic-bezier(0.19, 1, 0.22, 1);
        }

        /* --- GLOBAL BASE --- */
        html, body {
            /*width: 100%;
            height: 100%;*/
            background-color: var(--Ml-bg-dark);
            color: var(--Ml-text-light);
            font-family: var(--Ml-font-body);
            overflow-x: hidden; /* Critical for mobile to prevent side-scroll */
            -webkit-font-smoothing: antialiased;
            position: relative;
            background-image: 
                linear-gradient(rgba(0, 240, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 240, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            background-position: center top;
            background-attachment: fixed;
        }

        /* ? FILM GRAIN OVERLAY */
        .Ml-noise-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999; opacity: 0.05;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='1'/%3E%3C/svg%3E");
        }

        h1, h2, h3, h4 { font-family: var(--Ml-font-heading); margin: 0; }
        a, a:hover, button:focus { text-decoration: none; outline: none; color: inherit; }

        /* --- COMPONENTS --- */
        .Ml-btn {
            display: inline-block; padding: 12px 32px; border-radius: 4px;
            font-family: var(--Ml-font-heading); font-weight: 700; text-transform: uppercase; letter-spacing: 2px;
            font-size: 11px; border: none; cursor: pointer; transition: 0.3s; position: relative; overflow: hidden;
            clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
        }
        .Ml-btn-primary { background: var(--Ml-accent-cyan); color: #000; }
        .Ml-btn-primary:hover {  box-shadow: 0 0 20px var(--Ml-accent-cyan); }
        
        
        @media (hover: none) { .Ml-gravity-target { transition: none !important; transform: none !important; } }

        /* --- NAVIGATION --- */
        .Ml-wrapper-topbar { position: fixed; top: 20px; left: 0; right: 0; z-index: 1000; padding: 0 20px; pointer-events: none; }
        .Ml-navbar {
            pointer-events: auto; background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1); border-radius: 999px; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center; max-width: 1140px; margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
            position: relative; /* For mobile dropdown */
        }
        .Ml-brand { font-family: var(--Ml-font-heading); font-size: 24px; font-weight: 700; color: white; z-index: 1002; }
        
        /* Desktop Links */
        .Ml-nav-links { display: flex; align-items: center; }
        .Ml-nav-links a { color: var(--Ml-text-muted); margin-left: 25px; font-size: 14px; font-weight: 600; transition: 0.3s; }
        .Ml-nav-links a:hover, .Ml-nav-links a.active { color: white; text-shadow: 0 0 10px rgba(255,255,255,0.3); }
        
        /* Mobile Toggle */
        .Ml-mobile-toggle { display: none; color: white; font-size: 20px; cursor: pointer; z-index: 1002; }

        /* Mobile Menu Dropdown */
        .Ml-mobile-menu {
            display: none; position: absolute; top: 100%; left: 0; width: 100%;
            background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px);
            border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);
            padding: 20px; margin-top: 10px; text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .Ml-mobile-menu a { display: block; padding: 15px; color: white; font-family: var(--Ml-font-heading); font-size: 16px; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .Ml-mobile-menu a:last-child { border-bottom: none; }

        /* --- HERO --- */
        .Ml-browse-hero { padding-top: 40px; padding-bottom: 60px; position: relative; text-align: center; padding-left: 15px; padding-right: 15px; }
        .Ml-hero-badge {
            display: inline-block; border: 1px solid var(--Ml-accent-purple); color: var(--Ml-accent-purple);
            padding: 5px 12px; font-size: 10px; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 20px;
        }
        .Ml-hero-title { font-size: 48px !important; font-weight: 900; margin-bottom: 10px; text-transform: uppercase; letter-spacing: -1px; line-height: 1.1; }
        .Ml-hero-sub { color: var(--Ml-text-muted); font-family: monospace; letter-spacing: 1px; font-size: 14px; }

        /* --- LAYOUT --- */
        .Ml-browse-layout { display: flex; gap: 50px; position: relative; padding-top: 40px; }
        
        /* SIDEBAR */
        .Ml-sidebar { width: 280px; flex-shrink: 0; }
        
        /* --- PAGINATION CENTERING & STYLING --- */
.post-pagination-block {
    text-align: center; /* Centers the inline-block UL */
    margin: 60px 0;
    width: 100%;
    display: flex;
    justify-content: center;
}

.post-pagination-block .pagination {
    display: inline-flex;
    background: rgba(5, 10, 20, 0.8);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 5px;
    border-radius: 4px;
    margin: 0 auto;
    clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
}

.post-pagination-block .pagination > li {
    display: inline;
    margin: 0 3px;
}

.post-pagination-block .pagination > li > a,
.post-pagination-block .pagination > li > span {
    background: transparent;
    border: 1px solid rgba(0, 240, 255, 0.1);
    color: var(--Ml-text-muted);
    font-family: var(--Ml-font-heading);
    font-weight: 700;
    font-size: 14px;
    padding: 8px 16px;
    transition: all 0.3s var(--Ml-ease-tech);
    border-radius: 0 !important; /* Forces sharp corners */
}

/* Hover State */
.post-pagination-block .pagination > li > a:hover {
    background: rgba(0, 240, 255, 0.1);
    color: var(--Ml-accent-cyan);
    border-color: var(--Ml-accent-cyan);
    text-shadow: 0 0 10px var(--Ml-accent-cyan);
}

/* Active State (The Current Page) */
.post-pagination-block .pagination > .active > a,
.post-pagination-block .pagination > .active > a:hover,
.post-pagination-block .pagination > .active > a:focus {
    background: var(--Ml-accent-cyan) !important;
    color: #000 !important;
    border-color: var(--Ml-accent-cyan) !important;
    box-shadow: 0 0 15px rgba(0, 240, 255, 0.4);
}

/* Arrows styling (») */
.post-pagination-block .pagination > li:last-child > a {
    font-size: 18px;
    line-height: 1;
}
        .Ml-filter-header { font-family: monospace; color: var(--Ml-accent-cyan); font-size: 12px; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 15px; margin-bottom: 25px; display: flex; justify-content: space-between; }
        .Ml-filter-group { margin-bottom: 30px; }
        .Ml-filter-label { font-size: 11px; text-transform: uppercase; letter-spacing: 1px; color: white; margin-bottom: 15px; display: block; font-weight: 700; }
        
        /* Ranges */
        .Ml-range-wrapper { position: relative; height: 4px; background: rgba(255,255,255,0.1); margin: 10px 0 20px; }
        .Ml-range-track { position: absolute; height: 100%; background: var(--Ml-accent-purple); width: 60%; }
        .Ml-range-thumb { position: absolute; width: 12px; height: 12px; background: white; border-radius: 0; top: 50%; transform: translate(-50%, -50%) rotate(45deg); left: 60%; box-shadow: 0 0 10px var(--Ml-accent-purple); cursor: pointer; }
        .Ml-range-val { font-family: monospace; color: var(--Ml-text-muted); font-size: 11px; text-align: right; display: block; }

        /* Toggles */
        .Ml-tech-toggle { display: flex; align-items: center; justify-content: space-between; margin-bottom: 10px; cursor: pointer; }
        .Ml-toggle-box { width: 14px; height: 14px; border: 1px solid rgba(255,255,255,0.3); display: flex; align-items: center; justify-content: center; transition: 0.2s; }
        .Ml-tech-toggle.active .Ml-toggle-box { border-color: var(--Ml-accent-cyan); background: rgba(0, 240, 255, 0.1); }
        .Ml-tech-toggle.active .Ml-toggle-box::after { content: ''; width: 6px; height: 6px; background: var(--Ml-accent-cyan); }
        .Ml-toggle-text { font-size: 13px; color: var(--Ml-text-muted); }
        .Ml-tech-toggle.active .Ml-toggle-text { color: white; }

        /* MAIN FEED */
        .Ml-main-feed { flex-grow: 1; min-width: 0; /* Prevents flex item from overflowing */ }
        .Ml-feed-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; padding-bottom: 15px; border-bottom: 1px solid rgba(255,255,255,0.05); flex-wrap: wrap; gap: 15px; }
        .Ml-feed-title { font-size: 14px; font-family: monospace; color: var(--Ml-accent-cyan); letter-spacing: 1px; }
        
        .Ml-view-switcher { display: flex; gap: 5px; background: rgba(255,255,255,0.05); padding: 4px; border-radius: 4px; }
        .Ml-view-btn { border: none; background: transparent; color: var(--Ml-text-muted); width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; border-radius: 2px; transition: 0.2s; }
        .Ml-view-btn:hover { color: white; }
        .Ml-view-btn.active { background: var(--Ml-accent-cyan); color: #000; }

        /* =========================================
           CARD STYLES (GRID VIEW - DEFAULT)
           ========================================= */
        .Ml-grid-container { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px; }

        .Ml-crew-card {
            background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.1); padding: 20px;
            position: relative; transition: all 0.4s var(--Ml-ease-tech); overflow: hidden;
            clip-path: polygon(20px 0, 100% 0, 100% calc(100% - 20px), calc(100% - 20px) 100%, 0 100%, 0 20px);
            height: 100%; display: flex; flex-direction: column;
        }
        .Ml-crew-card:hover { background: rgba(255, 255, 255, 0.05); border-color: var(--Ml-accent-cyan); transform: translateY(-5px); }
        
        /* Holographic overlay */
        .Ml-crew-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 240, 255, 0.05) 50%, transparent 100%);
            transform: translateY(-100%); transition: transform 0.6s var(--Ml-ease-tech); pointer-events: none; z-index: 1;
        }
        .Ml-crew-card:hover::before { transform: translateY(100%); }

        /* Photo Grid View */
        .Ml-photo-frame { width: 100%; aspect-ratio: 1/1.1; margin-bottom: 20px; position: relative; border: 1px solid rgba(255,255,255,0.05); }
        .Ml-photo-frame::after {
            content: ''; position: absolute; bottom: -1px; right: -1px; width: 15px; height: 15px;
            border-bottom: 2px solid var(--Ml-accent-cyan); border-right: 2px solid var(--Ml-accent-cyan);
        }
        .Ml-photo { width: 100% !important; height: 100% !important; object-fit: cover; filter: grayscale(100%) contrast(1.1); transition: filter 0.5s; }
        .Ml-crew-card:hover .Ml-photo { filter: grayscale(0%) contrast(1); }

        /* Content Grid View */
        .Ml-role-tag { font-family: monospace; color: var(--Ml-accent-cyan); font-size: 11px; text-transform: uppercase; margin-bottom: 8px; display: block; letter-spacing: 1px; }
        .Ml-name { font-size: 24px; color: white; margin-bottom: 5px; font-weight: 700; }
        .Ml-bio { font-size: 13px; color: var(--Ml-text-muted); line-height: 1.5; margin-bottom: 20px; flex-grow: 1; }
        .Ml-card-footer { border-top: 1px solid rgba(255,255,255,0.1); padding-top: 15px; display: flex; justify-content: space-between; align-items: center; }
        .Ml-match-stat { font-family: monospace; color: white; font-size: 12px; }
        .Ml-match-stat span { color: var(--Ml-accent-cyan); }
        .Ml-icon-btn { background: transparent; border: 1px solid rgba(255,255,255,0.2); color: white; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; transition: 0.3s; cursor: pointer; border-radius:50%;}
        .Ml-icon-btn:hover { background: var(--Ml-accent-cyan); color: black; border-color: var(--Ml-accent-cyan); }

        /* Featured Badge */
        .Ml-featured-badge { 
            position: absolute; top: 10px; right: 10px; 
            background: var(--Ml-accent-gold); color: black; 
            font-size: 7px; font-weight: 800; text-transform: uppercase; 
            padding: 4px 8px; letter-spacing: 1px; z-index: 5; 
        }
        
        .Ml-crew-card.featured { border-color: var(--Ml-accent-gold); background: radial-gradient(circle at 50% 0%, rgba(255, 215, 0, 0.05), transparent 70%); }
        .Ml-crew-card.featured .Ml-role-tag { color: var(--Ml-accent-gold); }
        .Ml-crew-card.featured .Ml-photo-frame::after { border-color: var(--Ml-accent-gold); }
        .Ml-crew-card.featured:hover { border-color: var(--Ml-accent-gold); box-shadow: 0 0 30px rgba(255, 215, 0, 0.15); }

        /* =========================================
           LIST VIEW (CORRECTED & RESPONSIVE)
           ========================================= */
        .view-list .Ml-grid-container { grid-template-columns: 1fr; gap: 20px; }

        .view-list .Ml-crew-card {
            flex-direction: row; align-items: center; padding: 15px;
            min-height: 120px; /* Ensured height */
            clip-path: polygon(15px 0, 100% 0, 100% 100%, 0 100%, 0 15px);
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);
        }
        
        .view-list .Ml-crew-card:hover { transform: translateX(10px); background: rgba(255,255,255,0.06); border-color: var(--Ml-accent-cyan); }

        .view-list .Ml-photo-frame {
            width: 100px; height: 100px; aspect-ratio: 1/1; margin: 0 25px 0 0; border: 1px solid rgba(255,255,255,0.1); flex-shrink: 0;
        }
        .view-list .Ml-photo { height: 100%; }
        .view-list .Ml-photo-frame::after { display: none; }

        .view-list .Ml-card-content { display: flex; flex-grow: 1; justify-content: space-between; align-items: center; padding: 0; }
        .view-list .Ml-info-group { display: flex; flex-direction: column; justify-content: center; text-align: left; }
        .view-list .Ml-role-tag { margin-bottom: 4px; font-size: 10px; opacity: 0.7; }
        .view-list .Ml-name { font-size: 16px; margin: 0; line-height: 1.2; }
        .view-list .Ml-bio { display: block; font-size: 12px; color: var(--Ml-text-muted); margin: 5px 0 0 0; max-width: 400px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .view-list .Ml-card-footer { border: none; padding: 0; margin-left: auto; display: flex; flex-direction: column; align-items: flex-end; gap: 10px; min-width: 100px; }
        

        /* List View Badge Fix */
        .view-list .Ml-crew-card.featured .Ml-featured-badge { left: 0; top: 0; right: auto; border-radius: 0 0 8px 0; font-size: 8px; padding: 3px 10px; }

        /* --- MAP VIEW --- */
        .Ml-map-view {
            display: none; width: 100%; height: 600px;
            background: radial-gradient(circle at 50% 50%, #0B1524 0%, #020408 100%);
            border: 1px solid rgba(255,255,255,0.1); border-radius: 4px; position: relative; overflow: hidden;
            background-image: linear-gradient(rgba(0, 240, 255, 0.05) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 240, 255, 0.05) 1px, transparent 1px);
            background-size: 50px 50px;
        }
        .Ml-radar-sweep {
            position: absolute; top: 50%; left: 50%; width: 100%; height: 100%; transform: translate(-50%, -50%);
            background: conic-gradient(from 0deg, transparent 0%, rgba(0, 240, 255, 0.1) 20%, transparent 40%);
            border-radius: 50%; animation: Ml-radar-spin 4s linear infinite; pointer-events: none;
        }
        @keyframes Ml-radar-spin { from { transform: translate(-50%, -50%) rotate(0deg); } to { transform: translate(-50%, -50%) rotate(360deg); } }
        .Ml-map-pin { position: absolute; width: 16px; height: 16px; background: var(--Ml-accent-cyan); border-radius: 50%; box-shadow: 0 0 10px var(--Ml-accent-cyan); cursor: pointer; transition: 0.3s; z-index: 5; }
        .Ml-map-pin::before { content: ''; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 40px; height: 40px; border: 1px solid var(--Ml-accent-cyan); border-radius: 50%; opacity: 0; animation: Ml-ping 2s infinite; }
        @keyframes Ml-ping { 0% { width: 10px; height: 10px; opacity: 0.8; } 100% { width: 60px; height: 60px; opacity: 0; } }
        .Ml-map-tooltip {
            position: absolute; bottom: 25px; left: 50%; transform: translateX(-50%);
            background: rgba(11, 16, 33, 0.9); border: 1px solid var(--Ml-accent-cyan); padding: 10px; width: 180px; text-align: center;
            opacity: 0; pointer-events: none; transition: 0.2s; clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
        }
        .Ml-map-pin:hover .Ml-map-tooltip { opacity: 1; bottom: 30px; }
        .Ml-map-tooltip h5 { color: white; margin-bottom: 2px; font-size: 14px; }
        .Ml-map-tooltip span { color: var(--Ml-accent-cyan); font-size: 10px; font-family: monospace; }

        /* Footer */
        .Ml-footer { padding: 80px 0 40px; border-top: 1px solid rgba(255,255,255,0.05); background: #020408; font-size: 14px; color: #888; margin-top: 80px; }
        .Ml-footer-col h4 { color: white; margin-bottom: 25px; font-size: 18px; }
        .Ml-footer-links { list-style: none; padding: 0; }
        .Ml-footer-links li { margin-bottom: 12px; }
        .Ml-footer-links a { color: #888; transition: 0.3s; }
        .Ml-footer-links a:hover { color: var(--Ml-accent-cyan); }
        .Ml-social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; transition: 0.3s; color: white; }
        .Ml-social-btn:hover { background: var(--Ml-accent-cyan); color: black; }

        /* ☄️ ASTEROID SYSTEM STYLES */
        .Ml-asteroid-system { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; overflow: hidden; }
        .Ml-asteroid { position: absolute; border-radius: 50%; background: #fff; box-shadow: 0 0 15px 2px rgba(255, 255, 255, 0.4), 0 0 30px 5px rgba(0, 240, 255, 0.6); opacity: 0; }
        .Ml-asteroid::after { content: ''; position: absolute; top: 50%; left: 50%; width: 100px; height: 2px; background: linear-gradient(90deg, rgba(255,255,255,0.5), transparent); transform-origin: left center; transform: translateY(-50%) rotate(180deg); }
        @keyframes Ml-fly-diag-1 { 0% { transform: translate(-100px, -100px) rotate(45deg); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translate(120vw, 120vh) rotate(45deg); opacity: 0; } }
        @keyframes Ml-fly-diag-2 { 0% { transform: translate(100vw, -100px) rotate(135deg); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translate(-100px, 120vh) rotate(135deg); opacity: 0; } }
        .Ml-asteroid-1 { top: 0; left: 0; width: 4px; height: 4px; animation: Ml-fly-diag-1 27s linear infinite; animation-delay: 0s; }
        .Ml-asteroid-2 { top: 20%; left: -100px; width: 3px; height: 3px; box-shadow: 0 0 10px 1px rgba(179, 0, 255, 0.6); animation: Ml-fly-diag-1 35s linear infinite; animation-delay: 15s; }
        .Ml-asteroid-3 { top: -100px; right: 20%; width: 5px; height: 5px; animation: Ml-fly-diag-2 22s linear infinite; animation-delay: 7s; }

        /* =========================================
           RESPONSIVE & MEDIA QUERIES
           ========================================= */
        
        /* Tablet & Large Phone (Stacking Layout) */
        @media (max-width: 991px) {
            .Ml-nav-links.hidden-xs { display: none !important; }
            .Ml-mobile-toggle { display: block; }
            .Ml-browse-layout { flex-direction: column; gap: 30px; }
            .Ml-sidebar { width: 100%; margin-bottom: 0; }
            .Ml-feed-header { flex-direction: column; align-items: flex-start; gap: 15px; }
            .Ml-view-switcher { width: 100%; justify-content: space-between; }
            .Ml-view-btn { flex: 1; }
        }

        /* Mobile & Fold (List View Reflow) */
        @media (max-width: 768px) {
            /* Force List View to stack on mobile for readability */
            .view-list .Ml-crew-card { flex-direction: column; align-items: flex-start; height: auto; border-radius: 12px; clip-path: none; }
            .view-list .Ml-photo-frame { width: 60px; height: 60px; margin-right: 0; margin-bottom: 15px; border-radius: 50%; overflow: hidden; border: 1px solid rgba(255,255,255,0.3); }
            .view-list .Ml-card-content { flex-direction: column; align-items: flex-start; width: 100%; gap: 15px; }
            .view-list .Ml-info-group { width: 100%; max-width: 100%; }
            .view-list .Ml-card-footer { margin-left: 0; width: 100%; flex-direction: row; justify-content: space-between; align-items: center; }
            .view-list .Ml-bio { white-space: normal; max-height: 60px; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 10px; }
            
            /* Fix Badge Position for Stacked List */
            .view-list .Ml-crew-card.featured .Ml-featured-badge { left: auto; right: 0; top: 0; border-radius: 0 12px 0 8px; }
            
            /* Hero Text */
            .Ml-hero-title { font-size: 36px; }
        }

        /* Ultra Small / Fold (320px) */
        @media (max-width: 480px) {
            .Ml-hero-title { font-size: 32px; }
            .Ml-browse-layout { padding-top: 20px; }
            .Ml-sidebar { display: none; } /* Optionally hide sidebar or make it a drawer */
            /* Re-enable sidebar as a compact block if needed, but usually hide on tiny screens or use a button */
        }
		.post-search-result-count{
			display:none;
		}
		#map-canvas{
			height:100vh;
		}
        /* This allows the grid to work even with the BD wrapper divs */
        #main-container > div {
            width: auto !important;
            display: block;
        }
        /* --- UPDATED SIDEBAR INPUTS --- */

        /* Range Slider Styling (Making it scrollable/draggable) */
        .Ml-input-range {
            -webkit-appearance: none;
            width: 100%;
            height: 4px;
            background: rgba(255, 255, 255, 0.1);
            outline: none;
            margin: 15px 0;
            cursor: pointer;
        }

        .Ml-input-range::-webkit-slider-thumb {
            -webkit-appearance: none;
            width: 12px;
            height: 12px;
            background: var(--Ml-accent-cyan);
            transform: rotate(45deg);
            box-shadow: 0 0 10px var(--Ml-accent-cyan);
            transition: 0.2s;
        }

        /* Age Input Boxes */
        .Ml-age-input-wrapper {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .Ml-input-text {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 12px;
            font-family: monospace;
            font-size: 13px;
            outline: none;
            transition: 0.3s;
        }

        .Ml-input-text:focus {
            border-color: var(--Ml-accent-cyan);
            background: rgba(0, 240, 255, 0.05);
        }

        .Ml-separator {
            font-size: 10px;
            font-family: monospace;
            color: var(--Ml-text-muted);
        }

        /* Dropdown / Select Styling */
        .Ml-select-wrapper {
            position: relative;
            width: 100%;
        }

        .Ml-input-select {
            width: 100%;
            background: rgba(5, 10, 20, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
            padding: 10px;
            font-family: var(--Ml-font-body);
            font-size: 13px;
            appearance: none; /* Removes browser default arrow */
            -webkit-appearance: none;
            outline: none;
            cursor: pointer;
        }

        /* Custom Cyber Arrow for Select */
        .Ml-select-wrapper::after {
            content: '\f107'; /* FontAwesome Angle Down */
            font-family: 'FontAwesome';
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--Ml-accent-cyan);
            pointer-events: none;
        }

        .Ml-input-select:focus {
            border-color: var(--Ml-accent-purple);
        }

        /* Chrome/Safari: Hide number input arrows */
        .Ml-input-text::-webkit-inner-spin-button, 
        .Ml-input-text::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }/* --- SINGLE AGE INPUT STYLING --- */
        .Ml-age-single {
            width: 100%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--Ml-accent-cyan); /* Cyan text for input */
            padding: 12px;
            font-family: monospace;
            font-size: 14px;
            outline: none;
            transition: 0.3s var(--Ml-ease-tech);
            text-align: center;
            letter-spacing: 2px;
        }

        .Ml-age-single:focus {
            border-color: var(--Ml-accent-cyan);
            background: rgba(0, 240, 255, 0.1);
            box-shadow: inset 0 0 10px rgba(0, 240, 255, 0.2);
        }

        /* Specific styling for the placeholder text */
        .Ml-age-single::placeholder {
            color: var(--Ml-text-muted);
            opacity: 0.5;
            font-size: 11px;
            text-transform: uppercase;
        }

        /* Keep the sidebar clean by removing default browser number arrows */
        .Ml-age-single::-webkit-inner-spin-button, 
        .Ml-age-single::-webkit-outer-spin-button { 
            -webkit-appearance: none; 
            margin: 0; 
        }
        /* Ensure the wrapper doesn't have a margin that breaks the grid math */
        .Ml-grid-item {
            margin-left: 0 !important;
            margin-right: 0 !important;
        }
        /* Prevent clip-path from cutting off dropdowns */




        /* styling for standard select if Select2 is disabled */
        .Ml-input-select {
            position: relative;
            z-index: 5;
        }
        #map-canvas {
            height: 100vh;
        }
        /* FIX SELECT DROPDOWN POSITION ISSUE */
        .Ml-telemetry-panel:focus-within {
            clip-path: none !important;
        }
        /* Disable transform for sidebar to protect selects */
        .Ml-sidebar .Ml-gravity-target {
            transform: none !important;
        }
        /* =========================================
        SELECT2 – CYBER / ML THEME OVERRIDES
        ========================================= */

        /* Main selected box */
        .select2-container .select2-choice,
        .select2-container--default .select2-selection--single {
            background: rgba(5, 10, 20, 0.95);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            height: 42px;
            line-height: 40px;
            padding: 0 40px 0 14px;
            font-family: var(--Ml-font-body);
            font-size: 13px;
            border-radius: 0;
            clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
        }

        /* Selected text */
        .select2-chosen,
        .select2-selection__rendered {
            color: white;
            font-weight: 600;
        }

        /* Arrow */
        .select2-arrow,
        .select2-selection__arrow {
            right: 12px;
        }

        .select2-arrow b,
        .select2-selection__arrow b {
            border-color: var(--Ml-accent-cyan) transparent transparent transparent !important;
        }

        /* Hover / Focus */
        .select2-container-active .select2-choice,
        .select2-container--open .select2-selection--single {
            border-color: var(--Ml-accent-cyan);
            box-shadow: 0 0 12px rgba(0,240,255,0.3);
        }

        /* =========================================
        DROPDOWN PANEL
        ========================================= */

        .select2-drop,
        .select2-dropdown {
            background: rgba(5, 10, 20, 0.98);
            border: 1px solid var(--Ml-accent-cyan);
            box-shadow: 0 20px 40px rgba(0,0,0,0.7);
            margin-top: 6px;
            border-radius: 0;
            clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
        }

        /* Search box */
        .select2-search input,
        .select2-search__field {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.2);
            color: white;
            font-family: monospace;
            font-size: 12px;
            padding: 8px 10px;
        }

        /* Results list */
        .select2-results,
        .select2-results__options {
            max-height: 240px;
        }

        /* Option item */
        .select2-result-label,
        .select2-results__option {
            padding: 10px 14px;
            font-size: 13px;
            color: var(--Ml-text-muted);
            font-family: var(--Ml-font-body);
            transition: 0.2s;
        }

        /* Hovered option */
        .select2-result-selectable:hover,
        .select2-results__option--highlighted {
            background: rgba(0,240,255,0.12);
            color: var(--Ml-accent-cyan);
        }

        /* Selected option */
        .select2-results__option[aria-selected="true"] {
            background: rgba(188,19,254,0.15);
            color: var(--Ml-accent-purple);
        }

        /* =========================================
        Z-INDEX & OVERFLOW FIXES
        ========================================= */

        .select2-container {
            z-index: 9999 !important;
        }

        .select2-drop-mask {
            z-index: 9998 !important;
        }

        /* Prevent parent clipping */
        .Ml-sidebar,
        .Ml-filter-group {
            overflow: visible !important;
        }
        @media only screen and (max-width: 991px) {
            body {
                margin-top: 0px !important; 
            }
        }
        @media (min-width: 768px) and (max-width: 1200px) {

            .Ml-photo-frame {
                height: 300px !important;
            }
        }
            </style>

        <?php
        $distance = 25; // default

        if (isset($_GET['distance']) && is_numeric($_GET['distance'])) {
            $distance = (int) $_GET['distance'];
        }
        ?>

    <!-- ☄️ ASTEROID SYSTEM -->
    <div class="Ml-asteroid-system">
        <div class="Ml-asteroid Ml-asteroid-1"></div>
        <div class="Ml-asteroid Ml-asteroid-2"></div>
        <div class="Ml-asteroid Ml-asteroid-3"></div>
    </div>

    <!-- 3) ? Wrapper Structure (Mandatory) -->
    <div class="Ml-page-homepage">


        <!-- Hero -->
        <div class="Ml-browse-hero">
            <div class="container">
                <span class="Ml-hero-badge">System Online</span>
                <h1 class="Ml-hero-title">Deep Space Scan</h1>
                <p class="Ml-hero-sub">Identify Compatible Signals in Your Sector</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="Ml-page-browse">
            <div class="container">
                <div class="Ml-browse-layout">
                    
                        <aside class="Ml-sidebar">
                            <div class=" Ml-gravity-target">
                                <form action="/modern_listing" class="website-search" accept-charset="UTF-8" method="get">
                                    
                                    <div class="Ml-filter-header">
                                        <span>// SEARCH PARAMETERS</span>
                                        <i class="fa fa-sliders"></i>
                                    </div>
                            <div class="Ml-filter-group">
                        <label>Location</label>
                        <input type="text"
                       autocomplete="off"
                       placeholder="Zip Code or City"
                       class="googleSuggest googleLocation form-control custom-input Ml-input-text Ml-age-single"
                       id="location_google_maps_homepage"
                       name="location_value"
                       value="<?php 
                       if ($_GET['location_value']!="") {
                           echo $_GET['location_value'];
                       } else if ($w['geocode_visitor_default']==1 && $w['geocode']==1 && $_SESSION['vdisplay']!="") {
                           echo $_SESSION['vdisplay'];
                       } ?>">
                </div>
            <div class="Ml-filter-group">
                <span class="Ml-filter-label">Search Radius</span>
            <div class="Ml-range-container">
                <input
                    type="range"
                    name="distance"
                    class="Ml-input-range"
                    min="1"
                    max="100"
                    value="<?php echo $distance; ?>"
                    oninput="this.nextElementSibling.value = this.value + ' Miles'"
                >
                <output><?php echo $distance; ?> Miles</output>
            </div>

            </div>

            <div class="Ml-filter-group">
                <span class="Ml-filter-label">Target Age</span>
                <div class="Ml-single-input-wrapper">
                    <input type="number" name="age" class="Ml-input-text Ml-age-single"  value="<?php echo isset($_GET['age']) ? htmlspecialchars($_GET['age']) : ''; ?>" placeholder="ENTER AGE" min="18" max="99">
                </div>
            </div>

            <div class="Ml-filter-group">
                <span class="Ml-filter-label">%%%home_search_dropdown_1%%%</span>
                <div class="Ml-select-wrapper">
                    <select name="sid" id="sid" class="Ml-input-select Ml-select-no-js">
                        <option value="">%%%all_categories_label%%%</option>
                        <?php echo listProfessions($_GET['sid'], "option", $w) ?>
                    </select>
                </div>
            </div>

            <div class="Ml-filter-group">
                <span class="Ml-filter-label">%%%home_search_dropdown_2%%%</span>
                <div class="Ml-select-wrapper">
                    <select name="tid" id="tid" class="Ml-input-select Ml-select-no-js">
                        <option value="">%%%all_categories_label%%%</option>
                        <?php echo listServices($_GET['tid'], "list", $w, $_GET['sid'], 0, $w['fast_search']); ?>
                    </select>
                </div>
            </div>

            <button type="submit" class="Ml-btn Ml-btn-primary" style="width:100%; margin-top:20px;">
                %%%home_search_submit%%%
            </button>
            
        </form>
    </div>
</aside>

<!-- Main Feed -->
                <main class="Ml-main-feed">
                    <div class="Ml-feed-header">
                        <div class="Ml-feed-title">FOUND Results</div>
                        <div class="Ml-view-switcher">
                            <button class="Ml-view-btn active" id="view-grid" title="Grid View"><i class="fa fa-th-large"></i></button>
                            <button class="Ml-view-btn" id="view-list" title="List View"><i class="fa fa-list"></i></button>
                            <button class="Ml-view-btn" style="display:none;" id="view-map" title="Map View"><i class="fa fa-map-marker"></i></button>
                            </div>
                        </div>

                        <!-- GRID / LIST CONTAINER -->
                        <div class="Ml-grid-container" id="main-container">                

    <!-- loop code from here  -->

    <?php
/**
 * MOONLOOP DYNAMIC SEARCH RESULT CARD
 * Maps BD $user_data and $user arrays to Ml-classes
 */

// 1. Logic for Age/Profession
$age = !empty($user_data['age']) ? ', ' . $user_data['age'] : '';
$profession = !empty($user_data['profession_name']) ? strtoupper($user_data['profession_name']) : 'MEMBER';

// 2. Logic for Bio/Description
$bio = '';
if (!empty($user_data['search_description'])) {
    $bio = strip_tags(bdString::prepareSpecialCharacter($user_data['search_description']));
} else if (!empty($user_data['about_me'])) {
    $bio = limitWords(strip_tags(bdString::prepareSpecialCharacter($user_data['about_me'])), 120);
} else {
    $bio = "No log entry found for this crew member.";
}

// 3. Match Logic (Using Rating or Fallback)
$matchPercent = ($ratingValue > 0) ? ($ratingValue * 20) : "92"; // Converts 5 stars to 100%
?>

<div class="Ml-grid-item member_results level_<?php echo $user_data['subscription_id'];?> search_result <?php echo ($user_data['verified'] == "1") ? 'verified_member_result' : ''; ?> clearfix" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
    
    <meta itemprop="name" content="<?php echo htmlspecialchars($user_data['full_name'], ENT_QUOTES, 'UTF-8'); ?>">
    <meta itemprop="position" content="<?php echo ++$GLOBALS['search_result_position']; ?>">
    
    <div class="Ml-crew-card Ml-gravity-target">
        
        <?php if ($user_data['verified'] == "1") { ?>
            <div class="Ml-featured-badge">Priority member</div>
        <?php } ?>

        <div class="Ml-photo-frame">
            <a href="/<?php echo $user_data['filename']?>?variation=modern&widget= Bootstrap Theme - Member Profile - Header-modern" ">
                <?php if (!empty($w['lazy_load_images'])) { ?>
                    <img src="<?php echo $user['image_main_file']?>" class="Ml-photo lazyloader" alt="<?php echo $user_data['full_name'];?>" data-src="<?php echo $user['image_main_file']?>">
                <?php } else { ?>
                    <img src="<?php echo $user['image_main_file']?>" class="Ml-photo" alt="<?php echo $user_data['full_name'];?>">
                <?php } ?>
            </a>
        </div>

        <div class="Ml-card-content">
            <div class="Ml-info-group">
                <span class="Ml-role-tag">// <?php echo $user['position']; ?></span>
                
                <h3 class="Ml-name">
                    <a href="/<?php echo $user_data['filename']; ?>?variation=modern&widget= Bootstrap Theme - Member Profile - Header-modern" style="color:inherit; text-decoration:none;">
                        <?php echo $user_data['full_name'] . $age; ?>
                    </a>
                </h3>
                
<p class="Ml-bio">
    <?php
    $bioClean = trim($bio);
    echo (strlen($bioClean) > 40)
        ? substr($bioClean, 0, 40) . '...'
        : $bioClean;
    ?>
</p>
            </div>

            <div class="Ml-card-footer">
                <div class="Ml-match-stat"><span><?php echo $user['city']; ?></span></div>
                
                <a href="/<?php echo $user_data['filename']; ?>?variation=modern&widget= Bootstrap Theme - Member Profile - Header-modern" class="Ml-icon-btn">
                    <i class="fa fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div><?php 
// Keep the Google Pins Widget for the Map functionality
echo widget("Bootstrap Theme - Google Pins Locations","",$w['website_id'],$w); 
?>
</div>


<!-- loop code ends here  -->

 <!-- MAP VIEW -->
                        <div class="Ml-map-view" id="map-container" style="display:none;">
                            <div class="Ml-radar-sweep"></div>
                            	  <?php
        $mapViewAddOn = getAddOnInfo('google_map_search_results','8342a12b460d88d90a8c421953a44530');
        if (isset($mapViewAddOn['status']) && $mapViewAddOn['status'] == 'success') {
            echo widget($mapViewAddOn['widget'],"",$w['website_id'],$w);
        } ?>

                        </div>
                        
                        <div class="text-center" style="margin-top: 60px;">
<?php
$lazyLoadSearchReults = getAddOnInfo('search_results_lazy_load', '8e5c29cd2531efea4db02ebc567b8442');
if (isset($lazyLoadSearchReults["status"]) && $lazyLoadSearchReults["status"] === "success" && ($dc["enableLazyLoad"] == 1 || $dc["enableLazyLoad"] == "")) {
    echo widget($lazyLoadSearchReults["widget"], "", $w[website_id], $w);
} ?>                        </div>
                    </main>
                </div>
            </div>
        </div>


   <!-- <div class="map_container" style="display:none;">
        <?php
        $mapViewAddOn = getAddOnInfo('google_map_search_results','8342a12b460d88d90a8c421953a44530');
        if (isset($mapViewAddOn['status']) && $mapViewAddOn['status'] == 'success') {
            echo widget($mapViewAddOn['widget'],"",$w['website_id'],$w);
        } ?>
    </div> -->
<?php
$clickPhoneAddOnFooter = getAddOnInfo("click_to_phone", "19dd6c19c0943cc078aa0873b330ada2");
if (isset($clickPhoneAddOnFooter['status']) && $clickPhoneAddOnFooter['status'] === 'success') {
    echo widget($clickPhoneAddOnFooter['widget'], "", $w[website_id], $w);
} else {
    $statisticsAddOnFooter = getAddOnInfo("user_statistics_addon", "ebb3e8d8cd4b30cb80a24d75f660987c");
    if (isset($statisticsAddOnFooter['status']) && $statisticsAddOnFooter['status'] === 'success') {
        echo widget($statisticsAddOnFooter['widget'], "", $w[website_id], $w);

    }
}
echo widget("Bootstrap Theme - Listing Search Results Statistics", '', $w[website_id], $w);

?>
<!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            // View Switcher Logic
            const $mainContainer = $('#main-container');
            const $mapContainer = $('#map-container');
            const $btns = $('.Ml-view-btn');

            $('#view-grid').click(function() {
                $btns.removeClass('active'); $(this).addClass('active');
                $mainContainer.removeClass('view-list').fadeIn();
                $mapContainer.hide();
            });

            $('#view-list').click(function() {
                $btns.removeClass('active'); $(this).addClass('active');
                $mainContainer.addClass('view-list').fadeIn();
                $mapContainer.hide();
            });

            $('#view-map').click(function () {
    $btns.removeClass('active');
    $(this).addClass('active');

    $mainContainer.hide();
    $mapContainer.fadeIn(function () {

        // ? Force Google Map to re-render
        if (typeof google !== 'undefined' && google.maps) {
            $('.gm-style').each(function () {
                google.maps.event.trigger(this, 'resize');
            });
        }

        // Fallback resize
        window.dispatchEvent(new Event('resize'));
    });
});


            // Mobile Menu Toggle
            $('#mobile-toggle-btn').click(function() {
                $('#mobile-menu').slideToggle();
            });

            // ? Logic: Soft Gravity Hover Effect - ONLY Physics, NO Idle
            const gravityStrength = 15;
            const range = 600; 

            if (window.matchMedia("(pointer: fine)").matches) {
                $(document).on('mousemove', function(e) {
                    requestAnimationFrame(() => {
                        $('.Ml-gravity-target').each(function() {
                            const $el = $(this);
                            const offset = $el.offset();
                            const width = $el.outerWidth();
                            const height = $el.outerHeight();
                            const centerX = offset.left + width / 2;
                            const centerY = offset.top + height / 2;
                            const deltaX = e.pageX - centerX;
                            const deltaY = e.pageY - centerY;
                            const distance = Math.sqrt(deltaX * deltaX + deltaY * deltaY);

                            if (distance < range) {
                                const pull = (1 - distance / range) * gravityStrength;
                                $el.css('transform', `translate(${(deltaX / distance) * pull}px, ${(deltaY / distance) * pull}px)`);
                            } else {
                                $el.css('transform', 'translate(0px, 0px)');
                            }
                        });
                    });
                });

                $(document).on('mouseleave', function() {
                    $('.Ml-gravity-target').css('transform', 'translate(0px, 0px)');
                });
            }
        });
    </script>
<script>
(function () {
    var btn = document.getElementById('btnToLoadMorePost');
    if (btn) {
        btn.classList.add('Ml-btn', 'Ml-btn-primary');
    }
})();
</script>

