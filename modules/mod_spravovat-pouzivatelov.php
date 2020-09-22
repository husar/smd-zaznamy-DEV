<div class="page-content">
<?php
    
include "functions.php";    

if($user->isAdmin()){

?>


<?php } 
    
    deleteUser();
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
    }
    
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
                                                    Pridaný v intervale medzi (od):
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
                                                        <option value="" >Zoradiť podľa</option>
                                                        <option value="osobne_cislo" <?php echo ($zoradenie == "osobne_cislo")? 'selected':'' ?>>Osobné číslo</option>
                                                        <option value="menoBD" <?php echo ($zoradenie == "menoBD")? 'selected':'' ?>>Meno</option>
                                                        <option value="priezviskoBD" <?php echo ($zoradenie == "priezviskoDB")? 'selected':'' ?>>Priezvisko</option>
                                                    </select>
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
                                    $os_cislo = mysqli_real_escape_string($connect,$_POST['osobne_cislo']);
                                    $meno = mysqli_real_escape_string($connect,$_POST['meno']);
                                    $priezvisko = mysqli_real_escape_string($connect,$_POST['priezvisko']);
                                    
                                    if(!empty($_POST['os_cis']) || !empty($_POST['meno']) || !empty($_POST['priezvisko']) || !empty($_POST['ldap']) || !empty($_POST['aktivny']) || !empty($_POST['zoradenie']) || !empty($_POST['fromDate']) || !empty($_POST['toDate']) || !empty($_POST['skupina']) || !empty($_POST['cislo_karty'])){
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
                                                          <th>Číslo karty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
																				
				
												$search_query="SELECT * FROM employees ";
                                        
                                        if(!empty($_POST['skupina'])){
                                            $search_query.="INNER JOIN user_groups ON employees.osobne_cislo=user_groups.osobne_cislo ";
                                            $conditions[]="user_groups.id_skupiny = '".$_POST['skupina']."'";
                                        }
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
                                        if(!empty($_POST['fromDate'])){
                                            $conditions[]= "datum_pridania >= '".$_POST['fromDate']."'";
                                        }
                                        if(!empty($_POST['toDate'])){
                                            $conditions[]= "datum_pridania <= '".$_POST['toDate']."'";
                                        }
                                        if(!empty($_POST['cislo_karty'])){
                                            $conditions[]= "cislo_karty LIKE ('%".$_POST['cislo_karty']."%')";
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
                                                            echo "[ ".$result_groups['meno']." ] ";
												        }?>
                                                        </td>
                                                        <td> <?php echo $result_zaznamy['datum_pridania']; ?></td>
														<td> <?php echo $result_zaznamy['cislo_karty']; ?></td>
														<td>
                                                            <form method="post"> 
                                                                
                                                                <input type="hidden" name="osobne_cislo" value="<?php echo $result_zaznamy['osobne_cislo'] ?>">
                                                                <button type="button" class="btn"  title="Zmazať zamestnanca" data-toggle="modal" data-target="#deleteModal" name="forDelete"   onclick="location.href='index.php?modul=spravovat-pouzivatelov/zaznamy&os_cis=<?php echo $result_zaznamy['osobne_cislo'] ?>';"><i class="fa fa-trash" ></i></button>
                                                                
                                                                <button class="btn" type="submit" formaction="index.php?modul=upravit-pouzivatela/vlozit-zaznam"><i class="fa fa-edit"></i></button>
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
                                                          <th>Číslo karty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
																				
				
												$query_zaznamy="SELECT * FROM employees";
												$apply_zaznamy=mysqli_query($connect,$query_zaznamy);
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
                                                            echo "[ ".$result_groups['meno']." ] ";
												        }?>
                                                        </td>
                                                        <td> <?php echo $result_zaznamy['datum_pridania']; ?></td>
                                                        <td> <?php echo $result_zaznamy['cislo_karty']; ?></td>
												        <td>
                                                            <form method="post"> 
                                                                
                                                                <input type="hidden" name="osobne_cislo" value="<?php echo $result_zaznamy['osobne_cislo'] ?>">
                                                                <button type="button" class="btn"  title="Zmazať zamestnanca" data-toggle="modal" data-target="#deleteModal" name="forDelete"   onclick="location.href='index.php?modul=spravovat-pouzivatelov/zaznamy&os_cis=<?php echo $result_zaznamy['osobne_cislo'] ?>';"><i class="fa fa-trash" ></i></button>
                                                                
                                                                <button class="btn" type="submit" formaction="index.php?modul=upravit-pouzivatela/vlozit-zaznam"><i class="fa fa-edit"></i></button>
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
                                </div>
						
 </div>
 <?php if(isset($_GET['os_cis'])){ ?>
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
          <div class="modal-body">
            Naozaj chcete odstrániť používateľa č. <?php echo $_GET['os_cis'] ?> zo systému?
          </div>
          <div class="modal-footer">
                <form method="post">
                    <input type="hidden" name="osobne_cislo" value="<?php echo $_GET['os_cis'] ?>">
                    <button type="submit" name="nothing" class="btn btn-secondary" formaction="index.php?modul=spravovat-pouzivatelov/zaznamy">Zrušiť</button>
                    <button type="submit" name="delete" class="btn btn-primary" formaction="index.php?modul=spravovat-pouzivatelov/zaznamy">Vymazať</button>
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