<!DOCTYPE html>
<html>
<head>
	<title>Hurray! 🎉🥳 A new sale!</title>
</head>
<body>
	<div style="padding:10px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;  border-radius:20px; font-size:16px;">
	
	<div style="width:100%;padding-top:10px; padding-bottom:10px; background-color:#E5E4E2; text-align:center">
	<img src="https://learniix.com/images/logo.jpeg" alt="logo" height="80" width="270" style="display:inline-block" />

</div>


	<p style="color:#000000; font-size:20px;font-weight:bold; ">Congrats  {{ $firstName }}, </h3>
	<p style="margin-top:20px; color:#696969;">You have just recorded a successful sale <span style="font-weight:bold; color:#000000;">{{ $productName }}</span></p>



    <p style="margin-top:12px; color:#000000;">Product Price :  ${{ $productPrice }}</p>

    <p style="margin-top:12px; color:#0000000;">Commission earned:   ${{ $commission }} </p>

	<p>Customer Name: {{ $customer_name }}</p>

	<p style="margin-top:20px; color:#696969;">Keep selling, keep earning!</p>

	<p style="margin-top:20px; color:#696969;">- From learniix</p>

	


		
	<div style="width:100%;padding-top:10px; padding-bottom:10px; background-color:#E5E4E2; text-align:center">
	<p style="margin-top:20px; color:#000000; display:inline-block;"> learniix.com © 2024</p>
</div>
	

</div>
</body>
</html>