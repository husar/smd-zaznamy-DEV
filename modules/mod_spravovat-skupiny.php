<div class="page-content">
<?php
    
include "functions.php";    

if($user->isAdmin()){

?>


<?php } 
    
    deleteGroup();
    $meno="";
    $fromDate="";
    $toDate="";
    $zoradenie="";
    
        $meno = $_GET['meno'];
        $fromDate = $_GET['fromDate'];
        $toDate = $_GET['toDate'];
        $zoradenie = $_GET['zoradenie'];
    
    
    ?>
 <div class="portlet box blue">
                               <!-- //****************//
                                    //*****Filter*****//
                                    //****************//   -->
                              <div class="portlet box blue ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-search"></i> Vyhľadávanie
											</div>
                                      
                                    </div>
                                    
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form" method="get">
                                            <div class="form-body">
                                                <div class="form-group">
                                                     <input type="hidden" name="modul" value="spravovat-skupiny/zaznamy">
                                                    <div class="col-md-2">
                                                    Názov skupiny:
                                                    <input class="form-control" type="text" placeholder="Meno"  name="meno" value="<?php echo $meno ?>">		
													</div>
                                                   <div class="col-md-2">
                                                    Vytvorená v intervale medzi (od):
                                                    <input class="form-control" type="date" placeholder="Meno"  name="fromDate" value="<?php echo $fromDate ?>">
                                                    <div class="pull-right">
                                                        <button class="btn">x</button>
                                                    </div>			
													</div>
                                                    <div class="col-md-2">(do)  
                                                    <input class="form-control" type="date" placeholder="Meno"  name="toDate" value="<?php echo $toDate ?>">
                                                    <div class="pull-right">
                                                        <button class="btn">x</button>	
                                                    </div>		
													</div>
                                                    <div class="col-md-2">
                                                    Zoradiť podľa:
                                                    <select name="zoradenie" class="form-control">
                                                        <option value="id_skupiny" <?php echo ($zoradenie == "id_skupiny")? 'selected':'' ?>>ID skupiny</option>
                                                        <option value="menoBD" <?php echo ($zoradenie == "menoBD")? 'selected':'' ?>>Názov</option>
                                                        <option value="datum_pridania" <?php echo ($zoradenie == "datum_pridania")? 'selected':'' ?>>Dátum vytvorenia skupiny</option>
                                                        <option value="pocet_zamestnancov" <?php echo ($zoradenie == "pocet_zamestnancov")? 'selected':'' ?>>Počet zamestnancov v skupine</option>
                                                    </select>
                                                    </div>
                                                    <div class="form-group">
                                                    <!--<label class="col-md-2 control-label">Usporiadať</label>-->
                                                    <div class="col-md-2">
                                                    <br>
													    <input type="radio" name="srt" value="vzostupne" <?php echo ($_GET['srt'] != "zostupne")? 'checked':''?>> Vzostupne
                                                        <input type="radio" name="srt" value="zostupne" <?php echo ($_GET['srt'] == "zostupne")? 'checked':''?>> Zostupne
                   
													</div>
														
                                                </div>
                                                </div>
												
                                               
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="search">Vyhľadať</button>
                                            </div>
        
                                        </form>
                                    </div>
                                    
                                   
                                    
                                </div>
                               <!-- //****************//
                                    //*****Tabulka****//
                                    //****************//   -->
                        
                                       <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-calendar"></i> Záznamy</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    
                               <!-- //****************//
                                    //*S*parametrami**//
                                    //****************//   -->
                                    <?php
                                    $os_cislo = mysqli_real_escape_string($connect,$_GET['osobne_cislo']);
                                    $meno = mysqli_real_escape_string($connect,$_GET['meno']);
                                    $priezvisko = mysqli_real_escape_string($connect,$_GET['priezvisko']);
                                    
                                    if(!empty($_GET['meno']) || !empty($_GET['fromDate']) || !empty($_GET['toDate']) || !empty($_GET['zoradenie'])){
                                        $conditions=array();
                                    
     ?>
                                  
                                   <div class="portlet-body">
									                                         <div class="table-responsive">
                                            <table class="table table-bordered">
                                               <thead>
                                                    <tr>
														  <th>ID Skupiny</th>
														  <th>Názov skupiny</th>
														  <th>Popis</th>
                                                          <th>Dátum vzniku</th>
                                                          <th>Počet zamestnancov v skupine</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
                                                $page = (int) (!isset($parameter[2]) ? 1 : $parameter[2]);
                                                $limit = 1;
                                                $url="?meno=".$_GET['meno']."&fromDate=".$_GET['fromDate']."&toDate=".$_GET['toDate']."&zoradenie=".$_GET['zoradenie']."&id_skupiny=".$_GET['id_skupiny']."&srt=".$_GET['srt']."&modul=spravovat-skupiny/zaznamy/";
                                                $startpoint = ($page * $limit) - $limit;
                                                $c=$connect;   
																				
				                            if($_POST['zoradenie']=="pocet_zamestnancov"){
                                                $search_query="SELECT groups.*, COUNT(user_groups.osobne_cislo) AS pocet_zamestnancov FROM groups INNER JOIN user_groups ON groups.id_skupiny=user_groups.id_skupiny ";
                                            }else{
												$search_query="SELECT * FROM groups ";
                                            }
                                        if(!empty($_GET['meno'])){
                                            $conditions[]= "menoBD LIKE ('%".url_slug($_GET['meno'])."%')";
                                        }
                                        
                                        if(!empty($_GET['fromDate'])){
                                            $conditions[]= "datum_pridania >= '".$_GET['fromDate']."'";
                                        }
                                        if(!empty($_GET['toDate'])){
                                            $conditions[]= "datum_pridania <= '".$_GET['toDate']."'";
                                        }
                                        
                                        $sql=$search_query;
                                        $sqlForPagination="";
                                        
                                        if(count($conditions)>0){
                                            $sql.="WHERE ".implode(' AND ',$conditions); 
                                            $sqlForPagination.="WHERE ".implode(' AND ',$conditions); 
                                        }
                                        
                                        if(!empty($_GET['zoradenie'])){
                                            if($_GET['zoradenie']=="id_skupiny"){
                                                $sql.="ORDER BY ".$_GET['zoradenie'];
                                                $sqlForPagination.="ORDER BY ".$_GET['zoradenie'];
                                            }elseif($_GET['zoradenie']=="pocet_zamestnancov"){
                                                $sql.="GROUP BY user_groups.id_skupiny ORDER BY pocet_zamestnancov";
                                                $sqlForPagination.="GROUP BY user_groups.id_skupiny ORDER BY pocet_zamestnancov";
                                            }else{
                                                $sql.="ORDER BY LOWER(".$_GET['zoradenie'].")";
                                                $sqlForPagination.="ORDER BY LOWER(".$_GET['zoradenie'].")";
                                            }
                                        }
                                        
                                        if($_GET['srt']=='zostupne'){
                                            $sql.=" DESC";
                                            $sqlForPagination.=" DESC";
                                        }
                                        
                                        $sql.=" LIMIT $startpoint, $limit"; 

                                        $apply_zaznamy=mysqli_query($connect,$sql);
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
												?>
												<tr>
														<td> <?php echo $result_zaznamy['id_skupiny']; ?></td>
														<td> <?php echo $result_zaznamy['meno']; ?></td>
														<td> <?php echo $result_zaznamy['popis']; ?></td>
														<td> <?php echo $result_zaznamy['datum_pridania']; ?></td>
                                                   <td>
                                                    <?php 
                                                    $query = "SELECT COUNT(osobne_cislo) FROM user_groups WHERE id_skupiny = '".$result_zaznamy['id_skupiny']."'";
                                                    $result = mysqli_query($connect,$query);
                                                    $skuska=mysqli_fetch_array($result);
                                                    echo $skuska[0];?>
                                                       </td>                                                     
																												
														<td>
                                                            <form method="post"> 
                                                                
                                                                <input type="hidden" name="osobne_cislo" value="<?php echo $result_zaznamy['osobne_cislo'] ?>">
                                                                <button type="button" class="btn"  title="Zmazať zamestnanca" data-toggle="modal" data-target="#deleteModal" name="forDelete"   onclick="location.href='index.php?modul=spravovat-skupiny/zaznamy&id_skupiny=<?php echo $result_zaznamy['id_skupiny'] ?>&action=delete';"><i class="fa fa-trash" ></i></button>
                                                                
                                                                <button class="btn" type="submit" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $result_zaznamy['id_skupiny'] ?>&meno_skupiny=<?php echo $result_zaznamy['meno']?>"><i class="fa fa-edit"></i></button>
                                                            </form>
                                                            
                                                        </td>
                                                        
														
														
                                                       
                                                    </tr>
                                            
												<?php } ?>	
													
                                                </tbody>
                                            </table>
											<?php	echo "<center>".pagination_search("groups ".$sqlForPagination,$limit,$page,$url,$c)."</center>"; ?>
															
                                        </div>
								
                                       
									
                                    </div>
                                    <?php } else{?>
                                    
                               <!-- //****************//
                                    //*Bez*parametrov*//
                                    //****************//   -->
                                    <div class="portlet-body">
									                                         <div class="table-responsive">
                                            <table class="table table-bordered">
                                               <thead>
                                                    <tr>
														  <th>ID Skupiny</th>
														  <th>Názov skupiny</th>
														  <th>Popis</th>
                                                          <th>Dátum vzniku</th>
                                                          <th>Počet zamestnancov v skupine</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												$page = (int) (!isset($parameter[2]) ? 1 : $parameter[2]);
                                                $limit = 10;
                                                $url="?modul=spravovat-skupiny/zaznamy";
                                                $startpoint = ($page * $limit) - $limit;
                                                $c=$connect;							
				
												$query_zaznamy="SELECT * FROM groups LIMIT $startpoint, $limit";
												$apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
												?>
												<tr>
														<td> <?php echo $result_zaznamy['id_skupiny']; ?></td>
														<td> <?php echo $result_zaznamy['meno']; ?></td>
														<td> <?php echo $result_zaznamy['popis']; ?></td>
														<td> <?php echo $result_zaznamy['datum_pridania']; ?></td>
														<td>
                                                        <?php 
                                                        $query = "SELECT COUNT(osobne_cislo) FROM user_groups WHERE id_skupiny = '".$result_zaznamy['id_skupiny']."'";
                                                        $result = mysqli_query($connect,$query);
                                                        $skuska=mysqli_fetch_array($result);
                                                        echo $skuska[0];?>
                                                        </td>
												        <td>
                                                            <form method="post"> 
                                                                
                                                                <input type="hidden" name="id_skupiny" value="<?php echo $result_zaznamy['id_skupiny'] ?>">
                                                                <button type="button" class="btn"  title="Odstrániť skupinu" data-toggle="modal" data-target="#deleteModal" name="forDelete"   onclick="location.href='index.php?modul=spravovat-skupiny/zaznamy&id_skupiny=<?php echo $result_zaznamy['id_skupiny'] ?>&action=delete';"><i class="fa fa-trash" ></i></button>
                                                                
                                                                <button class="btn" type="submit" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $result_zaznamy['id_skupiny'] ?>&meno_skupiny=<?php echo $result_zaznamy['meno']?>&popis_skupiny=<?php echo $result_zaznamy['popis']?>"><i class="fa fa-edit"></i></button>
                                                            </form>
                                                            
                                                        </td>
                                                        
														
														
                                                       
                                                    </tr>
                                            
												<?php } ?>	
													
                                                </tbody>
                                            </table>
											<?php	echo "<center>".pagination("groups",$limit,$page,$url,$c)."</center>"; ?>
															
                                        </div>
								
                                       
									
                                    </div>
                                    <?php } ?>
                                </div>
						
 </div>
 <?php if($_GET['action']=="delete"){ ?>
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            Naozaj chcete odstrániť skupinu č. <?php echo $_GET['id_skupiny'] ?> zo systému?
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="id_skupiny" value="<?php echo $_GET['id_skupiny'] ?>">
                    <button type="submit" name="nothing" class="btn btn-secondary" formaction="index.php?modul=spravovat-skupiny/zaznamy">Zrušiť</button>
                    <button type="submit" name="delete" class="btn btn-primary" formaction="index.php?modul=spravovat-skupiny/zaznamy">Vymazať</button>
                </form>
          </div>
    </div>
  </div>
</div>
<?php } ?>
 <script type="text/javascript">
$(document).ready(function(){
    $('.modal').modal('show');
});
</script>