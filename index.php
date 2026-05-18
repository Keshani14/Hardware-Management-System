<?php
session_start();
$hide_log = "block";
$show_profile = "none";
$is_admin = false;
$id = 0;
$role = "none";
$hide_help = "inline-block";
if (isset($_SESSION['id'])) {
    $hide_log = "none";
    $show_profile = "block";
    $id = $_SESSION['id'];
    require_once('connect.php');
    $sql = "SELECT username, role
            FROM users
            WHERE id = " . $id . ";";
    $result = mysqli_query($connection, $sql);
    $row = $result -> fetch_assoc();
    $name = $row['username'];
    $role = $row['role'];
    if ($role == 'admin') {
        $is_admin = true;
        $hide_help = "none";
    }
}
?>
<html>
<head>
    <title>ABC Builders Material Management System</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./styles/main.css">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --steel:    #1a2b3c;
            --steel-mid: #243b52;
            --amber:    #e8a020;
            --amber-lt: #f5c060;
            --slate:    #f0f3f6;
            --white:    #ffffff;
            --ink:      #1c2a36;
            --muted:    #5a7080;
            --border:   #d4dde5;
            --shadow:   0 4px 24px rgba(26,43,60,.12);
            --radius:   10px;
        }

        body {
            font-family: 'Barlow', sans-serif;
            background: var(--slate);
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ── HEADER ── */
        #site-header {
            background: var(--white);
            border-bottom: 2px solid var(--border);
            padding: 0 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 72px;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,.08);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 38px;
            height: 38px;
            background: var(--amber);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .brand-icon svg { width: 22px; height: 22px; fill: var(--steel); }

        .brand-name {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--steel);
            letter-spacing: .04em;
            text-transform: uppercase;
            line-height: 1.15;
        }

        .brand-name span { color: var(--amber); }

        /* ── NAV ── */
        nav {
            display: flex;
            align-items: center;
            gap: 4px;
        }

        nav a {
            font-family: 'Barlow', sans-serif;
            font-weight: 600;
            font-size: .9rem;
            color: #000000;
            text-decoration: none;
            padding: 8px 18px;
            border-radius: 6px;
            letter-spacing: .04em;
            transition: color .2s, background .2s;
            text-shadow: none;
        }

        nav a:hover { color: var(--amber); background: rgba(0,0,0,.06); }
        nav a.active { color: var(--steel); background: var(--amber); font-weight: 700; text-shadow: none; }

        .log_link {
            margin-left: 8px;
            border: 1.5px solid rgba(0,0,0,.4) !important;
        }

        .log_link:hover { border-color: var(--amber) !important; color: var(--amber) !important; background: transparent !important; }

        /* ── HERO BAND ── */
        .hero-band {
            background: linear-gradient(90deg, var(--steel) 0%, #2a4a63 100%);
            padding: 52px 60px;
            display: flex;
            align-items: center;
            gap: 48px;
            position: relative;
            overflow: hidden;
        }

        .hero-band::before {
            content: '';
            position: absolute;
            right: -60px; top: -60px;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(232,160,32,.18) 0%, transparent 70%);
        }

        .hero-badge {
            flex-shrink: 0;
            width: 60px; height: 60px;
            background: var(--amber);
            border-radius: 14px;
            display: flex; align-items: center; justify-content: center;
        }

        .hero-badge svg { width: 32px; height: 32px; fill: var(--steel); }

        .hero-text h1 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 2.6rem;
            font-weight: 800;
            color: var(--white);
            letter-spacing: .02em;
            text-transform: uppercase;
            line-height: 1.05;
        }

        .hero-text h1 em { color: var(--amber); font-style: normal; }

        .hero-text p {
            margin-top: 10px;
            color: rgba(255,255,255,.65);
            font-size: .95rem;
            font-weight: 300;
            max-width: 540px;
            line-height: 1.6;
        }

        /* ── MAIN CONTENT ── */
        main {
            flex: 1;
            padding: 48px 60px;
            max-width: 1200px;
            width: 100%;
            margin: 0 auto;
        }

        /* ── INTRO CARD ── */
        .intro-card {
            background: var(--white);
            border-radius: var(--radius);
            padding: 28px 32px;
            border-left: 4px solid var(--amber);
            box-shadow: var(--shadow);
            margin-bottom: 48px;
            display: flex;
            align-items: flex-start;
            gap: 20px;
        }

        .intro-card .info-icon {
            flex-shrink: 0;
            width: 40px; height: 40px;
            background: #fff7e6;
            border-radius: 8px;
            display: flex; align-items: center; justify-content: center;
            margin-top: 2px;
        }

        .intro-card .info-icon svg { width: 20px; height: 20px; fill: var(--amber); }

        .intro-card p {
            font-size: .95rem;
            line-height: 1.7;
            color: var(--muted);
        }

        .intro-card strong { color: var(--ink); font-weight: 600; }

        /* ── SECTION LABEL ── */
        .section-label {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .section-label h2 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .06em;
            color: var(--ink);
        }

        .section-label .line {
            flex: 1;
            height: 2px;
            background: var(--border);
        }

        /* ── MATERIAL GRID ── */
        .material-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .material-card {
            background: var(--white);
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: transform .25s, box-shadow .25s;
            cursor: pointer;
            border: 1.5px solid transparent;
        }

        .material-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 36px rgba(26,43,60,.18);
            border-color: var(--amber);
        }

        .material-card .img-wrap {
            width: 100%;
            aspect-ratio: 4/3;
            overflow: hidden;
            background: #e8edf2;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .material-card .img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s;
        }

        .material-card:hover .img-wrap img { transform: scale(1.06); }

        .material-card .card-body {
            padding: 16px 18px;
            border-top: 2px solid var(--slate);
        }

        .material-card .card-body h3 {
            font-family: 'Barlow Condensed', sans-serif;
            font-size: 1.05rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            color: var(--ink);
        }

        .material-card .card-body p {
            font-size: .8rem;
            color: var(--muted);
            margin-top: 4px;
        }

        .card-tag {
            display: inline-block;
            margin-top: 10px;
            font-size: .72rem;
            font-weight: 600;
            letter-spacing: .06em;
            text-transform: uppercase;
            color: var(--amber);
            background: #fff7e6;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* ── FOOTER ── */
        footer {
            background: var(--steel);
            color: rgba(255,255,255,.5);
            text-align: center;
            padding: 20px 40px;
            font-size: .8rem;
            font-weight: 400;
            letter-spacing: .04em;
        }

        footer strong { color: rgba(255,255,255,.8); }
    </style>
</head>
<body>

    <!-- HEADER / NAV -->
    <header id="site-header">
        <div class="brand">
            <div class="brand-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/>
                    <polyline points="9 22 9 12 15 12 15 22" fill="none" stroke="#1a2b3c" stroke-width="1.5"/>
                </svg>
            </div>
            <div class="brand-name">ABC <span>Builders</span></div>
        </div>

        <nav>
            <a class="active" style="margin-left: 4px;" href="#">Home</a>
            <a href="materials.php">Our Materials</a>
            <a href="manual.php" style="display: <?php echo $hide_help; ?>">Help</a>
            <?php
                if ($is_admin === true) {
                    echo '<a href="admin_panel.php">Admin</a> <a href="handle_orders.php">Orders</a>';
                } elseif ($role == "ordinary") {
                    echo '<a href="my_orders.php">My Orders</a>';
                } elseif ($role == "delivery") {
                    echo '<a href="deliveries.php">Deliveries</a>';
                }
            ?>
            <a class="log_link" href="login-page.php" style="display: <?php echo $hide_log ?>;">Log in</a>
            <a class="log_link" href="profile.php" style="display: <?php echo $show_profile ?>;">My Profile</a>
        </nav>
    </header>

    <!-- HERO BAND -->
    <div class="hero-band">
        <div class="hero-badge">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <rect x="2" y="7" width="20" height="14" rx="2"/>
                <path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/>
                <line x1="12" y1="12" x2="12" y2="16"/>
                <line x1="10" y1="14" x2="14" y2="14"/>
            </svg>
        </div>
        <div class="hero-text">
            <h1>Material <em>Management</em> System</h1>
            <p>Browse, order, and track building materials from ABC Builders &amp; Suppliers — all in one place.</p>
        </div>
    </div>

    <!-- MAIN -->
    <main>

        <!-- Intro Card -->
        <div class="intro-card">
            <div class="info-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
            </div>
            <p>
                This is the portal of <strong>ABC Builders &amp; Suppliers</strong> Material Management System.
                You can browse available materials and relevant information about those materials.
                If you are new to our site, please go to the <strong>Help</strong> page in the navigation above.
            </p>
        </div>

        <!-- Materials Section -->
        <div class="section-label">
            <h2>Featured Materials</h2>
            <div class="line"></div>
        </div>

        <div class="material-grid">
            <div class="material-card">
                <div class="img-wrap">
                    <img src="./images/cement.png" alt="Cement">
                </div>
                <div class="card-body">
                    <h3>Cement</h3>
                    <p>Portland &amp; specialty blends</p>
                    <span class="card-tag">In Stock</span>
                </div>
            </div>

            <div class="material-card">
                <div class="img-wrap">
                    <img src="./images/bricks.png" alt="Bricks">
                </div>
                <div class="card-body">
                    <h3>Bricks</h3>
                    <p>Clay &amp; concrete varieties</p>
                    <span class="card-tag">In Stock</span>
                </div>
            </div>

            <div class="material-card">
                <div class="img-wrap">
                    <img src="./images/tools.png" alt="Tools">
                </div>
                <div class="card-body">
                    <h3>Tools</h3>
                    <p>Trowels, screeds &amp; more</p>
                    <span class="card-tag">Available</span>
                </div>
            </div>

            <div class="material-card">
                <div class="img-wrap">
                    <img src="./images/rocks.png" alt="Aggregate">
                </div>
                <div class="card-body">
                    <h3>Aggregate</h3>
                    <p>Gravel, crushed stone &amp; sand</p>
                    <span class="card-tag">In Stock</span>
                </div>
            </div>
        </div>

    </main>

    <!-- FOOTER -->
    <footer>
        <strong>Copyright &copy; 2024 ABC Builders &amp; Suppliers</strong> &nbsp;|&nbsp; All rights reserved.
    </footer>

</body>
</html>