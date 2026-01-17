    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>?</text></svg>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Outfit:wght@300;500;700;900&family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->

    <style>
        /* --- MOONLOOP ROOT VARIABLES --- */
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
            background: radial-gradient(circle at 50% 10%, #1a0b2e 0%, #050A14 80%);
            background-attachment: fixed;
        }

        .Ml-noise-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 9999; opacity: 0.05;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='1'/%3E%3C/svg%3E");
        }

        .Ml-asteroid-system { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; overflow: hidden; }
        .Ml-asteroid { position: absolute; border-radius: 50%; background: #fff; box-shadow: 0 0 15px 2px rgba(255, 255, 255, 0.4); opacity: 0; }
        .Ml-asteroid::after { content: ''; position: absolute; top: 50%; left: 50%; width: 100px; height: 2px; background: linear-gradient(90deg, rgba(255,255,255,0.5), transparent); transform-origin: left center; transform: translateY(-50%) rotate(180deg); }
        @keyframes Ml-fly-diag-1 { 0% { transform: translate(-100px, -100px) rotate(45deg); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translate(120vw, 120vh) rotate(45deg); opacity: 0; } }
        .Ml-asteroid-1 { top: 0; left: 0; width: 4px; height: 4px; animation: Ml-fly-diag-1 35s linear infinite; }
        .Ml-asteroid-2 { top: 20%; left: -100px; width: 3px; height: 3px; animation: Ml-fly-diag-1 45s linear infinite; animation-delay: 10s; }

        h1, h2, h3, h4 { font-family: var(--Ml-font-heading); margin: 0; }
        a, a:hover, button:focus { text-decoration: none; outline: none; color: inherit; }

        .Ml-gallery-hero {
            padding-top: 60px; padding-bottom: 80px; text-align: center; position: relative; z-index: 1;
            background: radial-gradient(circle at 50% 100%, rgba(0, 240, 255, 0.05) 0%, transparent 60%);
        }
        .Ml-hero-title {
            font-size: clamp(42px, 8vw, 72px) !important; font-weight: 900; margin-bottom: 20px; color: white;
            text-transform: uppercase; letter-spacing: -1px;
        }
        .Ml-hero-sub { color: var(--Ml-text-muted); font-size: 18px; max-width: 600px; margin: 0 auto; }

        .Ml-story-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 40px;
            padding-bottom: 40px;
            position: relative; z-index: 1;
        }

        .Ml-gallery-card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.5s var(--Ml-ease-tech);
            position: relative;
            cursor: pointer;
            display: flex;
            flex-direction: column;
        }

        .Ml-gallery-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.05);
            border-color: var(--Ml-accent-cyan);
            box-shadow: 0 20px 50px rgba(0, 240, 255, 0.1);
        }

        .Ml-cover-img-wrap {
            width: 100%; height: 320px; overflow: hidden; position: relative;
        }

        /* --- CAROUSEL REFINEMENT --- */
        .carousel, .carousel-inner, .item { height: 100%; }
        .Ml-cover-img {
            width: 100% !important; height: 320px !important; object-fit: cover; transition: transform 1.2s var(--Ml-ease-tech);
            filter: brightness(0.9) contrast(1.1);
        }
        .Ml-gallery-card:hover .Ml-cover-img { transform: scale(1.05); filter: brightness(1); }
        
        .carousel-control { width: 10%; background-image: none !important; opacity: 0; transition: 0.3s; }
        .Ml-gallery-card:hover .carousel-control { opacity: 1; }
        .carousel-control i { position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); color: var(--Ml-accent-cyan); font-size: 18px; }

        .Ml-photo-count {
            position: absolute; top: 15px; right: 15px;
            background: rgba(0, 0, 0, 0.6); backdrop-filter: blur(5px);
            border: 1px solid var(--Ml-accent-cyan); color: var(--Ml-accent-cyan);
            padding: 4px 10px; border-radius: 4px; font-size: 10px; font-weight: 700;
            font-family: monospace; display: flex; align-items: center; gap: 5px; z-index: 5;
        }

        .Ml-card-body {
            padding: 25px; position: relative; z-index: 2;
            border-top: 1px solid rgba(255,255,255,0.05);
        }

        .Ml-avatar-float {
            width: 60px!important; height: 60px!important; border-radius: 50%;
            border: 2px solid var(--Ml-bg-dark);
            object-fit: cover; margin-top: -55px; margin-bottom: 15px;
            position: relative; z-index: 3; transition: transform 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.5);
        }
        .Ml-gallery-card:hover .Ml-avatar-float { transform: scale(1.1); border-color: var(--Ml-accent-cyan); }

        .Ml-member-name {
            font-family: var(--Ml-font-heading); font-size: 24px; font-weight: 700;
            color: white; margin-bottom: 5px; line-height: 1.2;
        }
        
        .Ml-member-meta {
            font-size: 13px; color: var(--Ml-text-muted); display: flex; align-items: center; gap: 15px;
            font-family: monospace; margin-bottom: 20px;
        }
        .Ml-member-meta i { color: var(--Ml-accent-purple); }

        .Ml-view-btn {
            border-top: 1px dashed rgba(255,255,255,0.1); padding-top: 20px;
            color: var(--Ml-accent-cyan); font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: 2px;
            display: flex; align-items: center; gap: 8px; opacity: 0.7; transition: 0.3s;
        }
        .Ml-gallery-card:hover .Ml-view-btn { opacity: 1; color: white; text-shadow: 0 0 10px var(--Ml-accent-cyan); }
        .Ml-gallery-card:hover .Ml-view-btn i { transform: translateX(5px); }

        .Ml-pagination-wrap {
            display: flex; justify-content: center; align-items: center; gap: 10px;
            padding: 40px 0 100px; position: relative; z-index: 1;
        }
        .Ml-page-btn {
            width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.1);
            color: var(--Ml-text-muted); border-radius: 8px; font-family: monospace; font-weight: 700;
            cursor: pointer; transition: 0.3s;
        }
        .Ml-page-btn.active { background: var(--Ml-accent-cyan); border-color: var(--Ml-accent-cyan); color: #000; box-shadow: 0 0 15px rgba(0, 240, 255, 0.3); }

        .Ml-filter-bar {
            margin-bottom: 30px; display: flex; flex-wrap: wrap; align-items: center; gap: 15px; justify-content: space-between;
        }
				.website-search{
					width : 300px;
				}
        .Ml-filter-input {
            flex: 1 1 220px; padding: 10px 14px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.18);
            background: rgba(5,10,20,0.8); color: var(--Ml-text-light); font-size: 13px; outline: none;
        }
        .Ml-filter-buttons { display: flex; flex-wrap: wrap; gap: 8px; }
        .Ml-filter-btn { font-size: 12px; padding: 8px 14px; border-radius: 999px; border: 1px solid rgba(255,255,255,0.18); background: rgba(255,255,255,0.02); color: var(--Ml-text-muted); text-transform: uppercase; letter-spacing: 1px; cursor: pointer; transition: 0.25s; }
        .Ml-filter-btn-active, .Ml-filter-btn:hover { color: #000; background: var(--Ml-accent-cyan); border-color: var(--Ml-accent-cyan); }

        @media (max-width: 991px) { .Ml-story-grid { grid-template-columns: repeat(2, 1fr); gap: 30px; } }
        @media (max-width: 600px) { .Ml-story-grid { grid-template-columns: 1fr; gap: 40px; } .Ml-hero-title { font-size: 42px; } }
		.Ml-cover-img-wrap .rsOverflow,
.Ml-cover-img-wrap .rsContainer,
.Ml-cover-img-wrap .rsSlide {
    height: 320px !important;
}
/* Force slider images to fixed height */
.Ml-cover-img-wrap .rsImg.rsMainSlideImage {
    height: 320px !important;
    width: 100% !important;
    object-fit: cover;
    margin: 0 !important;
}
		.favorite .fa .fa-heart{
			display:none !important;
		}
		#first_container .favorite, #first_container .fa.favorite{
			display:none;
		}
		.post-search-result-count{
			display:none;
		}
