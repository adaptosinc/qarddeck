
                <section class="page-main content">
                    <div class="create-theme">
                        <div class="form-group">
                            <label>Theme Name</label>
                            <input type="text" name="theme name" placeholder="Add theme name">
                        </div>          <!-- form-group  -->
                        <div class="form-group">
                            <label>Theme Colors</label>
                            <div class="themebg">
                                <ul>
                                    <li class="themebg1">
                                        <div class="bgcolor"></div>
                                        <p>#000000</p>
                                    </li>
                                    <li class="themebg2">
                                        <div class="bgcolor"></div>
                                        <p>#000000</p>
                                    </li>
                                    <li class="themebg3">
                                        <div class="bgcolor"></div>
                                        <p>#000000</p>
                                    </li>
                                    <li class="themebg4">
                                        <div class="bgcolor"></div>
                                        <p>#000000</p>
                                    </li>
                                    <li class="themebg5">
                                        <div class="bgcolor"></div>
                                        <p>#000000</p>
                                    </li>                                    
                                </ul>
                            </div>
                        </div>          <!-- form-group  -->
                        <div class="form-group">
                            <label>Fonts</label>
                            <div class="row">
                                <div class="col-sm-3 col-md-3">
                                    <ul class="text-elements">
                                        <li><a href="#">B</a></li>
                                        <li><a href="#"><i>I</a></i></li>
                                        <li class="underline"><a href="#">U</a></li>
                                    </ul>
                                    <ul class="align-elements">
                                        <li><a href="#"><img src="<?php echo \Yii::$app->homeUrl;?>images/icon-left.png" alt=""></a></li>
                                        <li><a href="#"><img src="<?php echo \Yii::$app->homeUrl;?>images/fonts.png" alt=""></a></li>
                                        <li><a href="#"><img src="<?php echo \Yii::$app->homeUrl;?>images/leftalign.png" alt=""></a></li>
                                    </ul>                                    
                                </div>      <!-- /div  -->
                                <div class="col-sm-4 col-md-4">
                                    <input type="text" name="size" class="form-control" placeholder="Font (Roboto)">
                                </div>      <!-- /div  -->
                                <div class="col-sm-4 col-md-4">
                                    <ul class="font-elements">
                                        <li>
                                            <span>Light Text</span>
                                            <input type="text" name="light text">
                                            <p>#000000</p>
                                        </li>
                                        <li>
                                            <span>Dark Text</span>
                                            <input type="text" name="light text">
                                            <p>#000000</p>
                                        </li>                                        
                                        <li>
                                            <span>Light Link</span>
                                            <input type="text" name="light text">
                                            <p>#000000</p>
                                        </li>
                                        <li>
                                            <span>Dark Link</span>
                                            <input type="text" name="light text">
                                            <p>#000000</p>
                                        </li>                                        
                                    </ul>                                    
                                </div>      <!-- /div  -->                                
                            </div>
                        </div>      <!-- form-group  -->
                        <div class="form-group">
                            <label>Image</label>
                            <div class="row">
                                <div class="col-sm-12 col-md-12">
                                    <div class="font-elements col-sm-2 col-md-2">
                                        <span><strong>Overlay</strong></span>
                                        <input type="text" name="overlay">
                                        <p>#000000</p>
                                    </div>
                                    <div class="col-sm-3 col-md-3">
                                        <input type="text" name="opacity" placeholder="Overlay Opacity (%)">
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <ul class="font-elements">
                                            <li>
                                                <span>Block Background</span>
                                                <input type="text" name="light text">
                                                <p>#000000</p>
                                            </li>
                                            <li>
                                                <span>Element highlight Color (icons, buttons, etc.)</span>
                                                <input type="text" name="light text">
                                                <p>#000000</p>
                                            </li>                                                                                
                                        </ul>                                        
                                    </div>
                                </div>
                            </div>
                        </div>              <!-- form-group  -->
                        <div class="form-group">
                            <ul class="pull-right">
                                <li><button class="btn btn-md btn-default" name="cancel">Cancel</button></li>
                                <li><button class="btn btn-md btn-default" name="preview">Save</button></li>
                            </ul>
                        </div>
                    </div>
                </section>
