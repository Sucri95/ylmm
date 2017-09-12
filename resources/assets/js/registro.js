var frmWorking = false;
var usuarioTipo = '';
var nombre = '';
var provincia = '';
var email = '';
var clave1 = '';
var clave2 = '';

function onFrm()
{
	if(!frmWorking)
	{
		frmWorking = true;
		
		if(validateFrm())
		{
			sendFrm();
		}
		else
		{
			frmWorking = false;
		}
	}
}

function setUserTipo(tipo)
{
	usuarioTipo = tipo;
	
	$('.check.persona').css('background-color', '#FFF');
	$('.check.banda').css('background-color', '#FFF');
	
	$('.check.'+tipo).css('background-color', '#42F44E');
}

function printError(obj)
{
	$(obj).css('background-color', '#F00');
}

function clearError(obj)
{
	$(obj).css('background-color', '#FFF');
}

function isEmail(email)
{
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function validateFrm()
{
	nombre = $('.input.nombre').val();
	provincia = $('.select.provincia').val();
	email = $('.input.mail').val();
	clave1 = $('.input.clave1').val();
	clave2 = $('.input.clave2').val();
	
	var frmOk = true;
	
	if(usuarioTipo == '')
	{
		printError('.check.persona');
		printError('.check.banda');
		frmOk = false;
	}
	else
	{
		clearError('.check.persona');
		clearError('.check.banda');
	}
	
	if(nombre == '')
	{
		printError('.input.nombre');
		frmOk = false;
	}
	else
	{
		clearError('.input.nombre');
	}
	
	if(provincia == '0')
	{
		printError('.select.provincia');
		frmOk = false;
	}
	else
	{
		clearError('.select.provincia');
	}
	
	if(!isEmail(email))
	{
		printError('.input.mail');
		frmOk = false;
	}
	else
	{
		clearError('.input.mail');
	}
	
	var claveStatus = 0;
	
	if(clave1 == '')
	{
		printError('.input.clave1');
		frmOk = false;
	}
	else
	{
		clearError('.input.clave1');
		claveStatus++;
	}
	
	if(clave2 == '')
	{
		printError('.input.clave2');
		frmOk = false;
	}
	else
	{
		clearError('.input.clave2');
		claveStatus++;
	}
	
	if(claveStatus==2)
	{
		if(clave1 != clave2)
		{
			printError('.input.clave1');
			printError('.input.clave2');
			frmOk = false;
		}
		else
		{
			clearError('.input.clave1');
			clearError('.input.clave2');
		}
	}
	
	return frmOk;
}

function sendFrm()
{
	$.ajax({
		url: 'services/registro_web.php',
		type: 'POST',
		data: 'nombre='+nombre+'&provincia='+provincia+'&email='+email+'&clave='+clave1+'&tipo='+usuarioTipo,
		success: function (response) {
			if(response == '0')
			{
				alert('El mail ingresado ya se encuentra registrado');
				frmWorking = false;
			}
			else
			{
				localStorage.setItem('uid', response);
				localStorage.setItem('utipo', usuarioTipo);
				localStorage.setItem('unombre', nombre);
				localStorage.setItem('ufoto', '');
				
				if(usuarioTipo == 'persona')
				{
					location.assign('home_usuario.php');
				}
				else
				{
					location.assign('home_banda.php');
				}
			}
		},
		error: function () {
			alert('Problema de conexión, asegurate estar conectado a internet.');
			frmWorking = false;
		}
	});
}