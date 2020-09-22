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
												<input type="hidden" name="modul" value="vyroba/cinova-vlna/zaznamy/export">
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
								<div class="portlet box blue ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-search"></i> Vyhľadávanie
											</div>
                                      
                                    </div>
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form">
                                            <div class="form-body">
                                                <div class="form-group">
												<input type="hidden" name="modul" value="vyroba/cinova-vlna/zaznamy">
                                                    
                                                    <div class="col-md-3">
                                                       
																	<input class="form-control" size="16" type="text" style="width:100%" placeholder="Text" id="search" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>"  required="">
																
													</div>
													
														<div class="col-md-3">
                                                        <div class="input-inline input-medium">
																<div class="input-group">
																<select class="input-group form-control form-control-inline" name="search_option" required>
																	<option value="">Vyhľadať podľa...</option>
																	<option value="1">Čísla modulu</option>
																	<option value="2">VP</option>
																</select>																

																</div>
															</div>
														</div>
                                                </div>
												
                                               
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue">Vyhľadať</button>
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
														  <th>Číslo modulu</th>
														  <th>VP</th>
														  <th>Počet</th>
														  <th>Č. modulov od-do</th>
														  <th>Os.č.</th>
														  <th>Dátum a čas záznamu</th>
														  <th>Pracovník</th>
														  
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												//**********
												$statement_part_a="";
												$statement_part_b="";
												$url_part="&";
												if(isset($_GET['search']) && isset($_GET['search_option'])){
													//if($_GET['search_option']==1){$statement_part_a=" WHERE cislo_modulu='".$_GET['search']."'"; $statement_part_b=" AND cislo_modulu='".$_GET['search']."'";}
													//if($_GET['search_option']==2){$statement_part_a=" WHERE vp='".$_GET['search']."'"; $statement_part_b=" AND vp='".$_GET['search']."'";}
													
													if($_GET['search_option']==1){$statement_part_a=" WHERE cislo_modulu LIKE('%".$_GET['search']."%')"; $statement_part_b=" AND cislo_modulu LIKE('%".$_GET['search']."%')";}
													if($_GET['search_option']==2){$statement_part_a=" WHERE vp  LIKE('%".$_GET['search']."%')"; $statement_part_b=" AND vp  LIKE('%".$_GET['search']."%')";}
													$url_part="search=".$_GET['search']."&search_option=".$_GET['search_option']."&";
												}
												//**********
												$page = (int) (!isset($parameter[3]) ? 1 : $parameter[3]);
												$limit = 50;
												$url="?".$url_part."modul=vyroba/cinova-vlna/zaznamy";
												$startpoint = ($page * $limit) - $limit;
												$c=$connect;
												if($user->isAdmin()){
													$statement = "vyroba_cinova_vlna_zaznamy".$statement_part_a;
												}
												else{
													$statement = "vyroba_cinova_vlna_zaznamy WHERE autor=".$_SESSION['user_id'].$statement_part_b;
												}
				
												
				
												$query_zaznamy="SELECT *,DATE_FORMAT(`datum`,'%d.%m.%Y %H:%i:%s') AS `datum_f` FROM ".$statement." ORDER BY id DESC LIMIT $startpoint, $limit";
												$apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
												?>
												<tr>
                                                        
														<td> <?php echo $result_zaznamy['id']; ?></td>
														<td> <?php echo $result_zaznamy['cislo_modulu']; ?></td>
														<td> <?php echo $result_zaznamy['vp']; ?></td>
														<td> <?php echo $result_zaznamy['pocet']; ?></td>
														<td> <?php echo $result_zaznamy['moduly_od_do']; ?></td>
														<td> <?php echo $result_zaznamy['os_cislo']; ?></td>
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