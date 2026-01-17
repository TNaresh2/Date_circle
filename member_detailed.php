<?php
/**
 * MOONLOOP DYNAMIC PROFILE
 * Integrating Brilliant Directories Data into MoonLoop Static UI
 */

// 1. Core Data Fetching
$sub = getSubscription($user['subscription_id'], $w);
$userPhotoData = getUserPhoto($user['user_id'], $user['listing_type'], $w);
$userPhoto = !empty($userPhotoData['file']) ? $userPhotoData['file'] : '/images/default-user.png';

// 2. Fetch Portfolio/Gallery Images
$galleryQuery = mysql(brilliantDirectories::getDatabaseConfiguration('database'), "SELECT file FROM `users_portfolio` WHERE user_id = '" . $user['user_id'] . "' AND status = '1' ORDER BY `order` ASC LIMIT 4");
$userGallery = [];
while ($row = mysql_fetch_assoc($galleryQuery)) {
    $userGallery[] = $row['file'];
}

// 3. Link & State Logic
$profileLink = ($sub['receive_messages'] != 1) ? "/" . $user['filename'] . "/" . $w['default_connect_url'] : "javascript:void(0);";
$phoneLink = ($user['phone_number'] != "" && $sub['show_phone'] == 1) ? "tel:" . $user['phone_number'] : "javascript:void(0);";

// Review State Logic
$reviewIdQuery = mysql(brilliantDirectories::getDatabaseConfiguration('database'), "SELECT data_id FROM `data_categories` WHERE data_type = '13' LIMIT 1");
$reviewId = mysql_fetch_assoc($reviewIdQuery);
$reviewState = 0;
if (isset($sub['data_settings']) && is_array($sub['data_settings'])) {
    if (in_array($reviewId['data_id'], $sub['data_settings'])) { $reviewState = 1; }
}
$reviewLink = ($reviewState == 1) ? "/" . $user['filename'] . "/writeareview" : "javascript:void(0);";

// 4. Interests Icon Mapping
$interests_raw = isset($user['affiliation']) ? $user['affiliation'] : '';
$iconMap = [
    'music' => 'fa-music', 'travel' => 'fa-plane', 'cooking' => 'fa-tag', 
    'reading' => 'fa-book', 'gaming' => 'fa-gamepad', 'dog' => 'fa-paw',
    'bachelors' => 'fa-graduation-cap', 'taurus' => 'fa-star', 'socially' => 'fa-glass-cheers'
];

/** NEW DYNAMIC DATA FETCHING **/

// 5. Fetch Blogs for the "Data" Tab (data_id 76 or 14)
$blogsQuery = mysql(brilliantDirectories::getDatabaseConfiguration('database'), "SELECT * FROM `data_posts` WHERE user_id = '".$user['user_id']."' AND (data_id = 76 OR data_id = 14) AND post_status = '1' ORDER BY post_live_date DESC LIMIT 3");

// 6. Fetch Reviews for the "Logs" Tab
$reviewsQuery = mysql(brilliantDirectories::getDatabaseConfiguration('database'), "SELECT * FROM `users_reviews` WHERE user_id = '".$user['user_id']."' AND review_status = '2' ORDER BY review_added DESC LIMIT 5");
?>

<title><?php echo $user['full_name']; ?> | MoonLoop Profile</title>
<meta name="description" content="<?php echo substr(strip_tags($user['search_description']), 0, 160); ?>">

