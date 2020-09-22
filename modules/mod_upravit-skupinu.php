<?php 
include "functions.php"; 
//include "mod_spravovat-pouzivatelov.php";      
?>

<div class="page-content">

<?php
    deleteFromUserGroup();
    insertToGroup();
    $IDactualGroup = $_GET['id_skupiny'];
    $groupData=showGroupsData();
    $groupsData = array();
    $groupsData=showUsersGroups();
    print_r($allUserGroups);
    editGroup();
    //$IDactualGroup = $groupData['id_skupiny'];
    if(isset($_POST['update']) || $_POST['search']){
        $groupData['meno'] = $_POST['meno'];
        $groupData['popis'] = $_POST['popis'];
    }
    if(isset($_POST['editGroup'])){
        $groupData=showGroupsData();
        $groupsData=showUsersGroups();
    }
    
?>

 <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-edit"></i>Upraviť záznamy o skupine</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
									
								
                                       <form class="form-horizontal" role="form" method="POST" action="">
                                            <div class="form-body">
                                                
												<div class="form-group">
                                                    <label class="col-md-3 control-label">ID skupiny</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="number" placeholder="ID skupiny" name="id_skupiny" value=<?php echo $IDactualGroup; ?> required min="0" readonly="true">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Názov</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Názov" name="meno" value="<?php echo $groupData['meno'] ?>"  required="">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Popis</label>
                                                    <div class="col-md-9">
													
													<textarea class="form-control" size="16" type="text" placeholder="Popis" name="popis" required="">
