<!DOCTYPE html>
<html lang="en">

<head>
    <title>Lab 07: Basic SQL</title>
    <meta charset='utf-8' />
</head>

<body>
  <h1>Lab 07</h1>
  <form action="sql.php" method="POST">
    DATABASE:
    <input type="text" name="db"/>
    <br>
    <br>
    SQL QUERY:
    <input type="text" name="query"/>
    <br>
    <br>
    <input type="submit" />
  </form>
  <h1>Results</h1>
  <?php
  if(isset($_POST['db']) and $_POST['db'] != "" and isset($_POST['query']) and $_POST['query'] != ""){
    try{
      $db = new PDO("mysql:dbname={$_POST['db']};port=3306", "root", "root");
      echo "Connected!";
      $rows = $db->query($_POST['query']);
    } catch(PDOException $error){
      echo $error->getMessage();
    }
    ?>
    <ul>
    <?php
    foreach($rows as $row){
    ?>
      <li>
        <?= print_r($row) ?>
      </li>
    <?php
      }
    ?>
    </ul>
  <?php
  }
  ?>
</body>

</html>
