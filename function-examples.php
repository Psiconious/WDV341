<?php
$departmentName = "DMACC Mailing Department";	//global scope variable

$name1 = "Jane";		//global scope variable
$name2 = "Smith";		//global scope variable

//Define the function.  THis is the code that will run when the function is called.  No parameters/arguments
function printDepartment()
{
	global $departmentName;	//tells the function to use the global scope version of this variable
	echo $departmentName;
}


//Define the function.  Note this function expects one piece of information to be sent to it.  The local variable $inName will contain the
// value that is passed into the function when the function is called. 
function printName($inName)
{
	echo $inName;	//NOTE $inName is a Local scopre variable defined within this function.  It is gone when the function ends
}

//This function has two parameters/arguments.  It expects two pieces of information to be passed to when it is called.  The first piece of information
//will be stored in the local variable $inFirstName and the second piece of information will be stored in the $inLastName.  The order of the pieces of 
//information will determine where the value is stored. 
function printFullName($inFirstName, $inLastName)
{
	echo $inFirstName . " " . $inLastName;
}


function printNameListing($inFirstName, $inLastName)
{
	echo $inLastName . ", " . $inFirstName;
}

function characterCount($inString)
{
	return 	strlen($inString);	//Provides the number of characters in the input string
}

function todaysDate()
{
	$mydate = getdate(date("U"));
	return date('l F, d Y');	//Should format the output as Monday January 1, 2016
}


?>
<!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>WDV341 Intro PHP Function Examples</title>
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        *,:after,:before{-moz-box-sizing:border-box;-webkit-box-sizing:border-box;box-sizing:border-box}body{font:normal 15px/25px 'Open Sans',Arial,Helvetica,sans-serif;color:#444;text-align:left}h1,h2,h3{font-weight:400}h1{font:normal 40px/120px 'Open Sans',Arial,Helvetica,sans-serif;text-align:center;color:#444;margin:0}h1 span{color:#484c9b}h2{font-size:25px;line-height:30px;color:#484c9b;margin:50px 0 10px}h3{font-size:18px;line-height:35px;margin:50px 0 0}a{color:#484c9b;text-decoration:none}a:focus,a:hover{text-decoration:underline}p{margin:0 0 2rem}p span{color:#aaa}header{width:98%;margin:40px auto 0;border-bottom:1px solid #ddd;padding-bottom:40px;text-align:center}header p{margin:0}section{width:95%;max-width:910px;margin:40px auto}pre{background:#f9f9f9;padding:10px;font-size:12px;border:1px solid #eee;white-space:pre-wrap;border-radius:10px}table{border:1px solid #eee;background:#f9f9f9;width:100%;border-collapse:collapse;border-spacing:0;margin-bottom:3rem}thead{background:#5965af;color:#fff}tbody tr td,thead td{padding:.5rem .75rem}tbody tr:nth-child(even){background:#efefef}tbody tr td:first-child{padding-left:1.25rem}tbody tr td:first-child,tbody tr td:nth-child(3),thead td:first-child,thead td:nth-child(3){width:15%}tbody tr td:nth-child(2),thead td:nth-child(2){width:20%}tbody tr td:last-child,thead td:last-child{width:50%}@media only screen and (min-width:768px){body{font-size:20px;line-height:30px}h2{font-size:30px;line-height:45px}h3{font-size:22px;line-height:45px;margin-top:50px}p{margin-bottom:2rem}h1{font-size:60px}pre{padding:20px;font-size:15px}}
    </style>
</head>

<body>
	<header>
		<h1>WDV341 Intro <span>PHP</span></h1>
		<p>PHP Functions - Example Code</p>
	</header>
	<section>
		<h2>Example Letter 1</h2>
		<p>Dear <?php printFullName("Mary", "Smith"); //Calling or activating the function ?> </p>
		<p>Please send us your address so that we may mail you your degree award. </p>
		<p>Thank You</p>

		<p><?php printDepartment() ?></p>
		<h2>Example Letter 2</h2>
		<p>Dear <?php printFullName("Anderson", "Mike"); //Note PHP takes the information in the order YOU provide. It does not try to fix your mistake. ?> </p>
		<p>Please send us your address so that we may mail you your degree award. </p>
		<p>Thank You</p>

		<p><?php printDepartment() ?></p>
		<h2>Example Letter 3</h2>
		<p>Dear <?php printFullName($name1, $name2); //You can pass the value of a variable as well.  The value stored in the variable is sent to the function ?> </p>
		<p>Please send us your address so that we may mail you your degree award. </p>
		<p>Thank You</p>

		<p><?php printDepartment() ?></p>
		<h2>Example Letter 4</h2>
		<p><?php printDepartment() ?></p>
		<p>The following people have been contacted.</p>
		<p><?php echo printNameListing("Mary", "Smith"); ?></p>
		<p><?php echo printNameListing("Mike", "Anderson"); ?></p>
		<p><?php echo printNameListing($name1, $name2); ?></p>
		<p>Thank You</p>

		<h2>String functions Example </h2>
		<p>The Department name <strong><?php printDepartment(); ?></strong> has <?php echo characterCount($departmentName); ?> characters.
		<h2>Date functions Example </h2>
		<p>Today is: <?php echo getdate(); ?></p>
		<p>Today is: <pre><?php print_r(getdate()); ?></pre></p>
		<p>Today is: <?php echo todaysDate(); ?></p>
	</section>
</body>

</html>