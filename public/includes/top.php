<div class="top">
	<img class="logo" src="images/logo-small-top.png" alt="ylmm" />
	
	<div class="user">
	</div>
</div>
<script>
	if(localStorage.getItem('unombre') != null)
	{
		var unombre = localStorage.getItem('unombre');
		var ufoto = localStorage.getItem('ufoto', '');
		
		var urlFoto = '';
		
		if(ufoto != '')
		{
			urlFoto = ufoto;
		}
		else
		{
			urlFoto = 'images/user-mini.png';
		}
		
		htmlUser = '<div class="pic" style="background-image: url('+urlFoto+');"></div><div class="nombre">'+unombre+' | <span onclick="closeSession();">Cerrar sesión</span></div>';
		
		$('.top .user').html(htmlUser);
	}
	
	function closeSession()
	{
		localStorage.clear();

		location.assign('index.php');
	}
</script>