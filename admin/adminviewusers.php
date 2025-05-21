<?php
include '../dbconnect.php';

$db = new PDO('mysql:host=localhost;dbname=travelscapes', 'root', 'admin');


$sql = 'SELECT * FROM login';
$stmt = $db->prepare($sql);
$stmt->execute();
$results = $stmt->fetchAll();

// Close the database connection
$db = null;
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="../css/adminviewusers.css">
<title>View User</title>
<link rel="icon" type="image/png" href="../images/favicon.png">
</head>
<body>

<h1>User Database</h1>

<table>
  <thead>
    <tr>
      <th>User ID</th>
      <th>User Email</th>
      <th>User UID</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $serialNumber = 1; 
    foreach ($results as $row):
    ?>
    <tr>
      <td><?php echo $serialNumber; ?></td>
      <td><?php echo $row['usersEmail']; ?></td>
      <td><?php echo $row['usersuid']; ?></td>
    </tr>
    <?php
    $serialNumber++; 
    endforeach;
    ?>
  </tbody>
</table>

</body>
</html>
