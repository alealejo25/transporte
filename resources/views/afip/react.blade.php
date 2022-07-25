<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
	<h1>Mujeres programadoasa</h1>
	<div id="app"></div>
	<script>
		const $app=document.getElementById("app")
		const Avatar = params=>{
			const src =´https://randomuser.me/api/portraits/women/${params.id}.jpg´
			return
			'
			<picture>
			<img src="${src]" />
			</picture>
			':
		};
		app.innerHtml == Avatar({id:}) ;
	</script>

</body>
</html>