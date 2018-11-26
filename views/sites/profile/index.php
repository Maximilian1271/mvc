<div class="container">
	<?php $user_data=json_decode($user['data'], true);?>
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
	</table>
	<p><a href="profile/edit">Daten editieren</a></p>
</div>