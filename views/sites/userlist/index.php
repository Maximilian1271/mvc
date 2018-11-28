<style>
	/*tr, td, table{
		border: 1px solid black;
	}*/
	.admin{
		background-color: #ff6a6a;
	}
</style>
<div class="container">
	<table class="table">
		<thead>
		<tr>
			<th>Username</th>
			<th>Email</th>
			<th>Fname</th>
			<th>Lname</th>
			<th>tel</th>
			<th>Country</th>
		</tr>
		</thead>
	<?php foreach ($list as $item):?>
	<?php $data=json_decode($item['data'], true);?>
	<?php if ($item['user_group']==1):?>
	<tr class="admin"><td><a href="<?php echo APP_URL."userlist/user/{$item['uname']}"?>"><?php echo $item['uname']?></a></td>
		<td><?php echo $item['email']?></td>
		<td><?php echo $data['fname']?></td>
		<td><?php echo $data['lname']?></td>
		<td><?php echo $data['tel']?></td>
		<td><?php echo $data['country']?></td>
	</tr>
	<?php else:?>
	<tr><td><a href="<?php echo APP_URL."userlist/user/{$item['uname']}"?>"><?php echo $item['uname']?></a></td>
		<td><?php echo $item['email']?></td>
		<td><?php echo $data['fname']?></td>
		<td><?php echo $data['lname']?></td>
		<td><?php echo $data['tel']?></td>
		<td><?php echo $data['country']?></td>
	</tr>
	<?php endif;?>
	<?php endforeach;?>
	</table>
</div>