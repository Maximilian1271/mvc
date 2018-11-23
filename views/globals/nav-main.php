<div class="nav-main">
	<ul>
		<li><a href="<?php echo APP_URL ?>">Home</a></li>
		<li><a href="#">News</a></li>
		<?php if(\App\Libs\Sessions::get("login")): ?>
		<li><a href="<?php echo APP_URL."dashboard" ?>">Dashboard</a></li>
		<?php endif; ?>
		<?php  if (\App\Libs\Sessions::get("login")&&is_string(\App\Libs\Sessions::get("uname"))&&\App\Libs\Sessions::get("login")==1): ?>
			<li><a href="<?php echo APP_URL."logout" ?>"><?php echo "Logout (Logged in as \"".\App\Libs\Sessions::get("uname")."\")" ?></a></li>
		<?php else: ?>
			<li><a href="<?php echo APP_URL."login" ?>">Login</a></li>
			<li><a href="<?php echo APP_URL."register" ?>">Register</a></li>
		<?php endif; ?>


	</ul>
</div>