/* --- MOONLOOP PAGINATION PERFECTION --- */
.post-pagination-block {
    padding: 40px 0 100px;
    display: flex;
    justify-content: center;
    position: relative;
    z-index: 10;
}

.post-pagination-block .pagination {
    margin: 0;
    border: none;
    display: flex;
    gap: 10px;
}

/* Base Style for each Page Link */
.post-pagination-block .pagination > li > a, 
.post-pagination-block .pagination > li > span {
    width: 42px;
    height: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.03); /* Subtle Space Glass */
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 8px !important; /* Overriding Bootstrap defaults */
    color: #8892B0; /* --Ml-text-muted */
    font-family: "Outfit", sans-serif;
    font-weight: 700;
    transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
    margin: 0;
    padding: 0;
}

/* Hover State */
.post-pagination-block .pagination > li > a:hover, 
.post-pagination-block .pagination > li > a:focus {
    background: rgba(0, 240, 255, 0.05); /* --Ml-accent-cyan low opacity */
    border-color: #00F0FF; /* --Ml-accent-cyan */
    color: #00F0FF;
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(0, 240, 255, 0.2);
}

/* Active Page State */
.post-pagination-block .pagination > .active > a, 
.post-pagination-block .pagination > .active > a:hover, 
.post-pagination-block .pagination > .active > a:focus {
    background: #00F0FF !important; /* --Ml-accent-cyan */
    border-color: #00F0FF !important;
    color: #020408 !important; /* Dark text on bright background */
    box-shadow: 0 0 20px rgba(0, 240, 255, 0.4);
    z-index: 2;
}

