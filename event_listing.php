<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Outfit:wght@300;500;700;900&family=Playfair+Display:ital,wght@1,400;1,700&display=swap" rel="stylesheet">

    <style>
        /* --- ROOT VARIABLES --- */
        :root {
            --Ml-bg-dark: #050A14; 
            --Ml-bg-darker: #020408;
            --Ml-text-light: #EAEAEA;
            --Ml-text-muted: #8892B0;
            --Ml-accent-cyan: #00F0FF;
            --Ml-accent-purple: #BC13FE;
            --Ml-accent-gold: #FFD700;
            --Ml-accent-rose: #FF0055;
            
            --Ml-font-heading: "Outfit", sans-serif;
            --Ml-font-body: "Nunito", sans-serif;
            --Ml-font-serif: "Playfair Display", serif;
            
            --Ml-ease-tech: cubic-bezier(0.19, 1, 0.22, 1);
        }

        /* --- GLOBAL BASE --- */
        html, body {
            width: 100%; min-height: 100%;
            background-color: var(--Ml-bg-dark);
            color: var(--Ml-text-light);
            font-family: var(--Ml-font-body);
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            position: relative;
            /* Nebula Background */
            background: radial-gradient(circle at 20% 20%, #1a0b2e 0%, #050A14 60%);
            background-attachment: fixed;
            background-size: cover;
        }

        /* ? FILM GRAIN */
        .Ml-noise-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999; opacity: 0.05;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='1'/%3E%3C/svg%3E");
        }

        /* ☄️ ASTEROIDS (Shared from other pages) */
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
            display: inline-block; padding: 14px 36px; border-radius: 4px;
            font-family: var(--Ml-font-heading); font-weight: 700; text-transform: uppercase; letter-spacing: 2px;
            font-size: 12px; border: none; cursor: pointer; transition: 0.3s; position: relative; overflow: hidden;
            clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
        }
        .Ml-btn-primary { background: var(--Ml-accent-cyan); color: #000; }
        .Ml-btn-primary:hover { background: #fff; box-shadow: 0 0 30px var(--Ml-accent-cyan); }
        
        .Ml-btn-outline { background: transparent; border: 1px solid rgba(255,255,255,0.2); color: white; }
        .Ml-btn-outline:hover { border-color: var(--Ml-accent-cyan); color: var(--Ml-accent-cyan); }

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
        .Ml-nav-links { display: flex; align-items: center; }
        .Ml-nav-links a { color: var(--Ml-text-muted); margin-left: 25px; font-size: 14px; font-weight: 600; transition: 0.3s; }
        .Ml-nav-links a:hover, .Ml-nav-links a.active { color: white; text-shadow: 0 0 10px rgba(255,255,255,0.3); }
        .Ml-mobile-toggle { display: none; color: white; font-size: 20px; cursor: pointer; z-index: 1002; }
        .Ml-mobile-menu {
            display: none; position: absolute; top: 100%; left: 0; width: 100%;
            background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px);
            border-radius: 20px; border: 1px solid rgba(255,255,255,0.1);
            padding: 20px; margin-top: 10px; text-align: center;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5);
        }
        .Ml-mobile-menu a { display: block; padding: 15px; color: white; font-family: var(--Ml-font-heading); font-size: 16px; border-bottom: 1px solid rgba(255,255,255,0.05); }

        /* --- HERO --- */
        .Ml-event-hero {
            padding-top: 100px; padding-bottom: 40px; text-align: center; position: relative; z-index: 1;
            background: radial-gradient(circle at 50% 100%, rgba(188, 19, 254, 0.1) 0%, transparent 60%);
        }
        .Ml-hero-label {
            font-family: monospace; color: var(--Ml-accent-cyan);
            font-size: 14px; letter-spacing: 2px; margin-bottom: 10px; display: block; text-transform: uppercase;
        }
        .Ml-hero-title {
            font-size: clamp(48px, 8vw, 72px) !important; line-height: 0.9; font-weight: 800;
            background: linear-gradient(180deg, #fff 0%, #888 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            margin-bottom: 10px; text-transform: uppercase; letter-spacing: -2px;
        }
        .Ml-hero-sub { color: var(--Ml-text-muted); max-width: 600px; margin: 0 auto; }

        /* --- SEARCH BAR (New) --- */
        .Ml-search-bar { 
             margin: 40px auto; padding: 15px; 
            background: rgba(11, 16, 33, 0.8); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 30px; display: flex; gap: 10px; align-items: center; z-index: 50; position: relative;
        }
        .Ml-search-input { 
            flex-grow: 1; background: transparent; border: none; padding: 5px 10px; 
            color: white; font-size: 16px; outline: none;width:100vw;
        }
        .Ml-search-btn { 
            background: var(--Ml-accent-purple); color: white; border: none; 
            width: 40px; height: 40px; border-radius: 50%; transition: 0.3s;
        }
        .Ml-search-btn:hover { background: var(--Ml-accent-cyan); color: black; }

        /* --- FILTERS & TOGGLE BAR --- */
        .Ml-filter-wrapper {
			padding:20px;
			margin:0px 15px;
            background: rgba(11, 16, 33, 0.9); border-top: 1px solid rgba(255,255,255,0.1); border-bottom: 1px solid rgba(255,255,255,0.1);
            padding: 10px 0; position: sticky; top: 80px; z-index: 50;display:flex;
        }
        .Ml-controls-container { display: flex; justify-content: space-between; align-items: center; max-width: 1140px; margin: 0 auto; padding: 0 15px; flex-wrap: wrap; gap: 10px; }
        .Ml-event-filters { display: flex; gap: 10px; flex-wrap: wrap; }
        .Ml-filter-btn {
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: var(--Ml-text-muted);
            padding: 8px 20px; border-radius: 30px; cursor: pointer; transition: 0.3s; font-size: 13px;
        }
        .Ml-filter-btn.active, .Ml-filter-btn:hover {
            background: var(--Ml-accent-purple); color: white; border-color: var(--Ml-accent-purple); box-shadow: 0 0 10px rgba(188, 19, 254, 0.3);
        }
        .Ml-view-switcher { display: flex; gap: 5px; background: rgba(255,255,255,0.05); padding: 4px; border-radius: 4px; }
        
        .Ml-view-btn { border: none; background: transparent; color: var(--Ml-text-muted); width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; cursor: pointer; border-radius: 2px; transition: 0.2s; }
        .Ml-view-btn:hover { color: white; }
        .Ml-view-btn.active { background: var(--Ml-accent-cyan); color: #000; }

        /* --- HYBRID GRID/MAP LAYOUT --- */
        .Ml-events-section { padding: 40px 0 100px; position: relative; z-index: 1; }
        
        .Ml-hybrid-grid {
			margin-top:10px;
            display: grid;
            grid-template-columns: 1fr 1fr; /* Default: Hybrid View */
            gap: 40px;
        }
        
        /* Map Column (REAL MAP EMBED) */
        .Ml-map-column { 
            height: 600px; 
            position: relative; 
            overflow: hidden; 
            border: 1px solid var(--Ml-accent-cyan);
            border-radius: 4px;
            box-shadow: 0 0 30px rgba(0, 240, 255, 0.2);
        }
        .Ml-map-column iframe {
            width: 100%; height: 100%; border: none; filter: grayscale(100%) invert(90%) contrast(1.2);
            opacity: 0.8;
        }

        /* Event List Column (EXPANDED HEIGHT) */
        .Ml-list-column { 
            height: 80vh; /* Base height for hybrid view */
            overflow-y: auto; 
            padding-right: 15px; 
        }
        .Ml-list-column::-webkit-scrollbar { width: 6px; }
        .Ml-list-column::-webkit-scrollbar-thumb { background: rgba(188, 19, 254, 0.5); border-radius: 3px; }
        
        /* Layout Structure Class Toggles */
        .Ml-calendar-active #map-view { display: none !important; }
        
        .Ml-list-grid-content { padding: 0 15px; } /* Wrapper for list/grid content */
        
        /* Hybrid View Content (Default List) */
        .Ml-hybrid-active #list-view { height: 600px; padding-right: 15px; }
        .Ml-hybrid-active #default-list-view { display: block; }
        .Ml-hybrid-active #calendar-split-container { display: none; }
        
        
        /* Event Card Styling for List Column */
        .Ml-event-card-list {
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1);
            border-radius: 4px; padding: 15px; margin-bottom: 15px;
            display: flex; align-items: center; gap: 15px; transition: 0.3s;
            cursor: pointer;
        }
        .Ml-event-card-list:hover { background: rgba(255,255,255,0.08); border-color: var(--Ml-accent-purple); }
        .Ml-list-time { 
            font-family: monospace; font-size: 12px; color: var(--Ml-accent-cyan); flex-shrink: 0; 
            text-align: center; line-height: 1.2;
        }
        .Ml-list-title { font-size: 16px; font-weight: 700; }
        .Ml-list-meta { font-size: 11px; color: var(--Ml-text-muted); }
        .Ml-list-action { margin-left: auto; color: var(--Ml-accent-purple); }
        
        /* --- CALENDAR + GRID VIEW (Adjusted for 50/50 Split) --- */
        
        .Ml-calendar-active #hybrid-container { display: none; } /* Hide map+list container entirely */
        .Ml-calendar-active #calendar-split-container { 
            display: flex; 
            gap: 30px;
            max-width: 1140px; 
            margin: 0 auto;
            padding: 0 15px;
        }
        
        /* Calendar Panel (Right Side, Sticky) */
        .Ml-calendar-panel {
            width: 50%;
            background: rgba(11, 16, 33, 0.9);
            border: 1px solid var(--Ml-accent-cyan);
            border-radius: 4px;
            height: 600px;
            position: sticky;
            top: 150px;
            order: 2;
            box-shadow: 0 0 30px rgba(0, 240, 255, 0.2);
            overflow: hidden;
        }
        
        /* Grid Cards (Left Side, Scrolling) */
        .Ml-mini-card-grid {
            width: 50%;
            display: grid;
            grid-template-columns: 1fr 1fr; /* 2x Grid within the 50% width */
            gap: 15px;
            height: fit-content;
            order: 1; /* Grid Cards on the Left */
        }
        
        .Ml-mini-card {
            background: rgba(255,255,255,0.03);
            border: 1px solid rgba(255,255,255,0.1);
            padding: 25px 15px; 
            border-radius: 4px;
            height: 100%;
            transition: transform 0.3s;
            display: flex; 
            flex-direction: column;
            justify-content: space-between;
        }
        .Ml-mini-card:hover { transform: translateY(-5px); border-color: var(--Ml-accent-purple); }
        .Ml-mini-card-title { font-size: 18px; font-weight: 700; margin-bottom: 5px; line-height: 1.2; }
        .Ml-mini-card-loc { font-size: 12px; color: var(--Ml-text-muted); margin-top: 10px; }

        /* Footer */
        .Ml-footer { padding: 80px 0 40px; border-top: 1px solid rgba(255,255,255,0.05); background: var(--Ml-bg-darker); font-size: 14px; color: var(--Ml-text-muted); }
        .Ml-footer-col h4 { color: white; margin-bottom: 25px; font-size: 18px; }
        .Ml-footer-links { list-style: none; padding: 0; }
        .Ml-footer-links li { margin-bottom: 12px; }
        .Ml-footer-links a { color: var(--Ml-text-muted); transition: 0.3s; text-decoration: none; }
        .Ml-footer-links a:hover { color: var(--Ml-accent-cyan); }
        .Ml-social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; transition: 0.3s; color: white; }
        .Ml-social-btn:hover { background: var(--Ml-accent-cyan); color: black; }

        /* Responsive */
        @media (max-width: 991px) {
				.Ml-event-hero {
					padding-top: 60px;

				}
            .Ml-nav-links { display: none; }
            .Ml-mobile-toggle { display: block; }
            .Ml-hybrid-grid { grid-template-columns: unset !important; gap: 30px; }
            .Ml-list-column { height: 400px; padding-right: 0; }
            .Ml-map-column { height: 300px; }
            .Ml-filter-wrapper { top: 60px; }
            .Ml-controls-container { flex-direction: column; align-items: stretch; }
            .Ml-event-filters { justify-content: center; width: 100%; }
            
            /* Calendar Split on Tablet (Stacks vertically) */
            .Ml-calendar-split-container { flex-direction: column; gap: 30px; }
            .Ml-calendar-panel, .Ml-mini-card-grid { width: 100%; position: relative; top: 0; }
            .Ml-mini-card-grid { grid-template-columns: 1fr 1fr; }
            .Ml-calendar-panel { height: 400px; order: 1; }
            .Ml-mini-card-grid { order: 2; }
        }
        
        @media (max-width: 600px) {
            .Ml-event-filters { flex-direction: column; align-items: stretch; padding: 0 15px; }
            .Ml-mini-card-grid { grid-template-columns: 1fr; }
        }
		#map-canvas{
			height:100vh !important;
		}
		.post-search-result-count{
			display:none;
		}
