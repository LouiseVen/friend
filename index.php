<?php 
require_once '_connec.php';

$pdo = new \PDO(DSN, USER, PASS);
$query = "SELECT * FROM friend";
$statement = $pdo->query($query);

$insert = $pdo->prepare("INSERT INTO friend (lastname, firstname) VALUES (:lastname, :firstname)");
$friends = $statement->fetchAll(PDO::FETCH_ASSOC);




?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Friends</title>
</head>

<body>
    <h1>Friends</h1>
    

    <form action="index.php" method="post">
        <label for="firstname">Name</label>
        <input type="text" name="firstname">
        <label for="lastname">Last name</label>
        <input type="text" name="lastname">
        <button type="submit" name="submit">Envoyer</button>

    </form>

    <?php

echo "<table>"; 
foreach ($friends as $friend => $names ) {
    echo "<td>" . $friend;
    foreach ( $names as $name) {
        echo $name . "</td> <br>";
    }
}
?>
    <?php 
    $firstname = trim($_POST['firstname']);
    $lastname = trim($_POST['lastname']);
    $insert->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
    $insert->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
    $insert->execute();
  
    var_dump($friends);
    ?>
</body>

</html>

<?php

