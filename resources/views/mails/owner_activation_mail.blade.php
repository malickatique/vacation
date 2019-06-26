<h1>Hi, {{ $name }}</h1>
<p>You have been requested to become an owner on our site, Your credential has been generated successfully.</p>

<p>Here is following detail:</p>
<ul>
    <li>Email: {{ $email }}</li>
    <li>Password: {{ $password }}</li>
</ul>

<p>You can change your password in future.</p>
<p>Before login, you account must be activate, Here is link below to complete your profile and activate current account</p>
<a href="{{ url('/owner/completeprofile') }}/{{$id}}">Activate Profile</a>
<h4>Regard's</h4>
<p>OVR Team</p>
<p>www.ovr.com</p>
