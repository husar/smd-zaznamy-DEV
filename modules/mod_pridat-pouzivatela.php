<?php include "functions.php"; ?>

<div class="page-content">

<?php
    insertNewEmployee();
?>
 <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-user"></i> Pridať používateľa</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
									
								
                                       <form class="form-horizontal" role="form" method="POST" action="">
                                            <div class="form-body">
                                                
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Osobné číslo</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Osobné číslo" name="osobne_cislo" value="<?php echo $_POST['osobne_cislo']?>" required pattern="[0-9]+">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Meno</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Meno" name="meno" value="<?php echo $_POST['meno']?>"  required="">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Priezvisko</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Priezvisko" name="priezvisko" value="<?php echo $_POST['priezvisko']?>"  required="">
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Email</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="email" placeholder="Email" name="email" value="<?php echo $_POST['email']?>"  >
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Číslo karty</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Číslo karty" name="cislo_karty" value="<?php echo $_POST['cislo_karty']?>" required pattern="[0-9]+">
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">LDAP</label>
                                                    <div class="col-md-9">
                                                    <br>
													    <input type="radio" id="ano" name="ldap" value="1" <?php echo ($_POST['ldap'] ==1)? 'checked':''?>>
                                                        <label for="ano">Áno</label>
                                                        <input type="radio" id="nie" name="ldap" value="2" <?php echo ($_POST['ldap'] !=1)? 'checked':''?>>
                                                        <label for="nie">Nie</label><br>
                   
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Aktívny používateľ</label>
                                                    <div class="col-md-9">
                                                    <br>
													    <input type="radio" id="aktivny" name="active" value="1" <?php echo ($_POST['active'] !=2)? 'checked':''?>>
                                                        <label for="aktivny">Aktívny</label>
                                                        <input type="radio" id="neaktivny" name="active" value="2" <?php echo ($_POST['active'] ==2)? 'checked':''?>>
                                                        <label for="neaktivny">Neaktívny</label><br>
                   
													</div>
														
                                                </div>
                                                
																				
				
												
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Skupina</label>
                                                    
                                                    <div class="col-md-9">
                                                    <br>
                                                    <?php
                                                    $query_zaznamy="SELECT * FROM groups";
												$apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){?>
												
													    <input type="checkbox" id="<?php echo $result_zaznamy['id_skupiny'] ?>" name="check[]" value="<?php echo $result_zaznamy['id_skupiny']?>" <?php echo in_array($result_zaznamy['id_skupiny'],$_POST['check'])?"checked":""?>>
                                                        <label for="<?php echo $result_zaznamy['id_skupiny']?>"><?php echo $result_zaznamy['meno']?></label>
                                
                                              <?php  }?>
                   
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Heslo</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Heslo" name="heslo" value="<?php echo isset($_POST['heslo'] )?$_POST['heslo']:randomPassword() ?>"  >
                                                       <br>
                                                        
													</div>
                                                   
                                                </div>
                                                                                       
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="submit">Zaznamenať</button>
                                            </div>
                                            <div class="form-actions right1">
                                                
                                            </div>
                                        </form>
									<div class="form-group">
                                                        
                                    </div>
                                </div>
						
 </div>