<?php
/* MoonLoop Story Detail Page - Fully Dynamic 
    Project: MoonLoop Chronicles
*/
echo widget("Bootstrap Theme - Detail Page - Schema Markup - Website Blog Article");
echo widget("Bootstrap Theme - Display - Posted By Snippet");

// Image Logic
$mainImage = "https://placehold.co/1200x800/29004d/FFF?text=No+Image+Available";
if ($post['post_image'] != "") {
    $mainImage = str_replace("'", "", $post['post_image']);
}

// Meta Data Fallbacks
$matchScore = (!empty($post['post_promo'])) ? $post['post_promo'] : "98%";
$sector = (!empty($post['post_location'])) ? $post['post_location'] : "Global Sector";
$chronicleId = (!empty($post['post_id'])) ? str_pad($post['post_id'], 3, '0', STR_PAD_LEFT) : "000";
?>

<div class="Ml-noise-overlay"></div>

<div class="Ml-asteroid-system">
    <div class="Ml-asteroid Ml-asteroid-1"></div>
    <div class="Ml-asteroid Ml-asteroid-2"></div>
</div>

<div class="Ml-story-hero-image">
    
    <div class="Ml-hero-visual">
         <img src="<?php echo $mainImage; ?>" alt="<?php echo $post['post_title']; ?>" />
    </div>

    <div class="Ml-hero-data-panel">
        <h1 class="Ml-title-header"><?php echo $post['post_title']; ?></h1>
        <span class="Ml-meta">CHRONICLE ID: #<?php echo $chronicleId; ?></span>
        
        <div class="Ml-data-readout">
            <p>ORBIT ESTABLISHED: <span><?php echo transformDate($post['post_live_date'], "QB"); ?></span></p>
            <p>SECTOR: <span><?php echo $post['post_category']; ?></span></p>
        </div>
    </div>
</div>

<div class="Ml-content-wrapper">
    <div class="Ml-story-body">
        
        <div class="the-post-description">
            <?php if ($post['post_content'] != "") {
                echo $post['post_content'];
            } else {
                echo "<p>The data for this chronicle is currently being synchronized from the galactic core...</p>";
            } ?>
        </div>

        <?php if ($tags != ""): ?>
            <div class="tags tmargin">
                <h4 style="color:var(--Ml-accent); font-size:14px; letter-spacing:2px;">// SIGNAL TAGS</h4>
                <?php echo $tags; ?>
            </div>
        <?php endif; ?>

        <div class="Ml-orbit-chronology">
            <h3>Chronology of Alignment</h3>
            <p>System tracking milestones for: <?php echo $post['post_title']; ?>.</p>
            
            <div class="Ml-chronology-timeline">
                <div class="Ml-chronology-event">
                    <h4>Initial Signal Lock</h4>
                    <span>STARDATE <?php echo date('m.d.Y', strtotime($post['post_live_date'])); ?></span>
                </div>
                
                <div class="Ml-chronology-event">
                    <h4>Trajectory Commitment</h4>
                    <span>STARDATE <?php echo date('m.d.Y'); ?> | Orbit Stable</span>
                </div>
            </div>
        </div>

        <?php if ($post['post_caption'] != ""): ?>
            <blockquote>
                "<?php echo $post['post_caption']; ?>" 
                <br>— <?php echo $user['full_name']; ?>, Pilot Level <?php echo ($user['subscription_id']) ? $user['subscription_id'] : '1'; ?>
            </blockquote>
        <?php endif; ?>
        
    </div>
</div>

<div class="Ml-cta-section">
    <div class="container">
        <h2>Ready to Start Your Own Chronicle?</h2>
        <p style="color:var(--Ml-text-muted);">Confirm the unseen forces are already pulling you toward your match.</p>
        <button class="Ml-btn Ml-btn-primary" onclick="window.location.href='/account/modern-blog/add'">Initiate Quantum Sync</button>
    </div>
