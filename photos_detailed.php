    <style>
        /* --- ROOT VARIABLES (MoonLoop Theme) --- */
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
            /* Deep Space Background */
            background: radial-gradient(circle at 50% 10%, #1a0b2e 0%, #050A14 80%);
            background-attachment: fixed;
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
        .Ml-btn { display: inline-block; padding: 14px 40px; border-radius: 4px; font-family: var(--Ml-font-heading); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 12px; border: none; cursor: pointer; transition: 0.3s; position: relative; overflow: hidden; clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px); }
        .Ml-btn-primary { background: var(--Ml-accent-cyan) !important; color: #000; }

        /* Gravity Hover */
        .Ml-gravity-target { transition: transform 0.4s var(--Ml-ease-tech); will-change: transform; }
        @media (hover: none) { .Ml-gravity-target { transition: none !important; transform: none !important; } }

        /* --- NAVIGATION --- */
        .Ml-wrapper-topbar { position: fixed; top: 20px; left: 0; right: 0; z-index: 1000; padding: 0 20px; pointer-events: none; }
        .Ml-navbar { pointer-events: auto; background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 999px; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; max-width: 1140px; margin: 0 auto; box-shadow: 0 10px 40px rgba(0,0,0,0.6); position: relative; }
        .Ml-brand { font-family: var(--Ml-font-heading); font-size: 24px; font-weight: 700; color: white; z-index: 1002; }
        .Ml-nav-links { display: flex; align-items: center; }
        .Ml-nav-links a { color: var(--Ml-text-muted); margin-left: 25px; font-size: 14px; font-weight: 600; transition: 0.3s; text-decoration: none; }
        .Ml-nav-links a:hover, .Ml-nav-links a.active { color: white; text-shadow: 0 0 10px rgba(255,255,255,0.3); }
        .Ml-mobile-toggle { display: none; color: white; font-size: 20px; cursor: pointer; z-index: 1002; }
        .Ml-mobile-menu { display: none; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); padding: 20px; margin-top: 10px; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.5); z-index: 999; }
        .Ml-mobile-menu a { display: block; padding: 15px; color: white; font-family: var(--Ml-font-heading); font-size: 16px; border-bottom: 1px solid rgba(255,255,255,0.05); }

        /* --- HERO HEADER --- */
        .Ml-detail-hero {
            padding-top: 140px; padding-bottom: 40px; position: relative; z-index: 1;
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }
        
        .Ml-back-link {
            display: inline-flex; align-items: center; gap: 10px; color: var(--Ml-text-muted); 
            font-size: 12px; text-transform: uppercase; letter-spacing: 2px; text-decoration: none;
            margin-bottom: 20px; transition: 0.3s; font-family: monospace;
        }
        .Ml-back-link:hover { color: var(--Ml-accent-cyan); text-decoration: none; }

        .Ml-detail-title { font-size: clamp(36px, 6vw, 64px); line-height: 1; font-weight: 800; margin-bottom: 10px; color: white; }
        .Ml-detail-meta { font-size: 16px; font-family: monospace; color: var(--Ml-accent-gold); display: flex; gap: 20px; align-items: center; }
        .Ml-detail-meta span { display: flex; align-items: center; gap: 8px; }
        .Ml-detail-meta i { font-size: 14px; }

        /* --- MAIN CONTENT --- */
        .Ml-detail-layout {
            display: grid; grid-template-columns: 3fr 1fr; gap: 40px; 
            max-width: 1400px; margin: 0 auto; padding: 60px 20px 100px; position: relative; z-index: 2;
        }

        /* LEFT: Main Viewer */
        .Ml-viewer-container { position: relative; }
        
        .Ml-main-image-frame {
            width: 100%; aspect-ratio: 16/9; background: #000; position: relative; overflow: hidden;
            border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; margin-bottom: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);height:400px;
        }
        .Ml-main-image-frame .Ml-main-image { width: 100% !important; height: 100% !important; object-fit: none; transition: opacity 0.3s ease; }
        
        /* Controls */
        .Ml-viewer-controls {
            position: absolute; top: 50%; width: 100%; display: flex; justify-content: space-between; 
            transform: translateY(-50%); padding: 0 20px; pointer-events: none;
        }
        .Ml-ctrl-btn {
            pointer-events: auto; width: 50px; height: 50px; border-radius: 50%; 
            background: rgba(0,0,0,0.5); backdrop-filter: blur(5px); border: 1px solid rgba(255,255,255,0.2);
            color: white; display: flex; align-items: center; justify-content: center; cursor: pointer;
            transition: 0.3s;
        }
        .Ml-ctrl-btn:hover { background: var(--Ml-accent-cyan); color: black; border-color: var(--Ml-accent-cyan); }

        /* Filmstrip Thumbs */
        .Ml-filmstrip {
            display: flex; gap: 15px; overflow-x: auto; padding-bottom: 10px;
            scrollbar-width: thin; scrollbar-color: var(--Ml-accent-purple) rgba(255,255,255,0.05);
        }
        .Ml-thumb {
            flex: 0 0 120px; height: 80px; border-radius: 6px; overflow: hidden; cursor: pointer;
            border: 2px solid transparent; transition: 0.3s; opacity: 0.6;
        }
        .Ml-thumb img { width: 100%; height: 100%; object-fit: contain; }
        .Ml-thumb:hover, .Ml-thumb.active { opacity: 1; border-color: var(--Ml-accent-cyan); transform: scale(1.05); }

        /* RIGHT: Sidebar Telemetry */
        .Ml-detail-sidebar { position: sticky; top: 120px; height: fit-content; }
        
        .Ml-info-card {
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);
            padding: 30px; border-radius: 12px; margin-bottom: 30px;
        }
        
        .Ml-info-title { 
            font-size: 12px; text-transform: uppercase; letter-spacing: 2px; color: var(--Ml-accent-purple); 
            margin-bottom: 15px; font-weight: 700; font-family: monospace; border-bottom: 1px solid rgba(255,255,255,0.05); padding-bottom: 10px;
        }
        
        .Ml-photo-desc { font-size: 16px; color: #ccc; line-height: 1.6; font-family: var(--Ml-font-serif); font-style: italic; margin-bottom: 20px; }
        
        .Ml-data-list { list-style: none; padding: 0; }
        .Ml-data-item { display: flex; justify-content: space-between; padding: 8px 0; border-bottom: 1px dashed rgba(255,255,255,0.05); font-size: 13px; }
        .Ml-data-item:last-child { border-bottom: none; }
        .Ml-data-label { color: var(--Ml-text-muted); width:80px;}
        .Ml-data-val { color: white; font-family: monospace; width:120px;}

        /* Avatar Group */
        .Ml-avatar-group { display: flex; align-items: center; gap: 15px; margin-bottom: 20px; }
        .Ml-avatar-group .Ml-avatar { width: 60px !important; height: 60px !important; border-radius: 50%; border: 2px solid var(--Ml-accent-cyan); object-fit: cover; }
        .Ml-user-info h4 { color: white; font-size: 18px; margin: 0 0 5px 0; }
        .Ml-user-role { font-size: 11px; color: var(--Ml-text-muted); text-transform: uppercase; letter-spacing: 1px; }

        /* Footer */
        .Ml-footer { padding: 80px 0 40px; border-top: 1px solid rgba(255,255,255,0.05); background: var(--Ml-bg-darker); font-size: 14px; color: var(--Ml-text-muted); position: relative; z-index: 2; }
        .Ml-footer-col { margin-bottom: 30px; }
        .Ml-footer-col h4 { color: white; margin-bottom: 25px; font-size: 18px; }
        .Ml-footer-links { list-style: none; padding: 0; }
        .Ml-footer-links li { margin-bottom: 12px; }
        .Ml-footer-links a { color: var(--Ml-text-muted); transition: 0.3s; text-decoration: none; }
        .Ml-footer-links a:hover { color: var(--Ml-accent-cyan); }
        .Ml-social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; transition: 0.3s; color: white; }
        .Ml-social-btn:hover { background: var(--Ml-accent-cyan); color: black; }

        /* Responsive */
        @media (max-width: 991px) {
            .Ml-nav-links.hidden-xs { display: none !important; }
            .Ml-mobile-toggle { display: block; }
            .Ml-detail-layout { grid-template-columns: 1fr; gap: 40px; display: block; }
            .Ml-gallery-sidebar { position: relative; top: 0; }
            .Ml-main-image-frame { aspect-ratio: 4/3; }
        }
        @media (max-width: 480px) {
            .Ml-hero-title { font-size: 36px; }
            .Ml-main-image-frame { aspect-ratio: 1/1; }
            .Ml-detail-meta { flex-direction: column; align-items: center; gap: 10px; }
			.Ml-gravity-target .Ml-hero-title{
				text-align :center;
			}
        }