/* --- CLEAN FILTER SECTION --- */
.Ml-filter-wrapper {
    background: rgba(5, 10, 20, 0.4); /* Transparent glass look */
    backdrop-filter: blur(15px);
    border-top: 1px solid rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    padding: 20px 0;
    position: sticky;
    top: 75px; /* Adjust based on navbar height */
    z-index: 90;
    width: 100%;
}

.Ml-controls-container {
    max-width: 1140px;
    margin: 0 auto;
    padding: 0 20px;
}

.Ml-event-filters {
    display: flex;
    justify-content: center;
    gap: 15px;
    overflow-x: auto; /* Enables swipe on mobile */
    scrollbar-width: none; /* Hides scrollbar Firefox */
    -ms-overflow-style: none; /* Hides scrollbar Edge */
    padding: 5px 0;
}

.Ml-event-filters::-webkit-scrollbar {
    display: none; /* Hides scrollbar Chrome/Safari */
}

/* --- THE FILTER BUTTONS (LINKS) --- */
.Ml-filter-link {
    display: inline-block;
    white-space: nowrap;
    text-decoration: none !important;
    color: var(--Ml-text-muted);
    font-family: var(--Ml-font-heading);
    font-size: 13px;
    font-weight: 600;
    letter-spacing: 1px;
    text-transform: uppercase;
    padding: 10px 24px;
    border-radius: 100px;
    border: 1px solid rgba(188, 19, 254, 0.3); /* Purple border base */
    background: rgba(188, 19, 254, 0.03);
    transition: all 0.4s var(--Ml-ease-tech);
    position: relative;
}

