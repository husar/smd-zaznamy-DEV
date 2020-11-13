<?php 
include "functions.php"; 
//include "mod_spravovat-pouzivatelov.php";      
?>

<div class="page-content">

<?php
    deleteFromUserGroup();
    insertToGroup();
    $IDactualGroup = $_GET['id_skupiny'];
    $groupName = $_GET['meno_skupiny'];
    $groupInfo = $_GET['popis_skupiny'];
    $groupData=showGroupsData();
    $groupsData = array();
    $groupsData=showUsersGroups();
    //print_r($allUserGroups);
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
    $os_cis="";
    $meno="";
    $priezvisko="";
    $ldap="";
    $aktivny="";
    $zoradenie="";
    $fromDate="";
    $toDate="";
    $skupina=0;
    $cislo_karty="";
    if(isset($_POST['search'])){
        $os_cis = $_POST['os_cis'];
        $meno = $_POST['meno'];
        $priezvisko = $_POST['priezvisko'];
        $ldap = $_POST['ldap'];
        $aktivny = $_POST['aktivny'];
        $zoradenie = $_POST['zoradenie'];
        $fromDate = $_POST['fromDate'];
        $toDate = $_POST['toDate'];
        $skupina = $_POST['skupina'];
        $cislo_karty = $_POST['cislo_karty'];
        $fromDateGroup = $_POST['fromDateGroup'];
        $toDateGroup = $_POST['toDateGroup'];
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
													
													<input class="form-control" size="16" type="text" placeholder="Názov" name="meno" value="<?php echo $groupName ?>"  required="">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Popis</label>
                                                    <div class="col-md-9">
													
													<textarea class="form-control" size="16" type="text" placeholder="Popis" name="popis" required=""><?php echo $groupInfo; ?></textarea>
                                                        
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
                                            <i class="fa fa-search"></i> Vyhľadávanie
											</div>
                                      
                                    </div>
                                    
                                    <div class="portlet-body form">
                                        <form class="form-horizontal" role="form" method="post">
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <input type="hidden" name="modul" value="upravit-skupinu/zaznam">
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
                                                    <?php
                                                    $query_zaznamy="SELECT * FROM groups";
												    $apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												    ?>
                                                    Patriaci do skupiny:
                                                    <select name="skupina" class="form-control">
                                                        <option value="" >Skupina</option>
                                                        <?php while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){?>
                                                        <option value="<?php echo $result_zaznamy['id_skupiny'] ?>" <?php echo ($skupina ==$result_zaznamy['id_skupiny'])? 'selected':'' ?>><?php echo $result_zaznamy['meno'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                    Číslo karty:
                                                    <input class="form-control" type="text" placeholder="Číslo karty"  name="cislo_karty" pattern="[0-9]+" value="<?php echo $cislo_karty ?>">	
													</div>
                                                    <div class="col-md-2">
                                                    Zamestnanec vytvorený (od):
                                                    <input class="form-control" type="date" name="fromDate" value="<?php echo $fromDate ?>">
                                                    <div class="pull-right">
                                                        <button class="btn">x</button>
                                                    </div>			
													</div>
                                                    <div class="col-md-2">(do)  
                                                    <input class="form-control" type="date" name="toDate" value="<?php echo $toDate ?>">
                                                    <div class="pull-right">
                                                        <button class="btn">x</button>	
                                                    </div>		
													</div>
                                                    <div class="col-md-2">
                                                    Pridaný do skupiny (od):
                                                    <input class="form-control" type="date" name="fromDateGroup" value="<?php echo $fromDateGroup ?>">
                                                    <div class="pull-right">
                                                        <button class="btn">x</button>
                                                    </div>			
													</div>
                                                    <div class="col-md-2">(do)  
                                                    <input class="form-control" type="date" name="toDateGroup" value="<?php echo $toDateGroup ?>">
                                                    <div class="pull-right">
                                                        <button class="btn">x</button>	
                                                    </div>		
													</div>
                                                    <div class="col-md-2">
                                                    Zoradiť podľa:
                                                    <select name="zoradenie" class="form-control">
                                                        <option value="osobne_cislo" <?php echo ($zoradenie == "osobne_cislo")? 'selected':'' ?>>Osobné číslo</option>
                                                        <option value="menoBD" <?php echo ($zoradenie == "menoBD")? 'selected':'' ?>>Meno</option>
                                                        <option value="priezviskoBD" <?php echo ($zoradenie == "priezviskoBD")? 'selected':'' ?>>Priezvisko</option>
                                                        <option value="datum_pridania" <?php echo ($zoradenie == "datum_pridania")? 'selected':'' ?>>Dátum vytvorenia zamestnanca</option>
                                                        <option value="user_groups.datum_pridania" <?php echo ($zoradenie == "user_groups.datum_pridania")? 'selected':'' ?>>Dátum pridania zamestnanca do tejto skupiny</option>
                                                        
                                                    </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                    <br>
													    <input type="radio" name="srt" value="vzostupne" <?php echo ($_POST['srt'] != "zostupne")? 'checked':''?>> Vzostupne
                                                        <input type="radio" name="srt" value="zostupne" <?php echo ($_POST['srt'] == "zostupne")? 'checked':''?>> Zostupne
                   
													</div>
                                                    <div class="col-md-2">Zobrazovať iba používateľov tejto skupiny
                                                     <input type="checkbox" id="thisGroup" name="thisGroup" value="thisGroup" <?php echo (isset($_POST['thisGroup']))? 'checked':'' ?>>
                                                     
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
                               <!-- //****************//
                                    //*S*parametrami**//
                                    //****************//   -->
                                    
                                    <?php
                                    $os_cislo = mysqli_real_escape_string($connect,$_POST['osobne_cislo']);
                                    $meno = mysqli_real_escape_string($connect,$_POST['meno']);
                                    $priezvisko = mysqli_real_escape_string($connect,$_POST['priezvisko']);
                                    
                                    /*if(!empty($_POST['os_cis']) || !empty($_POST['meno']) || !empty($_POST['priezvisko']) || !empty($_POST['ldap']) || !empty($_POST['aktivny']) || !empty($_POST['zoradenie']) || !empty($_POST['fromDate']) || !empty($_POST['toDate']) || !empty($_POST['skupina']) || !empty($_POST['cislo_karty'])){*/
                                        $conditions=array();
                                    
     ?>
                                  
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
                                                          <th>Dátum vytvorenia zamestnanca</th>
                                                          <th>Dátum pridania do skupiny</th>
                                                          <th>Číslo karty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
																				
				
												$search_query="SELECT employees.* ";
                                                if(!empty($_POST['fromDateGroup']) || !empty($_POST['toDateGroup'])|| $_POST['zoradenie']=="user_groups.datum_pridania" || isset($_POST['thisGroup'])){
                                                    $search_query.=", user_groups.datum_pridania AS vSkupine ";
                                                }    
                                                $search_query.="FROM employees ";
                                                    
                                        if(!empty($_POST['skupina']) || $_POST['zoradenie']=="user_groups.datum_pridania" || isset($_POST['thisGroup']) || !empty($_POST['fromDateGroup']) || !empty($_POST['toDateGroup'])){
                                            $search_query.="INNER JOIN user_groups ON employees.osobne_cislo=user_groups.osobne_cislo ";
                                        }
                                        
                                        if(isset($_POST['thisGroup']) || !empty($_POST['fromDateGroup']) || !empty($_POST['toDateGroup'])){
                                            $conditions[]="user_groups.id_skupiny = '".$_GET['id_skupiny']."'";
                                        }
                                        
                                        if(!empty($_POST['skupina'])){
                                            $conditions[]="user_groups.id_skupiny = '".$_POST['skupina']."'";
                                        }
                                        if(!empty($_POST['os_cis'])){
                                            $conditions[]= "employees.osobne_cislo LIKE ('%".$_POST['os_cis']."%')";
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
                                        if(!empty($_POST['fromDate'])){
                                            $conditions[]= "datum_pridania >= '".$_POST['fromDate']."'";
                                        }
                                        if(!empty($_POST['toDate'])){
                                            $conditions[]= "datum_pridania <= '".$_POST['toDate']."'";
                                        }
                                        if(!empty($_POST['fromDateGroup'])){
                                            $conditions[]= "user_groups.datum_pridania >= '".$_POST['fromDateGroup']."'";
                                        }
                                        if(!empty($_POST['toDateGroup'])){
                                            $conditions[]= "user_groups.datum_pridania <= '".$_POST['toDateGroup']."'";
                                        }
                                        if(!empty($_POST['cislo_karty'])){
                                            $conditions[]= "cislo_karty LIKE ('%".$_POST['cislo_karty']."%')";
                                        }
                                        if($_POST['zoradenie']=="user_groups.datum_pridania"){
                                            $conditions[]= "user_groups.id_skupiny = '".$_GET['id_skupiny']."'";
                                        }
                                        
                                        $sql=$search_query;
                                        
                                        if(count($conditions)>0){
                                            $sql.="WHERE ".implode(' AND ',$conditions);    
                                        }
                                        
                                        if(!empty($_POST['zoradenie'])){
                                            if($_POST['zoradenie']=="osobne_cislo"){
                                                $sql.=" ORDER BY ".$_POST['zoradenie'];
                                            }
                                            else{
                                                $sql.=" ORDER BY LOWER(".$_POST['zoradenie'].")";
                                            }
                                        }
                                   
                                        $apply_zaznamy=mysqli_query($connect,$sql);
												while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
                                                    //echo $sql;
//                                                    print_r($result_zaznamy);
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
                                                        <td> <?php echo $result_zaznamy['datum_pridania']; ?></td>
                                                        <td>
                                                  <?php      $queryna="SELECT id_skupiny FROM user_groups WHERE osobne_cislo = '".$result_zaznamy['osobne_cislo']."'";
                                                                $apply_zaz = mysqli_query($connect, $queryna);
                                                                $allGroups = array();
                                                                while($result_zaz=mysqli_fetch_array($apply_zaz)){
                                                                    array_push($allGroups,$result_zaz['id_skupiny']);
                                                                }
                                        
                                                                if(in_array($_GET['id_skupiny'],$allGroups)){
                                                                ?>
                                                         <?php echo $result_zaznamy['vSkupine']; ?>
                                                        <?php }?>
                                                        </td>
														<td> <?php echo $result_zaznamy['cislo_karty']; ?></td>
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
                                                                <button type="button" class="btn"  title="Odstrániť zo skupiny" data-toggle="modal" data-target="#deleteFromGroupModal" name="forDelete"   onclick="location.href='index.php?modul=upravit-skupinu/vlozit-zaznam&os_cis=<?php echo $result_zaznamy['osobne_cislo'] ?>&id_skupiny=<?php echo $_GET['id_skupiny']?>&meno_skupiny=<?php echo $_GET['meno_skupiny']?>&popis_skupiny=<?php echo $_GET['popis_skupiny']?>&operation=delete';"><i class="fa fa-trash" ></i></button>
                                                                <?php }else{ ?>
                                                                <button type="button" class="btn"  title="Pridať do skupiny" data-toggle="modal" data-target="#insertToGroupModal" name="forInsert"   onclick="location.href='index.php?modul=upravit-skupinu/vlozit-zaznam&os_cis=<?php echo $result_zaznamy['osobne_cislo'] ?>&id_skupiny=<?php echo $_GET['id_skupiny']?>&meno_skupiny=<?php echo $_GET['meno_skupiny']?>&popis_skupiny=<?php echo $_GET['popis_skupiny']?>&operation=edit';"><i class="fa fa-arrow-right"></i></button>
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
                    <button type="submit" name="nothing" class="btn btn-secondary" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $_GET['id_skupiny']?>&meno_skupiny=<?php echo $_GET['meno_skupiny']?>&popis_skupiny=<?php echo $_GET['popis_skupiny']?>">Zrušiť</button>
                    <button type="submit" name="deleteFromUserGroup" class="btn btn-primary" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $_GET['id_skupiny']?>&meno_skupiny=<?php echo $_GET['meno_skupiny']?>&popis_skupiny=<?php echo $_GET['popis_skupiny']?>">Vymazať</button>
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
                    <button type="submit" name="nothing" class="btn btn-secondary" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $_GET['id_skupiny']?>&meno_skupiny=<?php echo $_GET['meno_skupiny']?>&popis_skupiny=<?php echo $_GET['popis_skupiny']?>">Zrušiť</button>
                    <button type="submit" name="insertToGroup" class="btn btn-primary" formaction="index.php?modul=upravit-skupinu/vlozit-zaznam&id_skupiny=<?php echo $_GET['id_skupiny']?>&meno_skupiny=<?php echo $_GET['meno_skupiny']?>&popis_skupiny=<?php echo $_GET['popis_skupiny']?>">Pridať</button>
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