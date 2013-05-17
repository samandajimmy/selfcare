			<div id="content-wrap" class="right">
				<div id="content-body">
                	<h2>Profil</h2>  
                        
					<table class="cust-profile">
                        <tr>
                            <td class="label-field">Kode Pelanggan</td>
                            <td class="content-field"><?php echo set_value('customercode', isset($default['customercode']) ? $default['customercode'] : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="label-field">Nama Lengkap</td>
                            <td class="content-field"><?php echo set_value('customername', isset($default['customername']) ? $default['customername'] : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="label-field">Alamat</td>
                            <td class="content-field"><?php echo set_value('address', isset($default['address']) ? $default['address'] : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="label-field">Jenis Identitas / No Identitas</td>
                            <td class="content-field"><?php echo set_value('idtype', isset($default['idtype']) ? $default['idtype'] : ''); ?> / <?php echo set_value('idno', isset($default['idno']) ? $default['idno'] : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="label-field">Telepon</td>
                            <td class="content-field"><?php echo set_value('phone', isset($default['phone']) ? $default['phone'] : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="label-field">No HP</td>
                            <td class="content-field"><?php echo set_value('mobile', isset($default['mobile']) ? $default['mobile'] : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="label-field">E-mail</td>
                            <td class="content-field"><?php echo set_value('email', isset($default['email']) ? $default['email'] : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="label-field">Alamat Penagihan</td>
                            <td class="content-field"><?php echo set_value('billing', isset($default['billing']) ? $default['billing'] : ''); ?></td>
                        </tr>
                        <tr>
                            <td class="label-field">Terakhir Perubahan Paket</td>
                            <td class="content-field"><?php echo set_value('lastupdate', isset($default['lastupdate']) ? $default['lastupdate'] : ''); ?></td>
                        </tr>
                    </table>    
                    
                    <div id="util"><a id="pass-change" href="#" class="edit">Change Password</a></div> 
                    
                    <div id="pass-form" class="hidden">
                        <form name="frmuser" method="post" action="<?php //echo $form_action; ?>">
                            <table class="cust-profile">
                                <tr>
                                    <td class="label-field">Current Password :</td>
                                    <td class="content-field"><input type="password" name="curr-pass" size="15" value="" /></td>
                                </tr>
                                <tr>
                                    <td class="label-field">New Password :</td>
                                    <td class="content-field"><input type="password" name="new-pass" size="15" value="" /></td>
                                </tr>
                                <tr>
                                    <td class="label-field">Confirm Password :</td>
                                    <td class="content-field"><input type="password" name="confirm-pass" size="15" value="" /></td>
                                </tr>
                            </table>
                            <input type="submit" name="submit-pass" value="Save" />
                        </form>
                        
                    </div> 
				</div>	
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>