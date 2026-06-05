<?php
$conn = new mysqli("localhost","root","","skilllinker");

if($conn->connect_error){
    die("DB Error");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Skill Linker Dashboard</title>

<!-- BOOTSTRAP CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    font-family:'Segoe UI', sans-serif;
    color:white;
    overflow-x:hidden;
}

/* BACKGROUND */
.background{
    position:fixed;
    width:100%;
    height:100%;
    background:url("https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1950&q=80") no-repeat center;
    background-size:cover;
    filter:blur(6px) brightness(0.4);
    z-index:-2;
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

/* DROPDOWN */
.dropdown-menu{
    border-radius:10px;
}

/* MAIN WRAPPER */
.wrapper{
    display:flex;
    min-height:100vh;
}

/* LEFT PANEL */
.left-panel{
    width:40%;
    background:url("https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=900&q=80") no-repeat center;
    background-size:cover;
    position:relative;
}

.left-panel::after{
    content:"";
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:rgba(0,0,0,0.5);
}

/* RIGHT PANEL */
.right-panel{
    width:60%;
    padding:30px;
    overflow-y:auto;
}

/* TITLE */
.title{
    font-size:40px;
    font-weight:900;
    margin-bottom:20px;
    text-shadow:0 3px 15px rgba(0,0,0,0.6);
}

/* SECTION TITLE */
.section-title{
    font-size:38px;
    font-weight:900;
    margin-top:25px;
    text-align:center;
    letter-spacing:1px;
    text-transform:uppercase;
    text-shadow:0 4px 15px rgba(0,0,0,0.7);
}

/* GLASS BOX */
.box{
    background:rgba(255,255,255,0.10);
    backdrop-filter:blur(15px);
    padding:20px;
    border-radius:15px;
    margin-top:15px;
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

/* BUTTONS */
.btn-role{
    width:220px;
    margin:10px;
    border-radius:10px;
    font-weight:bold;
    padding:12px;
}

/* MOBILE */
@media(max-width:768px){

    .wrapper{
        flex-direction:column;
    }

    .left-panel{
        width:100%;
        height:250px;
    }

    .right-panel{
        width:100%;
    }

    .title{
        font-size:30px;
        text-align:center;
    }

    .section-title{
        font-size:28px;
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
    <a class="navbar-brand" href="/skilllinker/index.php">
        Skill Linker
    </a>

    <!-- MOBILE TOGGLE -->
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
                <a class="nav-link"
                   href="/skilllinker/index.php">

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

<!-- MAIN CONTENT -->
<div class="wrapper">

<!-- LEFT SIDE -->
<div class="left-panel"></div>

<!-- RIGHT SIDE -->
<div class="right-panel">

<div class="container">

<!-- TITLE -->
<div class="title">
📊 Skill Linker Dashboard
</div>

<!-- ROLE SELECTION -->
<?php if(!isset($_GET['role'])) { ?>

<div class="text-center mt-5">

    <div class="section-title">
        Select Dashboard Side
    </div>

    <!-- LEARNER BUTTON -->
    <a href="learner_login_check.php"
       class="btn btn-primary btn-role">

        👨‍🎓 Learner Side

    </a>

    <!-- PROVIDER BUTTON -->
    <a href="provider_login_check.php"
       class="btn btn-success btn-role">

        👨‍🏫 Provider Side

    </a>

</div>

<?php } ?>


<!-- PROVIDER DASHBOARD -->
<?php
if(isset($_GET['role']) &&
   $_GET['role']=="provider" &&
   !isset($_GET['view'])) {
?>

<div class="section-title">
👨‍🏫 Provider Dashboard
</div>

<div class="text-center mt-5">

<a href="dashboard.php?role=provider&view=1"
   class="btn btn-primary"
   style="padding:20px 60px;
          font-size:28px;
          font-weight:bold;
          border-radius:15px;">

   👁 VIEW REQUESTS

</a>

</div>

<?php } ?>


<!-- VIEW REQUESTS -->
<?php
if(isset($_GET['role']) &&
   $_GET['role']=="provider" &&
   isset($_GET['view'])) {
?>

<div class="section-title">
📥 All Requests
</div>

<!-- BACK BUTTON -->
<a href="dashboard.php?role=provider"
   class="btn btn-light btn-sm mt-2">

⬅ Back

</a>

<!-- REQUEST BOX -->
<div class="box">

<?php

$sql = "SELECT * FROM request WHERE status='Pending'";

$res = $conn->query($sql);

if($res->num_rows > 0){

    while($r = $res->fetch_assoc()){

        echo "

        <p>

        <b>Request ID:</b> {$r['request_id']} <br>

        <b>Learner ID:</b> {$r['learner_id']} <br>

        <b>Provider ID:</b> {$r['provider_id']} <br>

        <a href='accept.php?id={$r['request_id']}'
           class='btn btn-success btn-sm mt-2'>

           Accept

        </a>

        </p>

        <hr>

        ";
    }

}else{

    echo "<p>No Requests Found</p>";

}

?>

</div>

<?php } ?>

</div>
</div>
</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>