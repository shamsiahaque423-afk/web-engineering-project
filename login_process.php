<?php

$conn = new mysqli("localhost", "root", "", "skilllinker");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
$success = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $user_id = $_POST["user_id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = $_POST["role"];

    if (empty($name) || empty($email) || empty($password) || empty($role)) {
        $message = "❌ Please fill all fields!";
    } else {

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (user_id, name, email, password, role) VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("issss", $user_id, $name, $email, $hashed_password, $role);

        if ($stmt->execute()) {
            $message = "✅ Account Created Successfully!";
            $success = true;
        } else {
            $message = "❌ Error: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
<title>Result</title>

<style>
body{
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
    background:linear-gradient(135deg,#1e3a8a,#7f1d1d);
    color:white;
    font-family:Segoe UI;
}

.box{
    text-align:center;
    padding:40px;
    background:rgba(255,255,255,0.1);
    border-radius:20px;
}

a{
    display:inline-block;
    margin-top:15px;
    padding:10px 20px;
    background:#3b82f6;
    color:white;
    text-decoration:none;
    border-radius:10px;
    margin-right:10px;
}

a:hover{
    background:#2563eb;
}
</style>

</head>

<body>

<div class="box">

<h2><?php echo $message; ?></h2>

<?php if ($success) { ?>

    <h3>Select Login Type</h3>

    <a href="learner_form.php?role=learner">👨‍🎓 Login as Learner</a>
    <a href="provider_form.php?role=provider">🧑‍🏫 Login as Provider</a>

<?php } else { ?>

    <a href="#" onclick="history.back()">⬅ Go Back</a>

<?php } ?>

</div>

</body>
</html>