<?php
$learner_id = $_GET['learner_id'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
<title>Learner Options</title>

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

/* CARD BOX */
.box{
    width:420px;
    padding:30px;
    background:rgba(255,255,255,0.1);
    border-radius:15px;
    text-align:center;
    box-shadow:0 0 20px rgba(0,0,0,0.4);
}

/* TITLE */
h2{
    font-weight:800;
    margin-bottom:20px;
}

/* BUTTONS */
.btn-option{
    width:100%;
    margin-top:15px;
    padding:12px;
    font-size:16px;
    font-weight:bold;
    border-radius:10px;
}
</style>
</head>

<body>

<div class="box">

<h2>👨‍🎓 Learner Dashboard</h2>

<p>Logged in ID: <b><?php echo $learner_id; ?></b></p>

<!-- OPTION 1 -->
<a href="learner_search.php?learner_id=<?php echo $learner_id; ?>"
   class="btn btn-primary btn-option">
   🔍 Search for Learners
</a>

<!-- OPTION 2 -->
<a href="learner_view.php?learner_id=<?php echo $learner_id; ?>"
   class="btn btn-success btn-option">
   👁 View Learners
</a>

</div>

</body>
</html>