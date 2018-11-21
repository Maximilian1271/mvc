<div class="nav-main">
	<ul>
		<li><a href="#">Home</a></li>
		<li><a href="#">News</a></li>
		<?php  if (isset($_SESSION['login'])&&isset($_SESSION['uname'])&&$_SESSION['login']): ?>
			<li><a href="<?php echo APP_URL."logout" ?>"><?php echo "Logout (Logged in as {$_SESSION['uname']})" ?></a></li>
		<?php else: ?>
			<li><a href="<?php echo APP_URL."login" ?>">Login</a></li>
		<?php endif; ?>
	</ul>
</div>