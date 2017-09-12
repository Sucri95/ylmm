<html>
<body>

<p><br/><strong>{{$user->name}}</strong>,</p>

<p>¡{{$admin}}, te ha invitado a formar parte de su banda!</p>
<p>Hacé click en el siguiente enlace si querés aceptar la invitación:</p>
<a href="http://localhost:8000/membersvalidationmobile?id={{$user->id}}&idband={{$band}}&role={{$role}}&token={{$topica['especificaciones']}}">http://localhost:8000/membersvalidation?token=<?php echo $topica['especificaciones']; ?></a>

<p><strong>Saludos</strong></p>

<img src="{{ $message->embed(public_path() . '/images/logo_mail.png') }}" alt="" />

</body>
</html>

 

	

	

