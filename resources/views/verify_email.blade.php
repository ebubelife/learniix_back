<!DOCTYPE html>
<html>
<head>
	<title>Email Verification</title>
</head>
<body>
	<div style="padding:10px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;  border-radius:20px; font-size:16px;">
	<img src="https://www.zenithstake.com/images/logo.png" alt="logo" height="80" width="270" />


	<p style="color:#696969; font-size:21px;">Hi  {{ $firstName }}, </h3>
	<p style="margin-top:20px; color:#696969;">Your account has been successfully created. Please use the code below to verify your email</p>

		<h3 style="color:#5B2C6F;">{{ $emailCode }}</h3>

	<p style="margin-top:20px; color:red">If you are receiving this email in error, please disregard it</p>

	<p style="margin-top:20px; color:#B2BEB5">© zenithstake.com 2023</p>

</div>
</body>
</html>