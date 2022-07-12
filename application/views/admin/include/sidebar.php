<?php 
//print_r($this->session->userdata); 
$navigation = $this->uri->segment(2);
$active1 = '';
$active2 = '';
$active3 = '';
$active4 = '';
$active5 = '';

if($navigation=='adduser' || $navigation=='users-list' || $navigation=='business-users-list' || $navigation=='pickup-delivery-boy-list' || $navigation=='branch-users-list' || $navigation=='edituser' || $navigation=='editbranchuser' || $navigation=='addusershift' || $navigation=='adduserarea' || $navigation=='addorderpickup' || $navigation=='addorderdelivery' || $navigation=='addcredit' || $navigation=='addpaylater' || $navigation=='adduserduty'){
	$class = 'menu-open active';
	$style = 'style="display: block"';
	if($navigation=='adduser'){$active1 = 'class="active"';}
	elseif($navigation=='users-list'){$active2 = 'class="active"';}
	elseif($navigation=='business-users-list'){$active3 = 'class="active"';}
	elseif($navigation=='pickup-delivery-boy-list'){$active4 = 'class="active"';}
	elseif($navigation=='branch-users-list'){$active5 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class = '';
	$style = 'style="display: none"';
	$active = 'class=""';
}

if($navigation=='addbranch' || $navigation=='branch-list' || $navigation=='editbranch' || $navigation=='addbrancharea' || $navigation=='addbranchshift' || $navigation=='addbranchholiday' || $navigation=='addbranchcalendar' || $navigation=='addpickuprules'){
	$class1 = 'menu-open active';
	$style1 = 'style="display: block"';
	if($navigation=='addbranch'){$active1 = 'class="active"';}
	elseif($navigation=='branch-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class1 = '';
	$style1 = 'style="display: none"';
}

if($navigation=='addcontainer' || $navigation=='container-list' || $navigation=='editcontainer' || $navigation=='add-item-to-container' || $navigation=='view-item-to-container'){
	$class2 = 'menu-open active';
	$style2 = 'style="display: block"';
	if($navigation=='addcontainer'){$active1 = 'class="active"';}
	elseif($navigation=='container-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class2 = '';
	$style2 = 'style="display: none"';
}

if($navigation=='addcategory' || $navigation=='categories-list' || $navigation=='editcategory'){
	$class3 = 'menu-open active';
	$style3 = 'style="display: block"';
	if($navigation=='addcategory'){$active1 = 'class="active"';}
	elseif($navigation=='categories-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class3 = '';
	$style3 = 'style="display: none"';
}

if($navigation=='adddocument' || $navigation=='document-list' || $navigation=='editdocument'){
	$class4 = 'menu-open active';
	$style4 = 'style="display: block"';
	if($navigation=='adddocument'){$active1 = 'class="active"';}
	elseif($navigation=='document-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class4 = '';
	$style4 = 'style="display: none"';
}

if($navigation=='addpackage' || $navigation=='package-list' || $navigation=='editpackage'){
	$class5 = 'menu-open active';
	$style5 = 'style="display: block"';
	if($navigation=='addpackage'){$active1 = 'class="active"';}
	elseif($navigation=='package-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class5 = '';
	$style5 = 'style="display: none"';
}

if($navigation=='addprohibited' || $navigation=='prohibited-list' || $navigation=='editprohibited'){
	$class6 = 'menu-open active';
	$style6 = 'style="display: block"';
	if($navigation=='addprohibited'){$active1 = 'class="active"';}
	elseif($navigation=='prohibited-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class6 = '';
	$style6 = 'style="display: none"';
}

if($navigation=='addrate' || $navigation=='rate-list' || $navigation=='editrate' || $navigation=='rate-factor'){
	$class7 = 'menu-open active';
	$style7 = 'style="display: block"';
	if($navigation=='addrate'){$active1 = 'class="active"';}
	elseif($navigation=='rate-list'){$active2 = 'class="active"';}
	elseif($navigation=='rate-factor'){$active3 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class7 = '';
	$style7 = 'style="display: none"';
}

if($navigation=='addpaymentoption' || $navigation=='paymentoption-list' || $navigation=='editpaymentoption'){
	$class8 = 'menu-open active';
	$style8 = 'style="display: block"';
	if($navigation=='addpaymentoption'){$active1 = 'class="active"';}
	elseif($navigation=='paymentoption-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class8 = '';
	$style8 = 'style="display: none"';
}

if($navigation=='addtax' || $navigation=='tax-list' || $navigation=='edittax'){
	$class9 = 'menu-open active';
	$style9 = 'style="display: block"';
	if($navigation=='addtax'){$active1 = 'class="active"';}
	elseif($navigation=='tax-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class9 = '';
	$style9 = 'style="display: none"';
}

if($navigation=='addshift' || $navigation=='shift-list' || $navigation=='editshift'){
	$class10 = 'menu-open active';
	$style10 = 'style="display: block"';
	if($navigation=='addshift'){$active1 = 'class="active"';}
	elseif($navigation=='shift-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class10 = '';
	$style10 = 'style="display: none"';
}

if($navigation=='addcms' || $navigation=='cms-list' || $navigation=='editcms'){
	$class11 = 'menu-open active';
	$style11 = 'style="display: block"';
	if($navigation=='addcms'){$active1 = 'class="active"';}
	elseif($navigation=='cms-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class11 = '';
	$style11 = 'style="display: none"';
}

if($navigation=='addbanner' || $navigation=='banner-list' || $navigation=='editbanner'){
	$class12 = 'menu-open active';
	$style12 = 'style="display: block"';
	if($navigation=='addbanner'){$active1 = 'class="active"';}
	elseif($navigation=='banner-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class12 = '';
	$style12 = 'style="display: none"';
}

if($navigation=='addquotation' || $navigation=='quotation-list' || $navigation=='editquotation' || $navigation=='viewquotation'){
	$class13 = 'menu-open active';
	$style13 = 'style="display: block"';
	if($navigation=='addquotation'){$active1 = 'class="active"';}
	elseif($navigation=='quotation-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class13 = '';
	$style13 = 'style="display: none"';
}

if($navigation=='addorder' || $navigation=='order-list' || $navigation=='editorder' || $navigation=='vieworder' || $navigation=='pickup-order-list' || $navigation=='delivery-order-list' || $navigation=='add-order-status' || $navigation=='pdboy-pickup-order-list' || $navigation=='pdboy-delivery-order-list' || $navigation=='order-tracking-list' || $navigation=='order_tracking' || $navigation=='creditors-order-list'){
	$class14 = 'menu-open active';
	$style14 = 'style="display: block"';
	if($navigation=='creditors-order-list'){$active1 = 'class="active"';}
	elseif($navigation=='order-list'){$active2 = 'class="active"';}
	elseif($navigation=='pickup-order-list' || $navigation=='pdboy-pickup-order-list'){$active3 = 'class="active"';}
	elseif($navigation=='delivery-order-list' || $navigation=='pdboy-delivery-order-list'){$active4 = 'class="active"';}
	elseif($navigation=='order-tracking-list'){$active5 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class14 = '';
	$style14 = 'style="display: none"';
}

if($navigation=='pdboy-holiday-list' || $navigation=='pdboy-duty-list'){
	$class15 = 'menu-open active';
	$style15 = 'style="display: block"';
	if($navigation=='pdboy-holiday-list'){$active1 = 'class="active"';}
	elseif($navigation=='pdboy-duty-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class15 = '';
	$style15 = 'style="display: none"';
}
if($navigation=='pdboy-pickup-order-history-list' || $navigation=='pdboy-delivery-order-history-list'){
	$class16 = 'menu-open active';
	$style16 = 'style="display: block"';
	if($navigation=='pdboy-pickup-order-history-list'){$active1 = 'class="active"';}
	elseif($navigation=='pdboy-delivery-order-history-list'){$active2 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class16 = '';
	$style16 = 'style="display: none"';
}
if($navigation=='invoice-list'){
	$class17 = 'menu-open active';
	$style17 = 'style="display: block"';
	if($navigation=='invoice-list'){$active1 = 'class="active"';}
	else {$active = 'class=""';}
}
else
{
	$class17 = '';
	$style17 = 'style="display: none"';
}
?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?= base_url('admin') ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>R</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>RoyalSerry</b> Shipping</span>
        <!--<span class="logo-lg"><img src="<?= base_url('assets/admin/') ?>dist/img/logo.png" /></span>-->
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">                
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <?php if($this->session->userdata('prof_img') != ''){?>
                        <img src="<?= base_url('uploads/profile_img/') . $this->session->userdata('prof_img') ?>" class="user-image" alt="User Image">
                      <?php } else {?>
                      <img src="<?= base_url('assets/admin/') ?>dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> 
                      <?php } ?>
                        <span class="hidden-xs"><?= $this->session->userdata('firstName'); ?> <?= $this->session->userdata('lastName'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                             <?php if($this->session->userdata('prof_img') != ''){?>
                                <img src="<?= base_url('uploads/profile_img/') . $this->session->userdata('prof_img') ?>" class="img-circle" alt="User Image">
                              <?php } else {?>
                              <img src="<?= base_url('assets/admin/') ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> 
                              <?php } ?>

                            <p>
                            <?= $this->session->userdata('name'); ?>  - <?= $this->session->userdata('accounttype'); ?>
                                <small>Member since <?= date("F j, Y, g:i a", strtotime($this->session->userdata('add_date'))); ?></small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <!-- <div class="col-xs-4 text-center">
                                    <a href="#">Followers</a>
                                </div> -->
                                <div class="col-xs-4 text-center">
                                    <a href="<?= base_url('admin/changepassword') ?>">Change Password</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="<?= base_url('admin/profile') ?>">Profile Settings</a>
                                </div>
                                <div class="col-xs-4 text-left">
                                    <a href="<?= base_url('admin/changeemail') ?>">Change Email</a>
                                </div>
                            </div>                            
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                            </div>
                            <div class="pull-right">
                                <a href="<?= base_url('admin/logout') ?>" class="btn btn-danger btn-flat">Sign out</a>
                            </div>
                        </li>
                    </ul>
                </li>                
            </ul>
        </div>
    </nav>
</header>

<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if($this->session->userdata('prof_img')){?>
                    <img src="<?= base_url('uploads/profile_img/') . $this->session->userdata('prof_img') ?>" class="img-circle" alt="User Image">
                  <?php } else {?>
                  <img src="<?= base_url('assets/admin/') ?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> 
                  <?php } ?>
            </div>
            <div class="pull-left info">
                <p><?= $this->session->userdata('name') ?> </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li id="dashboard" class="">
                <a href="<?= base_url('admin') ?>">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>              
            </li>
            <?php
            		$step  = 2;
            	 // echo '<pre>';
            	 // print_r($_SESSION); die;
				if(is_superadmin_loggedin()){
					$moduleData = getModule();
				} else {
					$moduleData = getModuleRole(loggedin_role_id());            
				}
				foreach ($moduleData as $key => $value) {
            ?>
            <li class="header"><?php echo $value['patent_label']; ?> Module</li>
            <li class="treeview">
              <a href="#" id="module_<?php echo $value['parent_id']; ?>" style="border-left:4px solid <?php echo $value['tab_color']; ?>;">
                <?php echo $value['icon_path']; ?> <span><?php echo $value['patent_label']; ?></span> <i class="fa fa-angle-left pull-right"></i>
              </a>              
              <ul class="treeview-menu" id="subparent_<?php echo $value['parent_id']; ?>">
              	<?php 
                  if(is_superadmin_loggedin()){
                    $menuData = getSideBarMenu($value['parent_id'], '');
                  } else {
                    $menuData = getSideBarMenuRole($value['parent_id'], '',loggedin_role_id());            
                  }  
                  
                  foreach ($menuData as $key1 => $value1) {
              	?>
                	<li><a href="<?php echo base_url($value1['page_url']); ?>" id="menu_<?php echo $value1['tabid']; ?>" data-color="<?php echo $value['tab_color']; ?>" data-module="<?php echo $value['parent_id']; ?>"><?php echo $value1['icon_path']; ?> <?php echo $value1['tablabel']; ?> </a></li>                	
            	<?php $step++; } ?>
              </ul>
            </li>
        	<?php } ?>
            <?php /*if($this->session->userdata('user_type') == 'PDB'){?>
            <li class="header">Order Management</li>
            <li class="treeview <?php echo $class14;?>">
                <a href="#">
                    <i class="fa fa-first-order"></i>
                    <span>My Order List</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style14;?>>
                    <li <?php echo $active3;?>>
                        <a href="<?= base_url('admin/pdboy-pickup-order-list') ?>"><i class="fa fa-list text-blue"></i> Pickup Order List </a>
                    </li>
                    <li <?php echo $active4;?>>
                        <a href="<?= base_url('admin/pdboy-delivery-order-list') ?>"><i class="fa fa-list text-blue"></i> Delivery Order List </a>
                    </li>
                    <li <?php echo $active4;?>>
                        <a href="<?= base_url('admin/createQuote') ?>"><i class="fa fa-list text-blue"></i> Create Quote </a>
                    </li>
                    
                </ul>
            </li>
            <li class="header">Branch Holidays</li>
            <li class="treeview <?php echo $class15;?>">
                <a href="#">
                    <i class="fa fa-calendar-o"></i>
                    <span>Duty Master</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style15;?>>
                	<li <?php echo $active2;?>>
                        <a href="<?= base_url('admin/pdboy-duty-list') ?>"><i class="fa fa-list text-blue"></i> Duty Allocation List </a>
                    </li>
                    <li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/pdboy-holiday-list') ?>"><i class="fa fa-list text-blue"></i> Holiday List </a>
                    </li>
                    
                </ul>
            </li>
            <li class="header">Order History</li>
            <li class="treeview <?php echo $class16;?>">
                <a href="#">
                    <i class="fa fa-history"></i>
                    <span>My Order History</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style16;?>>
                    <li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/pdboy-pickup-order-history-list') ?>"><i class="fa fa-list text-blue"></i> Pickup History </a>
                    </li>
                    <li <?php echo $active2;?>>
                        <a href="<?= base_url('admin/pdboy-delivery-order-history-list') ?>"><i class="fa fa-list text-blue"></i> Delivery History </a>
                    </li>
                </ul>
            </li>
            <?php } else {?>
            <li class="header">Users Management</li>
            <li class="treeview <?php echo $class;?>">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style;?>>
                    <li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/adduser') ?>"><i class="fa fa-plus text-aqua"></i> Add User </a>
                    </li>
                    <li <?php echo $active2;?>>
                        <a href="<?= base_url('admin/users-list') ?>"><i class="fa fa-list text-blue"></i> Normal Users List </a>
                    </li>
                    <li <?php echo $active3;?>>
                        <a href="<?= base_url('admin/business-users-list') ?>"><i class="fa fa-list text-blue"></i> Business Users List </a>
                    </li>
                    <li <?php echo $active4;?>>
                        <a href="<?= base_url('admin/pickup-delivery-boy-list') ?>"><i class="fa fa-list text-blue"></i> Delivery/Pickup Boy List </a>
                    </li>    
                    <li <?php echo $active5;?>>
                        <a href="<?= base_url('admin/branch-users-list') ?>"><i class="fa fa-list text-blue"></i> Branch Users List </a>
                    </li>              
                </ul>
            </li>
            <li class="header">Branch Management</li>
            <li class="treeview <?php echo $class1;?>">
                <a href="#">
                    <i class="fa fa-university"></i>
                    <span>Branch</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style1;?>>
                <?php if($this->session->userdata('user_type') == 'MO'){?>
                    <li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/addbranch') ?>"><i class="fa fa-plus text-aqua"></i> Add Branch </a>
                    </li>
                 <?php }?>
                    <li <?php echo $active2;?>>
                        <a href="<?= base_url('admin/branch-list') ?>"><i class="fa fa-list text-blue"></i> Branch List </a>
                    </li>                    
                </ul>
            </li>
            
            <li class="header">Quotation Management</li>
            <li class="treeview <?php echo $class13;?>">
                <a href="#">
                    <i class="fa fa-file-word-o"></i>
                    <span>Quotation</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style13;?>>
                    <!--<li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/addquotation') ?>"><i class="fa fa-plus text-aqua"></i> Add Quotation </a>
                    </li>-->
                    <li <?php echo $active2;?>>
                        <a href="<?= base_url('admin/quotation-list') ?>"><i class="fa fa-list text-blue"></i> Quotation List </a>
                    </li>                    
                </ul>
            </li>
            
            <li class="header">Order Management</li>
            <li class="treeview <?php echo $class14;?>">
                <a href="#">
                    <i class="fa fa-first-order"></i>
                    <span>Order</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style14;?>>
                    <?php if($this->session->userdata('user_type') == 'MO'){?>
                    <li <?php echo $active2;?>>
                        <a href="<?= base_url('admin/order-list') ?>"><i class="fa fa-list text-blue"></i> Order List </a>
                    </li>
                    <li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/creditors-order-list') ?>"><i class="fa fa-list text-blue"></i> Credit Order list </a>
                    </li>  
                    <?php } else {?>  
                    <li <?php echo $active3;?>>
                        <a href="<?= base_url('admin/pickup-order-list') ?>"><i class="fa fa-list text-blue"></i> Pickup Order List </a>
                    </li>
                    <li <?php echo $active4;?>>
                        <a href="<?= base_url('admin/delivery-order-list') ?>"><i class="fa fa-list text-blue"></i> Delivery Order List </a>
                    </li>
                    <?php }?>   
                    <li <?php echo $active5;?>>
                        <a href="<?= base_url('admin/order-tracking-list') ?>"><i class="fa fa-list text-blue"></i>Tracking Order  </a>
                    </li>              
                </ul>
            </li>
            
            <?php if($this->session->userdata('user_type') == 'MO'){?>
            <li class="header">Invoice Management</li>
            <li class="treeview <?php echo $class17;?>">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>Invoice</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style17;?>>
                    
                    <li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/invoice-list') ?>"><i class="fa fa-list text-blue"></i> Invoice List </a>
                    </li>
                    
                </ul>
            </li>
             <?php }?> 
              
            <li class="header">Shipment Management</li>
            <li class="treeview <?php echo $class2;?>">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span>Container/Shipment Module</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style2;?>>
                    <li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/addcontainer') ?>"><i class="fa fa-plus text-aqua"></i> Add Container </a>
                    </li>
                    <li <?php echo $active2;?>>
                        <a href="<?= base_url('admin/container-list') ?>"><i class="fa fa-list text-blue"></i> Container List </a>
                    </li>                    
                </ul>
            </li>
            <?php if($this->session->userdata('user_type') == 'MO'){?>
            <li class="header">Categories Management</li>
            <li class="treeview <?php echo $class3;?>">
                <a href="#">
                    <i class="fa fa-window-restore"></i>
                    <span>Documents & Packages<br /> Categories</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style3;?>>
                    <li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/addcategory') ?>"><i class="fa fa-plus text-aqua"></i> Add Category </a>
                    </li>
                    <li <?php echo $active2;?>>
                        <a href="<?= base_url('admin/categories-list') ?>"><i class="fa fa-list text-blue"></i> Categories List </a>
                    </li>                    
                </ul>
            </li>
            <li class="header">Documents Management</li>
            <li class="treeview <?php echo $class4;?>">
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Documents</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-right pull-left"></i>
                    </span>
                </a>
                <ul class="treeview-menu" <?php echo $style4;?>>
                    <li <?php echo $active1;?>>
                        <a href="<?= base_url('admin/adddocument') ?>"><i class="fa fa-plus text-aqua"></i> Add Document </a>
                    </li>
                    <li <?php echo $active2;?>>
                        <a href="<?= base_url('admin/document-list') ?>"><i class="fa fa-list text-blue"></i> Documents List </a>
                    </li>                    
                </ul>
            </li>
            <li class="header">Package Management</li>
            
            <li class="treeview <?php echo $class5;?>">
                <a href="#">
                    <i class="fa fa-th"></i>
                    <span>Packages</span>
                    <span class="pull-right-container">
              			<i class="fa fa-angle-right pull-left"></i>
            		</span>
                </a>
                <ul class="treeview-menu" <?php echo $style5;?>>                    
                    <li <?php echo $active1;?>><a href="<?= base_url('admin/addpackage') ?>"><i class="fa fa-plus text-aqua"></i> Add Package </a></li>
                    <li <?php echo $active2;?>><a href="<?= base_url('admin/package-list') ?>"><i class="fa fa-list text-blue"></i> Package List </a></li>
                </ul>
            </li>
            <li class="header">Prohibited Management</li>
            <li class="treeview <?php echo $class6;?>">
                <a href="#">
                    <i class="fa fa-files-o"></i>
                    <span>Prohibited</span>
                    <span class="pull-right-container">
		              <i class="fa fa-angle-right pull-left"></i>
		            </span>
                </a>
                <ul class="treeview-menu" <?php echo $style6;?>>                    
                    <li <?php echo $active1;?>><a href="<?= base_url('admin/addprohibited') ?>"><i class="fa fa-plus text-aqua"></i> Add Prohibited </a></li>
                    <li <?php echo $active2;?>><a href="<?= base_url('admin/prohibited-list') ?>"><i class="fa fa-list text-blue"></i> Prohibited List </a></li>
                </ul>
            </li>
            <li class="header">Rate Management</li>
            <li class="treeview <?php echo $class7;?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Rate Module</span>
                    <span class="pull-right-container">
		              <i class="fa fa-angle-right pull-left"></i>
		            </span>
                </a>
                <ul class="treeview-menu" <?php echo $style7;?>>                    
                    <li <?php echo $active1;?>><a href="<?= base_url('admin/addrate') ?>"><i class="fa fa-plus text-aqua"></i> Add Rate </a></li>
                    <li <?php echo $active2;?>><a href="<?= base_url('admin/rate-list') ?>"><i class="fa fa-list text-blue"></i> Rate List </a></li>
                    <li <?php echo $active3;?>><a href="<?= base_url('admin/rate-factor') ?>"><i class="fa fa-list text-blue"></i> Rate Factor </a></li>
                </ul>
            </li>
            <li class="header">Payment-option Management</li>
            <li class="treeview <?php echo $class8;?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Payment Options</span>
                    <span class="pull-right-container">
		              <i class="fa fa-angle-right pull-left"></i>
		            </span>
                </a>
                <ul class="treeview-menu" <?php echo $style8;?>>                    
                    <!--<li <?php echo $active1;?>><a href="<?= base_url('admin/addprohibited') ?>"><i class="fa fa-plus text-aqua"></i> Add Prohibited </a></li>-->
                    <li <?php echo $active2;?>><a href="<?= base_url('admin/paymentoption-list') ?>"><i class="fa fa-list text-blue"></i> Payment Options List </a></li>
                </ul>
            </li>
            
            <li class="header">Tax Management</li>
            <li class="treeview <?php echo $class9;?>">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>Tax Module</span>
                    <span class="pull-right-container">
		              <i class="fa fa-angle-right pull-left"></i>
		            </span>
                </a>
                <ul class="treeview-menu" <?php echo $style9;?>>                    
                    <li <?php echo $active2;?>><a href="<?= base_url('admin/tax-list') ?>"><i class="fa fa-list text-blue"></i> Tax Options List </a></li>
                </ul>
            </li>
            
            <li class="header">Shift Management</li>
            <li class="treeview <?php echo $class10;?>">
                <a href="#">
                    <i class="fa fa-calendar-check-o"></i>
                    <span>Shift Module</span>
                    <span class="pull-right-container">
		              <i class="fa fa-angle-right pull-left"></i>
		            </span>
                </a>
                <ul class="treeview-menu" <?php echo $style10;?>>
                	<li <?php echo $active1;?>><a href="<?= base_url('admin/addshift') ?>"><i class="fa fa-plus text-aqua"></i> Add Shift </a></li>                    
                    <li <?php echo $active2;?>><a href="<?= base_url('admin/shift-list') ?>"><i class="fa fa-list text-blue"></i> Shift List </a></li>
                </ul>
            </li>
            
            <li class="header">CMS Management</li>
            <li class="treeview <?php echo $class11;?>">
                <a href="#">
                    <i class="fa fa-film"></i>
                    <span>CMS Module</span>
                    <span class="pull-right-container">
		              <i class="fa fa-angle-right pull-left"></i>
		            </span>
                </a>
                <ul class="treeview-menu" <?php echo $style11;?>>
                	<!--<li <?php echo $active1;?>><a href="<?= base_url('admin/addcms') ?>"><i class="fa fa-plus text-aqua"></i> Add CMS </a></li>-->                 
                    <li <?php echo $active2;?>><a href="<?= base_url('admin/cms-list') ?>"><i class="fa fa-list text-blue"></i> CMS List </a></li>
                </ul>
            </li>
            
            <li class="header">Banner Management</li>
            <li class="treeview <?php echo $class12;?>">
                <a href="#">
                    <i class="fa fa-picture-o"></i>
                    <span>Banner Module</span>
                    <span class="pull-right-container">
		              <i class="fa fa-angle-right pull-left"></i>
		            </span>
                </a>
                <ul class="treeview-menu" <?php echo $style12;?>>
                	<li <?php echo $active1;?>><a href="<?= base_url('admin/addbanner') ?>"><i class="fa fa-plus text-aqua"></i> Add Banner </a></li>                 
                    <li <?php echo $active2;?>><a href="<?= base_url('admin/banner-list') ?>"><i class="fa fa-list text-blue"></i> Banner List </a></li>
                </ul>
            </li>
            <?php } }*/?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>