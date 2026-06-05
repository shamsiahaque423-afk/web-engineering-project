<?php
$conn = new mysqli("localhost","root","","skilllinker");

if($conn->connect_error){
    die("DB Connection Failed");
}

// GET LEARNER ID
$learner_id = $_GET['learner_id'];

// GET ALL REQUESTS OF THIS LEARNER
$sql = "SELECT * FROM request WHERE learner_id='$learner_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Learner Requests</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    min-height:100vh;
    font-family:'Segoe UI', sans-serif;
    background:linear-gradient(135deg,#1e3a8a,#7f1d1d);
    color:white;
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

/* MAIN CONTAINER */
.main-container{
    padding:40px 20px;
}

/* BOX */
.container-box{
    max-width:900px;
    margin:auto;
    background:rgba(255,255,255,0.1);
    padding:30px;
    border-radius:20px;
    backdrop-filter:blur(15px);
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

/* TITLE */
h2{
    text-align:center;
    margin-bottom:25px;
    font-weight:bold;
}

/* REQUEST BOX */
.request-box{
    background:rgba(0,0,0,0.3);
    padding:15px;
    border-radius:10px;
    margin-bottom:15px;
    font-size:18px;
}

/* STATUS */
.status-pending{
    color:orange;
    font-weight:bold;
}

.status-accepted{
    color:lightgreen;
    font-weight:bold;
}

/* BACK BUTTON */
.back-btn{
    display:inline-block;
    margin-top:20px;
    color:white;
    text-decoration:none;
    font-weight:bold;
}

.back-btn:hover{
    text-decoration:underline;
}

/* NO REQUEST */
.no-request{
    text-align:center;
    font-size:18px;
    margin-top:20px;
}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

    <!-- LOGO -->
    <a class="navbar-brand" href="index.php">
        Skill Linker
    </a>

    <!-- MOBILE TOGGLE -->
    <button class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#navbarNav">

        <span class="navbar-toggler-icon"></span>

    </button>

    <!-- NAVIGATION MENU -->
    <div class="collapse navbar-collapse justify-content-end"
         id="navbarNav">

        <ul class="navbar-nav align-items-center">

            <!-- HOME -->
            <li class="nav-item">

                <a class="nav-link"
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

<!-- MAIN CONTENT -->
<div class="main-container">

<div class="container-box">

<h2>
👨‍🎓 Your Requests Status
</h2>

<?php

if($result->num_rows > 0){

    while($row = $result->fetch_assoc()){

        echo "<div class='request-box'>";

        echo "<b>Provider ID:</b> ".$row['provider_id']." <br><br>";

        echo "<b>Status:</b> ";

        // STATUS CHECK
        if($row['status'] == "Accepted"){

            echo "<span class='status-accepted'>
                    Accepted ✅
                  </span>";

        } else {

            echo "<span class='status-pending'>
                    Pending ⏳
                  </span>";
        }

        echo "</div>";
    }

}else{

    echo "
    <div class='no-request'>
        No requests found.
    </div>
    ";
}

?>

<!-- BACK -->
<a href="index.php" class="back-btn">

⬅ Back to Home

</a>

</div>

</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>