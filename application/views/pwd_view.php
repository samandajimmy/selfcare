			<div class="page">
            	<section class="content-section">
            		<header>Edit Profile</header>
                    <div class="content-body">
                        <div id="pass-form" class="content-view">
                        <?php 
                            $form = array('name' => 'password_form');
                            echo form_open('customer_control/update_profile',$form);						
                            $curpwd = array('name'=>'curr-pass', 'maxlength'=> '50','size'=> '20','value'=>'');
                            $newpwd = array('name'=>'new-pass', 'maxlength'=> '50','size'=> '20','value'=>'');
                            $confpwd = array('name'=>'confirm-pass', 'maxlength'=> '50','size'=> '20','value'=>'');
                            $login = array('name'=>'button-save','value'=>'Simpan');
							
							$email = array('name'=>'email', 'maxlength'=> '100','size'=> '30',
								'value'=>isset($default['email']) ? $default['email'] : '');
							$hp = array('name'=>'hp', 'maxlength'=> '50','size'=> '30',
								'value'=>isset($default['hp']) ? $default['hp'] : '');
                        ?>  
                        	<div id="util">
                            	<?=form_submit($login)?> &nbsp; <input type="button" value="Batal" onclick="window.open('<?=base_url();?>customer_control','_self','resizable=yes')"/>
                            </div>
                                         
                            <fieldset class="form-set" >
                                <legend >Edit Profil</legend>
                                <table class="profile-data" cellspacing="10">
                                <tr class="full-row">
                                    <td colspan="2"><span class="tx-red"><?=$err_msg?></span></td>
                                </tr>
                                    <tr>
                                        <td class="label-field">Email</td>
                                        <td class="content-field"><?=form_input($email)?> <span style="font-size:10px; font-weight:normal;">Contoh: myemail@mail.com</span></td>
                                    </tr>
                                    <tr>
                                        <td class="label-field">Nomor Ponsel</td>
                                        <td class="content-field"><?=form_input($hp)?> <span style="font-size:10px; font-weight:normal;">Contoh: 08123456789</span></td>
                                    </tr>
                                    <?php /*?><tr>
                                        <td class="label-field"></td>
                                        <td class="content-field"><?=form_submit($login)?> &nbsp; 
                                            <input type="button" value="Cancel" onclick="window.open('<?=base_url();?>welcome','_self','resizable=yes')"/>
                                        </td>
                                    </tr><?php */?>
                                </table>
                            </fieldset>
                            
                            <fieldset class="form-set">
                            	<legend>Ganti Password</legend>
                            	<table class="profile-data" cellspacing="10">
                                    <tr>
                                        <td class="label-field">Password Saat Ini</td>
                                        <td class="content-field"><?=form_password($curpwd)?></td>
                                    </tr>
                                    <tr>
                                        <td class="label-field">Password Baru</td>
                                        <td class="content-field"><?=form_password($newpwd)?></td>
                                    </tr>
                                    <tr>
                                        <td class="label-field">Konfirmasi Password</td>
                                        <td class="content-field"><?=form_password($confpwd)?></td>
                                    </tr>
                                </table>
                            </fieldset>
                         <?=form_close()?>  
                        </div>
                        
                        
                        <div class="tx-black" style="font-size:12px; width:95%; margin:0 auto; background:#EFEFEF; padding:20px;">Alamat email dan nomor telepon Anda akan digunakan untuk mengirimkan informasi terkini mengenai tagihan, promo, event, dan layanan lainnya dari CEPATnet.</div>
                    </div>	    
            	</section>    
			</div>