<!DOCTYPE html>
<html>
<head>
	<title>Fetch Full Address from Area PIN Code</title>
</head>
<body>
	<h1>Fetch Full Address from Area PIN Code</h1>

	<form method="post">
		<label>Enter Area PIN Code:</label>
		<input type="text" name="pincode">
		<button type="submit" name="submit">Submit</button>
	</form>

	<?php
		if(isset($_POST['submit'])) {
			$pincode = $_POST['pincode'];
			$url = "https://api.postalpincode.in/pincode/".$pincode;

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			curl_close($ch);

			$data = json_decode($result);

			if($data[0]->Status == "Success") {
				echo "<h2>Full Address:</h2>";
				echo "<p>".$data[0]->PostOffice[0]->Name.", ".$data[0]->PostOffice[0]->District.", ".$data[0]->PostOffice[0]->State.", ".$data[0]->PostOffice[0]->Pincode."</p>";
			} else {
				echo "<p>No Results Found.</p>";
			}
		}
	?>

</body>
</html>
