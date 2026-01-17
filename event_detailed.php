<style>
@media (max-width: 767px) {
	.Ml-sticky-action {
		flex-direction: column !important;
        gap: 20px !important;
        padding: 30px !important;
	}
}
</style>

<?php
// Build hero background image
$heroBg = "https://placehold.co/1600x900/333/fff?text=Event";
if (!empty($post['post_image'])) {
    $heroBg = str_replace("'", "", $post['post_image']);
}

// Format Price
$eventPrice = "Contact for Details";
if ($post['post_promo'] != "") {
    $fixedValue = websiteSettingsController::fixPriceValue(
        $post['post_promo'],
        brilliantDirectories::getCurrencySymbol(),
        brilliantDirectories::getCurrencySuffix(),
        brilliantDirectories::getCurrencyThousandsDivider()
    );
    $eventPrice = ($fixedValue != "") ? displayPrice($fixedValue) : $post['post_promo'];
}

// Fetch 6 random active members for the "Orbiting Guests" stack
$guestQuery = mysql($w['database'], "SELECT ud.user_id, ud.listing_type FROM users_data AS ud INNER JOIN users_photo AS up ON ud.user_id = up.user_id WHERE ud.active = '2' AND up.file != '' ORDER BY RAND() LIMIT 6");
?>

<div class="Ml-noise-overlay"></div>

<div class="Ml-event-header">
    <img src="<?= $heroBg; ?>" class="Ml-header-img" alt="<?= $post['post_title']; ?>">
    <div class="Ml-header-overlay"></div>
    <div class="Ml-header-content container">
        <span class="Ml-header-category">
            <?= !empty($post['post_category']) ? $post['post_category'] : 'Planetary Alignment'; ?>
        </span>
        <h1 class="Ml-header-title">
            <?= $post['post_title']; ?>
            <?php 
            // Check if event is happening now
            $startTime = strtotime($post['post_start_date']);
            $endTime = strtotime($post['post_expire_date']);
            $now = time();
            if ($now >= $startTime && $now <= $endTime) { ?>
                <span class="Ml-live-badge">LIVE NOW</span>
            <?php } ?>
        </h1>
    </div>
</div>

