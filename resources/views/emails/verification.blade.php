<h1>Welcome {{ $user->name }} to our website</h1>

<p>You have successfully registered to our platform,</p>
<p>Please click the link below to complete your regitration</p>

<div style="margin-top: 40px; border: 1px solid #3333; padding: 10px 24px; border-radius: 10px; background-color: #00f;  text-align: center;">
    <a href={{ $verficationURL }} style="color: #fff; font-size: 30px;">Confirm Registration</a>
</div>