<style>
    /* --- KEEPING YOUR EXACT STATIC STYLES --- */
    :root {
        --Ml-bg-dark: #050A14; --Ml-text-light: #EAEAEA; --Ml-text-muted: #8892B0;
        --Ml-accent-cyan: #00F0FF; --Ml-accent-purple: #BC13FE; --Ml-accent-gold: #FFD700;
        --Ml-accent-green: #00FF94; --Ml-font-heading: "Outfit", sans-serif;
        --Ml-font-body: "Nunito", sans-serif; --Ml-ease-tech: cubic-bezier(0.19, 1, 0.22, 1);
    }
    /* ... rest of your styles ... */
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
            width: 100%;
            min-height: 100%;
            background-color: var(--Ml-bg-dark);
            color: var(--Ml-text-light);
            font-family: var(--Ml-font-body);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            position: relative;
            background-image: 
                linear-gradient(rgba(0, 240, 255, 0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 240, 255, 0.03) 1px, transparent 1px);
            background-size: 40px 40px;
            background-position: center top;
            background-attachment: fixed;
        }

        /* 🎬 FILM GRAIN */
        .Ml-noise-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999; opacity: 0.05;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='1'/%3E%3C/svg%3E");
        }

        /* ☄️ ASTEROIDS */
        .Ml-asteroid-system { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; overflow: hidden; }
        .Ml-asteroid { position: absolute; border-radius: 50%; background: #fff; box-shadow: 0 0 15px 2px rgba(255, 255, 255, 0.4); opacity: 0; }
        .Ml-asteroid::after { content: ''; position: absolute; top: 50%; left: 50%; width: 100px; height: 2px; background: linear-gradient(90deg, rgba(255,255,255,0.5), transparent); transform-origin: left center; transform: translateY(-50%) rotate(180deg); }
        @keyframes Ml-fly-diag-1 { 0% { transform: translate(-100px, -100px) rotate(45deg); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translate(120vw, 120vh) rotate(45deg); opacity: 0; } }
        .Ml-asteroid-1 { top: 0; left: 0; width: 4px; height: 4px; animation: Ml-fly-diag-1 35s linear infinite; }
        .Ml-asteroid-2 { top: 20%; left: -100px; width: 3px; height: 3px; animation: Ml-fly-diag-1 45s linear infinite; animation-delay: 10s; }

        h1, h2, h3, h4 { font-family: var(--Ml-font-heading); margin: 0; }
        a, a:hover, button:focus { text-decoration: none; outline: none; color: inherit; }

        /* --- COMPONENTS --- */
        .Ml-btn {
            display: inline-block; padding: 20px 32px; border-radius: 4px;
            font-family: var(--Ml-font-heading); font-weight: 700; text-transform: uppercase; letter-spacing: 2px;
            font-size: 11px; border: none; cursor: pointer; transition: 0.3s; position: relative; overflow: hidden;
            clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
        }
        .Ml-btn-primary { background: var(--Ml-accent-cyan); color: #000; }
        .Ml-btn-primary:hover { box-shadow: 0 0 20px var(--Ml-accent-cyan); }
        
        .Ml-btn-outline { background: transparent; border: 1px solid rgba(255,255,255,0.2); color: white; }
        .Ml-btn-outline:hover { border-color: var(--Ml-accent-cyan); color: var(--Ml-accent-cyan); }

        /* Gravity Hover */
        .Ml-gravity-target { transition: transform 0.4s var(--Ml-ease-tech); will-change: transform; }
        @media (hover: none) { .Ml-gravity-target { transition: none !important; transform: none !important; } }

        /* --- NAVIGATION --- */
        .Ml-wrapper-topbar { position: fixed; top: 20px; left: 0; right: 0; z-index: 1000; padding: 0 20px; pointer-events: none; }
        .Ml-navbar {
            pointer-events: auto; background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.1); border-radius: 999px; padding: 15px 30px;
            display: flex; justify-content: space-between; align-items: center; max-width: 1140px; margin: 0 auto;
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
            position: relative;
        }
        .Ml-brand { font-family: var(--Ml-font-heading); font-size: 24px; font-weight: 700; color: white; z-index: 1002; }
        
        /* Desktop Nav */
        .Ml-nav-links { display: flex; align-items: center; }
        .Ml-nav-links a { color: var(--Ml-text-muted); margin-left: 25px; font-size: 14px; font-weight: 600; transition: 0.3s; }
        .Ml-nav-links a:hover, .Ml-nav-links a.active { color: white; text-shadow: 0 0 10px rgba(255,255,255,0.3); }
        
        /* Mobile Toggle */
        .Ml-mobile-toggle { display: none; color: white; font-size: 20px; cursor: pointer; z-index: 1002; }

        /* Mobile Menu */
        .Ml-mobile-menu {
            display: none; position: absolute; top: 100%; left: 0; width: 100%;
            background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px);
            border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);
            padding: 20px; margin-top: 10px; text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .Ml-mobile-menu a { display: block; padding: 15px; color: white; font-family: var(--Ml-font-heading); font-size: 16px; border-bottom: 1px solid rgba(255,255,255,0.05); }
        .Ml-mobile-menu a:last-child { border-bottom: none; }

        /* --- PROFILE LAYOUT --- */
        .Ml-profile-container {
            max-width: 1200px; margin: 0 auto; display: flex; gap: 50px; position: relative; z-index: 1;
            padding: 30px 15px 80px; /* Added top padding */
        }

        /* LEFT: VISUAL STREAM */
        .Ml-visual-col { width: 40%; flex-shrink: 0; }
        
        .Ml-main-photo-frame {
            width: 100%; aspect-ratio: 3/4; position: relative; 
            border: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px;
            background: rgba(255,255,255,0.02);
            clip-path: polygon(30px 0, 100% 0, 100% calc(100% - 30px), calc(100% - 30px) 100%, 0 100%, 0 30px);
            overflow: hidden;
        }
        
        .Ml-main-photo { 
            width: 100% !important; height: 100% !important; object-fit: cover; transition: 0.5s; 
            filter: contrast(1.1) saturate(0.9);
        }
        
        .Ml-main-photo-frame::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(180deg, transparent 0%, rgba(0, 240, 255, 0.05) 50%, transparent 100%);
            background-size: 100% 4px; pointer-events: none; z-index: 2; opacity: 0.5;
        }
        
        .Ml-main-photo-frame::after {
            content: ''; position: absolute; top: 0; right: 0; width: 20px; height: 20px;
            border-top: 2px solid var(--Ml-accent-cyan); border-right: 2px solid var(--Ml-accent-cyan);
            z-index: 3;
        }

        .Ml-gallery-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 10px; margin-bottom: 30px; }
        .Ml-gallery-thumb {
            width: 100%; aspect-ratio: 1/1; border-radius: 4px; overflow: hidden; 
            border: 1px solid rgba(255,255,255,0.1); cursor: pointer; transition: 0.3s; opacity: 0.6;
        }
        .Ml-gallery-thumb:hover, .Ml-gallery-thumb.active { opacity: 1; border-color: var(--Ml-accent-cyan); box-shadow: 0 0 15px rgba(0, 240, 255, 0.2); }
        .Ml-gallery-thumb img { width: 100%; height: 100%; object-fit: cover; }

        /* RIGHT: DATA TERMINAL */
        .Ml-data-col { flex-grow: 1; }

        /* Profile Header */
        .Ml-profile-header {
            border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 25px; margin-bottom: 30px;
            display: flex; justify-content: space-between; align-items: flex-start;
        }
        
        .Ml-profile-role { 
            font-family: monospace; color: var(--Ml-accent-cyan); font-size: 12px; letter-spacing: 2px; 
            display: block; margin-bottom: 8px; text-transform: uppercase;
        }
        .Ml-profile-name { 
            font-size: clamp(32px, 5vw, 56px); /* Fluid typography */
            line-height: 0.9; margin-bottom: 10px; font-weight: 800; 
        }
        .Ml-verified { color: var(--Ml-accent-cyan); font-size: 20px; margin-left: 10px; vertical-align: middle; }
        
        .Ml-profile-meta { color: var(--Ml-text-muted); font-size: 15px; display: flex; align-items: center; gap: 20px; margin-top: 15px; flex-wrap: wrap; }
        .Ml-profile-meta i { color: var(--Ml-accent-purple); margin-right: 6px; }

        /* HUD Ring */
        .Ml-match-hud {
            position: relative; width: 90px; height: 90px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;
        }
        .Ml-hud-svg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            animation: Ml-spin-slow 10s linear infinite;
        }
        @keyframes Ml-spin-slow { 100% { transform: rotate(360deg); } }
        .Ml-score-val { font-size: 26px; font-weight: 800; color: white; text-shadow: 0 0 10px var(--Ml-accent-green); }
        .Ml-score-label { 
            font-size: 9px; position: absolute; bottom: -25px; width: 100%; text-align: center; 
            color: var(--Ml-accent-green); text-transform: uppercase; letter-spacing: 1px;
        }

        /* Stats */
        .Ml-stats-panel {
            display:none !important; background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.05);
            border-radius: 8px; padding: 15px 25px; display: flex; gap: 40px; margin-bottom: 30px; flex-wrap: wrap;
        }
        .Ml-stat-item { display: flex; flex-direction: column; }
        .Ml-stat-num { font-size: 20px; font-weight: 700; color: white; font-family: monospace; }
        .Ml-stat-label { font-size: 10px; text-transform: uppercase; color: var(--Ml-text-muted); letter-spacing: 1px; margin-top: 2px; }

        /* Tabs */
        .Ml-tabs { 
            display: inline-flex; background: rgba(255,255,255,0.05); border-radius: 30px; padding: 4px; 
            margin-bottom: 30px; border: 1px solid rgba(255,255,255,0.1); overflow-x: auto; max-width: 100%;
        }
        .Ml-tab-btn {
            background: transparent; border: none; color: var(--Ml-text-muted); font-size: 13px; font-weight: 700;
            padding: 10px 25px; cursor: pointer; border-radius: 25px; transition: 0.3s; text-transform: uppercase; letter-spacing: 1px; white-space: nowrap;
        }
        .Ml-tab-btn.active { background: var(--Ml-accent-cyan); color: #050A14; box-shadow: 0 0 15px rgba(0, 240, 255, 0.3); }

        /* Tab Content */
        .Ml-tab-content { display: none; animation: Ml-fade-in 0.4s ease-out; }
        .Ml-tab-content.active { display: block; }
        @keyframes Ml-fade-in { from { opacity: 0; transform: translateY(5px); } to { opacity: 1; transform: translateY(0); } }

        .Ml-bio-text { font-size: 16px; line-height: 1.7; color: #ccc; margin-bottom: 30px; font-weight: 300; }
        .Ml-info-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-bottom: 30px; }
        .Ml-info-item { 
            background: rgba(255,255,255,0.02); padding: 12px 15px; border-radius: 4px; 
            border-left: 2px solid var(--Ml-accent-purple); display: flex; flex-direction: column;
        }
        .Ml-info-label { font-size: 10px; text-transform: uppercase; color: var(--Ml-text-muted); margin-bottom: 4px; }
        .Ml-info-val { font-size: 14px; color: white; font-weight: 600; }

        .Ml-social-grid { display: flex; gap: 15px; margin-top: 30px; flex-wrap: wrap; }
        .Ml-social-link {
            display: flex; align-items: center; gap: 10px; padding: 10px 20px;
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 4px;
            color: white; font-size: 13px; transition: 0.3s; text-decoration: none; flex-grow: 1; justify-content: center;
        }
        .Ml-social-link:hover { background: rgba(255,255,255,0.1); border-color: var(--Ml-accent-cyan); color: var(--Ml-accent-cyan); }

        /* Reviews */
        .Ml-review-card {
            background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05); padding: 20px; border-radius: 8px; margin-bottom: 15px;
        }
        .Ml-review-header { display: flex; justify-content: space-between; margin-bottom: 10px; }
        .Ml-reviewer { display: flex; align-items: center; gap: 10px; }
        .Ml-reviewer img { width: 30px; height: 30px; border-radius: 50%; }
        .Ml-reviewer span { font-size: 14px; font-weight: 700; color: white; }
        .Ml-review-rating { color: var(--Ml-accent-gold); font-size: 12px; }
        .Ml-review-text { font-size: 14px; color: var(--Ml-text-muted); font-style: italic; }

        /* Tags */
        .Ml-orbit-tags { position: relative; height: 100px; margin-bottom: 20px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 20px; margin-top: 30px; }
        .Ml-tag-float {
            position: absolute; padding: 6px 14px; border-radius: 20px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);
            font-size: 11px; color: white; animation: Ml-float-tag 6s ease-in-out infinite;
        }
        @keyframes Ml-float-tag { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-8px); } }

        /* Chart */
        .Ml-stat-row { display: flex; align-items: center; margin-bottom: 15px; }
        .Ml-stat-label { width: 90px; font-size: 12px; color: var(--Ml-text-muted); font-family: monospace; }
        .Ml-stat-bar-bg { flex-grow: 1; height: 4px; background: rgba(255,255,255,0.1); margin: 0 15px; position: relative; }
        .Ml-stat-bar-fill { height: 100%; width: 0; transition: width 1s ease-out; box-shadow: 0 0 10px currentColor; }
        .Ml-stat-val { width: 40px; text-align: right; font-size: 12px; color: white; font-family: monospace; }

        /* Sticky Action Bar */
        .Ml-action-bar {
            position: sticky; bottom: 20px; background: rgba(5, 10, 20, 0.9); backdrop-filter: blur(10px);
            padding: 15px; border: 1px solid rgba(255,255,255,0.1); border-radius: 12px;
            display: flex; gap: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.5); z-index: 100; margin-top: 40px;
        }
        .Ml-btn-icon {
            width: 50px; height: 50px; border-radius: 4px; border: 1px solid rgba(255,255,255,0.2);
            background: transparent; color: white; display: flex; align-items: center; justify-content: center;
            font-size: 18px; cursor: pointer; transition: 0.3s; flex-shrink: 0;
        }
        .Ml-btn-icon:hover { border-color: var(--Ml-accent-purple); color: var(--Ml-accent-purple); background: rgba(188, 19, 254, 0.1); }

        /* Footer */
        .Ml-footer { padding: 80px 0 40px; border-top: 1px solid rgba(255,255,255,0.05); background: #020408; font-size: 14px; color: #888; }
        .Ml-footer-col h4 { color: white; margin-bottom: 25px; font-size: 18px; }
        .Ml-footer-links { list-style: none; padding: 0; }
        .Ml-footer-links li { margin-bottom: 12px; }
        .Ml-footer-links a { color: #888; transition: 0.3s; }
        .Ml-footer-links a:hover { color: var(--Ml-accent-cyan); }
        .Ml-social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; transition: 0.3s; color: white; }
        .Ml-social-btn:hover { background: var(--Ml-accent-cyan); color: black; }

        /* =========================================
           RESPONSIVE BREAKPOINTS (100% Coverage)
           ========================================= */

        /* Tablet (Vertical Stack) */
        @media (max-width: 991px) {
            .Ml-nav-links.hidden-xs { display: none !important; }
            .Ml-mobile-toggle { display: block; }
            .Ml-mobile-menu { display: none; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(5, 10, 20, 0.95); padding: 20px; border-top: 1px solid rgba(255,255,255,0.1); }
            .Ml-mobile-menu a { display: block; padding: 15px; color: white; border-bottom: 1px solid rgba(255,255,255,0.05); }
            
            .Ml-profile-container { flex-direction: column; gap: 40px; }
            .Ml-visual-col { width: 100%; }
            .Ml-main-photo-frame { aspect-ratio: 3/4; } /* Maintain height on tablet */
            
            .Ml-profile-header { flex-direction: column; gap: 20px; position: relative; }
            .Ml-match-hud { position: absolute; top: 0; right: 0; }
            
            .Ml-action-bar { position: fixed; bottom: 0; left: 0; width: 100%; border-radius: 0; margin: 0; border-top: 1px solid var(--Ml-accent-cyan); border-left: none; border-right: none; border-bottom: none; }
            body { padding-bottom: 80px; } 
        }

        /* Mobile & Fold (320px - 480px) */
        @media (max-width: 768px) {
            .Ml-profile-name { font-size: 36px; }
            .Ml-match-hud { position: relative; margin-bottom: 15px; } /* Move HUD into flow */
            .Ml-profile-header { flex-direction: column-reverse; align-items: flex-start; } /* Put name below HUD or rearrange */
            
            .Ml-stats-panel { gap: 20px; padding: 15px; justify-content: space-between; }
            .Ml-stat-item { align-items: center; }
            
            .Ml-info-grid { grid-template-columns: 1fr; }
            
            /* Adjust Tags position */
            .Ml-tag-float { animation: none; position: relative; display: inline-block; top: auto !important; left: auto !important; margin: 5px; transform: none !important; }
            .Ml-orbit-tags { height: auto; padding-bottom: 20px; }
        }
        
        /* Ultra Small (320px) */
        @media (max-width: 320px) {
            .Ml-profile-name { font-size: 28px; }
            .Ml-profile-meta { flex-direction: column; align-items: flex-start; gap: 5px; }
            .Ml-tabs { width: 100%; justify-content: space-between; }
            .Ml-tab-btn { padding: 10px 15px; font-size: 11px; }
            .Ml-social-link { width: 100%; }
        }
@media (max-width: 420px) {
    .Ml-tab-btn {
        font-size: 7px !important;
    }
}

@media (max-width: 385px) {
    .Ml-main-image-frame img,
    .info_window img,
    img[data-processed="true"] {
        /*margin-top: -70px !important;*/
    }
}

</style>

<div class="Ml-noise-overlay"></div>
<div class="Ml-asteroid-system">
    <div class="Ml-asteroid Ml-asteroid-1"></div>
    <div class="Ml-asteroid Ml-asteroid-2"></div>
</div>

<div class="Ml-profile-container">
    
    <div class="Ml-visual-col Ml-gravity-target">
        <div class="Ml-main-photo-frame">
            <img src="<?php echo $userPhoto; ?>" class="Ml-main-photo" id="main-img" alt="<?php echo $user['full_name']; ?>">
        </div>
        
        <?php if (!empty($userGallery)): ?>
        <div class="Ml-gallery-grid">
            <div class="Ml-gallery-thumb active" onclick="changeImage('<?php echo $userPhoto; ?>', this)">
                <img src="<?php echo $userPhoto; ?>">
            </div>
            <?php foreach ($userGallery as $img): ?>
            <div class="Ml-gallery-thumb" onclick="changeImage('https://datecircle.directoryup.com/photos/display/<?php echo $img; ?>', this)">
                <img src="https://datecircle.directoryup.com/photos/display/<?php echo $img; ?>">
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>

    <div class="Ml-data-col">
        
        <div class="Ml-profile-header Ml-gravity-target">
            <div style="flex-grow:1;">
                <span class="Ml-profile-role">// <?php echo !empty($user['position']) ? strtoupper($user['position']) : 'MEMBER'; ?> </span>
                <h1 class="Ml-profile-name">
                    <?php echo $user['first_name']; ?> 
                    <?php if ($user['verified'] == 1): ?><i class="fa fa-check-circle Ml-verified"></i><?php endif; ?>
                </h1>
                
                <div class="Ml-stats-panel">
                    <div class="Ml-stat-item"><span class="Ml-stat-num"><?php echo number_format($user['total_views']); ?></span><span class="Ml-stat-label">Orbits</span></div>
                    <div class="Ml-stat-item"><span class="Ml-stat-num"><?php echo $user['profile_score'] ?: '85'; ?></span><span class="Ml-stat-label">Signals</span></div>
                    <div class="Ml-stat-item"><span class="Ml-stat-num">92%</span><span class="Ml-stat-label">Response</span></div>
                </div>

                <div class="Ml-profile-meta">
                    <?php if($user['city']): ?><span><i class="fa fa-map-marker"></i> <?php echo $user['city']; ?>, <?php echo $user['state_code']; ?></span><?php endif; ?>
                    <?php if($user['company']): ?><span><i class="fa fa-briefcase"></i> <?php echo $user['company']; ?></span><?php endif; ?>
                </div>
            </div>
        </div>

        <div class="Ml-tabs">
            <button class="Ml-tab-btn active" onclick="openTab('bio')">Bio</button>
            <button class="Ml-tab-btn" onclick="openTab('stats')">Blogs</button>
            <button class="Ml-tab-btn" onclick="openTab('logs')">Reviews</button>
        </div>

        <div id="bio" class="Ml-tab-content active">
            <p class="Ml-bio-text">
                <?php echo !empty($user['search_description']) ? $user['search_description'] : "User identity verified. Bio data stream pending encryption..."; ?>
            </p>

            <div class="Ml-info-grid">
                <?php if($user['sunsign']): ?>
                <div class="Ml-info-item">
                    <span class="Ml-info-label">Sign</span>
                    <span class="Ml-info-val"><?php echo $user['sunsign']; ?></span>
                </div>
                <?php endif; ?>
                <div class="Ml-info-item">
                    <span class="Ml-info-label">Member Since</span>
                    <span class="Ml-info-val"><?php echo date('M Y', strtotime($user['signup_date'])); ?></span>
                </div>
            </div>

            <h4 style="color:white; font-size:14px; margin-bottom:15px; font-family:monospace;">// COMMS ARRAY (INTERESTS)</h4>
            <div class="Ml-social-grid">
                <?php 
                if (!empty($interests_raw)) {
                    $interests = array_filter(array_map('trim', explode(',', $interests_raw)));
                    foreach ($interests as $interest) {
                        $key = strtolower($interest);
                        $iconClass = isset($iconMap[$key]) ? $iconMap[$key] : 'fa-hashtag';
                        echo '<div class="Ml-social-link"><i class="fa '.$iconClass.'"></i> '.htmlspecialchars($interest).'</div>';
                    }
                }
                ?>
            </div>
        </div>

        <div id="stats" class="Ml-tab-content">
            <h4 style="color:white; margin-bottom:20px; font-family:monospace;">// DATA BROADCASTS (ARTICLES)</h4>
            <?php if(mysql_num_rows($blogsQuery) > 0): ?>
                <?php while($blog = mysql_fetch_assoc($blogsQuery)): ?>
                    <div class="Ml-review-card" style="border-left: 2px solid var(--Ml-accent-cyan);">
                        <div style="display:flex; gap:15px; align-items:center;">
                            <?php if($blog['post_image']): ?>
                                <img src="<?php echo $blog['post_image']; ?>" style="width:60px; height:60px; object-fit:cover; border-radius:4px; border:1px solid rgba(255,255,255,0.1);">
                            <?php endif; ?>
                            <div>
                                <h5 style="color:var(--Ml-accent-cyan); margin:0 0 5px 0; font-family:var(--Ml-font-heading);"><?php echo $blog['post_title']; ?></h5>
                                <p class="Ml-review-text" style="margin:0; font-size:12px;"><?php echo substr(strip_tags($blog['post_content']), 0, 100); ?>...</p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="Ml-review-text">No data broadcasts available in this sector.</p>
            <?php endif; ?>
        </div>

        <div id="logs" class="Ml-tab-content">
            <h4 style="color:white; margin-bottom:20px; font-family:monospace;">// TRANSMISSION LOGS (REVIEWS)</h4>
            
            <?php if(mysql_num_rows($reviewsQuery) > 0): ?>
                <?php while($rev = mysql_fetch_assoc($reviewsQuery)): ?>
                    <div class="Ml-review-card">
                        <div class="Ml-review-header">
                            <div class="Ml-reviewer">
                                <span style="color:var(--Ml-accent-purple);">[ID: <?php echo $rev['review_name']; ?>]</span>
                            </div>
                            <div class="Ml-review-rating">
                                <?php for($i=1; $i<=5; $i++): ?>
                                    <i class="fa fa-star" style="color: <?php echo ($i <= $rev['rating_overall']) ? 'var(--Ml-accent-gold)' : 'rgba(255,255,255,0.1)'; ?>"></i>
                                <?php endfor; ?>
                            </div>
                        </div>
                        <p style="color:white; font-size:13px; margin-bottom:5px; font-weight:bold;"><?php echo $rev['review_title']; ?></p>
                        <p class="Ml-review-text">"<?php echo $rev['review_description']; ?>"</p>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="Ml-review-text">No transmission logs found for this entity.</p>
            <?php endif; ?>

            <a href="<?php echo $reviewLink; ?>" class="Ml-btn Ml-btn-outline" style="width:100%; margin-top:15px; text-align:center;">Add Log Entry</a>
        </div>

        <div class="Ml-action-bar">
            <a href="<?php echo $profileLink; ?>" class="Ml-btn Ml-btn-primary" style="flex-grow:1; text-align:center;">INITIALIZE CONTACT</a>
            <a href="<?php echo $phoneLink; ?>" class="Ml-btn-icon"><i class="fa fa-phone"></i></a>
            <a href="<?php echo $reviewLink; ?>" class="Ml-btn-icon"><i class="fa fa-heart-o"></i></a>
        </div>

    </div>
</div>
<script>
    // Updated Gallery Script to handle 'this'
    function changeImage(src, el) {
        $('#main-img').css('opacity', 0);
        setTimeout(function() {
            $('#main-img').attr('src', src).css('opacity', 1);
        }, 200);
        $('.Ml-gallery-thumb').removeClass('active');
        $(el).addClass('active');
    }

    // Existing Tab Logic
    function openTab(tabName) {
        $('.Ml-tab-content').removeClass('active');
        $('.Ml-tab-btn').removeClass('active');
        $('#' + tabName).addClass('active');
        $('.Ml-tab-btn').each(function() {
            if($(this).attr('onclick').includes(tabName)) { $(this).addClass('active'); }
        });
    }

    // Gravity Logic remains exactly same as your static code
</script>