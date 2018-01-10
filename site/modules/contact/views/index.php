<h2 class="heading">LIÊN HỆ</h2>
<div class=" contact_box col-lg-12 col-md-12 col-sm-12 col-xs-12">
<!--	<h1 class="title_imos"><?=$this->config->item('contact_name')?></h1>
			<table>
				<tbody><tr>
					<td style="width: 100px;"><b>Địa chỉ</b>: </td>
					<td><?=$this->config->item('contact_address')?> </td>
				</tr>
				<tr>
					<td><b>Email</b>: </td>
					<td><?=$this->config->item('contact_email')?></td>
				</tr>
				<tr>
					<td><b>Điện thoại</b>: </td>
					<td><?=$this->config->item('contact_phone')?> - Hotline: <?=$this->config->item('contact_hotline')?></td>
				</tr>
			</tbody></table>-->
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
           

			<div class="contact-form-box">
				<h2 class="title_imos">Gửi thông tin đến chúng tôi</h2>
				<!--ROW-->
				<?=form_open(base_url().uri_string(),array('class'=>'form_contact','id'=>'form_contact'))?>
				<?if(isset($message) && $message !=''){ echo '<div class="show_notice" id="msg">'.$message.'</div>';}?>
					<div class="row">
						<div class="col col-6">
							<label class="label">Họ tên</label>
							<label class="input">
								<i class="icon-append icon-user"></i>
								<input type="text" name="vdata[fullname]">
							</label>
						</div>
						<div class="col col-6">
							<label class="label">Email</label>
							<label class="input">
								<i class="icon-append icon-envelope-alt"></i>
								<input type="text" name="vdata[email]">
							</label>
						</div>	
					</div>
					<!--END ROW-->
					<div>
						<label class="label">Tiêu đề</label>
						<label class="input">
							<i class="icon-append icon-tag"></i>
							<input type="text" name="vdata[title]">
						</label>
					</div>
					<div>
						<label class="label">Nội dung</label>
						<label class="input">
							<i class="icon-append icon-comment"></i>
							<textarea rows="4" name="vdata[content]"></textarea>
						</label>
					</div>
					<button type="submit" class="bt_send button bnt_submit fr">Gửi Email</button>
				<?=form_close()?>						
			</div>
</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
 <?=$this->load->mod('chinhanh')?>

</div>