<?php echo $groupData['popis']; ?>
                                                    </textarea>
                                                        
													</div>                                                                                       
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" title="Upraviť info o zamestnancovi" name="update" data-toggle="modal" data-target="#updateModal" >Upraviť</button>
                                            </div>
                                             <?php if(isset($_POST['update'])){ ?>
 <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            Chcete uložiť vykonané zmeny?
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="id_skupiny" value="<?php echo $_POST['id_skupiny'] ?>">
                    <input type="hidden" name="meno" value="<?php echo $groupData['meno'] ?>">
                    <textarea style="display:none;" name="popis" ><?php echo $groupData['popis']; ?></textarea>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                    <button type="submit" name="editGroup" class="btn btn-primary">Prepísať</button>
                </form>
          </div>
    </div>
  </div>
</div>
                                           </div>
<?php } ?>
                                        </form>
									<div class="form-group">
                                                        
                                    </div>
                                </div>
						
 </div>
 
 <!-- //****************//
                                    //*****Filter*****//
                                    //****************//   -->
                              <div class="portlet box blue ">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class='fa fa-cloud-upload'></i> Pridať zamestnanca do tejto skupiny
											</div>
                                      
                                    </div>
                                    
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form" method="post">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    
                                                    <div class="col-md-2">
                                                    Osobné číslo:
                                                    <input class="form-control" type="text" placeholder="Osobne číslo"  name="os_cis" pattern="[0-9]+" value="<?php echo $os_cis ?>">		
													</div>
                                                    <div class="col-md-2">
                                                    Meno:
                                                    <input class="form-control" type="text" placeholder="Meno"  name="meno" value="<?php echo $meno ?>">		
													</div>
                                                    <div class="col-md-2">
                                                    Priezvisko:
                                                    <input class="form-control" type="text" placeholder="Priezvisko"  name="priezvisko" value="<?php echo $priezvisko ?>">		
													</div>
                                                    <div class="col-md-2">
                                                    LDAP:
                                                    <select name="ldap" class="form-control">
                                                        <option value="" >LDAP</option>
                                                        <option value="1" <?php echo ($ldap ==1)? 'selected':'' ?>>Áno</option>
                                                        <option value="2" <?php echo ($ldap ==2)? 'selected':'' ?>>Nie</option>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                    Aktívny:
                                                    <select name="aktivny" class="form-control">
                                                        <option value="" >Aktívny používateľ</option>
                                                        <option value="1" <?php echo ($aktivny ==1)? 'selected':'' ?>>Áno</option>
                                                        <option value="2" <?php echo ($aktivny ==2)? 'selected':'' ?>>Nie</option>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                    Zoradiť podľa:
                                                    <select name="zoradenie" class="form-control">
                                                        <option value="" >Zoradiť podľa</option>
                                                        <option value="osobne_cislo" <?php echo ($zoradenie == "osobne_cislo")? 'selected':'' ?>>Osobné číslo</option>
                                                        <option value="menoBD" <?php echo ($zoradenie == "menoBD")? 'selected':'' ?>>Meno</option>
                                                        <option value="priezviskoBD" <?php echo ($zoradenie == "priezviskoDB")? 'selected':'' ?>>Priezvisko</option>
                                                    </select>
                                                    </div>
                                                    <input type="hidden" name="id_skupiny" value="<?php echo $IDactualGroup ?>">
                                                </div>
												
                                               
                                            </div>
                                            <div class="form-actions right1">
                                                
                                                <button type="submit" class="btn blue" name="search" >Vyhľadať</button>
                                            </div>
        
                                        </form>
                                    </div>
                                    
                                   
                                    
                                </div>
                               <!-- //****************//
                                    //*****Tabulka****//
                                    //****************//   -->                                  
                               <!-- //****************//
                                    //*S*parametrami**//
                                    //****************//   -->
                                    
                                    <?php
                                    $os_cislo = mysqli_real_escape_string($connect,$_POST['osobne_cislo']);
                                    $meno = mysqli_real_escape_string($connect,$_POST['meno']);
                                    $priezvisko = mysqli_real_escape_string($connect,$_POST['priezvisko']);
                                    
                                    if(!empty($_POST['os_cis']) || !empty($_POST['meno']) || !empty($_POST['priezvisko']) || !empty($_POST['ldap']) || !empty($_POST['aktivny']) || !empty($_POST['zoradenie'])){
                                        $conditions=array();
                                    
     ?>
                                 <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-calendar"></i>Ďalší zamestnanci</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                  
                                   <div class="portlet-body">
									                                         <div class="table-responsive">
                                            <table class="table table-bordered">
                                               <thead>
                                                    <tr>
														  <th>Osobné číslo</th>
														  <th>Meno</th>
														  <th>Priezvisko</th>
                                                          <th>Email</th>
                                                          <th>LDAP</th>
                                                          <th>Aktívny</th>
                                                          <th>Skupiny</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
																				
				                                                                            
												$search_query="SELECT * FROM employees ";
                                        
                                        if(!empty($_POST['os_cis'])){
                                            $conditions[]= "osobne_cislo LIKE ('%".$_POST['os_cis']."%')";
                                        }
                                        
                                        if(!empty($_POST['meno'])){
                                            $conditions[]= "menoBD LIKE ('%".url_slug($_POST['meno'])."%')";
                                        }
                                        
                                        if(!empty($_POST['priezvisko'])){
                                            $conditions[]= "priezviskoBD LIKE ('%".url_slug($_POST['priezvisko'])."%')";
                                        }
                                        
                                        if(!empty($_POST['ldap'])){
                                            $conditions[]= "ldap = '".$_POST['ldap']."'";
                                        }
                                        
                                        if(!empty($_POST['aktivny'])){
                                            $conditions[]= "aktivny = '".$_POST['aktivny']."'";
                                        }
                                        
                                        $sql=$search_query;
                                        
                                        if(count($conditions)>0){
                                            $sql.="WHERE ".implode(' AND ',$conditions);    
                                        }
                                        
                                        if(!empty($_POST['zoradenie'])){
                                            if($_POST['zoradenie']=="osobne_cislo"){
                                                $sql.="ORDER BY ".$_POST['zoradenie'];
                                            }else{
                                                $sql.="ORDER BY LOWER(".$_POST['zoradenie'].")";
                                            }
                                        }
                                        
                                        $apply_zaznamy=mysqli_query($connect,$sql);
                                        
                                        
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
                                                    
												?>
												<tr>
														<td> <?php echo $result_zaznamy['osobne_cislo']; ?></td>
														<td> <?php echo $result_zaznamy['meno']; ?></td>
														<td> <?php echo $result_zaznamy['priezvisko']; ?></td>
														<td> <?php echo $result_zaznamy['email']; ?></td>
														<td> <?php echo ($result_zaznamy['ldap']==1)?"&#9989":"&#10060" ?></td>
														<td> <?php echo ($result_zaznamy['aktivny']==1)?"&#9989":"&#10060" ?></td>
														<td>
                                                        <?php
                                                        $query_groups="SELECT meno FROM groups INNER JOIN user_groups ON groups.id_skupiny=user_groups.id_skupiny WHERE user_groups.osobne_cislo='".$result_zaznamy['osobne_cislo']."';";
												        $apply_groups=mysqli_query($connect,$query_groups);
												        while($result_groups=mysqli_fetch_array($apply_groups)){
                                                            $isInGroup = mysqli_fetch_array($apply_isInGroup); 
                                                            echo "[ ".$result_groups['meno']." ] ";
												        }?>
                                                        </td>
														
														<td>
                                                            <form method="post"> 
                                                                
                                                                <input type="hidden" name="osobne_cislo" value="<?php echo $result_zaznamy['osobne_cislo'] ?>">
                                                                <?php
                                                            
                                                                $queryna="SELECT id_skupiny FROM user_groups WHERE osobne_cislo = '".$result_zaznamy['osobne_cislo']."'";
                                                                $apply_zaz = mysqli_query($connect, $queryna);
                                                                $allGroups = array();
                                                                while($result_zaz=mysqli_fetch_array($apply_zaz)){
                                                                    array_push($allGroups,$result_zaz['id_skupiny']);
                                                                }
                                        
                                                                if(in_array($_GET['id_skupiny'],$allGroups)){
                                                                ?>
                                                                <button type="button" class="btn"  title="Odstrániť zo skupiny" data-toggle="modal" data-target="#deleteFromGroupModal" name="forDelete"   onclick="location.href='index.php?modul=upravit-skupinu/vlozit-zaznam&os_cis=<?php echo $result_zaznamy['osobne_cislo'] ?>&id_skupiny=<?php echo $_GET['id_skupiny']?>&operation=delete';"><i class="fa fa-trash" ></i></button>
                                                                <?php }else{ ?>
                                                                <button type="button" class="btn"  title="Pridať do skupiny" data-toggle="modal" data-target="#insertToGroupModal" name="forInsert"   onclick="location.href='index.php?modul=upravit-skupinu/vlozit-zaznam&os_cis=<?php echo $result_zaznamy['osobne_cislo'] ?>&id_skupiny=<?php echo $_GET['id_skupiny']?>&operation=edit';"><i class="fa fa-arrow-right"></i></button>
                                                                <?php } ?>
                                                            </form>
                                                            
                                                        </td>
                                                        
														
														
                                                       
                                                    </tr>
                                            
												<?php } ?>	
													
                                                </tbody>
                                            </table>
											<?php	echo "<center>".pagination($statement,$limit,$page,$url,$c)."</center>"; ?>
															
                                        </div>
								
                                       
									
                                    </div>
                                    <?php } else{?>
                                    <!-- //****************//
                                    //*Bez*parametrov*//
                                    //****************//   -->
                                    
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-calendar"></i>Zamestnanci tejto skupiny</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    
                                    <div class="portlet-body">
									                                         <div class="table-responsive">
                                            <table class="table table-bordered">
                                               <thead>
                                                    <tr>
														  <th>Osobné číslo</th>
														  <th>Meno</th>
														  <th>Priezvisko</th>
                                                          <th>Email</th>
                                                          <th>LDAP</th>
                                                          <th>Aktívny</th>
                                                          <th>Skupiny</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
																				
				
												$query_zaznamy="SELECT * FROM employees INNER JOIN user_groups ON employees.osobne_cislo=user_groups.osobne_cislo WHERE user_groups.id_skupiny=".$IDactualGroup."";
												$apply_zaznamy=mysqli_query($connect,$query_zaznamy);
                                                $query_isInGroup="SELECT * FROM user_groups WHERE id_skupiny=".$IDactualGroup."";
												$apply_isInGroup=mysqli_query($connect,$query_isInGroup);
                                                $isInGroup=array();
                                                
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
                                                $isInGroup = mysqli_fetch_array($apply_isInGroup);
												?>
												<tr>
														<td> <?php echo $result_zaznamy['osobne_cislo']; ?></td>
														<td> <?php echo $result_zaznamy['meno']; ?></td>
														<td> <?php echo $result_zaznamy['priezvisko']; ?></td>
														<td> <?php echo $result_zaznamy['email']; ?></td>
														<td> <?php echo ($result_zaznamy['ldap']==1)?"&#9989":"&#10060" ?></td>
														<td> <?php echo ($result_zaznamy['aktivny']==1)?"&#9989":"&#10060" ?></td>
                                                        <td>
                                                        <?php
                                                        $query_groups="SELECT meno FROM groups INNER JOIN user_groups ON groups.id_skupiny=user_groups.id_skupiny WHERE user_groups.osobne_cislo='".$result_zaznamy['osobne_cislo']."';";
												        $apply_groups=mysqli_query($connect,$query_groups);
												        while($result_groups=mysqli_fetch_array($apply_groups)){
                                                            echo "[ ".$result_groups['meno']." ] ";
												        }?>
                                                        </td>
												        <td>
                                                            <form method="post"> 
                                                                <input type="hidden" name="osobne_cislo" value="<?php echo $result_zaznamy['osobne_cislo'] ?>">
                                                                <?php
                                                                if($isInGroup['osobne_cislo']==$result_zaznamy['osobne_cislo']){
                                                                ?>
                                                                <button type="button" class="btn"  title="Odstrániť zo skupiny" data-toggle="modal" data-target="#deleteFromGroupModal" name="forDelete"   onclick="location.href='index.php?modul=upravit-skupinu/vlozit-zaznam&os_cis=<?php echo $result_zaznamy['osobne_cislo'] ?>&id_skupiny=<?php echo $result_zaznamy['id_skupiny']?>&operation=delete';"><i class="fa fa-trash" ></i></button>
                                                                <?php }else{ ?>
                                                                
                                                                <button type="button" class="btn"  title="Pridať do skupiny" data-toggle="modal" data-target="#insertToGroupModal" name="forInsert"   onclick="location.href='index.php?modul=upravit-skupinu/vlozit-zaznam&os_cis=<?php echo $result_zaznamy['osobne_cislo'] ?>&id_skupiny=<?php echo $_GET['id_skupiny']?>&operation=edit';"><i class="fa fa-arrow-right"></i></button>
                                                                <?php } ?>
                                                            </form>
                                                            
                                                        </td>
                                                        
														
														
                                                       
                                                    </tr>
                                            
												<?php } ?>	
													
                                                </tbody>
                                            </table>
											<?php	echo "<center>".pagination($statement,$limit,$page,$url,$c)."</center>"; ?>
															
                                        </div>
								                                       
									
                                    </div>
                                    <?php } ?>
                                    <?php if(isset($_GET['os_cis']) && isset($_GET['id_skupiny']) && $_GET['operation']=="delete"){ ?>
 <div class="modal fade" id="deleteFromGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            Naozaj chcete odstrániť používateľa č. <?php echo $_GET['os_cis'] ?> z tejto skupiny?
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="osobne_cislo" value="<?php echo $_GET['os_cis'] ?>">
                    <input type="hidden" name="id_skupiny" value="<?php echo $_GET['id_skupiny'] ?>">
                    <button type="submit" name="nothing" class="btn btn-secondary" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $_GET['id_skupiny']?>">Zrušiť</button>
                    <button type="submit" name="deleteFromUserGroup" class="btn btn-primary" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $_GET['id_skupiny']?>">Vymazať</button>
                </form>
          </div>
    </div>
  </div>
</div>
<?php } ?>
<?php if(isset($_GET['os_cis']) && isset($_GET['id_skupiny']) && $_GET['operation']=="edit"){ ?>
 <div class="modal fade" id="insertToGroupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            Naozaj chcete pridať používateľa č. <?php echo $_GET['os_cis'] ?> do tejto skupiny?
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="osobne_cislo" value="<?php echo $_GET['os_cis'] ?>">
                    <input type="hidden" name="id_skupiny" value="<?php echo $_GET['id_skupiny'] ?>">
                    <button type="submit" name="nothing" class="btn btn-secondary" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $_GET['id_skupiny']?>">Zrušiť</button>
                    <button type="submit" name="insertToGroup" class="btn btn-primary" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $_GET['id_skupiny']?>">Pridať</button>
                </form>
          </div>
    </div>
  </div>
</div>
<?php } ?>
 
 <script type="text/javascript">
        $(document).ready(
        function(){
        $('.modal').modal('show');
        });
</script>