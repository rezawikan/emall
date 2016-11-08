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
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories  <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                          <?php
                          use Emall\Auth\Session;
                          $seller->setTable('categories');
                          $categories = $seller->join('sub_categories','categories.categoriesID','=','sub_categories.categoriesID')
                          ->join('product','sub_categories.subcategoriesID','=','product.subcategoriesID')
                          ->where('product.sellerID','=',Session::get('sellerSession'))
                          ->select('categories.categoryName, categories.categoriesID','DISTINCT')
                          ->all();

                          foreach ($categories as $index => $category) {
                            $seller->setTable('sub_categories');
                            $sub_categories = $seller->join('product','sub_categories.subcategoriesID','=','product.subcategoriesID')
                            ->where('categoriesID','=',$category->categoriesID)
                            ->select('sub_categories.subName','DISTINCT')
                            ->all();
                            if ($sub_categories != null) {
                                echo "<li class='dropdown-submenu'><a tabindex='-1' href='#'>{$category->categoryName}<span class='glyphicon glyphicon-adjust'></span></a>";
                                if ($sub_categories != null) {
                                  echo "<ul class='dropdown-menu'>";
                                  foreach ($sub_categories as $key => $value) {
                                    echo "<li class='dropdown-submenu'><a href='#'>{$value->subName}</a></li>";
                                  }
                                  echo "</li></ul>";
                                }
                            } else {
                              // Sangat Jarang bahkan tidak ada
                              echo "<li><a class='page-scroll' href=''>{$category->categoryName}</a></li>";
                            }
                          }
                            ?>

                            <!-- <li class="dropdown-submenu">
                              <a tabindex="-1" href="#">apa</a>
                              <ul class="dropdown-menu">
                                <li><a href="#">Book</a></li>
                                <li><a href="#">Electronic</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Food</a></li>
                                <li><a href="#">Food</a></li>
                              </ul>
                            </li>
                            <li><a class="page-scroll" href="#">Electronic</a></li>
                            <li><a class="page-scroll" href="#">Food</a></li>
                            <li><a class="page-scroll" href="#">Food</a></li>
                            <li><a class="page-scroll" href="#">Food</a></li> -->
                          </ul>
                        </li>

                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <img alt="image" width="48" height="48" class="img-circle" src="uploads/profile/<?php echo $user->image; ?>"/>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                      <li class="dropdown">
                          <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#" aria-expanded="true">
                              <i class="fa fa-bell"></i> <span class="label label-primary pull-right">8</span>
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
                        <div class="col-md-6 col-sm-5 col-xs-8">
                          <input class="form-control" placeholder="Search Your Products" type="text">
                        </div>
                    </form>
                </div>
            </div>
        </nav>
</div>
