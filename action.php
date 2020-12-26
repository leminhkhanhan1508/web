<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>SQL Injection form error example</title>
 <meta name="description" content="Twitter Bootstrap Version2.0 form error example from w3resource.com."> <link href="http://localhost/twitter-bootstrap/twitter-bootstrap-v2/docs/assets/css/bootstrap.css" rel="stylesheet">
 </head>
 <body style="margin-top: 50px">
 <div class="container">
 <div class="row">
 <div class="span6">
 <?php $host="localhost";
 $username="root";
 $password="";
 $db_name="mydb_demo";
 class DB
 {
     private static $instance = NULl;
     public static function getInstance() {
       if (!isset(self::$instance)) {
         try {
           self::$instance = new PDO('mysql:host=localhost;dbname=mydb_demo', 'root', '');
           self::$instance->exec("SET NAMES 'utf8'");
         } catch (PDOException $ex) {
           die($ex->getMessage());
         }
       }
       return self::$instance;
     }
 }

 $db = DB::getInstance();


//  $con=mySQL_connect("$host", "$username", "$password")or 
// die("cannot connect"); 
// mySQL_select_db("$db_name")or
//  die("cannot select DB");
$uid = $_POST['uid'];
$pid = $_POST['passid'];// everything'or '1'='1 
// $SQL = "select * from user_details where userid = '$uid' and password = '$pid' ";
// echo $SQL;
// $result = $db->query($SQL);
// $db->query($SQL);
$result = $db->prepare('SELECT * FROM user_details WHERE userid = :id and password=:pass');
$result->execute(array('id' => $uid, 'pass' => $pid));

$item = $result->fetchAll();

if($item)
{
    for($i=0; $i<sizeof($item); $i++){
        echo '<h4>' . '-- Personal Information -- '. $item[$i][2]. " " . $item[$i][3] . "</h4>". "</br>";
        echo "<p>".   "User ID : ".  $item[$i][0]."   </p>";
        echo "<p>".
        "Password : ".
        $item[$i][1]."</p>";
        echo "<p>".
        "First Name : ".
        $item[$i][2]." Last Name : ".
        $item[$i][3]."</p>";
        echo "<p>".
        "Gender : ".
        $item[$i][4]." 
        Date of Birth :".
        $item[$i][5]."</p>
        ";echo "
        <p>".
        "Country : ".
        $item[$i][6]." 
        User rating : ".$item[$i][7].
        "</p>
        ";
        echo "<p>
        "."Email ID : ".
        $item[$i][8].
        "</p>
        ";
echo "--------------------------------------------";
    }

}
else 
{
  echo "<p>";
  echo "sai userid hoặc password rồi ";}
?>
</div>
</div>
</div>
</body>
</html>