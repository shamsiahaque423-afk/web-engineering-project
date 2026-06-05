<?php
$conn = new mysqli("localhost","root","","skilllinker");

if($conn->connect_error){
    die("DB Error");
}

// GET REQUEST ID
$request_id = $_GET['id'];

// UPDATE STATUS
$sql = "UPDATE request 
        SET status='Accepted' 
        WHERE request_id='$request_id'";

if($conn->query($sql) === TRUE){

    $message = "✅ Request Accepted Successfully!";

} else {

    $message = "❌ Failed to accept request!";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Request Status</title>

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
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:90vh;
    padding:20px;
}

/* MESSAGE BOX */
.box{
    text-align:center;
    padding:40px;
    width:450px;
    background:rgba(255,255,255,0.1);
    border-radius:20px;
    backdrop-filter:blur(15px);
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

/* TITLE */
h2{
    margin-bottom:25px;
    font-weight:bold;
}

/* BUTTON */
.btn-custom{
    border-radius:10px;
    padding:10px 20px;
    font-weight:bold;
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

    <!-- NAVBAR MENU -->
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

<div class="box">

<h2>
<?php echo $message; ?>
</h2>

<a href="dashboard.php?role=provider"
   class="btn btn-light btn-custom">

⬅ Back to Dashboard

</a>

</div>

</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>