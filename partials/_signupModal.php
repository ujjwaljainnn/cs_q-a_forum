<div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="signupModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signupModalLabel">Signup to iDiscuss</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class = "container mt-3">
                <!-- <h1 class = "text-muted my-3">Please enter your email and password</h1> -->
                <form action = "/forum/partials/_handleSignup.php" method = "POST">
                    <div class="form-group">
                        <label for="username">Email Address</label>
                        <input type="email"  class="form-control" id="signupEmail" name="signupEmail"  placeholder="Enter Email">
                        
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" maxlength = "30" name = "signupPassword" class="form-control" id="signupPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="cpassword">Confirm Password</label>
                        <input type="password" maxlength = "30" name = "signupCPassword" class="form-control" id="signupCPassword" placeholder="Confirm Password">
                        <small  class="form-text text-muted">Make sure it matches the password you entered above </small>
                    </div>
                    <button type="submit" class="btn btn-primary">Sign Up</button>
                </form>
            </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
