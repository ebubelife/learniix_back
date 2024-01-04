<!DOCTYPE html>
<html>
<head>
	<title>Access Course</title>
</head>
<body>
	<div style="padding:10px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;  border-radius:20px; font-size:16px;">
    <div style="width:100%;padding-top:10px; padding-bottom:10px; background-color:#E5E4E2; text-align:center">
	<img src="https://learniix.com/images/logo.jpeg" alt="logo" height="80" width="270" style="display:inline-block" />

</div>


	<p style="color:#696969; font-size:21px;">Hi  {{ $customerName }}, </h3>
	<p style="margin-top:20px; color:#696969;">You have successfully purchased the <b>{{ $productName }}</b>  </p>

    	<p style="margin-top:20px; color:#696969;">Click the link below to access the product </p>


	<br>

	<a href="{{ $productTYLink }}" style="background-color: #FFA500; color: black; padding: 10px 20px; border-radius: 5px; text-decoration: none; box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);">
 Access this product
</a>

<br>

	<p style="margin-top:20px; color:#B2BEB5">© Learniix.com © 2024</p>

</div>
</body>
</html>