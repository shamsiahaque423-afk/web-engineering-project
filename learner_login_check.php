<?php
$conn = new mysqli("localhost","root","","skilllinker");

if($conn->connect_error){
    die("Database Connection Failed");
}

$message = "";

if(isset($_POST['login'])){

    $learner_id = $_POST['learner_id'];

    // CHECK LEARNER ID
    $sql = "SELECT * FROM learners WHERE learner_id='$learner_id'";
    $result = $conn->query($sql);

    // IF USER EXISTS
    if($result && $result->num_rows == 1){

        // GO TO NEXT PAGE
        header("Location: learner_panel.php?learner_id=$learner_id");
        exit();

    } else {

        // ERROR MESSAGE
        $message = "❌ User does not exist!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Learner Verification</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
    margin:0;
    min-height:100vh;
    background:linear-gradient(135deg,#1e3a8a,#7f1d1d);
    font-family:'Segoe UI', sans-serif;
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

/* CENTER BOX */
.main-container{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:90vh;
    padding:20px;
}

.box{
    width:380px;
    padding:30px;
    border-radius:20px;
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(20px);
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

h3{
    text-align:center;
    margin-bottom:25px;
    font-weight:bold;
}

.form-control{
    margin-top:10px;
    border-radius:10px;
}

/* BUTTON */
.btn-custom{
    width:100%;
    margin-top:20px;
    background:linear-gradient(135deg,#3b82f6,#b91c1c);
    border:none;
    color:white;
    padding:12px;
    border-radius:25px;
    font-weight:bold;
}

.btn-custom:hover{
    opacity:0.9;
}

/* ERROR */
.error{
    text-align:center;
    color:#ffb4b4;
    margin-top:15px;
    font-weight:bold;
}

/* BACK */
.back{
    display:block;
    text-align:center;
    margin-top:15px;
    color:white;
    text-decoration:none;
}

.back:hover{
    text-decoration:underline;
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

<h3>
👨‍🎓 Learner Verification
</h3>

<form method="POST">

<label>
Enter learner_id
</label>

<input 
type="number" 
name="learner_id" 
class="form-control"
placeholder="Enter learner_id"
required
>

<button type="submit"
        name="login"
        class="btn btn-custom">

Verify

</button>

</form>

<?php
if(!empty($message)){
    echo "<div class='error'>$message</div>";
}
?>

<a href="index.php" class="back">
⬅ Back to Home
</a>

</div>

</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html></html>