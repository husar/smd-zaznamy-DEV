<div class="page-content">
<?php
if(isset($_POST['submit'])){
	//$datum=date('Y/m/d', strtotime(str_replace('.', '-', $_POST['datum'])));
	$autor=$_SESSION['user_id'];
	$query_insert="INSERT INTO esd_preskusanie_zaznamy(polozka,poznamka,datum,autor) VALUES('".$_POST['polozka']."','".$_POST['poznamka']."',NOW(),'".$autor."')";
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
                                                    <label class="col-md-3 control-label">Položka ovládania ESD</label>
                                                    <div class="col-md-9">
													
													<select class="form-control" name="polozka" required>
														<option value="">Vyberte...</option>
														<option value="Podlaha">Podlaha</option>
														<option value="Pracovné plochy">Pracovné plochy</option>
														<option value="Tieniace vrecká">Tieniace vrecká</option>
														
													</select>
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Poznámka</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Poznámka" name="poznamka" value="" required="">
                                                        
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