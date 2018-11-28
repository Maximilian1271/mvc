<div class="container">
	<?php
	if(isset($errors) && count($errors) > 0){
		echo "<div class='alert alert-danger'>";
		foreach ($errors as $error):
			echo "<p> $error</p>";
		endforeach;
		echo "</div>";}?>
	<?php echo $form;?>
</div>
