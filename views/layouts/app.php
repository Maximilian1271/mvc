<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
	      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="<?PHP echo APP_URL ?>assets/css/styles.css">
	<?php
	if(count($this->files_css)>0)
	{echo $this->loadCss();
	};?>
</head>
<body>
	<div class="site-wrapper">
		<?php load_global("header") ?>
		<div class="main">
			<?php load_view($view, $data); ?>
		</div>
		<?php load_global("footer") ?>
	</div>
</body>
<?php if(count($this->files_js)>0){
	echo $this->loadJS();
} ?>
</html>