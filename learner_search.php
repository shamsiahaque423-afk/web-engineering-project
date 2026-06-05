<?php
$conn = new mysqli("localhost","root","","skilllinker");
$learner_id = $_GET['learner_id'] ?? null;
?>

<!DOCTYPE html>
<html>
<head>
<title>Search Learners</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
    background:#111827;
    color:white;
    font-family:Segoe UI;
}
.box{
    margin-top:20px;
    background:rgba(255,255,255,0.1);
    padding:20px;
    border-radius:10px;
}
</style>
</head>

<body class="container mt-4">

<h3>🔍 Search Learners</h3>

<a href="learner_options.php?learner_id=<?php echo $learner_id; ?>" class="btn btn-light btn-sm">⬅ Back</a>

<form method="GET" class="mt-3">
<input type="hidden" name="learner_id" value="<?php echo $learner_id; ?>">

<input type="text" name="search" class="form-control" placeholder="Search learners">
<button class="btn btn-primary mt-2">Search</button>
</form>

<div class="box">

<?php
if(isset($_GET['search'])){
    $s = $_GET['search'];

    $stmt = $conn->prepare("SELECT * FROM learners WHERE learner_id LIKE ? OR name LIKE ?");
    $like = "%$s%";
    $stmt->bind_param("ss",$like,$like);
    $stmt->execute();
    $res = $stmt->get_result();
} else {
    $res = $conn->query("SELECT * FROM learners");
}

while($row = $res->fetch_assoc()){
    echo "
    <p>
    <b>ID:</b> {$row['learner_id']} <br>
    <b>Name:</b> {$row['name']} <br>
    <b>Email:</b> {$row['email']}
    </p><hr>
    ";
}
?>

</div>

</body>
</html>