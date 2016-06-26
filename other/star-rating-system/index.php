<html>
<head>
	<title>5 Star Rating System In PHP, MySql & jQuery</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<input type="hidden" value="HERE COME THE PRODUCT ID" id="product_id">
	<div class="container">
		<h1>Star Rating System</h1>
		<br>
		<p>Staring Rating System <a href="http://blog.hackerkernel.com/2015/11/01/star-rating-system-in-php-mysql-jquery/">Tutorial link</a> For more Tutorial <a href="http://blog.hackerkernel.com">HackerKernel.com</a>, Want Me to Work on Your Dream Project <a href="http://hackerkernel.com/contact.php">Hire Me</a></p>
		<br>
		<br>
		<div id="star-container">
			<i class="fa fa-star star" id="star-1"></i>
			<i class="fa fa-star star" id="star-2"></i>
			<i class="fa fa-star star" id="star-3"></i>
			<i class="fa fa-star star" id="star-4"></i>
			<i class="fa fa-star star" id="star-5"></i>
		</div>
		<div id="result"></div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script type="text/javascript" src="main.js"></script>
</body>
</html>