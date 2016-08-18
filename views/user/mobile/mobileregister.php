 <section class="email-signin content">                    
                    <div class="signback">
                        <button type="button" class="btn btn-sm btn-default close pull-left" onclick="location.href='<?= Yii::$app->request->baseUrl?>/user/register';" ><i class="fa fa-chevron-left"></i>&nbsp;Back to Social Login</button>
                        <p class="login-link">Already have an account? <a href="<?= Yii::$app->request->baseUrl?>/user/sign-up">Login in here</a></p>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4">
                        <h3>Sign Up</h3>
                        <form class="signup-new">
                            <div class="form-group">
                                <label>Username</label>
                                <img src="../images/user_icon.png" alt="" class="col-xs-2 col-sm-2 col-md-2 img-responsive"><input type="text" name="username" class="col-xs-10 col-sm-10 col-md-10" placeholder="Username">
                            </div>                                    
                            <div class="form-group">
                                <label>First name</label>
                                <img src="../images/user_icon.png" alt="" class="col-xs-2 col-sm-2 col-md-2 img-responsive"><input type="text" name="firstname" class="col-xs-10 col-sm-10 col-md-10" placeholder="First name">
                            </div>
							  <div class="form-group">
                                <label>Last name</label>
                                <img src="../images/user_icon.png" alt="" class="col-xs-2 col-sm-2 col-md-2 img-responsive"><input type="text" name="lastname" class="col-xs-10 col-sm-10 col-md-10" placeholder="Last name">
                            </div>
							
                            <div class="form-group">
                                <label>Email</label>
                                <img src="../images/email_icon.png" alt="" class="col-xs-2 col-sm-2 col-md-2 img-responsive"><input type="text" name="email" class="col-xs-10 col-sm-10 col-md-10" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <img src="../images/lock_icon.png" alt="" class="col-xs-2 col-sm-2 col-md-2 img-responsive"><input type="text" name="password" class="col-xs-10 col-sm-10 col-md-10" placeholder="Password">
                                <span class="pull-right"><i>Must have atleast 6 characters</i></span>
                            </div>
                            <div class="form-group">
                                <label>Verify Password</label>
                                <img src="../images/lock_icon.png" alt="" class="col-xs-2 col-sm-2 col-md-2 img-responsive"><input type="text" name="password" class="col-xs-10 col-sm-10 col-md-10" placeholder="Verify Password">
                            </div>                                    
                            <div class="form-group">
                                <button class="btn btn-lg btn-warning">Sign Up</button>
                            </div>                                     
                        </form>
                    </div>
                    <p class="terms">You agree to our <a href=""><strong>Terms and Conditions of Use</strong></a> by signing up</p>
                </div>                                          
                </section>