<div class="container">
	<?php
	$user_data=json_decode($user['data'], true);
	?>
	<h2>Profil</h2>
	<table width="100%" class="table table-stripped">
		<tr>
			<td>Username:</td>
			<td><?php echo $user['uname']?></td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><?php echo $user['email']?></td>
		</tr>
		<tr>
			<td>Vorname:</td>
			<td><?php echo $user_data['fname']?></td>
		</tr>
		<tr>
			<td>Nachname:</td>
			<td><?php echo $user_data['lname']?></td>
		</tr>
		<tr>
			<td>Tel:</td>
			<td><?php echo $user_data['tel']?></td>
		</tr>
		<tr>
			<td>Country:</td>
			<td><?php echo($user_data['country']=="de"?"Deutschland":"Österreich") ?></td>
		</tr>
	</table>
	<p><a href="<?php echo APP_URL."profile/edit"?>">Daten editieren</a></p>
</div>