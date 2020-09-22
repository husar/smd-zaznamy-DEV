<div class="page-content">
<?php
if(isset($_POST['submit'])){
	//$datum=date('Y/m/d', strtotime(str_replace('.', '-', $_POST['datum'])));
	$autor=1;
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
                                            <i class="fa fa-calendar"></i> Záznamy</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
									                                         <div class="table-responsive">
                                            <table class="table table-bordered">
                                               <thead>
                                                    <tr>
														<th>ID</th>
														<th>Položka</th>
														<th>Poznámka</th>
														
											
														  
														  <th>Dátum a čas záznamu</th>
														  <th>Pracovník</th>
														  
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												$page = (int) (!isset($parameter[2]) ? 1 : $parameter[2]);
												$limit = 50;
												$url="?modul=preskusanie-esd-naramkovej-zostavy-a-obuvi/zaznamy";
												$startpoint = ($page * $limit) - $limit;
												$c=$connect;
												if($user->isAdmin()){
													$statement = "esd_preskusanie_zaznamy";
												}
												else{
													$statement = "esd_preskusanie_zaznamy WHERE autor=".$_SESSION['user_id'];
												}
				
												
				
												$query_zaznamy="SELECT *,DATE_FORMAT(`datum`,'%d.%m.%Y %H:%i:%s') AS `datum_f` FROM ".$statement." ORDER BY id DESC LIMIT $startpoint, $limit";
												$apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
												?>
												<tr>
                                                        
														<td> <?php echo $result_zaznamy['id']; ?></td>
														<td> <?php echo $result_zaznamy['polozka']; ?></td>
														<td> <?php echo $result_zaznamy['poznamka']; ?></td>
														
													
                                                        <td> <?php echo $result_zaznamy['datum_f']; ?></td>
														<td> <?php echo $user->returnUserFullname($result_zaznamy['autor'],$connect); ?></td>
														
                                                       
                                                    </tr>
												<?php } ?>	
													
                                                </tbody>
                                            </table>
											<?php	echo "<center>".pagination($statement,$limit,$page,$url,$c)."</center>"; ?>
															
                                        </div>
								
                                       
									
                                    </div>
                                </div>
						
 </div>