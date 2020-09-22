<?php include "functions.php"; ?>

<div class="page-content">

<?php
    insertNewGroup();
?>
 <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-group"></i> Vytvoriť skupinu</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
									
								
                                       <form class="form-horizontal" role="form" method="POST" action="">
                                            <div class="form-body">
                                                
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Názov</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Názov" name="meno" value="<?php echo $_POST['meno']?>"  required="">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Popis</label>
                                                    <div class="col-md-9">
													
													<textarea class="form-control" size="16" type="text" placeholder="Popis" name="popis" required=""><?php echo $_POST['popis']?></textarea>    
                                                    
													</div>
														
                                                </div>
                                                                                       
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="submit">Zaznamenať</button>
                                            </div>
                                        </form>
									<div class="form-group">
                                                        
                                    </div>
                                </div>
						
 </div>