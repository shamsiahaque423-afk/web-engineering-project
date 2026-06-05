<?php
// DATABASE CONNECTION
$conn = new mysqli("localhost","root","","skilllinker");

if($conn->connect_error){
    die("Connection Failed");
}

// GET LEARNER ID
$learner_id = $_GET['learner_id'];

// MESSAGE
$message = "";

// REQUEST BUTTON ACTION
if(isset($_GET['request_provider'])){

    $provider_id = $_GET['request_provider'];

    // CHECK IF LEARNER ALREADY SENT ANY REQUEST
    $already_sent = "
    SELECT * FROM request
    WHERE learner_id='$learner_id'
    ";

    $already_result = $conn->query($already_sent);

    if($already_result->num_rows > 0){

        $message = "❌ Only one request at a time!";

    } else {

        // INSERT REQUEST
        $insert = "
        INSERT INTO request (learner_id, provider_id, status)
        VALUES ('$learner_id', '$provider_id', 'Pending')
        ";

        if($conn->query($insert) === TRUE){

            $message = "✅ Request Sent Successfully!";

        } else {

            $message = "❌ Request Failed!";
        }
    }
}

// FETCH PROVIDERS
$sql = "SELECT * FROM providers";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Learner Panel</title>

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

/* PANEL */
.panel{
    width:95%;
    max-width:1100px;
    margin:40px auto;
    padding:30px;
    border-radius:20px;
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(20px);
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

/* TITLES */
h2{
    text-align:center;
    margin-bottom:20px;
    font-weight:bold;
}

/* TABLE */
.table{
    background:white;
    border-radius:10px;
    overflow:hidden;
}

.table th{
    background:#111827;
    color:white;
}

/* REQUEST BUTTON */
.btn-request{
    background:#2563eb;
    color:white;
    border:none;
    padding:8px 14px;
    border-radius:8px;
    text-decoration:none;
    font-weight:bold;
}

.btn-request:hover{
    background:#1d4ed8;
    color:white;
}

/* BACK BUTTON */
.back{
    display:inline-block;
    margin-top:20px;
    color:white;
    text-decoration:none;
}

.back:hover{
    text-decoration:underline;
}

/* MESSAGE */
.message{
    text-align:center;
    margin-bottom:20px;
    font-size:18px;
    color:#90ee90;
    font-weight:bold;
}

.error-message{
    text-align:center;
    margin-bottom:20px;
    font-size:18px;
    color:#ffb3b3;
    font-weight:bold;
}

/* STATUS BOX */
.status-box{
    display:inline-block;
    padding:6px 10px;
    border-radius:6px;
    font-size:13px;
    margin-top:5px;
    font-weight:bold;
}

.requested{
    background:white;
    color:black;
}

.pending{
    background:orange;
    color:white;
}

.accepted{
    background:red;
    color:white;
}

/* MOBILE */
@media(max-width:768px){

    .panel{
        padding:15px;
    }

    .table{
        font-size:12px;
    }

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

<!-- MAIN PANEL -->
<div class="panel">

<h2>
✅ Learner Verified
</h2>

<p>
Welcome Learner ID:
<strong><?php echo $learner_id; ?></strong>
</p>

<!-- MESSAGE -->
<?php
if($message != ""){

    if(strpos($message, "Only one") !== false){

        echo "<div class='error-message'>$message</div>";

    } else {

        echo "<div class='message'>$message</div>";
    }
}
?>

<h3 class="mt-4 mb-3">
Available Providers
</h3>

<!-- TABLE -->
<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>

    <th>Provider ID</th>
    <th>Email</th>
    <th>Skill Name</th>
    <th>Experience</th>
    <th>Action</th>

</tr>

</thead>

<tbody>

<?php

if($result && $result->num_rows > 0){

    while($row = $result->fetch_assoc()){

        echo "<tr>";

        echo "<td>".$row['provider_id']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['skill_name']."</td>";
        echo "<td>".$row['experience']."</td>";

        echo "<td>";

        // CHECK REQUEST
        $request_check = "
        SELECT * FROM request
        WHERE learner_id='$learner_id'
        AND provider_id='".$row['provider_id']."'
        ";

        $check_result = $conn->query($request_check);

        if($check_result->num_rows > 0){

            $req = $check_result->fetch_assoc();

            echo "<div class='status-box requested'>Requested ✔</div><br>";

            if($req['status'] == "Accepted"){

                echo "<div class='status-box accepted'>Accepted</div>";

            } else {

                echo "<div class='status-box pending'>Pending</div>";
            }

        } else {

            echo "
            <a href='learner_panel.php?learner_id=".$learner_id."&request_provider=".$row['provider_id']."'
               class='btn-request'>

               Request

            </a>
            ";
        }

        echo "</td>";

        echo "</tr>";
    }

}else{

    echo "
    <tr>

        <td colspan='5' class='text-center'>

            No Providers Found

        </td>

    </tr>
    ";
}

$conn->close();

?>

</tbody>

</table>

</div>

<!-- BACK -->
<a href="index.php" class="back">
⬅ Back to Home
</a>

</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>