/* Updated Layout: 70% Image, 30% Sidebar */
.Ml-detail-layout {
    display: grid; 
    grid-template-columns: 70% 30%; 
    gap: 40px; 
    max-width: 1400px; 
    margin: 0 auto; 
    padding: 60px 20px 100px; 
    position: relative; 
    z-index: 2;
}

/* Enhanced Portrait Image Frame */
.Ml-main-image-frame {
    width: 100%; 
    /* Changed from 4/5 to 2/3 for a taller, more cinematic portrait look */
    aspect-ratio: 2 / 3; 
    /* Increased min-height to ensure faces are clear on larger screens */
    /*min-height: 750px; */
    background: #000; 
    position: relative; 
    overflow: hidden;
    border: 1px solid rgba(255,255,255,0.1); 
    border-radius: 12px; 
    margin-bottom: 25px;
    box-shadow: 0 25px 70px rgba(0,0,0,0.8);
}

.Ml-main-image-frame .Ml-main-image { 
    width: 100% !important; 
    height: 100% !important; 
    /* "cover" fills the space, but "top" ensures the face isn't cut off */
    object-fit: none; 
    object-position: top center; 
    transition: opacity 0.4s var(--Ml-ease-tech); 
}

/* Responsiveness for Mobile/Tablets */
@media (max-width: 991px) {
    .Ml-detail-layout { display: block; }
    .Ml-main-image-frame { 
        aspect-ratio: 3 / 4; 
        min-height: 500px; 
    }
}

