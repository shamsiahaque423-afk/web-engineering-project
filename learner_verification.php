<?php
$conn = new mysqli("localhost","root","","skilllinker");
if($conn->connect_error){ die("DB Error"); }
?>

<!DOCTYPE html>
<html>
<head>
<title>Learner Verification</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#0f172a;
    color:white;
    font-family:Segoe UI;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.box{
    width:360px;
    padding:25px;
    background:rgba(255,255,255,0.1);
    border-radius:15px;
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

h3{
    text-align:center;
    font-weight:bold;
    margin-bottom:15px;
}
</style>
</head>

<body>

<div class="box">

<h3>👨‍🎓 Learner Verification</h3>

<!-- FORM -->
<form method="POST">

<label>Enter learner_id</label>
<input type="number"
       name="learner_id"
       class="form-control mt-2"
       placeholder="Enter learner_id"
       required>

<button class="btn btn-primary w-100 mt-3" name="login">
Verify
</button>

</form>

<?php
if(isset($_POST['login'])){

    $learner_id = $_POST['learner_id'];

    // ✅ CHECK DATABASE
    $stmt = $conn->prepare("SELECT learner_id FROM learners WHERE learner_id = ?");
    $stmt->bind_param("i", $learner_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result && $result->num_rows == 1){

        // ✅ SUCCESS → GO TO OPTIONS PAGE
        header("Location: learner_options.php?learner_id=$learner_id");
        exit();

    } else {

        // ❌ ERROR
        echo "<p class='text-danger mt-3 text-center'>
                Invalid learner_id. Not found in database.
              </p>";
    }
}
?>

</div>

</body>
</html></html>