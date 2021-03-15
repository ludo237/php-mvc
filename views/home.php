<div class="w-50 mx-auto flex justify-content-center">
  <h1>Home Page</h1>

  <div>
      <?php

      use Arcadia\Application;

      echo Application::$instance->session->flash("test")
      ?>
  </div>

  <form enctype="application/x-www-form-urlencoded" action="/" method="post" role="form">
    <p>Change the displayed name to test POST data</p>
    <div class="mb-3">
      <label for="exampleInput" class="form-label">New name</label>
      <input
        type="text"
        name="name"
        class="form-control"
        id="exampleInput"
        aria-describedby="textHelp"
        value="<?php echo $name ?>"
      >
      <div id="textHelp" class="form-text">Change your name</div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

  <hr>

  <strong>Hello <?php echo $name ?></strong>
</div>
