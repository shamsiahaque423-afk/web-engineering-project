<?php
$conn = new mysqli("localhost", "root", "", "skilllinker");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$provider_id = $_POST['provider_id'];
$email = $_POST['email'];
$skill_name = $_POST['skill_name'];
$experience = $_POST['experience'];
$password = $_POST['password'];

if (empty($email) || empty($skill_name) || empty($experience) || empty($password)) {
    die("❌ Please fill all required fields!");
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO providers (provider_id, email, skill_name, experience, password)
        VALUES (?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("❌ Prepare failed: " . $conn->error);
}

$stmt->bind_param("issss", $provider_id, $email, $skill_name, $experience, $hashed_password);

$success = $stmt->execute();
?>

<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Provider Registration</title>

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

/* MAIN CENTER */
.main-container{
  display:flex;
  justify-content:center;
  align-items:center;
  min-height:90vh;
  padding:20px;
}

/* BOX */
.container-box{
  text-align:center;
  padding:40px;
  width:500px;
  background:rgba(255,255,255,0.1);
  border-radius:20px;
  backdrop-filter:blur(15px);
  box-shadow:0 0 20px rgba(0,0,0,0.4);
}

/* SUCCESS / ERROR */
.success{
  color:lightgreen;
  font-weight:bold;
}

.error{
  color:#ffb3b3;
  font-weight:bold;
}

/* BUTTON */
.btn-back{
  margin-top:20px;
  display:inline-block;
  padding:10px 20px;
  border-radius:10px;
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

                    <li>
                        <a class="dropdown-item" href="log_in_learner.html">
                            Login as Learner
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="log_in_provider.html">
                            Login as Provider
                        </a>
                    </li>

                </ul>

            </li>

            <li class="nav-item">
                <a class="nav-link" href="dashboard.php">Dashboard</a>
            </li>

        </ul>

    </div>

</div>

</nav>

<!-- RESULT -->
<div class="main-container">

<div class="container-box">

<?php if ($success): ?>

    <h2 class="success">✅ Provider Registered Successfully!</h2>

<?php else: ?>

    <h2 class="error">❌ Registration Failed!</h2>
    <p class="error"><?php echo $stmt->error; ?></p>

<?php endif; ?>

<br>

<a href="log_in_provider.html" class="btn btn-light btn-back">
⬅ Go to Login
</a>

<br><br>

<a href="index.php" class="btn btn-outline-light btn-back">
🏠 Back to Home
</a>

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