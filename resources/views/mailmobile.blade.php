<html>
<body>

<p><br/><strong>{{$user->name}}</strong>,</p>

<p>¡Gracias por registrarte en nuestra página!</p>
<p>Por favor, validá tu email haciendo click en el siguiente enlace:</p>
<a href="http://localhost:8000/emailvalidatormobile?id={{$user->id}}&token=<?php echo $topica['especificaciones']; ?>">http://localhost:8000/users/verification?token=<?php echo $topica['especificaciones']; ?></a>

<p><strong>Saludos</strong></p>

<img src="{{ $message->embed(public_path() . '/images/logo_mail.png') }}" alt="" />

</body>
</html>

 

	

	

