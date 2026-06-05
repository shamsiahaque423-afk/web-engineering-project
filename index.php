<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Skill Linker - Home</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    overflow-x:hidden;
}

/* BACKGROUND */
.background{
    position:fixed;
    width:100%;
    height:100%;
    background:url('https://images.unsplash.com/photo-1521791136064-7986c2920216?auto=format&fit=crop&w=1950&q=80') no-repeat center;
    background-size:cover;
    filter:blur(6px);
    z-index:-1;
}

/* NAVBAR */
.navbar{
    background:rgba(0,0,0,0.7) !important;
}

.navbar-brand{
    color:white !important;
    font-weight:bold;
    font-size:24px;
}

.nav-link{
    color:white !important;
    font-weight:600;
    margin-left:10px;
}

.nav-link:hover{
    color:#ffd700 !important;
}

/* HERO */
.hero{
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    text-align:center;
    color:white;
}

.hero-box{
    background:rgba(0,0,0,0.6);
    padding:40px;
    border-radius:20px;
    max-width:700px;
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

.hero-box h1{
    font-size:55px;
    font-weight:900;
}

.hero-box p{
    font-size:20px;
    margin-top:15px;
}

/* FEATURES */
.features{
    padding:60px 20px;
    background:rgba(255,255,255,0.92);
}

.features h2{
    font-weight:900;
}

.card{
    border:none;
    border-radius:20px;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-5px);
}

.card h4{
    font-weight:bold;
}

/* FOOTER */
footer{
    background:black;
    color:white;
    font-weight:500;
}

/* MOBILE */
@media(max-width:768px){

    .hero-box h1{
        font-size:35px;
    }

    .hero-box p{
        font-size:16px;
    }

}

</style>

</head>

<body>

<!-- BACKGROUND -->
<div class="background"></div>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

    <!-- LOGO -->
    <a class="navbar-brand" href="index.php">
        Skill Linker
    </a>

    <!-- MOBILE BUTTON -->
    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

        <span class="navbar-toggler-icon"></span>

    </button>

    <!-- NAVBAR MENU -->
    <div class="collapse navbar-collapse justify-content-end"
         id="navbarNav">

        <ul class="navbar-nav align-items-center">

            <!-- HOME -->
            <li class="nav-item">

                <a class="nav-link active"
                   href="index.php">

                    Home

                </a>

            </li>

            <!-- LOGIN DROPDOWN -->
            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle"
                   href="#"
                   id="loginDropdown"
                   role="button"
                   data-bs-toggle="dropdown">

                    Login

                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>
                        <a class="dropdown-item"
                           href="log_in_learner.html">

                            Login as Learner

                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item"
                           href="log_in_provider.html">

                            Login as Provider

                        </a>
                    </li>

                </ul>

            </li>

            <!-- DASHBOARD -->
            <li class="nav-item">

                <a class="nav-link"
                   href="dashboard.php">

                    Dashboard

                </a>

            </li>

        </ul>

    </div>

</div>

</nav>

<!-- HERO SECTION -->
<div class="hero">

<div class="hero-box">

    <h1>
        Welcome to Skill Linker
    </h1>

    <p>
        Connect users, share skills, and build opportunities easily.
    </p>

</div>

</div>

<!-- FEATURES -->
<div class="features text-center">

<div class="container">

<h2 class="mb-5">
Our Features
</h2>

<div class="row g-4">

    <!-- USER MANAGEMENT -->
    <div class="col-md-6">

        <div class="card p-4 shadow">

            <h4>
                User Management
            </h4>

            <p>
                Create account, login, and manage profile.
            </p>

        </div>

    </div>

    <!-- SKILLS -->
    <div class="col-md-6">

        <div class="card p-4 shadow">

            <h4>
                Skills
            </h4>

            <p>
                Add and explore skills easily.
            </p>

        </div>

    </div>

</div>

</div>

</div>

<!-- FOOTER -->
<footer class="text-center p-3">

© 2026 Skill Linker

</footer>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>