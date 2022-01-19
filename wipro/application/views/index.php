<?php $this->load->view('common/header'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Router List</h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <?php
            if(isset($_SESSION['error_message'])){
          ?>
            <div class="alert alert-danger" role="alert">
              <?php
                echo $_SESSION['error_message'];
                unset($_SESSION['error_message']);
              ?>
            </div>
          <?php   
            }
          ?>

          <?php
            if(isset($_SESSION['success_message'])){
          ?>
            <div class="alert alert-success" role="alert">
              <?php
                echo $_SESSION['success_message'];
                unset($_SESSION['success_message']);
              ?>
            </div>
          <?php   
            }
          ?>


          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Router List</h3>
              <span style="margin-left:3%">
				<button type="button" class="btn bg-addnew btn-flat margin" data-toggle="modal" data-target="#modal-default">Add New Router</button>
			  </span>
            </div>
            <!-- /.box-header -->
            <div class="box-body" id="router-table">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width: 5%">#</th>                 
                  <th>Host Name</th>                                  
                  <th>Loop Back </th>
                  <th>Mac Address </th>
                  <th>View </th>
                  <th>Edit </th>
                  <th>Delete </th>
                </tr>
                </thead>
                <tbody>

                <?php    
                    $i=0;
                    foreach ($record as $val) {
                        $i++;
                ?> 
                <tr>
					<td><?php echo $i; ?></td>                 
					<td><?php echo $val['hostname']; ?></td>  					           
					<td><?php echo $val['loopback']; ?></td>  					           
					<td><?php echo $val['mac_address']; ?></td>  	
					<td>
						<a href="javascript:view_router(<?php echo $val['sapid'];?>)" id="<?php echo $val['sapid'];?>" title="View">
                          <i class="fa fa-eye fa-2x"></i>
                        </a>
                    </td>	
					<td>
						<a href="javascript:edit_router(<?php echo $val['sapid'];?>)" id="<?php echo $val['sapid'];?>" title="Edit">
                          <i class="fa fa-edit fa-2x"></i>
                        </a>
                    </td>
                    <td>
                        <a href="javascript:delete_router(<?php echo $val['sapid'];?>)" id="<?php echo $val['sapid'];?>" title="Delete">
                          <i class="fa fa-times fa-2x"></i>
                        </a>
                    </td>
                </tr>
                <?php
                  }
                ?>
                </tbody>
               
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  
	<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add New Router</h4>
              </div>
			  <form role="form" action="#" method="post">
              <div class="modal-body">
                 <!-- general form elements -->
					<div class="alert alert-danger print-error-msg" style="display:none"></div>
				  <div class="box box-primary">					
					<!-- form start -->					
					  <div class="box-body">
						<div class="form-group">
						  <label for="exampleInputEmail1">Host Name</label>
						  <input type="text" class="form-control" name="hostname" id="hostname" placeholder="Enter Host Name" maxlength="14" minlength="14" required autofocus>
						  <span style="color:red;"><?php echo form_error('hostname'); ?></span>
						</div>
						<div class="form-group">
						  <label for="exampleInputEmail1">Loopback</label>
						  <input type="text" class="form-control" name="loopback" id="loopback" placeholder="Enter Loopback" maxlength="15" minlength="7" pattern="^((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])$" onkeypress="return isNumberIP(event)" required>
						  <span style="color:red;"><?php echo form_error('loopback'); ?></span>
						</div>
						<div class="form-group">
						  <label for="exampleInputEmail1">MAC Address</label>
						  <input type="text" class="form-control" name="mac_address" id="mac_address" placeholder="Enter MAC Address" maxlength="17" minlength="17" required>
						  <span style="color:red;"><?php echo form_error('mac_address'); ?></span>
						</div>	
					  </div>
					  <!-- /.box-body -->					
				  </div>
				  <!-- /.box -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_btn">Save</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
	
	
	<div class="modal fade" id="modal-edit">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Router Details</h4>
              </div>
			  <form role="form" action="#" method="post">
			  <input type="hidden" name="e_sapid" id="e_sapid">
              <div class="modal-body">
                 <!-- general form elements -->
				 <div class="alert alert-danger print-error-msg-edit" style="display:none"></div>
				  <div class="box box-primary">					
					<!-- form start -->					
					  <div class="box-body">
						<div class="form-group">
						  <label for="exampleInputEmail1">Host Name</label>
						  <input type="text" class="form-control" name="hostname" id="e_hostname" placeholder="Enter Host Name" maxlength="14" minlength="14" required autofocus>
						  <span style="color:red;"><?php echo form_error('hostname'); ?></span>
						</div>
						<div class="form-group">
						  <label for="exampleInputEmail1">Loopback</label>
						  <input type="text" class="form-control" name="loopback" id="e_loopback" placeholder="Enter Loopback" maxlength="15" minlength="7" pattern="^((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.){3}(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])$" onkeypress="return isNumberIP(event)" required>
						  <span style="color:red;"><?php echo form_error('loopback'); ?></span>
						</div>
						<div class="form-group">
						  <label for="exampleInputEmail1">MAC Address</label>
						  <input type="text" class="form-control" name="mac_address" id="e_mac_address" placeholder="Enter MAC Address" maxlength="17" minlength="17" required>
						  <span style="color:red;"><?php echo form_error('mac_address'); ?></span>
						</div>	
					  </div>
					  <!-- /.box-body -->					
				  </div>
				  <!-- /.box -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update_btn">Save</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
	
	<div class="modal fade" id="modal-view">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">View Router Details</h4>
              </div>
			  <form role="form" action="#" method="post">
			  <input type="hidden" name="e_sapid" id="e_sapid">
              <div class="modal-body">
                 <!-- general form elements -->
				  <div class="box box-primary">					
					<!-- form start -->					
					  <div class="box-body">
						<div class="form-group">
						  <table class="table table-striped">
							<tbody>
							  <tr>
								<th>Host Name</th>
								<td id="v_hostname"></td>
							  </tr>
							  <tr>
								<th>Loopback</th>
								<td id="v_loopback"></td>
							  </tr>
							  <tr>
								<th>MAC Address</th>
								<td id="v_mac_address"></td>
							  </tr>
							</tbody>
						  </table>
						</div>
					  </div>
					  <!-- /.box-body -->					
				  </div>
				  <!-- /.box -->
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
			  </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
    </div>
	
	<script>
		$(document).ready(function(){			
			$("#save_btn").click(function() {
			var hostname = document.getElementById("hostname").value;				
			var loopback = document.getElementById("loopback").value;				
			var mac_address = document.getElementById("mac_address").value;				
			
			var regex = /^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$/;
			
			if(regex.test(mac_address) === false)
			{
				alert('please enter valid mac address');
				return false;
			}
			
			if(hostname !== '' && regex.test(mac_address) === true)
			{
				$.ajax({				
					type: 'POST',
					dataType: "json",
					url: '<?php echo base_url('index.php/admin/add_router_details');?>',						
					data: "hostname=" + hostname + "&loopback=" + loopback + "&mac_address=" + mac_address,	
					success: function (res)
					{	
						if(res==1)
						{
							alert('Added Successfully');
							$('#modal-default').modal('hide');	
							$("#router-table" ).load(window.location.href + " #router-table" );	
							document.getElementById('hostname').value='';
							document.getElementById('loopback').value='';
							document.getElementById('mac_address').value='';
						}
						else
						{
							$(".print-error-msg").css('display','block');
							$(".print-error-msg").html(res.error);
						}		
					}					
				}); 
			}	
			else
			{
				alert('All field compulsory');
			}
		
			});
		});
	</script>
	
	<script type="text/javascript">
		function delete_router(sapid)
		{    
			if(confirm('Sure To Delete This Entry ?'))
			{
				var sapid = sapid;					
				 $.ajax({				
					url: '<?php echo base_url('index.php/admin/delete_router');?>',	
					data:"sapid="+sapid,
					type:'POST',				
					success:function(data){	
						alert('record deleted successfully');
						$("#router-table" ).load(window.location.href + " #router-table" );	
							
						}	
					});			 
			}	
		}
	</script>
	
	<script type="text/javascript">
		function edit_router(sapid)
		{    
			var sapid = sapid;					
			 $.ajax({				
				url: '<?php echo base_url('index.php/admin/edit_router');?>',			
				data:"sapid="+sapid,
				type:'POST',				
				success:function(res){						

						var result = jQuery.parseJSON(res);					
						var arr = $.map(result, function (el) {								
							return el								
						});							
						var sapid = arr[0].sapid;
						var hostname = arr[0].hostname;							
						var loopback = arr[0].loopback;
						var mac_address = arr[0].mac_address;												
					
						$('#e_sapid').val(sapid);
						$('#e_hostname').val(hostname);
						$('#e_loopback').val(loopback);
						$('#e_mac_address').val(mac_address);		

						$('#modal-edit').modal('show');	
					}	
				});			 
		}
	</script>
	
	<script>
		$(document).ready(function(){			
			$("#update_btn").click(function() {
			var sapid = document.getElementById("e_sapid").value;				
			var hostname = document.getElementById("e_hostname").value;				
			var loopback = document.getElementById("e_loopback").value;				
			var mac_address = document.getElementById("e_mac_address").value;		

			var regex = /^([0-9A-F]{2}[:-]){5}([0-9A-F]{2})$/;
			
			if(regex.test(mac_address) === false)
			{
				alert('please enter valid mac address');
				return false;
			}	
			
			if(hostname !== '' && regex.test(mac_address) === true)
			{
				$.ajax({		
					dataType: "json",	
					type: 'POST',
					url: '<?php echo base_url('index.php/admin/update_router_details');?>',						
					data: "hostname=" + hostname + "&loopback=" + loopback + "&mac_address=" + mac_address + "&sapid=" + sapid,	
					success: function (res)
					{	
						if(res==1)
						{
							alert('update Successfully');
							$('#modal-edit').modal('hide');	
							$("#router-table" ).load(window.location.href + " #router-table" );	
							document.getElementById('hostname').value='';
							document.getElementById('loopback').value='';
							document.getElementById('mac_address').value='';
						}
						else
						{
							$(".print-error-msg-edit").css('display','block');
							$(".print-error-msg-edit").html(res.error);
						}		
					}					
				}); 
			}	
			else
			{
				alert('All field compulsory');
			}
		
			});
		});
	</script>
	
	<script type="text/javascript">
		function view_router(sapid)
		{    
			var sapid = sapid;					
			 $.ajax({				
				url: '<?php echo base_url('index.php/admin/edit_router');?>',	
				data:"sapid="+sapid,
				type:'POST',				
				success:function(res){						

						var result = jQuery.parseJSON(res);					
						var arr = $.map(result, function (el) {								
							return el								
						});							
						var sapid = arr[0].sapid;
						var hostname = arr[0].hostname;							
						var loopback = arr[0].loopback;
						var mac_address = arr[0].mac_address;												
						
						document.getElementById('v_hostname').innerHTML = hostname;	
						document.getElementById('v_loopback').innerHTML = loopback;	
						document.getElementById('v_mac_address').innerHTML = mac_address;	

						$('#modal-view').modal('show');	
					}	
				});			 
		}
	</script>
	
	<script>
		function isNumberIP(evt) 
		{
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 46 || charCode > 57)) {
				return false;
			}
			return true;
		}
	</script>
	
	<script>
		function isNumberMAC(evt) 
		{
			evt = (evt) ? evt : window.event;
			var charCode = (evt.which) ? evt.which : evt.keyCode;
			if (charCode > 31 && (charCode < 45 || charCode > 58)) {
				return false;
			}
			return true;
		}
	</script>
<?php $this->load->view('common/footer'); ?>

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>