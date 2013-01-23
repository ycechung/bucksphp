<div class="page-header">
	<a href="profile.php?action=edit" class="btn btn-primary pull-right">Edit Profile</a>
	<a href="profile.php?action=edit_password" class="btn pull-right">Change Password</a>
	<h1><?= h($page_title) ?></h1>
</div>

<p>
	<b>Email:</b><br>
	<a href="mailto:<?= h($user['email']) ?>"><?= h($user['email']) ?></a>
</p>

<?php if ( $user['shipping_address'] ): ?>
	<p>
		<b>Shipping Address:</b><br>
		<?= nl2br(h($user['shipping_address'])) ?>
	</p>
<?php endif; ?>

<?php if ( $user['billing_address'] ): ?>
	<p>
		<b>Billing Address:</b><br>
		<?= nl2br(h($user['billing_address'])) ?>
	</p>
<?php endif; ?>