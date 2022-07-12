<?php
   $page =  $this->uri->segment(1);
   //snigdho
 ?>
<!--+++++++++++++++++++++++left-side==============-->
<div class="col-sm-3 white-gap gray-line">
   <ul class="list-group">
      <li class="list-group-item" ><a href="<?php echo base_url('quotation'); ?>" <?php echo ($page == 'quotation' || $page == 'home')?'class="red-active"':''; ?>><i class="fa fa-file-text-o" aria-hidden="true"></i>
 Quotation</a></li>
      <li class="list-group-item" ><a href="<?php echo base_url('orders'); ?>" <?php echo ($page == 'orders' || $page == 'order-shipment')?'class="red-active"':''; ?>><i class="fa fa-truck"></i> Shipment Order</a></li>
      <li class="list-group-item"><a href="<?php echo base_url('order-tracking'); ?>"><i class="fa fa-map-marker"></i> Track Order</a></li>
      <li class="list-group-item"><a href="<?php echo base_url('profile'); ?>"><i class="fa fa-cog"></i> Manage Account</a></li>
   </ul>
</div>
<!--+++++++++++++++++++++++left-side-end==============-->
