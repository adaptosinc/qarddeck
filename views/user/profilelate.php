<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = $profile->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Edit Profile', 'url' => ['profile']];
$this->params['breadcrumbs'][] = 'Edit';

?>      




<!-- Edit Account -->

                <div class="modal fade" tabindex="-1" id="myModaledit" role="dialog" aria-labelledby="myModalLabel">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                      </div>
                      <div class="modal-body">
                        <h3>Edit Account Info</h3>
                        <div class="row">
                            <div class="public-profile col-sm-7 col-md-7">      <!-- public profile -->
                                <h3 class="main-title">Public Profile</h3>
                                <div class="row">
                                    <div class="profile-img col-sm-2 col-md-2">
                                        <img src="images/avatar-lg.png" alt="">
                                    </div>
                                    <div class="profile-content col-sm-10 col-md-10">
                                        <h3>@<?= Html::encode($this->title) ?></h3>
                                        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
                                        <div class="form-group">
                                           <input type="text" value="<?php echo $profile->firstname;?>" class="form-control" name="firstname" placeholder="First Name">
                                        </div>
                                         <div class="form-group">
                                            <input type="text" value="<?php echo $profile->lastname;?>" class="form-control" name="lastname" placeholder="Last Name">   
                                        </div>  
                                  <div class="form-group">
                                            <input type="text" class="form-control" name="short_description" placeholder="Something about yourself (x char max)">
                                        </div>
                                        
                                  <div class="form-group">     
                                    <?= $form->field($profile, 'profile_photo')->fileInput() ?>
                                    <?= $form->field($profile, 'profile_bg_image')->fileInput() ?>
                                  </div>
                                        <div class="form-group" style="display: inline-block;">
                                      <div class="col-sm-6 col-md-6">
                                                <img src="images/email-trans.png" alt=""><input type="text"  value="<?php echo $model->email;?>" class="form-control" name="email" type="email" placeholder="Email Adddress">
                                            </div>
                                            <div class="col-sm-6 col-md-6">
                                                <div class="switch">
                                                    <input id="cmn-toggle-4" class="cmn-toggle cmn-toggle-round" type="checkbox">
                                                    <label for="cmn-toggle-4"></label>
                                                </div>  <span>Display email on public profile</span>                                                   
                                            </div>                                            
                                        </div>
                                        <div class="form-group">
                                            <img src="images/link-trans.png" alt=""><input type="text" class="form-control" name="fullname" placeholder="Link Optional">
                                        </div>                                        
                                    </div>
                                </div>
                            </div>          <!-- public profile -->
                            <div class="col-sm-4 col-md-4 col-md-offset-1">
                                <h3 class="main-title">Change Your Password</h3>
                         
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="password" placeholder="Confirm New Password">
                                </div>                                  
                            </div>
                        </div>          <!-- row -->
                        <div class="social-ccount">
                            <h3>Connect Social Accounts</h3>
                            <div class="form-group">
                                <button class="btn btn-lg btn-primary"><i class="fa fa-facebook"></i> Connect facebook account</button>
                                <button class="btn btn-lg btn-info"><i class="fa fa-twitter"></i>Connect Twitter account</button>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <ul class="pull-right">
                                <li><button class="btn btn-lg btn-default">Cancel</button></li>
                                <li><button class="btn btn-lg btn-warning">Save</button></li>                     
                            </ul>
                        </div>
                        
                      </div>

                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->                
                
                <section class="main-profile">
                    <ul class="profile-title">
                        <li>@username</li>
                        <li><i class="fa fa-envelope"></i>email@address.com</li>
                    </ul>
                    
                    <div class="main-content">
                        <h3>To get you started, we've added some of our popular content on your wall</h3>
                        <p>Start following other users to customize what you see</p>
                        <div class="popular-qards">     <!-- popular qard list -->
                            <div class="row">
                                <div class="col-sm-9 col-md-9">
                                    <div class="row">
                                        <div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
                                            <div class="qard-content">
                                                
                                            </div>
                                            <div class="qard-bottom">
                                                <ul class="qard-tags">
                                                    <li class="pull-left">#tag#tag#tag</li>
                                                    <li class="pull-right">x days ago</li>
                                                </ul>
                                                <h4>Author Full name</h4>
                                                <ul class="social-list">
                                                    <li><a href=""><img src="images/heart.png" alt=""><br />500</a></li>
                                                    <li><a href=""><img src="images/comment-dark.png" alt=""><br />500</a></li>
                                                    <li><a href=""><img src="images/certify.png" alt=""><br />500</a></li>
                                                    <li><a href=""><img src="images/share.png" alt=""><br />500</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
                                            <div class="qard-content">
                                                
                                            </div>
                                            <div class="qard-bottom">
                                                <ul class="qard-tags">
                                                    <li class="pull-left">#tag#tag#tag</li>
                                                    <li class="pull-right">x days ago</li>
                                                </ul>
                                                <h4>Author Full name</h4>
                                                <ul class="social-list">
                                                    <li><a href=""><img src="images/heart.png" alt=""><br />500</a></li>
                                                    <li><a href=""><img src="images/comment-dark.png" alt=""><br />500</a></li>
                                                    <li><a href=""><img src="images/certify.png" alt=""><br />500</a></li>
                                                    <li><a href=""><img src="images/share.png" alt=""><br />500</a></li>
                                                </ul>
                                            </div>                                            
                                        </div>
                                        <div class="col-sm-3 col-md-3 col-md-offset-1">     <!-- qard -->
                                            <div class="qard-content">
                                                
                                            </div>
                                            <div class="qard-bottom">
                                                <ul class="qard-tags">
                                                    <li class="pull-left">#tag#tag#tag</li>
                                                    <li class="pull-right">x days ago</li>
                                                </ul>
                                                <h4>Author Full name</h4>
                                                <ul class="social-list">
                                                    <li><a href=""><img src="images/heart.png" alt=""><br />500</a></li>
                                                    <li><a href=""><img src="images/comment-dark.png" alt=""><br />500</a></li>
                                                    <li><a href=""><img src="images/certify.png" alt=""><br />500</a></li>
                                                    <li><a href=""><img src="images/share.png" alt=""><br />500</a></li>
                                                </ul>
                                            </div>                                            
                                        </div>                                        
                                    </div>  <!-- row -->
                                </div>
                                <div class="col-sm-3 col-md-3">
                                    <div class="featured-tags">     <!--featured tags -->
                                        <h4>Featured Tags</h4>
                                        <button class="btn btn-default">Tag</button>
                                    </div>
                                </div>
                            </div>          <!-- row -->
                        </div>
                    </div>
                </section>