<div class="Ml-detail-container">
    <div class="Ml-detail-layout">
        
        <div class="Ml-main-col">
            
            <?php if ($post['post_content_clean'] != "") { ?>
                <div class="Ml-section">
                    <h3 class="Ml-section-title">Mission Briefing</h3>
                    <div class="Ml-text-block">
                        <?= $post['post_content_clean']; ?>
                    </div>
                </div>
            <?php } ?>

            <?php if (!empty($post['post_tags'])) { ?>
                <div class="Ml-section">
                    <h3 class="Ml-section-title">Required Protocols (Tags)</h3>
                    <div class="Ml-text-block">
                        <ul class="Ml-list" style="columns: 2;">
                            <?php 
                            $tagsArray = explode(',', $post['post_tags']);
                            foreach($tagsArray as $tag) {
                                echo "<li>// " . trim($tag) . "</li>";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
            
            <?php if (!empty($post['post_location'])) { 
                $encodedLocation = urlencode($post['post_location']);
            ?>
                <div class="Ml-section Ml-map-section">
                    <h3 class="Ml-section-title">Event Horizon</h3>
                    <p class="Ml-text-block" style="margin-bottom:15px;">
                        <?= !empty($post['post_venue']) ? '<strong>'.$post['post_venue'].'</strong><br>' : ''; ?>
                        <?= $post['post_location']; ?>
                    </p>
                    <iframe 
                        src="https://maps.google.com/maps?q=<?= $encodedLocation; ?>&output=embed" 
                        class="Ml-map-iframe" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>
            <?php } ?>

        </div>

        <div class="Ml-side-col">
            
            <div class="Ml-telemetry-readout">
                <h4 class="Ml-readout-label" style="font-size:14px; color:white;">MISSION TELEMETRY</h4>
                
                <div class="Ml-readout-item">
                    <div class="Ml-readout-label">DATE & TIME</div>
                    <div class="Ml-readout-val">
                        <?= transformDate($post['post_start_date'], "QBTIME"); ?>
                        <?php if ($post['post_expire_date'] != "") { ?>
                            <br>to <?= transformDate($post['post_expire_date'], "QBTIME"); ?>
                        <?php } ?>
                    </div>
                </div>

                <div class="Ml-readout-item">
                    <div class="Ml-readout-label">LOCATION</div>
                    <div class="Ml-readout-val">
                        <?= !empty($post['post_venue']) ? $post['post_venue'] : 'TBA'; ?>
                    </div>
                </div>

                <div class="Ml-readout-item">
                    <div class="Ml-readout-label">HOST PILOT</div>
                    <div class="Ml-readout-val">
                        <a href="/<?= $user['filename']; ?>" style="color:inherit; text-decoration:underline;">
                            <?= $user['full_name']; ?>
                        </a>
                    </div>
                </div>

                <div class="Ml-readout-item">
                    <div class="Ml-readout-label">CLEARANCE REQUIRED</div>
                    <div class="Ml-readout-val">
                        <?= $subscription['subscription_name']; ?>
                    </div>
                </div>
            </div>
            
            <div class="Ml-attendees-panel">
                <div class="Ml-attendees-header">Orbiting Guests (Featured)</div>
                <div class="Ml-avatar-stack">
                    <?php 
                    while ($guest = mysql_fetch_array($guestQuery)) { 
                        $gPhoto = getUserPhoto($guest['user_id'], $guest['listing_type'], $w);
                    ?>
                        <img src="<?= $gPhoto['file']; ?>" class="Ml-avatar" alt="Guest">
                    <?php } ?>
                    <span class="Ml-avatar-count">+<?= rand(10, 50); ?> more</span>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="Ml-sticky-action">
    <div class="Ml-action-price">
        Ticket Price: <?= $eventPrice; ?> <span>(<?= $post['post_promo'] != "" ? 'Standard Fuel Rate' : 'Signal host for info'; ?>)</span>
    </div>

    <?php if ($subscription['receive_messages'] != 1 && $user['active'] == 2) { ?>
        [widget=Bootstrap Theme - Contact Member Modal]
        <button class="Ml-btn Ml-btn-primary" data-toggle="modal" data-target="#contactModal">
            Confirm Attendance
        </button>
    <?php } else { ?>
        <a href="/<?= $user['filename']; ?>" class="Ml-btn Ml-btn-primary" style="text-align:center; line-height:45px; text-decoration:none;">
            View Pilot Profile
        </a>
    <?php } ?>
</div>

<style>
    /* Ensuring the sticky bar doesn't hide content */
    body { padding-bottom: 80px; }
    .Ml-sticky-action { z-index: 9999; }
</style>
  <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>🌑</text></svg>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Outfit:wght@300;500;700;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 3.4.1 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* --- ROOT VARIABLES --- */
        :root {
            --Ml-bg-dark: #050A14; 
            --Ml-bg-darker: #020408;
            --Ml-text-light: #EAEAEA;
            --Ml-text-muted: #8892B0;
            --Ml-accent-cyan: #00F0FF;
            --Ml-accent-purple: #BC13FE;
            --Ml-accent-rose: #FF0055;
            
            --Ml-font-heading: "Outfit", sans-serif;
            --Ml-font-body: "Nunito", sans-serif;
            --Ml-ease-tech: cubic-bezier(0.19, 1, 0.22, 1);
        }

        /* --- GLOBAL BASE --- */
        body {
            background-color: var(--Ml-bg-dark);
            color: var(--Ml-text-light);
            font-family: var(--Ml-font-body);
            overflow-x: hidden;
            background: radial-gradient(circle at 50% 10%, #1a0b2e 0%, #050A14 80%);
            background-attachment: fixed;
            padding-bottom: 100px; /* Space for sticky bar */
        }

        /* Nav (Shared) */
        .Ml-wrapper-topbar { position: fixed; top: 20px; left: 0; right: 0; z-index: 1000; padding: 0 20px; pointer-events: none; }
        .Ml-navbar { pointer-events: auto; background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 999px; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; max-width: 1140px; margin: 0 auto; box-shadow: 0 10px 40px rgba(0,0,0,0.6); position: relative; }
        .Ml-brand { font-family: var(--Ml-font-heading); font-size: 24px; font-weight: 700; color: white; }
        .Ml-nav-links a { color: var(--Ml-text-muted); margin-left: 25px; font-size: 14px; font-weight: 600; transition: 0.3s; text-decoration: none; }
        .Ml-nav-links a.active { color: white; border-bottom: 2px solid var(--Ml-accent-cyan); padding-bottom: 3px; }
        .Ml-mobile-toggle { display: none; color: white; font-size: 20px; cursor: pointer; z-index: 1002; }
        .Ml-mobile-menu { display: none; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px); border-radius: 20px; border: 1px solid rgba(255,255,255,0.1); padding: 20px; margin-top: 10px; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.5); z-index: 999; }
        .Ml-mobile-menu a { display: block; padding: 15px; color: white; font-family: var(--Ml-font-heading); font-size: 16px; border-bottom: 1px solid rgba(255,255,255,0.05); }

        /* --- COMPONENTS --- */
        .Ml-btn { display: inline-block; padding: 14px 40px; border-radius: 4px; font-family: var(--Ml-font-heading); font-weight: 700; text-transform: uppercase; letter-spacing: 2px; font-size: 12px; border: none; cursor: pointer; transition: 0.3s; position: relative; overflow: hidden; clip-path: polygon(10px 0, 100% 0, 100% calc(100% - 10px), calc(100% - 10px) 100%, 0 100%, 0 10px); }
        .Ml-btn-primary { background: var(--Ml-accent-cyan); color: #000; }
        .Ml-btn-primary:hover { background: #fff; box-shadow: 0 0 30px var(--Ml-accent-cyan); }
        .Ml-btn-outline { background: transparent; border: 1px solid rgba(255,255,255,0.3); color: white; }
        .Ml-btn-outline:hover { border-color: var(--Ml-accent-cyan); color: var(--Ml-accent-cyan); }

        /* --- HERO HEADER (Immersive) --- */
        .Ml-event-header {
            width: 100%; height: 550px; position: relative; overflow: hidden;
            width: 100vw;
    margin-left: calc(50% - 50vw);
        }
        
        .Ml-header-img { 
            width: 100% !important; height: 100%; object-fit: cover; position: absolute !important; 
            top: 0; left: 0; filter: brightness(0.7);
            transform: scale(1.05);
        }
        
        /* Angular Overlay */
        .Ml-header-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; z-index: 10;
            background: linear-gradient(180deg, transparent 0%, var(--Ml-bg-dark) 100%);
            /*clip-path: polygon(0 0, 100% 0, 100% 90%, 0 40%);*/
        }
        
        /* Title Block */
        .Ml-header-content {
            position: absolute; bottom: 0; left: 0; right: 0; z-index: 20;
            padding: 0 15px 40px;
        }
        .Ml-header-category { font-family: monospace; color: var(--Ml-accent-rose); font-size: 14px; letter-spacing: 2px; margin-bottom: 5px; }
        .Ml-header-title { font-size: clamp(36px, 6vw, 56px); font-weight: 900; line-height: 1.1; margin-bottom: 10px; }
        
        /* Live Status Badge */
        .Ml-live-badge {
            background: var(--Ml-accent-rose); color: white; padding: 4px 10px; 
            font-size: 10px; font-weight: 700; border-radius: 4px; text-transform: uppercase;
            animation: Ml-pulse-rose 1.5s infinite; margin-left: 10px;
        }
        @keyframes Ml-pulse-rose { 0% { box-shadow: 0 0 0 0 rgba(255, 0, 85, 0.7); } 70% { box-shadow: 0 0 0 6px rgba(255, 0, 85, 0); } 100% { box-shadow: 0 0 0 0 rgba(255, 0, 85, 0); } }

        /* --- MAIN CONTENT LAYOUT --- */
        .Ml-detail-container { max-width: 1100px; margin: 0 auto; padding: 0 15px; }
        .Ml-detail-layout { display: flex; gap: 60px; margin-top: 40px; }
        .Ml-main-col { flex: 2; }
        .Ml-side-col { flex: 1; position: relative; }

        /* Telemetry Readout (Key Info Panel) */
        .Ml-telemetry-readout {
            position: initial; top: 120px;
            background: rgba(11, 16, 33, 0.8); border: 1px solid var(--Ml-accent-purple);
            padding: 25px; border-radius: 4px; z-index: 50;
            box-shadow: 0 10px 30px rgba(188, 19, 254, 0.1);
        }
        .Ml-readout-item { padding: 10px 0; border-bottom: 1px dashed rgba(255,255,255,0.1); }
        .Ml-readout-item:last-child { border-bottom: none; }
        .Ml-readout-label { font-family: monospace; color: var(--Ml-accent-cyan); font-size: 11px; letter-spacing: 1px; }
        .Ml-readout-val { font-size: 15px; margin-top: 5px; }
        
        /* Attendees Panel (Orbiting Guests) */
        .Ml-attendees-panel {
            margin-top: 40px; background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);
            padding: 20px; border-radius: 4px;
        }
        .Ml-attendees-header { font-size: 16px; font-weight: 700; margin-bottom: 15px; }
        .Ml-avatar-stack { display: flex; align-items: center; gap: 5px;    row-gap: 10px;
    flex-wrap: wrap; }
        .Ml-avatar-stack .Ml-avatar { width: 40px !important; height: 40px !important; border-radius: 50%; border: 2px solid var(--Ml-accent-purple); }
        .Ml-avatar:nth-child(even) { border-color: var(--Ml-accent-cyan); }
        .Ml-avatar-count { font-size: 14px; color: var(--Ml-accent-cyan); font-weight: 700; margin-left: 10px; }

        /* Location Section (Map) */
        .Ml-map-section {
            padding-top: 40px;
            margin-bottom: 60px;
        }
        .Ml-map-iframe {
            width: 100%; height: 350px; border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px; filter: grayscale(100%) invert(90%) contrast(1.2); opacity: 0.8;
        }
        
        /* Temporal Feedback (Reviews) */
        .Ml-feedback-section {
            padding-top: 40px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 60px;
        }
        .Ml-feedback-card {
            background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08); 
            padding: 20px; border-radius: 6px; margin-bottom: 20px;
        }
        .Ml-feedback-meta { font-size: 11px; color: var(--Ml-accent-purple); margin-bottom: 10px; }
        .Ml-feedback-quote { font-size: 14px; font-style: italic; color: #ccc; }
        .Ml-feedback-author { font-size: 12px; color: var(--Ml-accent-cyan); margin-top: 10px; display: block; }
        
        /* Main Description */
        .Ml-section-title { font-size: 28px; color: white; margin-bottom: 20px; font-weight: 700; }
        .Ml-text-block { font-size: 16px; line-height: 1.7; color: #ccc; margin-bottom: 30px; }
        .Ml-text-block p { margin-bottom: 20px; }

        /* Sticky Action Bar (Fixed on bottom for mobile) */
        .Ml-sticky-action {
            position: static; bottom: 0; left: 0; width: 100%; background: rgba(5, 10, 20, 0.95);
            padding: 15px; border-top: 3px solid var(--Ml-accent-cyan); z-index: 100;
            display: flex; justify-content: space-between; align-items: center;padding:20px 120px;width: 100vw;
    margin-left: calc(50% - 50vw);
        }
        .Ml-action-price { font-size: 18px; font-weight: 700; }
        .Ml-action-price span { font-size: 12px; color: var(--Ml-text-muted); font-weight: 400; }

        /* Footer */
        .Ml-footer { padding: 80px 0 40px; border-top: 1px solid rgba(255,255,255,0.05); background: var(--Ml-bg-darker); font-size: 14px; color: var(--Ml-text-muted); }
        .Ml-footer-col { margin-bottom: 30px; }
        .Ml-footer-col h4 { color: white; margin-bottom: 25px; font-size: 18px; }
        .Ml-footer-links { list-style: none; padding: 0; }
        .Ml-footer-links li { margin-bottom: 12px; }
        .Ml-footer-links a { color: var(--Ml-text-muted); transition: 0.3s; text-decoration: none; }
        .Ml-footer-links a:hover { color: var(--Ml-accent-cyan); }
        .Ml-social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; transition: 0.3s; color: white; }
        .Ml-social-btn:hover { background: var(--Ml-accent-cyan); color: black; }


        @media (max-width: 991px) {
            .Ml-detail-layout { flex-direction: column; gap: 30px; }
            .Ml-telemetry-readout { position: relative; top: 0; }
            .Ml-event-header { height: 300px; }
            .Ml-header-content { padding-bottom: 20px; }
            .Ml-header-title { font-size: 32px; }
            .Ml-nav-links.hidden-xs { display: none !important; }
            .Ml-mobile-toggle { display: block; }
        }
        
        @media (max-width: 480px) {
             .Ml-sticky-action { flex-direction: column; gap: 10px; }
             .Ml-action-price { order: 2; margin-top: 5px; }
             .Ml-btn { order: 1; width: 100%; }
        }
		.body-content{
			margin-bottom:0px;
		}
    </style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Mobile Menu Toggle
        $('#mobile-toggle-btn').click(function() {
            $('#mobile-menu').slideToggle();
        });
    </script>