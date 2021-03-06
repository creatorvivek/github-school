

<div class="row">
	<div class="col-md-5">

		<div class="card card-default">
			<div class="card-header">
				<h3 class="card-title">ADD VEHICLE</h3>


			</div>
			<!-- /.card-header -->
			<div class="card-body">




				<?= form_open_multipart('transport/add_vehicle_process',array("class"=>"form-horizontal","id"=>"form_validation")); ?>
				<div class="row">
					
        			<div class="col-md-9">
						<div class="form-group">
							<label for="vehicle_no" class="col-md-12 control-label"><span class="text-danger">*</span> Vehicle No.</label>
							<input type="text" name="vehicle_no" value="<?= $this->input->post('vehicle_no'); ?>" class="form-control" id="vehicle_no"  autofocus  required/>
							<span class="text-danger"><?= form_error('vehicle_no');?></span>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<label for="seats" class="col-md-12 control-label"><span class="text-danger">*</span>No of seats</label>
							<input type="text" name="seats" value="<?= $this->input->post('seats'); ?>" class="form-control" id="seats" s  required/>
							<span class="text-danger"><?= form_error('seats');?></span>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<label for="person" class="col-md-12 control-label"><span class="text-danger">*</span>contact person</label>
							<input type="text" name="person" value="<?= $this->input->post('person'); ?>" class="form-control" id="person"   required/>
							<span class="text-danger"><?= form_error('person');?></span>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<label for="mobile" class="col-md-12 control-label"><span class="text-danger">*</span>contact person mobile</label>
							<input type="text" name="mobile" value="<?= $this->input->post('mobile'); ?>" class="form-control" id="mobile"   required/>
							<span class="text-danger"><?= form_error('mobile');?></span>
						</div>
					</div>
					<div class="col-md-9">
						<div class="form-group">
							<label for="track_id" class="col-md-12 control-label">Track id</label>
							<input type="text" name="track_id" value="<?= $this->input->post('track_id'); ?>" class="form-control" id="track_id"  />
							<span class="text-danger"><?= form_error('track_id');?></span>
						</div>
					</div>
        		</div>
        <div class="form-group">
        	<div class="col-sm-offset-4 col-sm-8">
        		<button type="submit" class="btn btn-success">ADD</button>
        	</div>
        </div>

        <?= form_close(); ?>
    </div>
</div>
</div>



<div class="col-md-7">
	<div class="card">
            <div class="card-header">
                <h3 class="card-title">Vehicle List</h3>
                
            </div>
<div class="card-body">
  <div class="table-responsive">
<table id="vehicle_table" class="table  table-bordered table-hover">
    <thead>
    <tr>
    	<th>Vehicle no</th>
    	<th>No of seats</th>
    	<th>track id</th>
    	<th>contact person</th>
    	<th>person mobile</th>
    </tr>
</thead>
<tbody>
	<?php foreach($vehicle as $row) { ?>
		<tr>
			<td><?= $row['vehicle_no'] ?></td>
			<td><?= $row['seats'] ?></td>
			<td><?= $row['track_id'] ?></td>
			<td><?= $row['person'] ?></td>
			<td><?= $row['person_mobile'] ?></td>

		</tr>
	<?php } ?>
</table>
</div>
</div>
</div>
</div>
</div>















</div>

<!-- <script src="<?= base_url() ?>assets/admin/plugins/jqueryui/jquery-ui.min.js"></script> -->
<script src="<?= base_url() ?>assets/admin/plugins/jquery-validation/jquery.validate.js"></script>
<script src="<?= base_url() ?>assets/admin/js/form_validation.js"></script>

<script type="text/javascript">
	 $(document).ready( function () {
        $('#vehicle_table').DataTable();
    } );




  


</script>