<?php
//echo '<pre>'; print_r($userShiftList);echo '</pre>';
defined('BASEPATH') OR exit('No direct script access allowed');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  $this->load->view('admin/include/header');
?>
<body class="hold-transition skin-blue sidebar-mini">
<input type="hidden" name="branch_id" value="<?php echo $this->session->userdata('branch_id');?>" id="hidd_branch_id" />
<input type="hidden" value="<?php echo base_url(); ?>" id="base_url"  />
    <div class="wrapper">
        <?php
            $this->load->view('admin/include/sidebar');
			//echo '<pre>'; print_r($editVidResolution); echo '</pre>';
        ?>
        <div class="content-wrapper">
            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">×</button>
                    <?= $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>
            <section class="content-header">
                <h1>
                    Holiday List
                </h1>
                <ol class="breadcrumb">
                    <li class="active">Holiday List</li>
                </ol>
            </section>
            <h2></h2>
            <!-- DataTables Example -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <h3 class="box-title">Holiday List</h3>
                            </div>
                            <div class="box-body">
                                <!-- THE CALENDAR -->
      							<div id="calendar"></div>
                            </div>                    
                        </div>
                        <div class="box">
                            
                        </div>
                    </div>            
                </div>
            </section>
        </div>
        <?php
            $this->load->view('admin/include/footer-content');
        ?>

        <!-- Control Sidebar -->
        
        <!-- /.control-sidebar -->
        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
<!-- ./wrapper -->
<?php
    $this->load->view('admin/include/footer');
?>
<script>
  $(document).ready(function() {
	  var branch_id = document.getElementById("hidd_branch_id").value;
	  var base_url = document.getElementById("base_url").value;
	  //console.log(base_url);
	  $('#calendar').fullCalendar({
		  header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
        },
        //defaultView: 'agendaWeek',
        eventSources: [    
            {
                events: function(start, end, timezone, callback) {
				   //alert(base_url +"/branch/calHolidays/"+branch_id);
				   $.ajax({
					url: base_url + "/branch/calHolidays/" + branch_id,
					dataType: 'json',
					data: {
						// our hypothetical feed requires UNIX timestamps
						start: start.unix(),

						//color: 'yellow',
						end: end.unix()
					},
					success: function(msg) {
						var events = msg.events;
						callback(events);
					}
				});
				},               
                color: 'red'
            },
        ]
	  })
  });
</script>