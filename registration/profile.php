<div class="content">
    <!-- notification message -->
    <?php if (isset($_SESSION['success'])) : ?>
      <div class="error success" >
        <h3>
          <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
          ?>
        </h3>
      </div>
    <?php endif ?>

      <button type="submit" class = "mainpage" onclick="location='home.php'" name="home">Home</button>
      <button type="submit" class = "mainpage" onclick="location='profile.php'" name="profile">Profile</button>
      <button type="submit" class = "mainpage" onclick="location='search.php'" name="search">Search</button>

    <!-- logged in user information -->
    <?php  if (isset($_SESSION['username'])) : ?>
      <p>Welcome <strong><?php echo $_SESSION['username']; ?></strong></p>
      <p> <a href="index.php?logout='1'" style="color: red;">logout</a> </p>
    <?php endif ?>
</div>
