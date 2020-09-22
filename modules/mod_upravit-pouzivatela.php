<?php 
include "functions.php"; 
//include "mod_spravovat-pouzivatelov.php";      
?>

<div class="page-content">

<?php
    $userData=showUsersData();
    $groupsData = array();
    $groupsData=showUsersGroups();
    editUser();
    if(isset($_POST['update'])){
        $userData['meno'] = $_POST['meno'];
        $userData['priezvisko'] = $_POST['priezvisko'];
        $userData['email'] = $_POST['email'];
        $userData['ldap'] = $_POST['ldap'];
        $userData['aktivny'] = $_POST['active'];
        $userData['heslo'] = $_POST['heslo'];
        $userData['check'] = $_POST['check'];
    }
    if(isset($_POST['editUser'])){
        $userData=showUsersData();
        $groupsData=showUsersGroups();
    }
    
?>

 <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-edit"></i>Upraviť záznamy o používateľovi</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
									
								
                                       <form class="form-horizontal" role="form" method="POST" action="">
                                            <div class="form-body">
                                                
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Osobné číslo</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="number" placeholder="Osobné číslo" name="osobne_cislo" value=<?php echo $userData['osobne_cislo']; ?> required min="0" readonly="true">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Meno</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Meno" name="meno" value="<?php echo $userData['meno'] ?>"  required="">
                                                        
													</div>
														
                                                </div>
												<div class="form-group">
                                                    <label class="col-md-3 control-label">Priezvisko</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Priezvisko" name="priezvisko" value="<?php echo $userData['priezvisko']; ?>"  required="">
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Email</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="email" placeholder="Email" name="email" value="<?php echo $userData['email']; ?>"  >
                                                        
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">LDAP</label>
                                                    <div class="col-md-9">
                                                    <br>
													    <input type="radio" id="ano" name="ldap" value="1" <?php echo ($userData['ldap'] ==1)? 'checked':'' ?>>
                                                        <label for="ano">Áno</label>
                                                        <input type="radio" id="nie" name="ldap" value="2" <?php echo ($userData['ldap'] ==2)? 'checked':'' ?>>
                                                        <label for="nie">Nie</label><br>
                   
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Aktívny používateľ</label>
                                                    <div class="col-md-9">
                                                    <br>
													    <input type="radio" id="aktivny" name="active" value="1" <?php echo ($userData['aktivny'] ==1)? 'checked':'' ?>>
                                                        <label for="aktivny">Aktívny</label>
                                                        <input type="radio" id="neaktivny" name="active" value="2" <?php echo ($userData['aktivny'] ==2)? 'checked':'' ?>>
                                                        <label for="neaktivny">Neaktívny</label><br>
                   
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Skupina</label>
                                                    
                                                    <div class="col-md-9">
                                                    <br>
                                                    <?php

                                                    $query_zaznamy="SELECT * FROM groups";
												    $apply_zaznamy=mysqli_query($connect,$query_zaznamy);
												    while($result_zaznamy=mysqli_fetch_array($apply_zaznamy)){
                                                    
												    ?>
													    <input type="checkbox" id="<?php echo $result_zaznamy['id_skupiny']?>" name="check[]" value="<?php echo $result_zaznamy['id_skupiny']?>" <?php echo in_array($result_zaznamy['id_skupiny'],$groupsData)?"checked":"" ?>>
                                                        <label for="<?php echo $result_zaznamy['id_skupiny']?>"><?php echo $result_zaznamy['meno']?></label>
                                                    
                                                  <?php  }?>
                   
													</div>
														
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-md-3 control-label">Heslo</label>
                                                    <div class="col-md-9">
													
													<input class="form-control" size="16" type="text" placeholder="Heslo" name="heslo" value="<?php echo $userData['heslo'] ?>"  >
                                                       <br>
                                                        
													</div>
                                                   
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
                    <input type="hidden" name="groups" value="<?php for($i=0;$i<count($userData['check']);$i++){
            echo $_POST['check'][$i].($i==count($_POST['check'])-1?"":" ");
        } ?>">
                    <input type="hidden" name="osobne_cislo" value="<?php echo $_POST['osobne_cislo'] ?>">
                    <input type="hidden" name="meno" value="<?php echo $userData['meno'] ?>">
                    <input type="hidden" name="priezvisko" value="<?php echo $userData['priezvisko'] ?>">
                    <input type="hidden" name="email" value="<?php echo $userData['email'] ?>">
                    <input type="hidden" name="ldap" value="<?php echo $userData['ldap'] ?>">
                    <input type="hidden" name="aktivny" value="<?php echo $userData['aktivny'] ?>">
                    <input type="hidden" name="heslo" value="<?php echo $userData['heslo'] ?>">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zrušiť</button>
                    <button type="submit" name="editUser" class="btn btn-primary">Prepísať</button>
                </form>
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
 <script type="text/javascript">
        $(document).ready(
        function(){
        $('.modal').modal('show');
        });
</script>