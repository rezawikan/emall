<body id="page-top" class="landing-page">
<div class="navbar-wrapper">
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header page-scroll">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav navbar-left">
                      <li class="dropdown mega-dropdown">
                    		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a>
                    		<ul class="dropdown-menu mega-dropdown-menu">
                    			<li class="col-sm-3">
                    				<ul>
                    					<li class="dropdown-header">Sale</li>
                              <li class="divider"></li>
                              <li><a href="#">View all Collection <span class="glyphicon glyphicon-chevron-right pull-right"></span></a></li>
                    				</ul>
                    					</li>
                    					<li class="col-sm-3">
                    						<ul>
                    							<li class="dropdown-header">Features</li>
                    							<li><a href="#">Auto Carousel</a></li>
                                    <li><a href="#">Carousel Control</a></li>
                                    <li><a href="#">Left & Right Navigation</a></li>
                    							<li><a href="#">Four Columns Grid</a></li>
                    							<li class="divider"></li>
                    							<li class="dropdown-header">Fonts</li>
                                    <li><a href="#">Glyphicon</a></li>
                    							<li><a href="#">Google Fonts</a></li>
                    						</ul>
                    					</li>
                    					<li class="col-sm-3">
                    						<ul>
                    							<li class="dropdown-header">Plus</li>
                    							<li><a href="#">Navbar Inverse</a></li>
                    							<li><a href="#">Pull Right Elements</a></li>
                    							<li><a href="#">Coloured Headers</a></li>
                    							<li><a href="#">Primary Buttons & Default</a></li>
                    						</ul>
                    					</li>
                    					<li class="col-sm-3">
                    						<ul>
                    							<li class="dropdown-header">Much more</li>
                                    <li><a href="#">Easy to Customize</a></li>
                    							<li><a href="#">Calls to action</a></li>
                    							<li><a href="#">Custom Fonts</a></li>
                    							<li><a href="#">Slide down on Hover</a></li>
                    						</ul>
                    					</li>
                              <li class="col-sm-3">
                                <ul>
                                  <li class="dropdown-header">Much more</li>
                                    <li><a href="#">Easy to Customize</a></li>
                                  <li><a href="#">Calls to action</a></li>
                                  <li><a href="#">Custom Fonts</a></li>
                                  <li><a href="#">Slide down on Hover</a></li>
                                </ul>
                              </li>
                    				</ul>
                    			</li>
                        </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <img alt="image" width="48" height="48" class="img-circle" src="uploads/<?php echo $user->image; ?>"/>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="true">
                              <i class="fa fa-bell"></i>  <span class="label label-primary">8</span>
                          </a>
                          <ul class="dropdown-menu dropdown-alerts">
                              <li>
                                  <a href="mailbox.html">
                                      <div>
                                          <i class="fa fa-envelope fa-fw"></i> You have 16 messages
                                          <span class="pull-right text-muted small">4 minutes ago</span>
                                      </div>
                                  </a>
                              </li>
                              <li class="divider"></li>
                              <li>
                                  <a href="profile.html">
                                      <div>
                                          <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                          <span class="pull-right text-muted small">12 minutes ago</span>
                                      </div>
                                  </a>
                              </li>
                              <li class="divider"></li>
                              <li>
                                  <a href="grid_options.html">
                                      <div>
                                          <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                          <span class="pull-right text-muted small">4 minutes ago</span>
                                      </div>
                                  </a>
                              </li>
                              <li class="divider"></li>
                              <li>
                                  <div class="text-center link-block">
                                      <a href="notifications.html">
                                          <strong>See All Alerts</strong>
                                          <i class="fa fa-angle-right"></i>
                                      </a>
                                  </div>
                              </li>
                          </ul>
                      </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $user->firstName.' '.$user->lastName;?> <span class="caret"></span></a>
                          <ul class="dropdown-menu ">
                            <li><a class="" href="profile.php">Profile</a></li>
                            <li><a class="" href="manage_products.php">Manage Products</a></li>
                            <li><a class="" href="manage_orders.php">Manage Orders</a></li>
                            <li><a class="" href="bank.php">Manage Bank</a></li>
                            <li><a class="" href="withdrawal.php">Withdrawal</a></li>
                            <li><a class="" href="logout.php">Logout</a></li>
                          </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <?php

                                  $seller->setTable('seller_balance');
                                  $balance_user = $seller->select()->where('sellerID','=',$id)->first();
                                  $balanceConvert = $sellerA->convertToIDR($balance_user->balance);
                            ?>
                            <a class="balance"><i>Balance : <span><?php echo $balanceConvert; ?></span></i></a>
                        </li>
                    </ul>
                    <form class="form-horizontal" role="search">
                      <div class="col-sm-6">
                        <input class="form-control" placeholder="Search" type="text">
                      </div>
                    </form>
                </div>
            </div>
        </nav>
</div>
