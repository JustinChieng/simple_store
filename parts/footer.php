<div class="d-flex justify-content-between align-items-center pt-4 pb-2">
        <div class="text-muted small">
          © 2022 <a href="index.php" class="text-muted">My Store</a>
        </div>
        <div class="d-flex align-items-center gap-3">
            <?php if (isLoggedIn()):?>
                <a href="orders.php" class="btn btn-light btn-sm">My Orders</a>
                <a href="logout.php" class="btn btn-light btn-sm">My Logout</a>
            <?php else : ?>
          <a href="login.php" class="btn btn-light btn-sm">Login</a>
          <a href="signup.php" class="btn btn-light btn-sm">Sign Up</a>
            <?php endif; ?>
        </div>
      </div>
    </div>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