/* Handling the "»" Next Arrow */
.post-pagination-block .pagination > li:last-child > a span {
    font-size: 18px;
    line-height: 1;
}

/* Mobile Responsiveness */
@media (max-width: 767px) {
    .post-pagination-block .pagination > li > a {
        width: 36px;
        height: 36px;
        font-size: 12px;
    }
	.Ml-filter-bar {
		flex-direction: column;
	}
	.website-search, .website-search input{
		 width: 100%;
	}
}
    </style>

    <div class="Ml-noise-overlay"></div>
    <div class="Ml-asteroid-system">
        <div class="Ml-asteroid Ml-asteroid-1"></div>
        <div class="Ml-asteroid Ml-asteroid-2"></div>
    </div>

    <header class="Ml-gallery-hero">
        <div class="container">
            <h1 class="Ml-hero-title">Star Chart</h1>
            <p class="Ml-hero-sub">A visual glimpse into the lives of our community.</p>
        </div>
    </header>

    <div class="container">
        <div class="Ml-filter-bar">
    <form class="form website-search" action="/<?php echo $dc['data_filename']; ?>" method="get">
            <input type="text" name="q"  id="Ml-keyword-input" class="Ml-filter-input"  name="q" placeholder="%%%home_search_keyword%%%" name="q" value="<?php echo stripslashes($_GET['q']);?>">
</form>
            <div class="Ml-filter-buttons">
                <a href="https://datecircle.directoryup.com/modern-photo-albums" type="button" class="Ml-filter-btn" >All</a>
                <button type="button" class="Ml-filter-btn" data-category="men">Men</button>
                <button type="button" class="Ml-filter-btn" data-category="women">Women</button>
                <button type="button" class="Ml-filter-btn" data-category="other">Other</button>
            </div>
        </div>

        <div class="Ml-story-grid" id="Ml-grid-container">


        <!-- header ends here and loop begins below -->

        <?php
/**
 * MoonLoop Gallery Card - Fixed & Optimized
 */

// --- METADATA ---
$p = getMetaData("users_portfolio_groups", $p['group_id'], $p, $w);

// --- 1. COUNT IMAGES ---
$countResult = mysql(
    brilliantDirectories::getDatabaseConfiguration('database'),
    "SELECT COUNT(*) AS total_images
     FROM users_portfolio
     WHERE group_id = '".$p['group_id']."'
       AND data_id = '".$p['data_id']."'"
);
$countRow    = mysql_fetch_assoc($countResult);
$totalImages = (int)$countRow['total_images'];

// --- 2. FETCH FIRST IMAGE (PRIMARY IMAGE) ---
$presults = mysql(
    brilliantDirectories::getDatabaseConfiguration('database'),
    "SELECT file, user_id
     FROM users_portfolio
     WHERE group_id = '".$p['group_id']."'
       AND data_id = '".$p['data_id']."'
     ORDER BY `order` ASC, photo_id ASC
     LIMIT 1"
);
$pic = mysql_fetch_assoc($presults);

$p['group_picture'] = !empty($pic['file']) ? $pic['file'] : '';
$user_id            = !empty($pic['user_id']) ? (int)$pic['user_id'] : 0;

// --- 3. GET USER DETAILS (ONE QUERY ONLY) ---
$user = ($user_id > 0) ? getUser($user_id, $w) : [];

// --- TITLE FALLBACK ---
if (empty($p['title'])) {
    $p['title'] = defaultPhotoTitle($p, $w);
}

// --- FEATURED CLASS ---
$postFeaturedClass = (
    !empty($p['sticky_post']) &&
    ($p['sticky_post_expiration_date'] == '0000-00-00'
     || $p['sticky_post_expiration_date'] >= date('Y-m-d'))
) ? ' featured-post' : '';

$categoryAttr = !empty($p['group_category'])
    ? strtolower($p['group_category'])
    : 'all';
?>

