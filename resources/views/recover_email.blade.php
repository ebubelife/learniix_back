<!DOCTYPE html>
<html>
<head>
	<title>Account Recovery</title>
</head>
<body>
	<div style="padding:10px; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;  border-radius:20px; font-size:16px;">
	<div style="width:100%;padding-top:10px; padding-bottom:10px; background-color:#E5E4E2; text-align:center">
	<img src="https://www.zenithstake.com/images/logo.png" alt="logo" height="80" width="270" style="display:inline-block" />

</div>

	<p style="color:#696969; font-size:21px;">Hi  {{ $firstName }}, </h3>
	<p style="margin-top:20px; color:#696969;">You requested a password reset, please copy your account recovery code below</p>

		<h3 style="color:#5B2C6F;">{{ $emailCode }}</h3>

	<p style="margin-top:20px; color:red">If you're not the one who made this request and you're not aware of it, disregard this message.</p>

	<div style="width:100%;padding-top:10px; padding-bottom:10px; background-color:#E5E4E2; text-align:center">
	<p style="margin-top:20px; color:#000000; display:inline-block;"> zenithstake.com © 2023</p>
</div>

</div>
</body>
</html>