<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WDV101 Basic Form Handler Example</title>
</head>

<body>
<?php
	echo "<p>Dear $_POST[first_name],</p>";
	echo "<p>Thank you for your interest in DMACC.</p>";
	echo "<p>We have you listed as an $_POST[standing] starting this fall</p>";
	echo "<p>You have declared $_POST[program] as your major.</P>";
	echo "<p>Based upon your responses we will provide the following information in our confirmation email to you at $_POST[email].</p>";
	echo "<p>Information about the selected program: $_POST[program_info]</p>";
	echo "<p>Contact program advisor: $_POST[contact_advisor]</p>";
	echo "<p>You have shared the follow comment which we will review</p>";
	echo "<p>$_POST[comments]</p>";
?>

<?php
	echo "<table border='1'>";
	echo "<tr><th>Field Name</th><th>Value of Field</th></tr>";
	foreach($_POST as $key => $value)
	{
		echo '<tr>';
		echo '<td>',$key,'</td>';
		echo '<td>',$value,'</td>';
		echo "</tr>";
	} 
	echo "</table>";
	echo "<p>&nbsp;</p>";

?>

</body>
</html>
