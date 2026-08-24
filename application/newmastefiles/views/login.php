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
          </section>