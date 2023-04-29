<!DOCTYPE html>
<html>
<head>
	<title>Account Recovery</title>
</head>
<body>
	<div style="padding:10px; border:1px solid #cccccc; text-align:center; border-radius:20px; font-size:16px;">
	<img src="https://www.zenithstake.com/images/logo.png" alt="logo" height="80" width="270" />


	<p style="color:#696969; text-size:21px;">Hi  {{ $firstName }}, </h3>
	<p style="margin-top:20px; color:#696969;">You requested a password reset, please copy your account recovery code below</p>

		<h3 style="color:#5B2C6F;">{{ $emailCode }}</h3>

	<p style="margin-top:20px; color:red">If you're not the one who made this request and you're not aware of it, disregard this message.</p>

	<p style="margin-top:20px; color:#B2BEB5">© zenithstake.com 2023</p>

</div>
</body>
</html>