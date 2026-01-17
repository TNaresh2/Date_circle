 <style>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>?</text></svg>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Outfit:wght@300;500;700;900&family=Playfair+Display:ital,wght@1,400;1,700&display=swap" rel="stylesheet">

    <!-- Bootstrap 3.4.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
/* --- ROOT VARIABLES --- */
        :root {
            --Ml-bg-dark: #050A14; 
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
            width: 100%;
            min-height: 100%;
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
            display: inline-block; padding: 14px 36px; border-radius: 4px;
            font-family: var(--Ml-font-heading); font-weight: 700; text-transform: uppercase; letter-spacing: 2px;
            font-size: 12px; border: none; cursor: pointer; transition: 0.3s; position: relative; overflow: hidden;
            clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
        }
        .Ml-btn-primary { background: var(--Ml-accent-cyan); color: #fff; }
        .Ml-btn-primary:hover { background: black; box-shadow: 0 0 30px var(--Ml-accent-cyan);color:#fff }
        
        .Ml-btn-outline { background: transparent; border: 1px solid rgba(255,255,255,0.2); color: white; }
        .Ml-btn-outline:hover { border-color: var(--Ml-accent-cyan); color: var(--dc-text-main); }

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
        .Ml-nav-links { display: flex; align-items: center;color:#fff; }
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
        .Ml-story-hero {
            padding-top: 40px; padding-bottom: 80px; text-align: center; position: relative; z-index: 1;
            padding-left: 15px; padding-right: 15px;
        }
        .Ml-hero-label {
            font-family: var(--Ml-font-serif); font-style: italic;     color: var(--dc-text-main);
            font-size: 24px; margin-bottom: 10px; display: block;
        }
        .Ml-hero-title {
            font-size: clamp(42px, 8vw, 96px) !important; line-height: 0.9; font-weight: 800;
            background: linear-gradient(180deg, #fff 0%, #888 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;
            margin-bottom: 30px; text-transform: uppercase; letter-spacing: -2px;
        }

        /* --- FEATURED STORY --- */
        .Ml-featured-story {
            max-width: 1100px; margin: 0 auto 120px; position: relative; z-index: 1;
            padding: 0 15px;
        }
        
        .Ml-story-container {
            display: flex; align-items: center; gap: 60px;
            background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);
            padding: 40px; border-radius: 4px; position: relative;
            clip-path: polygon(40px 0, 100% 0, 100% calc(100% - 40px), calc(100% - 40px) 100%, 0 100%, 0 40px);
        }
        
        /* Glowing Border Animation */
        .Ml-story-container::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            border: 1px solid transparent; border-radius: 4px;
            background: linear-gradient(45deg, var(--Ml-accent-purple), transparent, var(--Ml-accent-cyan)) border-box;
            -webkit-mask: linear-gradient(#fff 0 0) padding-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor; mask-composite: exclude;
            opacity: 0.3;
        }

        .Ml-story-visual { width: 50%; position: relative; }
        .Ml-polaroid-stack { position: relative; width: 100%; padding-bottom: 100%; }
        
        .Ml-polaroid {
            position: absolute; top: 0; left: 0; width: 100%; height: auto;
            background: white; padding: 10px 10px 30px 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5); transform: rotate(-5deg);
            transition: 0.5s var(--Ml-ease-tech); z-index: 2;
        }
        .Ml-polaroid:hover { transform: rotate(0deg) scale(1.05); z-index: 5; }
        .Ml-polaroid img { width: 100%; display: block; filter: sepia(0.2); }
        .Ml-polaroid-caption { color: #333; font-family: 'Courier New', monospace; font-size: 12px; margin-top: 10px; text-align: center; font-weight: 700; }

        .Ml-polaroid.secondary {
            top: 40%; left: 30%; width: 60%; transform: rotate(10deg); z-index: 1;
        }
        .Ml-polaroid.secondary:hover { transform: rotate(5deg) scale(1.1); z-index: 6; }

        .Ml-story-content { width: 50%; }
        .Ml-story-meta { font-family: monospace; color: #fff; font-size: 12px; letter-spacing: 2px; margin-bottom: 10px; }
        .Ml-story-names { font-size: clamp(32px, 4vw, 42px); font-family: var(--Ml-font-serif); font-style: italic; margin-bottom: 20px; color: white; }
        .Ml-story-text { font-size: 16px; line-height: 1.8; color: #ccc; margin-bottom: 30px; }
        
        .Ml-orbit-stat { display: flex; gap: 20px; margin-bottom: 30px; flex-wrap: wrap; }
        .Ml-stat-bubble { background: rgba(255,255,255,0.05); padding: 10px 20px; border-radius: 20px; font-family: monospace; font-size: 12px; color: #fff; white-space: nowrap; }

        /* --- STORIES GRID (EQUAL HEIGHT) --- */
        .Ml-grid-section {  position: relative; z-index: 1; }
        .Ml-section-head { text-align: center; margin-bottom: 60px; padding: 0 15px; }
        .Ml-section-title { font-size: clamp(28px, 4vw, 36px); margin-bottom: 10px; }
        
        /* Filter Bar */
        .Ml-story-filters {
            display: flex; justify-content: center; gap: 10px; flex-wrap: wrap; margin-bottom: 50px; padding: 0 15px;
        }
        .Ml-filter-btn {
            background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);     color: var(--dc-text-main);
            padding: 8px 20px; border-radius: 30px; cursor: pointer; transition: 0.3s; font-size: 13px;
        }
        .Ml-filter-btn.active, .Ml-filter-btn:hover {
            background: var(--Ml-accent-cyan); color: var(--dc-text-main); border-color: var(--Ml-accent-cyan);
        }

        /* Strict Grid for Equal Height */
        .Ml-stories-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr); /* 3 Columns Desktop */
            gap: 30px;
            padding: 0 15px;
        }
        
        .Ml-story-card {
            background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);
            border-radius: 12px; overflow: hidden; transition: 0.4s; position: relative; cursor: pointer;
            height: 100%; /* Fill grid cell height */
            display: flex; flex-direction: column;
        }
        .Ml-story-card:hover { transform: translateY(-10px); border-color: var(--Ml-accent-cyan); background: rgba(255,255,255,0.05); }
        
        .Ml-card-img-wrapper {
            width: 100%; height: 250px; position: relative; overflow: hidden; flex-shrink: 0;
        }
        .Ml-card-img-wrapper .Ml-card-img { width: 100% !important; height: 100% !important; object-fit: cover; opacity: 0.8; transition: 0.4s; }
        .Ml-story-card:hover .Ml-card-img { opacity: 1; transform: scale(1.05); }
        
        .Ml-card-body { padding: 25px; position: relative; flex-grow: 1; display: flex; flex-direction: column; }
        .Ml-card-date { position: absolute; top: -15px; right: 20px; background: var(--Ml-accent-gold); color: var(--dc-text-main); padding: 4px 10px; font-size: 10px; font-weight: 800; text-transform: uppercase; letter-spacing: 1px; border-radius: 4px; }
        
        .Ml-card-title { font-family: var(--Ml-font-serif); font-size: 24px; margin-bottom: 10px; font-style: italic; color: white; }
        .Ml-card-excerpt { font-size: 14px;     color: var(--dc-text-main); line-height: 1.6; margin-bottom: 20px; flex-grow: 1; }
        .Ml-card-link { font-size: 11px;     color: var(--dc-text-main); text-transform: uppercase; letter-spacing: 1px; font-weight: 700; margin-top: auto; }

        .Ml-load-more-container { text-align: center; margin-top: 60px; }

        /* --- CTA --- */
        .Ml-share-cta {
            padding: 100px 0; text-align: center; background: linear-gradient(180deg, transparent 0%, #0B1021 100%);
            position: relative; overflow: hidden;
        }
        .Ml-share-glow {
            position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            width: 500px; height: 500px; background: radial-gradient(circle, rgba(255, 0, 85, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        /* Footer */
        .Ml-footer { padding: 80px 0 40px; border-top: 1px solid rgba(255,255,255,0.05); background: #020408; font-size: 14px; color: #888; position: relative; z-index: 1; }
        .Ml-footer-col h4 { color: white; margin-bottom: 25px; font-size: 18px; }
        .Ml-footer-links { list-style: none; padding: 0; }
        .Ml-footer-links li { margin-bottom: 12px; }
        .Ml-footer-links a { color: #888; transition: 0.3s; }
        .Ml-footer-links a:hover { color: var(--Ml-accent-cyan); }
        .Ml-social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; transition: 0.3s; color: white; }
        .Ml-social-btn:hover { background: var(--Ml-accent-cyan); color: black; }

        /* Responsive */
        @media (max-width: 991px) {
            .Ml-nav-links.hidden-xs { display: none !important; }
            .Ml-mobile-toggle { display: block; }
            
            /* Reset featured story to stack */
            .Ml-story-container { flex-direction: column; gap: 40px; clip-path: none; border-radius: 20px; padding: 25px; }
            .Ml-story-visual, .Ml-story-content { width: 100%; }
            .Ml-polaroid-stack { padding-bottom: 80%; }
            
            /* 2 Columns on Tablet */
            .Ml-stories-grid { grid-template-columns: repeat(2, 1fr); } 
			.Ml-share-cta {
				padding: 50px 0;
			}
			.Ml-featured-story {
				margin: 0 auto 20px;
			}
        }
        
        @media (max-width: 600px) {
            /* 1 Column on Mobile */
            .Ml-stories-grid { grid-template-columns: 1fr; } 
            .Ml-orbit-stat { flex-direction: column; gap: 10px; }
            .Ml-filter-btn { flex-grow: 1; text-align: center; }
            
            /* Adjust stack */
            .Ml-polaroid.secondary { top: 30%; left: 10%; width: 70%; }
            .Ml-polaroid { width: 85%; }
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
    border: none;
    cursor: pointer;
    transition: 0.3s;
    position: relative;
    overflow: hidden;
    clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px);
    background: var(--dc-bg-soft) !important;
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: white;
	  }
/* ================================
   PAGINATION – HIGH VISIBILITY (WHITE ONLY)
   ================================ */

.post-pagination-block {
    display: flex;
    justify-content: center;
    margin: 60px 0 20px;
}

/* Pagination container */
.post-pagination-block .pagination {
    margin: 0;
    display: flex;
    gap: 12px;
}

/* Pagination items */
.post-pagination-block .pagination > li {
    display: inline-flex;
}

/* Base link style */
.post-pagination-block .pagination > li > a,
.post-pagination-block .pagination > li > span {
    background: transparent;
    border: 1px solid rgba(255,255,255,0.6);
    color: #ffffff;
    padding: 10px 18px;
    font-family: var(--Ml-font-heading);
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 1px;
    transition: all 0.25s ease;
    clip-path: polygon(6px 0, 100% 0, 100% calc(100% - 6px), calc(100% - 6px) 100%, 0 100%, 0 6px);
}

/* Hover state */
.post-pagination-block .pagination > li > a:hover {
    background: #ffffff;
    color: #000000;
    border-color: #ffffff;
}

/* Active page */
.post-pagination-block .pagination > .active > a,
.post-pagination-block .pagination > .active > span {
    background: #ffffff;
    color: #000000;
    border-color: #ffffff;
    cursor: default;
}

/* Remove default Bootstrap radius */
.post-pagination-block .pagination > li > a,
.post-pagination-block .pagination > li > span {
    border-radius: 0;
}

/* Hide clearfix */
.post-pagination-block .clearfix {
    display: none;
}
	 .post-search-result-count{
		 display:none;
	 }
</style>
    <link rel="canonical" href="https://www.moonloop.com/stories">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://www.moonloop.com/stories">
    <meta property="og:title" content="Constellations | MoonLoop Stories">
    <meta property="og:description" content="Real stories of gravitational attraction. See how MoonLoop brought these binary stars together.">
    <meta property="og:image" content="https://placehold.co/1200x630/050A14/BC13FE.png?text=MoonLoop+Stories">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://www.moonloop.com/stories">
    <meta property="twitter:title" content="Constellations | MoonLoop Stories">
    <meta property="twitter:description" content="Real stories of gravitational attraction.">
    <meta property="twitter:image" content="https://placehold.co/1200x630/050A14/BC13FE.png?text=MoonLoop+Stories">
    

    <style>
        
    </style>


    <div class="Ml-noise-overlay"></div>
    <div class="Ml-asteroid-system">
        <div class="Ml-asteroid Ml-asteroid-1"></div>
        <div class="Ml-asteroid Ml-asteroid-2"></div>
    </div>

  

    <!-- Hero -->
    <div class="Ml-story-hero">
        <div class="container">
            <div class="Ml-gravity-target">
                <span class="Ml-hero-label">The Constellations</span>
                <h1 class="Ml-hero-title">Written in<br>The Stars</h1>
                <p style=" font-size:18px;   color: var(--dc-text-main);">Real stories of gravitational attraction.</p>
            </div>
        </div>
    </div>

  <?php
/**
 * DYNAMIC FEATURED STORY (DATA_ID 76)
 * Fetches the most recent 'post_featured' entry
 */

// 1. Fetch the featured post from data_posts for data_id 76
$featuredPostQuery = mysql_query("SELECT * FROM `data_posts` 
                                  WHERE `data_id` = '76' 
                                  AND `post_featured` = '1' 
                                  AND `post_status` = '1' 
                                  ORDER BY `post_live_date` DESC LIMIT 1");

$fPost = mysql_fetch_assoc($featuredPostQuery);

// If a featured post exists, render the HTML
if ($fPost) {
    // Formatting the Title (assuming "Person & Person" or standard title)
    $storyTitle = $fPost['post_title'];
    
    // Formatting the Content (Truncating post_content for the narrative section)
    $storyText = strip_tags($fPost['post_content']);
    if (strlen($storyText) > 300) {
        $storyText = substr($storyText, 0, 300) . "...";
    }

    // Getting the Image (Fallback to a default if empty)
    $storyImg = !empty($fPost['post_image']) ? $fPost['post_image'] : 'https://datecircle.directoryup.com/images/pexel-photo-5910856-medium.jpeg';
    
    // Post URL
    $storyUrl = "/articles/" . $fPost['post_filename'];

    // Calculating Orbit (Using post_live_date to show how long it's been active)
    $liveDate = strtotime($fPost['post_live_date']);
    $monthsAgo = floor((time() - $liveDate) / (30 * 24 * 60 * 60));
    $orbitMeta = ($monthsAgo > 0) ? $monthsAgo . " MONTHS" : "NEW ORBIT";
?>

    <div class="Ml-featured-story">
        <div class="Ml-story-container Ml-gravity-target">
            
            <div class="Ml-story-visual">
                <div class="Ml-polaroid-stack">
                    <div class="Ml-polaroid">
                        <img src="<?php echo $storyImg; ?>" alt="<?php echo $storyTitle; ?>">
                        <div class="Ml-polaroid-caption">STARDATE <?php echo date("Y", $liveDate); ?></div>
                    </div>
                </div>
            </div>

            <div class="Ml-story-content">
                <div class="Ml-story-meta">// ORBIT ESTABLISHED: <?php echo $orbitMeta; ?></div>
                <h2 class="Ml-story-names"><?php echo $storyTitle; ?></h2>
                <p class="Ml-story-text">
                    "<?php echo $storyText; ?>"
                </p>
                
                <div class="Ml-orbit-stat">
                    <?php 
                    $tags = explode(',', $fPost['post_tags']);
                    $count = 0;
                    foreach($tags as $tag) {
                        if($count < 2 && !empty($tag)) {
                            echo '<span class="Ml-stat-bubble"><i class="fa fa-star"></i> '.trim($tag).'</span> ';
                            $count++;
                        }
                    }
                    ?>
                </div>

            </div>

        </div>
    </div>

<?php } else { ?>
    <div class="Ml-featured-story" style="text-align:center; padding: 50px;">
        <p>// NO FEATURED SIGNAL DETECTED IN THIS SECTOR</p>
    </div>
<?php } ?>
    <!-- Grid: Recent Collisions -->
    <div class="Ml-grid-section">
        <div class="container">
            
            <!-- Filters -->
         <?php
/**
 * DYNAMIC CATEGORY FILTER FOR DATA_ID 76
 * Fetching from data_categories table
 */

// 1. Fetch the feature categories string from the database
$featureQuery = mysql_query("SELECT feature_categories, data_filename FROM `data_categories` WHERE `data_id` = '76' LIMIT 1");
$featureData  = mysql_fetch_assoc($featureQuery);

$rawCategories = $featureData['feature_categories']; // e.g., "Category 1, Category 2"
$pageFilename  = $featureData['data_filename'];     // The slug for the URL

// 2. Convert comma-separated string into an array
$catArray = array();
if (!empty($rawCategories)) {
    $catArray = array_map('trim', explode(',', $rawCategories));
}

// 3. Get currently selected categories from URL for the "active" class
$selectedCats = !empty($_GET['category']) ? $_GET['category'] : [];
?>

<div class="Ml-story-filters">
    <a href="/<?php echo $pageFilename; ?>" 
       class="Ml-filter-btn <?php echo (empty($selectedCats) ? 'active' : ''); ?>">
       All Stories
    </a>

    <?php 
    // 4. Loop through the array and generate dynamic links
    if (!empty($catArray)) {
        foreach ($catArray as $categoryName) {
            
            // Handle BD "value=>label" logic if present, otherwise use name
            if (strpos($categoryName, '=>') !== false) {
                $parts = explode('=>', $categoryName);
                $val = trim($parts[0]);
                $lbl = trim($parts[1]);
            } else {
                $val = $categoryName;
                $lbl = $categoryName;
            }

            $isActive = (is_array($selectedCats) && in_array($val, $selectedCats));
            ?>

            <a href="/<?php echo $pageFilename; ?>?category[]=<?php echo urlencode($val); ?>" 
               class="Ml-filter-btn <?php echo ($isActive ? 'active' : ''); ?>">
                <?php echo $lbl; ?>
            </a>

        <?php } 
    } ?>
</div>
            <!-- Equal Height Grid -->
            <div class="Ml-stories-grid">
                

            <!-- header code ends and loop begins below -->

            <?php 
// Initialize Subscription and Featured Class logic
$subscription = getSubscription($user['subscription_id'], $w);
$postFeaturedClass = ($post['sticky_post'] && ($post['sticky_post_expiration_date'] == '0000-00-00' || $post['sticky_post_expiration_date'] >= date('Y-m-d'))) 
    ? ' featured-post' 
    : '';

// Image Handling Logic
$thumbnailImage = "https://placehold.co/600x400?text=No+Image"; 
if ($post['post_image'] != "") {
    $postImageFile = explode("/", str_replace("'", "", $post['post_image']));
    $postImageFileName = $postImageFile[3];
    $thumbnailImage = "/uploads/news-pictures-thumbnails/" . $postImageFileName;
}
?>

<div class="Ml-story-card Ml-gravity-target <?php echo $postFeaturedClass; ?>" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
    <meta itemprop="position" content="<?php echo ++$GLOBALS['search_result_position']; ?>">
    <meta itemprop="url" content="/<?php echo $post['post_filename']; ?>">
    <meta itemprop="name" content="<?php echo htmlspecialchars($post['post_title'], ENT_QUOTES, 'UTF-8'); ?>">

    <div class="Ml-card-img-wrapper">
        <a title="<?php echo $post['post_title']; ?>" href="/<?php echo $post['post_filename']; ?>">
            <img src="<?php echo $thumbnailImage; ?>" 
                 class="Ml-card-img" 
                 alt="<?php echo (!empty($post['post_alt']) ? $post['post_alt'] : $post['post_title']); ?>" 
                 title="<?php echo $post['post_title']; ?>">
        </a>
    </div>

    <div class="Ml-card-body">
        <span class="Ml-card-date">
            <?php 
            if ($post['post_start_date'] != "") { 
                echo transformDate($post['post_start_date'], "QB");
            } else if ($post['post_live_date'] != "") { 
                echo transformDate($post['post_live_date'], "QB"); 
            } else {
                echo "New Orbit";
            }
            ?>
        </span>

        <h4 class="Ml-card-title">
            <a href="/<?php echo $post['post_filename']; ?>" style="color: inherit; text-decoration: none;">
                <?php echo $post['post_title']; ?>
            </a>
        </h4>

        <?php if ($post['post_content'] != "") { ?>
            <p class="Ml-card-excerpt">
                <?php echo limitWords(preg_replace('#<[^>]+>#', ' ', $post['post_content']), 115); ?>
            </p>
        <?php } ?>

        <a class="Ml-card-link" title="<?php echo $post['post_title']; ?>" href="/<?php echo $post['post_filename']; ?>">
            %%%view_more_label%%% <i class="fa fa-long-arrow-right"></i>
        </a>
        
        <div class="hidden">
            <?php
            $addonFavorites = getAddOnInfo("add_to_favorites","a8ad175dd81204563b3a9fc3ebcd5354");
            if (isset($addonFavorites['status']) && $addonFavorites['status'] === 'success') {
                echo '<span class="postItem" data-userid="'.$post['user_id'].'" data-datatype="'.$post['data_type'].'" data-dataid="'.$post['data_id'].'" data-postid="'.$post['post_id'].'"></span>';
            } 
            ?>
        </div>
    </div>
</div>

<!-- loop code ends here and footer begins below  -->
 </div>
            <div class="Ml-load-more-container">

<?php
$lazyLoadSearchReults = getAddOnInfo("search_results_lazy_load","8e5c29cd2531efea4db02ebc567b8442");
if(isset($lazyLoadSearchReults["status"]) && $lazyLoadSearchReults["status"] === "success" && ($dc["enableLazyLoad"] == 1 || $dc["enableLazyLoad"] == "")) {
    echo widget($lazyLoadSearchReults["widget"],"",$w['website_id'],$w);
} ?>
</div>
 <!-- CTA 
    <div class="Ml-share-cta">
        <div class="Ml-share-glow"></div>
        <div class="container" style="position:relative; z-index:1;">
            <h2 style="font-size:clamp(32px, 5vw, 42px); margin-bottom:20px;color: var(--dc-text-main);">Found Your Partner?</h2>
            <p style="margin-bottom:40px;color: var(--dc-text-main);">Share your trajectory with the universe.</p>
            <a href="/account/modern-blog/add" class="Ml-btn Ml-btn-outline">Submit Flight Log</a>
        </div>
    </div>-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#mobile-toggle-btn').click(function() {
            $('#mobile-menu').slideToggle();
        });

        // Filter Logic (Visual)
        $('.Ml-filter-btn').click(function() {
            $('.Ml-filter-btn').removeClass('active');
            $(this).addClass('active');
        });

        // Gravity Logic
        $(document).ready(function() {
            const gravityStrength = 15;
            const range = 600; 
            if (window.matchMedia("(pointer: fine)").matches) {
                $(document).on('mousemove', function(e) {
                    requestAnimationFrame(() => {
                        $('.Ml-gravity-target').each(function() {
                            const $el = $(this);
                            const offset = $el.offset();
                            const centerX = offset.left + $el.outerWidth() / 2;
                            const centerY = offset.top + $el.outerHeight() / 2;
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