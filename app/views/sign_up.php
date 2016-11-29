<h1>Регистрация</h1>
<?php
  if(!empty($data['flash']))
  {
    foreach ($data['flash'] as $key => $value) {
      echo "<p class='bg-" . $data['flash_status'] . "'>" . $value . "</p>";
    }
  }
?>
<form action="/users/signup" method="post">
  <div class="form-group">
    <label for="username">Username</label>
    <input name="username" value="<?= $_POST['username'] ?>" type="text" class="form-control" id="username" placeholder="Username">
  </div>
  <div class="form-group">
    <label for="email">Email address</label>
    <input type="email" value="<?= $_POST['email'] ?>" name="email" class="form-control" id="email" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="password_confirmation">Confirm Password</label>
    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm Password">
  </div>
   <div class="form-group">
    <label for="country">Country</label>
    <select name="country" id="country">
	  <?php foreach ($data['countries'] as $country): ?>
	  	<option value="<?= $country['id']; ?>"><?= $country['name']; ?></option>
	  <?php endforeach; ?>	
	</select>
  </div>
  <input name="token" type="hidden" value="<?= $data['token'] ?>" />

  <button type="submit" class="btn btn-default">Submit</button>
</form>