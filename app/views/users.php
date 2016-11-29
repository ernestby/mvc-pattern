<h1>Пользователи</h1>

<div>

	<?php foreach ($data['users'] as $user): ?>
	  	<p><?= $user['login'] ?> (<?= $user['email'] ?>) - <?= $user['country'] ?></p>
	<?php endforeach; ?>	

</div>
<div>
<?php
	
	if($data['page'] > 1)
	{
		echo "<a href='?page=" . ($data['page'] - 1) . "' class='button'>PREVIOUS</a> ";
	}
	if($data['page'] < $data['total'] - 2)
	{
		echo " <a href='?page=" . ($data['page'] + 1) . "' class='button'>NEXT</a>";
	}
?>
</div>