/* Hover State */
.Ml-filter-link:hover {
    color: #fff;
    border-color: var(--Ml-accent-cyan);
    background: rgba(0, 240, 255, 0.1);
    box-shadow: 0 0 20px rgba(0, 240, 255, 0.2);
    transform: translateY(-2px);
}

/* Active/Selected State */
.Ml-filter-link.active {
    background: var(--Ml-accent-purple);
    color: white;
    border-color: var(--Ml-accent-purple);
    box-shadow: 0 0 25px rgba(188, 19, 254, 0.4);
}

/* Responsive Tweak for Mobile */
@media (max-width: 768px) {
    .Ml-event-filters {
        justify-content: flex-start; /* Align left for scrolling */
        padding-left: 10px;
    }
    .Ml-filter-link {
        padding: 8px 18px;
        font-size: 12px;
    }
}
		#btnToLoadMorePost{
			    display: inline-block;
    padding: 14px 36px;
    border-radius: 4px;
    font-family: var(--Ml-font-heading);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 12px;
border-color: var(--Ml-accent-cyan);
    cursor: pointer;
    transition: 0.3s;
    position: relative;
    overflow: hidden;
    clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
	background: transparent; */
    border: 1px solid rgba(255, 255, 255, 0.2); 
    color: white;
		}