</div>
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
            
            --Ml-font-heading: "Outfit", sans-serif;
            --Ml-font-body: "Nunito", sans-serif;
            --Ml-font-serif: "Playfair Display", serif;
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
            padding-bottom: 0; 
            min-height: 100vh;
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

        /* --- HERO HEADER (Dual Pane Redesign) --- */
        .Ml-story-hero-image {
            width: 100%; height: 500px; position: relative; overflow: hidden;
            margin: 40px auto 60px;
            display: flex;
            max-width: 1140px;
            border: 1px solid rgba(255,255,255,0.1);
            clip-path: polygon(1% 0, 100% 0, 99% 100%, 0 100%);
            z-index: 1;
        }
        
        .Ml-hero-visual {
            flex: 2;
            position: relative;
            overflow: hidden;
            clip-path: polygon(0 0, 98% 0, 100% 100%, 0 100%);
        }

        .Ml-hero-visual img { 
            width: 100% !important; height: 100% !important; object-fit: cover; filter: brightness(0.75);
            transition: transform 0.8s cubic-bezier(0.2, 0.8, 0.2, 1);
            transform: scale(1.05);
        }
        
        .Ml-hero-visual:hover img { transform: scale(1.08); } 

        .Ml-hero-data-panel {
            flex: 1;
            background: rgba(11, 16, 33, 0.9);
            padding: 40px 25px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .Ml-title-header { 
            font-size: clamp(36px, 6vw, 48px); font-weight: 800; line-height: 1.1; 
            margin-bottom: 10px; font-family: var(--Ml-font-serif); font-style: italic;
            color: white;
        }
        .Ml-meta { 
            font-size: 14px; color: var(--Ml-accent-purple); font-family: monospace; 
            display: block; margin-bottom: 5px;
        }

        .Ml-data-readout {
            font-family: monospace;
            font-size: 14px;
            color: var(--Ml-accent-cyan);
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .Ml-data-readout p { margin: 5px 0; color: var(--Ml-text-muted); }
        .Ml-data-readout span { color: var(--Ml-accent-cyan); }


        /* --- CONTENT LAYOUT --- */
        .Ml-content-wrapper { max-width: 800px; margin: 0 auto; padding: 0 15px; }

        /* Story Body */
        .Ml-story-body {
            font-family: var(--Ml-font-serif); /* Apply serif font for reading */
            font-size: 18px; 
            line-height: 1.8;
            color: #ddd;
            margin-bottom: 60px;
        }
        .Ml-story-body p { margin-bottom: 25px; }
        .Ml-story-body strong { color: var(--Ml-accent-cyan); font-weight: 700; }
        .Ml-story-body blockquote {
            border-left: 4px solid var(--Ml-accent-purple);
            padding-left: 20px;
            margin: 30px 0;
            font-size: 20px;
            color: #ccc;
        }

        /* Orbit Map (Chronology) */
        .Ml-orbit-chronology {
            padding: 50px 20px;
            background: rgba(11, 16, 33, 0.7);
            border: 1px solid var(--Ml-accent-cyan);
            border-radius: 8px;
            margin: 60px 0;
            text-align: center;
        }
        .Ml-orbit-chronology h3 { font-family: monospace; color: var(--Ml-accent-cyan); margin-bottom: 10px; font-size: 20px; }
        .Ml-orbit-chronology p { color: var(--Ml-text-muted); margin-bottom: 25px; }
        
        /* Timeline */
        .Ml-chronology-timeline {
            border-left: 2px solid var(--Ml-accent-purple);
            padding-left: 20px;
            text-align: left;
            margin-top: 30px;
            position: relative;
        }
        .Ml-chronology-event {
            position: relative;
            margin-bottom: 30px;
            padding-left: 20px;
        }
        .Ml-chronology-event::before {
            content: '';
            position: absolute; left: -26px; top: 0;
            width: 14px; height: 14px;
            background: var(--Ml-accent-cyan);
            border: 3px solid var(--Ml-bg-dark);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--Ml-accent-cyan);
        }
        .Ml-chronology-event h4 { font-family: var(--Ml-font-heading); font-size: 16px; color: white; margin-bottom: 5px; }
        .Ml-chronology-event span { font-size: 12px; color: var(--Ml-text-muted); font-family: monospace; }
        

        /* --- CTA --- */
        .Ml-cta-section {
            padding: 80px 0; text-align: center;
            border-top: 1px solid rgba(255,255,255,0.1);
        }
        .Ml-cta-section h2 { font-size: 32px; margin-bottom: 15px;    font-weight: 900;color :#fff; }

        /* Footer (Updated for non-fixed position) */
        .Ml-footer { 
            padding: 80px 0 40px; 
            border-top: 1px solid rgba(255,255,255,0.05); 
            background: #020408; 
            font-size: 14px; 
            color: #888; 
            position: relative; 
            z-index: 2; 
        }
        .Ml-footer-col { margin-bottom: 30px; }
        .Ml-footer-col h4 { color: white; margin-bottom: 25px; font-size: 18px; }
        .Ml-footer-links { list-style: none; padding: 0; }
        .Ml-footer-links li { margin-bottom: 12px; }
        .Ml-footer-links a { color: #888; transition: 0.3s; }
        .Ml-footer-links a:hover { color: var(--Ml-accent-cyan); text-decoration: none; }
        .Ml-social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; transition: 0.3s; color: white; }
        .Ml-social-btn:hover { background: var(--Ml-accent-cyan); color: black; }

        /* Responsive */
        @media (max-width: 991px) {
            .Ml-nav-links.hidden-xs { display: none !important; }
            .Ml-mobile-toggle { display: block; }
            
            .Ml-story-hero-image { flex-direction: column; height: auto;  }
            .Ml-hero-visual, .Ml-hero-data-panel { flex: none; width: 100%; }
            .Ml-hero-visual { clip-path: none; height: 350px; border-bottom: 1px solid rgba(255,255,255,0.1); }
            .Ml-hero-data-panel { padding: 25px; }
            .Ml-title-header { font-size: 36px; }
            .Ml-story-body blockquote { font-size: 18px; }
        }
		.posted-by-snippet{
			display:none;
		}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Mobile Menu Toggle
        $('#mobile-toggle-btn').click(function() {
            $('#mobile-menu').slideToggle();
        });
        
        // Ensure the featured image is centered and slightly zoomed in
        $(document).ready(function() {
            const $img = $('.Ml-hero-visual img');
            // Add a slow hover effect for subtle motion
            $('.Ml-hero-visual').hover(
                function() { $img.css('transform', 'scale(1.08)'); },
                function() { $img.css('transform', 'scale(1.05)'); }
            );
        });
    </script>