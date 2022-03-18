<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
 <?php echo '<p>Hello World</p>'; ?> 
 <?php
header("Content-Type:application/json");
echo $_SERVER['HTTP_USER_AGENT'];
$servername = "137.184.195.46:3306";
$username = "finance_user";
$password = "13376XENQog682JZQX6TxpQpcoxWN";
$database = 'finance';

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

if (isset($_GET['date']) && $_GET['date']!="") {
	class Filters
{
    public $name;
    public $ticker;
    public $date;
    public $high;
    public $low;
    public $close;
}
	$data_array = array();
	$date = $_GET['date'];
	echo $date;
	$result = mysqli_query(
	$conn,
	"SELECT * FROM companies JOIN historical ON companies.company_id = historical.company_id WHERE historical.d='$date'");
	if(mysqli_num_rows($result)>0){
	while($row =mysqli_fetch_assoc($result))
		{
			$data = new Filters;
			$data->name = $row['name'];
			$data->name = $row['ticker'];
			$data->high = $row['high'];
			$data->low = $row['low'];
			$data->close = $row['close'];
			$data_array($data, 2);
		}
		echo $data_array();

	// $company_name = $row['name'];
	// $ticker = $row['ticker'];
	// $date = $row['d'];
	// $hp = $row['high'];
	// $lp = $row['low'];
	// $cp = $row['close'];
	// echo json_encode($data_array);

	
	response($company_name, $ticker, $date, $hp, $lp, $cp);
	mysqli_close($conn);
	}else{
		response(NULL, NULL, NULL, NULL, NULL, NULL, 200,"No Record Found");
		}
}else{
	response(NULL, NULL, NULL, NULL, NULL, NULL, NULL, 400,"Invalid Request");
	}

function response($company_name, $ticker, $date, $hp, $lp, $cp){
	$response['company_name'] = $company_name;
	$response['ticker'] = $ticker;
	$response['date'] = $date;
	$response['hp'] = $hp;
	$response['lp'] = $lp;
	$response['cp'] = $cp;


	
	$json_response = json_encode($response);
	echo $json_response;
}

?>
 </body>
</html> -->