.info_window > a:visited, .info_window > a:active, .info_window > a:hover {
    color: #000000 !important;
}

    </style>

<div class="grid-container Ml-hybrid-active">
    <div class="Ml-noise-overlay"></div>

    <div class="Ml-event-hero">
        <div class="container">
            <span style="color:var(--Ml-accent-cyan); letter-spacing:3px; font-family:monospace;">DISCOVER</span>
            <h1 class="Ml-hero-title">Planetary Alignments</h1>
            <p style="color:var(--Ml-text-muted);">Find your next gravitational convergence in the sector.</p>
        </div>
    </div>
<div class="container"><div class="Ml-search-bar"><i class="fa fa-search" style="color:var(--Ml-accent-purple);"></i>  
    <form action="/<?php echo $dc['data_filename']; ?>" method="get" class="eventsForm website-search">
<input type="text" class="Ml-search-input" placeholder="Search by keyword"  value="<?php echo stripslashes($_GET['q']);?>"  name="q" fdprocessedid="mxdqwl">            		
    </form>


</div>
</div>

   <div class="Ml-filter-wrapper">
    <div class="Ml-controls-container">
       <?php
/**
 * DYNAMIC EVENT FILTERS (DATA_ID 73)
 * Fetches categories from the data_categories table
 */

// 1. Fetch event categories and filename from the database
$eventQuery = mysql_query("SELECT feature_categories, data_filename FROM `data_categories` WHERE `data_id` = '73' LIMIT 1");
$eventData  = mysql_fetch_assoc($eventQuery);