@media (max-width: 480px) {
    .Ml-main-image-frame { 
        min-height: 400px; 
        aspect-ratio: 1 / 1; 
    }
}
.posted-by-snippet
		{
			display:none;
		}
@media (max-width: 968px) {
    .Ml-main-image-frame .Ml-main-image {
        object-fit: none !important;
    }
}

    </style>
<?php
// Brilliant Directories - Detail Page Dynamic Integration
echo widget("Bootstrap Theme - Display - Posted By Snippet");

// Fetch Gallery Images
$photogroup = mysql(brilliantDirectories::getDatabaseConfiguration('database'),"SELECT
        *
    FROM
        `users_portfolio`
    WHERE
        `group_id` = '".$group[group_id]."'
    AND
        `data_id` = '".$group[data_id]."'
    AND
        `file` != ''
    ORDER BY
        `order` ASC");

$total_photos = mysql_num_rows($photogroup);
$photo_list = []; 
$first_image = "";
$first_desc = "";

// Pre-process for JS and first display
while ($p_data = mysql_fetch_array($photogroup)) {
    $p_meta = getMetaData('users_portfolio', $p_data['photo_id'], $p_data, $w);
    $img_url = "/".$w['photo_folder']."/main/".$p_meta['file'];
    
    $photo_list[] = [
        'src' => $img_url,
        'desc' => !empty($p_meta['desc']) ? htmlspecialchars(limitWords($p_meta['desc'], 160)) : ""
    ];
}

if (!empty($photo_list)) {
    $first_image = $photo_list[0]['src'];
    $first_desc = $photo_list[0]['desc'];
}
?>

<style>
    /* Updated Layout: 70% Image, 30% Sidebar */
    .Ml-detail-layout {
        display: grid; 
        grid-template-columns: 70% 30%; /* 70/30 Split Requested */
        gap: 40px; 
        max-width: 1400px; 
        margin: 0 auto; 
        padding: 60px 20px 100px; 
        position: relative; 
        z-index: 2;
    }

    /* Portrait Image Frame */
    .Ml-main-image-frame {
        width: 100%; 
        aspect-ratio: 4/5; /* Height increased for Portrait look */
        background: #000; 
        position: relative; 
        overflow: hidden;
        border: 1px solid rgba(255,255,255,0.1); 
        border-radius: 8px; 
        margin-bottom: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,0.5);
    }

    @media (max-width: 991px) {
        .Ml-detail-layout { display: block; }
        .Ml-main-image-frame { aspect-ratio: 3/4; }
    }
</style>

