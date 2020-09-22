<div class="page-content">
<?php
if(isset($_POST['submit'])){
	//$datum=date('Y/m/d', strtotime(str_replace('.', '-', $_POST['datum'])));
	$autor=$_SESSION['user_id'];
	$query_insert="INSERT INTO oprava_modulov_zaznamy(cislo_modulu,vp,seriove_cislo,chyba,datum,autor) VALUES('".$_POST['modul']."','".$_POST['vp']."','".$_POST['seriove_cislo']."','".$_POST['chyba']."',NOW(),'".$autor."')";
	$apply_insert=mysqli_query($connect,$query_insert);
	if($apply_insert){
		echo '<div class="alert alert-success">Údaje boli zaznamenané.</div>';
	}
	else{echo '<div class="alert alert-danger">Údaje sa nepodarilo zaznamenať.</div>';}
}

?>
 <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-calendar"></i> Pridať záznam</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
									
								
                                       <form class="form-horizontal" role="form" method="POST" action="">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Číslo modulu</label>
                                                    <div class="col-md-9">
													
													<select class="form-control" name="modul" required>
														<option value="">Vyberte...</option>
														<option value="52409501">52409501</option>
														<option value="52409502">52409502</option>
														<option value="52409504">52409504</option>
														<option value="52409505">52409505</option>
														<option value="52409601">52409601</option>
														<option value="52409602">52409602</option>
														<option value="52409604">52409604</option>
														<option value="52409605">52409605</option>
														<option value="52409611">52409611</option>
														<option value="52409612">52409612</option>
													</select>
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">VP</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Výrobný príkaz" name="vp" value="" required="">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Sériové číslo</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Sériové číslo" name="seriove_cislo" value="">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Chyba / Spôsob opravy</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Chyba / Spôsob opravy" name="chyba" value=""  required="">
                                                        
													</div>
														
                                                </div>
												
												
												
                                               
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="submit">Zaznamenať</button>
                                            </div>
                                        </form>
									
                                    </div>
                                </div>
						
 </div>