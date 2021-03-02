<div class="w-50 mx-auto flex justify-content-center">
  <h1>Login Page</h1>

  <form enctype="application/x-www-form-urlencoded" method="post" action="/login">
    <div class="mb-3">
      <label for="inputEmail" class="form-label">Email address</label>
      <input type="email" name="email" class="form-control" id="inputEmail" aria-describedby="emailHelp">
    </div>
    <div class="mb-3">
      <label for="inputPassword" class="form-label">Password</label>
      <input type="password" name="password" class="form-control" id="inputPassword">
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
  </form>
</div>
