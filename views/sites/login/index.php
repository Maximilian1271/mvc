<div class="container">
	<div style="max-width: 400px; width: 400px; margin: 0 auto; background: #ccc; padding: 40px;">
		<h2>Login</h2>
	<?php
	if(isset($errors) && count($errors) > 0) {
		echo "<div class='alert alert-danger'>";
		foreach ($errors as $error):
			echo "<p> $error</p>";
		endforeach;
		echo "</div>";

	}
	echo $form;
	?>
	</div>
</div>