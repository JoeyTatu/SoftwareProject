<?php>
    $servername = getenv('IP');
    $username = getenv('C9_USER');
    $password = "";
    $database = "c9";
    $dbport = 3306;

    // Create connection
    $db = new mysqli($servername, $username, $password, $database, $dbport);
    // Check connection
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
$event_id   = mysql_real_escape_string($_POST['event_id']);
$event_name = mysql_real_escape_string($_POST['event_name']);
$amount     = mysql_real_escape_string($_POST['amount']);


$query  = "SELECT * FROM Event WHERE event_id = '$event_id' LIMIT 1";
$result = mysql_query($query) or die(mysql_error());

while($row = mysql_fetch_assoc($result)) {
    $event_name = $row['event_name'];
    $event_amount = $row['event_amount'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Booking</title>
</head>
<body><form target="paypal" action="https://www.paypal.com/cgi-bin/webscr" method="post">

  <!-- Identify your business so that you can collect the payments.-->
  <input type="hidden" name="business" value="kin@kinskards.com">

  <!-- Specify a PayPal Shopping Cart Add to Cart button. -->
  <input type="hidden" name="cmd" value="_cart">
  <input type="hidden" name="add" value="1">

  <!-- Specify details about the item that buyers will purchase. -->
  <!-- from form/php -->
  <p>
       <label for="item_name">Event Name*</label>
       <input type="text" id="item_name" name="item_name" value="Disco Night" required>
  </p>
  <p>
      <label for="amount">Amount*</label>
      <input type="number" min="1" step="any" id="amount" name="amount" value="4.95" required> 
  </p>
  <input type="hidden" name="currency_code" value="USD">

  <!-- Display the payment button. -->
  <input type="image" name="submit"
    src="https://www.paypalobjects.com/webstatic/en_US/i/btn/png/btn_addtocart_120x26.png"
    alt="Add to Cart">
  <img alt="" width="1" height="1"
    src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif">
</form>
</html>