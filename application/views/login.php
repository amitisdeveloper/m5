<section class="login_content">

  <form method="post">
    <h1><?php echo $title ?></h1>

    <?php if($this->session->flashdata('message')) { ?>
      <div class="alert alert-danger">
        <?php echo $this->session->flashdata('message')?>
      </div>
    <?php } ?>

    <div>
      <input type="text" class="form-control" name="user_name" placeholder="Username" required="" />
    </div>

    <div>
      <input type="password" class="form-control" name="password" placeholder="Password" required="" />
    </div>

    <div>
      <button class="btn btn-primary submit" value="login_submit" name="submit_login">Log in</button>
    </div>
  </form>

  <!-- 🚀 New Mobile Panel Card -->
  <!-- <div class="mobile-card">
    <div class="icon">📱</div>
    <h2>Party App</h2>
    <p>Access your app by clicking here.</p>
    <a href="https://new.555xch.live/appdemo/Login.html" target="_blank" class="btn-mobile">Click Here</a>
  </div> -->

</section>

<!-- <style>
  .mobile-card {
    margin-top: 30px;
    background: linear-gradient(135deg, #4facfe, #43e97b);
    border-radius: 16px;
    box-shadow: 0 8px 24px rgba(0,0,0,0.2);
    padding: 20px;
    color: #fff;
    text-align: center;
    transition: transform 0.3s ease;
  }
  .mobile-card:hover {
    transform: translateY(-5px);
  }
  .mobile-card .icon {
    font-size: 50px;
    margin-bottom: 12px;
    background: rgba(255,255,255,0.2);
    border-radius: 50%;
    padding: 16px;
    display: inline-block;
  }
  .mobile-card h2 {
    margin: 0 0 10px;
    font-size: 20px;
    font-weight: bold;
  }
  .mobile-card p {
    font-size: 14px;
    margin-bottom: 15px;
  }
  .mobile-card .btn-mobile {
    background: #fff;
    color: #333;
    padding: 10px 18px;
    border-radius: 8px;
    font-weight: bold;
    text-decoration: none;
    transition: background 0.3s ease;
  }
  .mobile-card .btn-mobile:hover {
    background: #f1f1f1;
  }
</style> -->