<div class="Ml-gallery-hero">
    <div class="container">
        <div class="Ml-gravity-target">
            <h1 class="Ml-hero-title"><?php echo $group['group_name']; ?></h1>
            <div class="Ml-detail-meta">
                <?php if($user['city'] != ""){ ?>
                    <span><i class="fa fa-map-marker"></i> <?php echo $user['city']; ?>, <?php echo $user['state_ln']; ?></span>
                <?php } ?>
                <span><i class="fa fa-clock-o"></i> Orbit Updated: <?php echo transformDate($group['date_updated'],"QB"); ?></span>
            </div>
        </div>
    </div>
</div>

<div class="Ml-main-container">
    <div class="Ml-detail-layout">
        
        <div class="Ml-main-col">
            <?php if ($total_photos > 0) { ?>
                <div class="Ml-viewer-container Ml-gravity-target">
                    <div class="Ml-main-image-frame">
                        <img src="<?php echo $first_image; ?>" class="Ml-main-image" id="main-img" alt="Main View">
                        
                        <?php if ($total_photos > 1) { ?>
                            <div class="Ml-viewer-controls">
                                <div class="Ml-ctrl-btn" onclick="prevImage()"><i class="fa fa-chevron-left"></i></div>
                                <div class="Ml-ctrl-btn" onclick="nextImage()"><i class="fa fa-chevron-right"></i></div>
                            </div>
                        <?php } ?>
                    </div>
                    
                    <div class="Ml-filmstrip">
                        <?php foreach ($photo_list as $index => $photo) { ?>
                            <div class="Ml-thumb <?php echo ($index === 0) ? 'active' : ''; ?>" onclick="setImage(<?php echo $index; ?>)">
                                <img src="<?php echo $photo['src']; ?>" alt="Thumb <?php echo $index + 1; ?>">
                            </div>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>

        <aside class="Ml-side-col Ml-gallery-sidebar">
            
            <div class="Ml-info-card Ml-gravity-target">
                <div class="Ml-avatar-group">
                    <a href="/<?php echo $user['filename']; ?>">
                        <img src="<?php echo ($user['image_main_file'] != "") ? $user['image_main_file'] : "https://placehold.co/100x100/333/FFF?text=Pilot"; ?>" class="Ml-avatar">
                    </a>
                    <div class="Ml-user-info">
                        <h4><?php echo $user['full_name']; ?></h4>
                        <span class="Ml-user-role"><?php echo $user['subscription_name']; ?> // Established <?php echo transformDate($user['date_created'],"QB"); ?></span>
                    </div>
                </div>
                
                <?php if ($group['group_desc_clean'] != "") { ?>
                    <div class="Ml-info-title">Memory Log</div>
                    <div class="Ml-photo-desc" id="photo-desc">
                        <?php echo $group['group_desc_clean']; ?>
                    </div>
                <?php } ?>
                
                <div class="Ml-info-title" style="margin-top:30px;">Metadata</div>
                <ul class="Ml-data-list">
                    <li class="Ml-data-item"><span class="Ml-data-label">Profession</span><span class="Ml-data-val"><?php echo $user['position']?></span></li>
                    <li class="Ml-data-item"><span class="Ml-data-label">Age</span><span class="Ml-data-val">    <?php if (!empty($user['age'])) { echo  $user['age']; } ?>
</span></li>
                </ul>
            </div>

            <a href="/<?php echo $user['filename']; ?>/connect" class="Ml-btn Ml-btn-primary" style="width:100%; text-align:center; text-decoration:none;">
                Connect <i class="fa fa-bolt" style="margin-left:5px;"></i>
            </a>

        </aside>

    </div>
</div>

<script>
    const photos = <?php echo json_encode($photo_list); ?>;
    let currentIndex = 0;

    function setImage(index) {
        currentIndex = index;
        const photo = photos[index];
        
        $('#main-img').css('opacity', 0);
        setTimeout(() => {
            $('#main-img').attr('src', photo.src).css('opacity', 1);
            if(photo.desc != "") {
                $('#photo-desc').html(photo.desc);
            }
        }, 300);
        
        $('.Ml-thumb').removeClass('active');
        $('.Ml-thumb').eq(index).addClass('active');
    }

    function nextImage() {
        let nextIndex = currentIndex + 1;
        if (nextIndex >= photos.length) nextIndex = 0;
        setImage(nextIndex);
    }

    function prevImage() {
        let prevIndex = currentIndex - 1;
        if (prevIndex < 0) prevIndex = photos.length - 1;
        setImage(prevIndex);
    }
</script>