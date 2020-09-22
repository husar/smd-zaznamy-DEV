<div class="page-content">
<?php
if(isset($_POST['submit'])){
	//$datum=date('Y/m/d', strtotime(str_replace('.', '-', $_POST['datum'])));
	$autor=$_SESSION['user_id'];
	$query_insert="INSERT INTO vyroba_osadzanie_smd_zaznamy(cislo_modulu,vp,pocet,datum,autor) VALUES('".$_POST['modul']."','".$_POST['vp']."','".$_POST['pocet']."',NOW(),'".$autor."')";
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
														
														<option value="u52400570">u52400570</option>
														<option value="u52400571">u52400571</option>
														<option value="u52400572">u52400572</option>
														<option value="u52400573">u52400573</option>
														<option value="u52400574">u52400574</option>
														<option value="u52400575">u52400575</option>
														<option value="u52400584">u52400584</option>
														<option value="u52400585">u52400585</option>
														<option value="u52400549">u52400549</option>
														<option value="u52400550">u52400550</option>
														<option value="u52400551">u52400551</option>
														<option value="u52400580">u52400580</option>
														<option value="u52400525">u52400525</option>
														
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
                                                    <label class="col-md-3 control-label">Počet ks</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Počet" name="pocet" value=""  required="">
                                                        
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