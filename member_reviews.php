    <style>
 :root {
            --Ml-bg-dark: #050A14; --Ml-bg-darker: #020408; --Ml-text-light: #EAEAEA; --Ml-text-muted: #8892B0;
            --Ml-accent-cyan: #00F0FF; --Ml-accent-purple: #BC13FE; --Ml-accent-gold: #FFD700;
            --Ml-font-heading: "Outfit", sans-serif; --Ml-font-body: "Nunito", sans-serif;
        }
        body { background-color: var(--Ml-bg-dark); color: var(--Ml-text-light); font-family: var(--Ml-font-body); overflow-x: hidden; background: radial-gradient(circle at 50% 10%, #1a0b2e 0%, #050A14 60%); background-attachment: fixed; }
        .Ml-noise-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; opacity: 0.05; background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)' opacity='1'/%3E%3C/svg%3E"); }

        /* ☄️ ASTEROIDS */
        .Ml-asteroid-system { position: fixed; top: 0; left: 0; width: 100%; height: 100%; pointer-events: none; z-index: 0; overflow: hidden; }
        .Ml-asteroid { position: absolute; border-radius: 50%; background: #fff; box-shadow: 0 0 15px 2px rgba(255, 255, 255, 0.4); opacity: 0; }
        .Ml-asteroid::after { content: ''; position: absolute; top: 50%; left: 50%; width: 100px; height: 2px; background: linear-gradient(90deg, rgba(255,255,255,0.5), transparent); transform-origin: left center; transform: translateY(-50%) rotate(180deg); }
        @keyframes Ml-fly-diag-1 { 0% { transform: translate(-100px, -100px) rotate(45deg); opacity: 0; } 10% { opacity: 1; } 90% { opacity: 1; } 100% { transform: translate(120vw, 120vh) rotate(45deg); opacity: 0; } }
        .Ml-asteroid-1 { top: 0; left: 0; width: 4px; height: 4px; animation: Ml-fly-diag-1 35s linear infinite; }
        .Ml-asteroid-2 { top: 20%; left: -100px; width: 3px; height: 3px; animation: Ml-fly-diag-1 45s linear infinite; animation-delay: 10s; }

        /* Nav/Footer (Shared) */
        .Ml-wrapper-topbar { position: fixed; top: 20px; left: 0; right: 0; z-index: 1000; padding: 0 20px; pointer-events: none; }
        .Ml-navbar { pointer-events: auto; background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); border-radius: 999px; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; max-width: 1140px; margin: 0 auto; box-shadow: 0 10px 40px rgba(0,0,0,0.6); position: relative; }
        .Ml-brand { font-family: var(--Ml-font-heading); font-size: 24px; font-weight: 700; color: white; z-index:1002; }
        .Ml-nav-links a { color: var(--Ml-text-muted); margin-left: 25px; font-size: 14px; font-weight: 600; text-decoration: none; transition: 0.3s; }
        .Ml-nav-links a:hover { color: white; }
        .Ml-mobile-toggle { display: none; color: white; font-size: 20px; cursor: pointer; z-index:1002; }
        .Ml-mobile-menu { display: none; position: absolute; top: 100%; left: 0; width: 100%; background: rgba(5, 10, 20, 0.95); backdrop-filter: blur(20px); border-radius: 20px; padding: 20px; margin-top: 10px; text-align: center; box-shadow: 0 20px 50px rgba(0,0,0,0.5); z-index:999; }
        .Ml-mobile-menu a { display: block; padding: 15px; color: white; border-bottom: 1px solid rgba(255,255,255,0.05); }
        
        .Ml-footer { padding: 80px 0 40px; border-top: 1px solid rgba(255,255,255,0.05); background: #020408; font-size: 14px; color: #888; position: relative; z-index: 1; }
        .Ml-footer-links { list-style: none; padding: 0; }
        .Ml-footer-links li { margin-bottom: 12px; }
        .Ml-footer-links a { color: var(--Ml-text-muted); text-decoration: none; transition: 0.3s; }
        .Ml-footer-links a:hover { color: var(--Ml-accent-cyan); }
        .Ml-footer-col h4 { color: white; margin-bottom: 25px; font-size: 18px; }
        .Ml-social-btn { width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.05); display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; transition: 0.3s; color: white; }
        .Ml-social-btn:hover { background: var(--Ml-accent-cyan); color: black; }

        /* Testimonials Grid (Hatke Design) */
        .Ml-review-hero { padding-top: 60px; padding-bottom: 80px; text-align: center; position: relative; z-index: 1; }
        .Ml-hero-title { font-size: clamp(42px, 6vw, 64px) !important; font-weight: 900; color: white; letter-spacing: -1px; }
        
        .Ml-intercept-grid { 
            column-count: 3; column-gap: 20px; 
            max-width: 1200px; margin: 0 auto; padding: 0 15px 100px; position: relative; z-index: 1; 
        }
        
        .Ml-transmission-card {
            background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.05);
            backdrop-filter: blur(10px); padding: 30px; border-radius: 12px;
            margin-bottom: 20px; break-inside: avoid;
            transition: 0.4s; position: relative; overflow: hidden;min-height:280px;
        }
        
        /* Transmission Decoration */
        .Ml-transmission-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 3px; height: 100%;
            background: linear-gradient(180deg, var(--Ml-accent-cyan), transparent);
        }
        .Ml-transmission-card:nth-child(2n)::before { background: linear-gradient(180deg, var(--Ml-accent-purple), transparent); }
        .Ml-transmission-card:nth-child(3n)::before { background: linear-gradient(180deg, var(--Ml-accent-gold), transparent); }
        
        .Ml-transmission-card:hover { transform: translateY(-5px); background: rgba(255,255,255,0.05); box-shadow: 0 10px 30px rgba(0,0,0,0.3); }

        .Ml-signal-meta { 
            font-family: monospace; font-size: 10px; color: var(--Ml-text-muted); margin-bottom: 15px; display: flex; justify-content: space-between;
        }
        .Ml-signal-bars { display: flex; gap: 2px; }
        .Ml-bar { width: 3px; height: 10px; background: var(--Ml-accent-cyan); opacity: 0.5; }
        .Ml-bar:nth-child(1) { height: 6px; } .Ml-bar:nth-child(2) { height: 8px; } .Ml-bar:nth-child(3) { height: 10px; opacity: 1; }

        .Ml-review-text { font-size: 15px; line-height: 1.6; color: #ddd; margin-bottom: 20px; }
        
        .Ml-user-info { display: flex; align-items: center; gap: 15px; border-top: 1px solid rgba(255,255,255,0.05); padding-top: 15px;object-fit: cover; }
        .Ml-user-info .Ml-user-img { width: 36px !important; height: 36px !important; border-radius: 50%; border: 1px solid rgba(255,255,255,0.2);object-fit: cover; }
        .Ml-user-name { font-size: 13px; font-weight: 700; color: white; display: block; }
        .Ml-user-meta { font-size: 11px; color: var(--Ml-text-muted); }

        @media (max-width: 991px) { .Ml-intercept-grid { column-count: 2; } }
        @media (max-width: 600px) { 
            .Ml-intercept-grid { column-count: 1; } 
            .Ml-nav-links { display: none; } .Ml-mobile-toggle { display: block; } 
        }
		.post-search-result-count{
			display:none;
		}
@media (max-width: 991px) {
    .Ml-transmission-card {
        min-height: 260px;
        padding: 25px;
    }
}

@media (max-width: 600px) {
    .Ml-transmission-card {
        min-height: auto;   /* let content decide */
        padding: 22px;
    }
}

</style>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2290%22>?</text></svg>">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700&family=Outfit:wght@300;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



    <div class="Ml-noise-overlay"></div>
    
    <!-- ☄️ ASTEROID SYSTEM -->
    <div class="Ml-asteroid-system">
        <div class="Ml-asteroid Ml-asteroid-1"></div>
        <div class="Ml-asteroid Ml-asteroid-2"></div>
    </div>

   

    <div class="Ml-review-hero">
        <div class="container">
            <h1 class="Ml-hero-title">Intercepted Signals</h1>
            <p style="color:#888;">12 encrypted transmissions decoded from the MoonLoop galaxy.</p>
        </div>
    </div>
    <div class="Ml-intercept-grid">

    <!-- header codes ends here and reviews loop starts here -->
     <?php
// BD Data Handling Logic
$empty_overall = 5 - $r['rating_overall'];
global $reviewLoop;
$userPhoto = getUserPhoto($user['user_id'], $user['listing_type'], $w);
$userPhoto = $userPhoto['file'];
$userfile = $user['filename'];
$subscription = getSubscription($user['subscription_id'],$w);
$r = getMetaData("users_reviews",$r['review_id'],$r,$w);
$reviewLoop = $r;

$submitter = getUser($r['member_id'], $w);
$submitterUserPhoto = getUserPhoto($submitter['user_id'], $submitter['listing_type'], $w);
$submitterUserPhoto = $submitterUserPhoto['file'];

// Clean up description
$description = strip_tags($r['review_description']);
?>

<a href="/<?php echo $userfile; ?>?variation=modern&widget= Bootstrap Theme - Member Profile - Header-modern" style="text-decoration: none; color: inherit;">
    <div class="Ml-transmission-card">
        <div class="Ml-signal-meta">
            <span></span> <?php echo $r['review_title'] ? $r['review_title'] : '104.5'; ?></span>
            <div class="Ml-signal-bars">
                <div class="Ml-bar"></div>
                <div class="Ml-bar"></div>
                <div class="Ml-bar"></div>
            </div>
        </div>
        
        <p class="Ml-review-text">
<?php
$words = preg_split('/\s+/', trim(strip_tags($description)));

if (count($words) > 23) {
    $words = array_slice($words, 0, 23);
    echo implode(' ', $words) . '...';
} else {
    echo implode(' ', $words);
}
?>
        </p>
        
        <div class="Ml-user-info">
            <img src="<?php echo $submitterUserPhoto; ?>" class="Ml-user-img" alt="<?php echo ucwords($r['review_name']); ?>">
            <div>
                <span class="Ml-user-name"><?php echo ucwords($r['review_name']); ?></span>
                <span class="Ml-user-meta">
                    <?php echo date($w['php_format'], strtotime($r['review_added'])); ?>
                </span>
            </div>
        </div>
    </div>
</a>

<!-- loop code ends here and footer starts here -->
 </div> 

<script>
    // Simple fade in animation on scroll
    document.addEventListener("DOMContentLoaded", function() {
        const cards = document.querySelectorAll('.dc-story-card');
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = 1;
                    entry.target.style.transform = "translateY(0)";
                }
            });
        });

        cards.forEach((card, index) => {
            card.style.opacity = 0;
            card.style.transform = "translateY(20px)";
            card.style.transition = "opacity 0.6s ease, transform 0.6s ease";
            // Stagger animation
            setTimeout(() => {
                observer.observe(card);
            }, index * 100); 
        });
    });
</script>