<div class="Ml-gallery-card search_result<?php echo $postFeaturedClass; ?>"
     data-category="<?php echo $categoryAttr; ?>"
     itemprop="itemListElement"
     itemscope
     itemtype="https://schema.org/ListItem">

    <meta itemprop="position" content="<?php echo ++$GLOBALS['search_result_position']; ?>">
    <meta itemprop="url" content="/<?php echo $p['group_filename']; ?>">
    <meta itemprop="name" content="<?php echo htmlspecialchars($p['group_name'], ENT_QUOTES, 'UTF-8'); ?>">

    <!-- COVER IMAGE / CAROUSEL -->
    <div class="Ml-cover-img-wrap">
        <?php if ($totalImages > 0) { ?>
            <?php echo widget("Bootstrap Theme - Search Results - Display Image Slider"); ?>
        <?php } else { ?>
            <img src="/images/default-image.jpg" class="Ml-cover-img" alt="Default image">
        <?php } ?>

        <div class="Ml-photo-count">
            <i class="fa fa-camera"></i>
            <?php echo $totalImages; ?> Photos
        </div>
    </div>

    <!-- CARD BODY -->
    <div class="Ml-card-body">

        <a href="/<?php echo $user['filename']; ?>">
            <img
                src="<?php echo !empty($user['image_main_file'])
                    ? $user['image_main_file']
                    : '/images/default-avatar.png'; ?>"
                class="Ml-avatar-float"
                alt="<?php echo $user['full_name']; ?>">
        </a>

        <h3 class="Ml-member-name">
            <a href="/<?php echo $p['group_filename']; ?>">
                <?php echo $p['group_name']; ?>
            </a>
        </h3>

        <div class="Ml-member-meta">
            <?php if (!empty($user['city'])) { ?>
                <span>
                    <i class="fa fa-map-marker"></i>
                    <?php echo $user['city']; ?>
                    <?php echo !empty($user['state_ln']) ? ', '.$user['state_ln'] : ''; ?>
                </span>
            <?php } ?>

            <?php if (!empty($p['group_category'])) { ?>
                <span>
                    <i class="fa fa-tags"></i>
                    <?php echo $p['group_category']; ?>
                </span>
            <?php } ?>
        </div>

        <a href="/<?php echo $p['group_filename']; ?>" class="Ml-view-btn">
            %%%results_view_details_link%%% <i class="fa fa-long-arrow-right"></i>
        </a>

        <div class="tmargin">
            <?php
            $addonFavorites = getAddOnInfo("add_to_favorites","a8ad175dd81204563b3a9fc3ebcd5354");
            if (!empty($addonFavorites['status']) && $addonFavorites['status'] === 'success') {
                echo '<span class="postItem"
                        data-userid="'.$user_id.'"
                        data-datatype="'.$p['data_type'].'"
                        data-dataid="'.$p['data_id'].'"
                        data-postid="'.$p['group_id'].'"></span>';
                echo widget($addonFavorites['widget'], "", $w['website_id'], $w);
            }

            addonController::showWidget(
                'star_ratings_for_posts',
                '609d748eaa051578e8ae2e3c8f848d9a'
            );
            ?>
        </div>
    </div>
</div>


<!-- loop ends here and footer begins below -->

</div>
<?php
$lazyLoadSearchReults = getAddOnInfo("search_results_lazy_load","8e5c29cd2531efea4db02ebc567b8442");
if(isset($lazyLoadSearchReults["status"]) && $lazyLoadSearchReults["status"] === "success" && ($dc["enableLazyLoad"] == 1 || $dc["enableLazyLoad"] == "")) {
    echo widget($lazyLoadSearchReults["widget"],"",$w['website_id'],$w);
} ?>


<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.rsImg.rsMainSlideImage').forEach(function (el) {
        el.classList.add('Ml-cover-img');
    });

});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const baseUrl = 'https://datecircle.directoryup.com/modern-photo-albums';

    const categoryMap = {
        all: '',
        men: 'Men',
        women: 'Women',
        other: 'others'
    };

    // --- CLICK HANDLER ---
    document.querySelectorAll('.Ml-filter-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {

            // Remove active from all
            document.querySelectorAll('.Ml-filter-btn')
                .forEach(b => b.classList.remove('Ml-filter-btn-active'));

            // Add active to clicked
            this.classList.add('Ml-filter-btn-active');

            // Redirect
            const key = this.getAttribute('data-category');
            const value = categoryMap[key] || 'All';

            window.location.href =
                baseUrl + '?category%5B%5D=' + encodeURIComponent(value);
        });
    });

    // --- ON PAGE LOAD: RESTORE ACTIVE STATE ---
    const params = new URLSearchParams(window.location.search);
    const activeCategory = params.get('category[]');

    if (activeCategory) {
        document.querySelectorAll('.Ml-filter-btn').forEach(function (btn) {
            const key = btn.getAttribute('data-category');
            if (categoryMap[key] === activeCategory) {
                btn.classList.add('Ml-filter-btn-active');
            }
        });
    } else {
        // Default active = All
        document.querySelector('[data-category="all"]')
            ?.classList.add('Ml-filter-btn-active');
    }

});
</script>
