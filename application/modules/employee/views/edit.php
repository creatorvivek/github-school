<div class="row">
  <div class="col-md-6 col-sm-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">EMPLOYEE EDIT</h3>
        <div class="card-tools pull-right">
          <a href="<?php echo site_url('employee/add'); ?>" class="btn btn-success">Add</a>
        </div>
      </div>
      <div class="card-body">



<?= form_open_multipart('employee/edit/'.$employee['id'],array("class"=>"form-horizontal")); ?>

	<div class="form-group">
		<label for="employee_Name" class="col-md-10 control-label"><span class="text-danger">*</span>Employee Name</label>
		<div class="col-md-10">
			<input type="text" name="employee_Name" value="<?= ($this->input->post('employee_Name') ? $this->input->post('employee_Name') : $employee['name']); ?>" class="form-control" id="employee_Name"  autofocus />
			<span class="text-danger"><?= form_error('employee_Name');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="type" class="col-md-10 control-label"><span class="text-danger">*</span>Employee type</label>
		<div class="col-md-10">
			<!-- <input type="text" name="type" value="<?= $this->input->post('type'); ?>" class="form-control" id="type" /> -->
			<select name="type" class="form-control" id="type">
				<?php foreach($emptype as $row) {
									if($row->id==$employee['id']){ ?>
										<option value="<?= $employee['id'] ?>" selected ><?= $employee['authentication_id'] ?> </option>
										<?php

									}else{
										?>

										<option value="<?= $row['id'] ?>"><?=  $row['type']     ?></option>

									<?php }} ?> 
		</select>
			<span class="text-danger"><?= form_error('type');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="qualification" class="col-md-10 control-label"><span class="text-danger">*</span>Qualification</label>
		<div class="col-md-10">
			<input type="text" name="qualification" value="<?= ($this->input->post('qualification') ? $this->input->post('qualification') : $employee['qualification']); ?>" class="form-control" id="qualification" />
			<span class="text-danger"><?= form_error('qualification');?></span>
		</div>
	</div>
	
	<div class="form-group">
		<label for="email" class="col-md-10 control-label">Email</label>
		<div class="col-md-10">
			<input type="text" name="email" maxlength="13" value="<?= ($this->input->post('email') ? $this->input->post('email') : $employee['email']); ?>" class="form-control" id="email" />
			<span class="text-danger"><?= form_error('email');?></span>
		</div>
	</div>
	
	<div class="form-group">
		<label for="mobile" class="col-md-10 control-label">Mobile</label>
		<div class="col-md-10">
			<input type="text" name="mobile" value="<?= ($this->input->post('mobile') ? $this->input->post('mobile') : $employee['mobile']); ?>" class="form-control" id="mobile" />
			<span class="text-danger"><?= form_error('mobile');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="profile_image" class="col-md-10 control-label">Profile Image</label>
		<div class="col-md-10">
			<input type="file" name="profile_image"  class="form-control" id="profile_image" />
			<span class="text-danger"><?= form_error('profile_image');?></span>
		<?php	if (isset($error)) { ?>
		<span class="text-danger"><?= $error ?></span>

	<?php }	 ?>
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="col-md-10 control-label"><span class="text-danger">*</span>Permanent Address</label>
		<div class="col-md-10">
			<textarea name="paddress" class="form-control" id="address"><?= ($this->input->post('paddress') ? $this->input->post('paddress') : $employee['permanent_address']); ?></textarea>
			<span class="text-danger"><?= form_error('paddress');?></span>
		</div>
	</div>
	<div class="form-group">
		<label for="address" class="col-md-10 control-label"><span class="text-danger">*</span>Corresponding Address</label>
		<div class="col-md-10">
			<textarea name="taddress" class="form-control" id="taddress"><?= ($this->input->post('taddress') ? $this->input->post('taddress') : $employee['temporary_address']); ?></textarea>
			<span class="text-danger"><?= form_error('taddress');?></span>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-10 col-sm-10">
			<button type="submit" class="btn btn-success">Save</button>
        </div>
	</div>
	
<?= form_close(); ?>
</div>
</div>
</div>
</div>