$rawEventCats  = $eventData['feature_categories']; 
$eventFilename = $eventData['data_filename'];     

// 2. Convert comma-separated string into an array
$eventCatArray = array();
if (!empty($rawEventCats)) {
    $eventCatArray = array_map('trim', explode(',', $rawEventCats));
}

// 3. Get currently selected categories from URL
$selectedEventCats = !empty($_GET['category']) ? $_GET['category'] : [];
?>

<div class="Ml-event-filters">
    <a href="/<?php echo $eventFilename; ?>" 
       class="Ml-filter-link <?php echo (empty($selectedEventCats) ? 'active' : ''); ?>">
       All Sectors
    </a>

    <?php 
    // 4. Loop through the array and generate dynamic links
    if (!empty($eventCatArray)) {
        // We reverse if you want the same order as your static example
        foreach ($eventCatArray as $categoryName) {
            
            // Handle "value=>label" logic
            if (strpos($categoryName, '=>') !== false) {
                $parts = explode('=>', $categoryName);
                $val = trim($parts[0]);
                $lbl = trim($parts[1]);
            } else {
                $val = $categoryName;
                $lbl = $categoryName;
            }

            $isActive = (is_array($selectedEventCats) && in_array($val, $selectedEventCats));
            ?>

            <a href="/<?php echo $eventFilename; ?>?category[]=<?php echo urlencode($val); ?>" 
               class="Ml-filter-link <?php echo ($isActive ? 'active' : ''); ?>">
                <?php echo $lbl; ?>
            </a>

        <?php } 
    } ?>
</div>
    </div>
</div>
    <div class="container">
        <div class="Ml-hybrid-grid">
            <div class="Ml-list-column" id="list-view">

            <!-- Header code ends here. -->
             <!-- loop code starts here. --> 


            <?php
// Dynamic BD Data Fetch
$post = getMetaData("data_posts", $post['post_id'], $post, $w);
$postFeaturedClass = ($post['sticky_post'] && ($post['sticky_post_expiration_date'] == '0000-00-00' || $post['sticky_post_expiration_date'] >= date('Y-m-d'))) ? ' featured-post' : '';

// Image Logic
$thumbnailImage = "";
if($post['post_image'] != "") {
    $postImageFile = explode("/", str_replace("'", "", $post['post_image']));
    $postImageFileName = end($postImageFile);
    $thumbnailImage = ($w['website_id'] < 9999 && $w['enable_new_path_image'] == 1) 
        ? "/uploads/news-pictures-thumbnails/" . $postImageFileName 
        : "/uploads/news-pictures/" . $postImageFileName;
}

// Price Logic
$displayPrice = "";
if(!empty($post['post_promo'])) {
    $displayPrice = websiteSettingsController::fixPriceValue(
        $post['post_promo'],
        brilliantDirectories::getCurrencySymbol(),
        brilliantDirectories::getCurrencySuffix(),
        brilliantDirectories::getCurrencyThousandsDivider()
    );
}
?>

<a href="/<?php echo $post['post_filename']; ?>" class="Ml-event-card-list <?php echo $postFeaturedClass; ?>">
    <div class="Ml-list-time">
        <?php if(!empty($displayPrice)): ?>
<i class="fa fa-dollar" aria-hidden="true" style="color:var(--Ml-accent-gold); "></i>
<span style="color:var(--Ml-accent-gold); font-weight:700;">
    <?php echo $displayPrice; ?>
