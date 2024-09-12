<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
</head>

<body>
    <p>Hello {{ $user->name }},</p>
    <p>Your OTP for email verification is: <strong>{{ $otp }}</strong></p>
    <p>This OTP is valid until: {{ $otpExpiry }}</p>
    <p>Click the button below to verify your email address:</p>
    <a href="{{ url('/verif') }}" target="_blank"
        style="padding: 10px 20px; background-color: #007bff; color: #ffffff; text-decoration: none; border-radius: 5px;">Verify
        Email</a>
    <br><br>
    <p>If you did not create an account, no further action is required.</p>
    <p>Regards,<br>Your Application Team</p>
</body>

</html>
