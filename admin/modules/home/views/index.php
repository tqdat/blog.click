<?=form_open(base_url().uri_string(),array('id'=>'admin_login'))?>
<div class="msg">
	<? if($msg != ''){ echo $msg;}?> 
	<?=$this->session->get_flashdata('message')?>
</div>
<form action="../../index2.html" method="post">
	<div class="form-group has-feedback">
		<input type="text" class="form-control" value="<?=set_value('username')?>" name="username" placeholder="Tên đăng nhập"/>
		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	</div>
	<div class="form-group has-feedback">
		<input type="password" class="form-control" name="password" placeholder="Mật khẩu"/>
		<span class="glyphicon glyphicon-lock form-control-feedback"></span>
	</div>
	<div class="row">
		<div class="col-xs-8">    
		</div><!-- /.col -->
		<div class="col-xs-4">
			<button type="submit" class="btn btn-primary btn-block btn-flat">Đăng nhập</button>
		</div><!-- /.col -->
	</div>
</form>
<a href="#">I forgot my password</a><br>
<?=form_close()?>