</span><br>
        <?php endif; ?>
        <?php echo date('M d', strtotime($post['post_start_date'])); ?>
    </div>

    <?php if($thumbnailImage): ?>
        <div style="width:80px; height:60px; border-radius:4px; overflow:hidden; flex-shrink:0; display:none;">
            <img src="<?php echo $thumbnailImage; ?>" style="width:100%; height:100%; object-fit:cover;" alt="event">
        </div>
    <?php endif; ?>

    <div style="flex-grow:1;">
        <h3 class="Ml-list-title"><?php echo $post['post_title']; ?></h3>
        <div class="Ml-list-meta">
            <i class="fa fa-map-marker" style="color:var(--Ml-accent-purple);"></i> 
            <?php echo !empty($post['post_location']) ? $post['post_venue'] : 'Virtual Sector'; ?>
            <?php echo !empty($post['start_time']) ? ' • ' . $post['start_time'] : ''; ?>
        </div>
    </div>

    <div style="color:var(--Ml-accent-cyan);">
        <i class="fa fa-chevron-right"></i>
    </div>
	[widget=Bootstrap Theme - Google Pins Locations]
</a>

<!-- loop code ends here. ?> -->
 <?php    // Lazy Load Dynamic Logic
    $lazyLoadSearchReults = getAddOnInfo("search_results_lazy_load","8e5c29cd2531efea4db02ebc567b8442");
    if(isset($lazyLoadSearchReults["status"]) && $lazyLoadSearchReults["status"] === "success") {
        echo widget($lazyLoadSearchReults["widget"],"",$w['website_id'],$w);
    } ?>
</div> <div class="Ml-map-column" style="height: 80vh; position: sticky; top: 80px; border: 1px solid rgba(0,240,255,0.2); border-radius: 8px; overflow: hidden;    width: 100%;
    height: 100%;
    border: none;
    filter: grayscale(100%) invert(90%) contrast(1.2);
    opacity: 0.8;">
                <?php
                $mapViewAddOn = getAddOnInfo('google_map_search_results','8342a12b460d88d90a8c421953a44530');
                if (isset($mapViewAddOn['status']) && $mapViewAddOn['status'] == 'success') {
                    echo widget($mapViewAddOn['widget'],"",$w['website_id'],$w);
                } ?>
            </div>

        </div> </div> 
  

</div> <script>
    $(document).ready(function() {
        // Apply custom map styles via CSS Filter to match the dark theme
        $('.Ml-map-column iframe').css({
            'filter': 'grayscale(100%) invert(90%) contrast(1.2)',
            'opacity': '0.8'
        });
    });
</script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Mobile Menu Toggle
        $('#mobile-toggle-btn').click(function() {
            $('#mobile-menu').slideToggle();
        });

        // Filter Logic (Visual)
        $('.Ml-filter-btn').click(function() {
            $('.Ml-filter-btn').removeClass('active');
            $(this).addClass('active');
        });

        // Event View Switcher Logic
        function setView(viewId) {
            const $container = $('#hybrid-container');
            const $listColumn = $('#list-view');
            const $defaultListView = $('#default-list-view');
            const $calendarSplit = $('#calendar-split-container');
            
            // Reset state
            $('.Ml-view-btn').removeClass('active').addClass('Ml-btn-outline');
            $('#' + viewId).addClass('active').removeClass('Ml-btn-outline');
            
            // Hide all specialized containers and reset body class
            $container.hide();
            $calendarSplit.hide();
            $('body').removeClass('Ml-hybrid-active Ml-calendar-active Ml-full-grid-active');

            // 1. Hybrid View (Map + List)
            if (viewId === 'view-hybrid') {
                $('body').addClass('Ml-hybrid-active');
                $container.show();
                $container.css('grid-template-columns', '1fr 1fr');
                $('#map-view').show();
                $listColumn.show().css('height', '600px');
                $defaultListView.show();
                $defaultListView.removeClass('Ml-grid-mode');

            // 2. Grid + Map View (50/50 Split)
            } else if (viewId === 'view-calendar-grid') {
                $('body').addClass('Ml-calendar-active');
                $calendarSplit.show();
            }
        }

        // Initialize Default View
        $(document).ready(function() {
            // Initialize to Hybrid View
            setView('view-hybrid'); 
        });

        // Attach Clicks
        $('#view-hybrid').click(() => setView('view-hybrid'));
        $('#view-calendar-grid').click(() => setView('view-calendar-grid'));
        
    </script>