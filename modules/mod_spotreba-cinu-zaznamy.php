<div class="page-content">
<?php
if($user->isAdmin()){

?>
<div class="portlet box blue ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-download"></i> Export záznamov
											</div>
                                      
                                    </div>
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-body">
                                                <div class="form-group">
												<input type="hidden" name="modul" value="spotreba-cinu/zaznamy/export">
                                                    <label class="col-md-3 control-label">Vyberte obdobie</label>
                                                    <div class="col-md-3">
                                                        <div class="input-inline input-medium">
																<div class="input-group">
																	<span class="input-group-addon">
																														<i class="fa fa-calendar"></i>
																													</span>

																	<input class="input-group form-control form-control-inline date date-picker" size="16" type="text" placeholder="Dátum od" id="od" name="datum_od" value="" data-date-format="dd.mm.yyyy" required="">
																</div>
															</div>
													</div>
														<div class="col-md-3">
                                                        <div class="input-inline input-medium">
																<div class="input-group">
																	<span class="input-group-addon">
																														<i class="fa fa-calendar"></i>
																													</span>

																	<input class="input-group form-control form-control-inline date date-picker" size="16" type="text" placeholder="Dátum do" id="do" name="datum_do" value="" data-date-format="dd.mm.yyyy" required="">
																</div>
															</div>
														</div>
                                                </div>
												
                                               
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue">Potvrdiť</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
<?php } ?>
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
														  <th>Doplnený cín</th>
														  <th>Odobratá struska</th>
														  <th>Poznámka</th>
														  
														  <th>Dátum a čas záznamu</th>
														  <th>Pracovník</th>
														  
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												$page = (int) (!isset($parameter[2]) ? 1 : $parameter[2]);
												$limit = 50;
												$url="?modul=spotreba-cinu/zaznamy";
												$startpoint = ($page * $limit) - $limit;
												$c=$connect;
												if($user->isAdmin()){
													$statement = "spotreba_cinu_zaznamy";
												}
												else{
													$statement = "spotreba_cinu_zaznamy WHERE autor=".$_SESSION['user_id'];
												}
				
												
				
												$query_zaznamy="SELECT *,DATE_FORMAT(`datum`,'%d.%m.%Y %H:%i:%s') AS `datum_f` FROM ".$statement." ORDER BY id DESC LIMIT $startpoint, $limit";
												$apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
												?>
												<tr>
                                                        
														<td> <?php echo $result_zaznamy['id']; ?></td>
														<td> <?php echo $result_zaznamy['doplneny_cin']; ?></td>
														<td> <?php echo $result_zaznamy['odobrata_struska']; ?></td>
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