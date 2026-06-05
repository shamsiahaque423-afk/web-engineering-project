<?php
// DATABASE CONNECTION
$conn = new mysqli("localhost", "root", "", "skilllinker");

// CHECK CONNECTION
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// GET FORM DATA
$learner_id = $_POST['learner_id'];
$email = $_POST['email'];
$skill_interest = $_POST['skill_interest'];
$learning_level = $_POST['learning_level'];
$password = $_POST['password'];

// BASIC VALIDATION
if (empty($email) || empty($skill_interest) || empty($learning_level) || empty($password)) {
    die("❌ Please fill all required fields!");
}

// HASH PASSWORD
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// INSERT QUERY
$sql = "INSERT INTO learners (learner_id, email, skill_interest, learning_level, password)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}

$stmt->bind_param("issss", $learner_id, $email, $skill_interest, $learning_level, $hashed_password);

// EXECUTE
$success = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Learner Registration</title>

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

/* CENTER BOX */
.main-container{
    display:flex;
    justify-content:center;
    align-items:center;
    min-height:90vh;
}

.box{
    width:450px;
    padding:30px;
    border-radius:20px;
    background:rgba(255,255,255,0.1);
    backdrop-filter:blur(20px);
    text-align:center;
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

.success{
    color:lightgreen;
    font-weight:bold;
}

.error{
    color:#ffb3b3;
    font-weight:bold;
}

.btn-back{
    margin-top:20px;
    display:inline-block;
    color:white;
    text-decoration:none;
    font-weight:bold;
}

.btn-back:hover{
    text-decoration:underline;
}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

    <a class="navbar-brand" href="index.php">
        Skill Linker
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">

        <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse justify-content-end" id="nav">

        <ul class="navbar-nav align-items-center">

            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>

            <li class="nav-item dropdown">

                <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">
                    Login
                </a>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li><a class="dropdown-item" href="log_in_learner.html">Login as Learner</a></li>
                    <li><a class="dropdown-item" href="log_in_provider.html">Login as Provider</a></li>

                </ul>

            </li>

            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>

        </ul>

    </div>

</div>

</nav>

<!-- CONTENT -->
<div class="main-container">

<div class="box">

<?php if ($success): ?>

    <h2 class="success">✅ Learner Registered Successfully!</h2>

<?php else: ?>

    <h2 class="error">❌ Registration Failed!</h2>
    <p class="error"><?php echo $stmt->error; ?></p>

<?php endif; ?>

<a href="log_in_learner.html" class="btn-back">⬅ Go to Login</a>
<br>
<a href="index.php" class="btn-back">🏠 Back to Home</a>

</div>

</div>

<!-- BOOTSTRAP JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>