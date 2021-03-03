<div class="w-50 mx-auto flex justify-content-center">
  <h1>Register Page</h1>
  
  <?php if(count($errors) > 0) { ?>
    <div class="alert alert-danger">
      <p class="h4">Validation errors</p>
      <ul>
        <?php foreach($errors as $error) { ?>
        <li><?php echo $error[0] ?></li>
        <?php } ?>
      </ul>
    </div>
  <?php } ?>

  <?php if(isset($user)) { ?>
    <p class="h3">Welcome <?php echo $user["name"]; ?></p>
  <?php } else { ?>
  <form enctype="application/x-www-form-urlencoded" method="post" action="/register">
    <div class="row">
      <div class="col">
        <div class="mb-3">
          <label for="inputName" class="form-label">Your name</label>
          <input type="text" name="name" class="form-control" id="inputName">
        </div>
      </div>
      <div class="col">
        <div class="mb-3">
          <label for="inputEmail" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="inputEmail">
        </div>
      </div>
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword">

      <div class="mb-3">
        <label for="inputPasswordConfirm" class="form-label">Confirm Password</label>
        <input type="password" name="password_confirm" class="form-control" id="inputPasswordConfirm">
      </div>
      <button type="submit" class="btn btn-primary">Register</button>
  </form>
  <?php } ?>
</div>
