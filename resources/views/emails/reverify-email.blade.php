<h1>Confirm Your Email Address, {{ $user->name }}</h1>

<p>We received a request to reconfirm your email address for your account.</p>
<p>To complete the email verification process, please click the button below:</p>

<div style="margin-top: 40px; border: 1px solid #3333; padding: 10px 24px; border-radius: 10px; background-color: #00f;  text-align: center;">
    <a href={{ $verficationURL }} style="color: #fff; font-size: 30px;">Verify Email Address</a>
</div>
