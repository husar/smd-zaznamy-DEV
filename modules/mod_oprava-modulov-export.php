<div class="page-content">

 <div class="portlet box blue">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-calendar"></i> Záznamy - export</div>
                                        <div class="tools">
                                            <a href="javascript:;" class="collapse" data-original-title="Zbaliť/Rozbaliť" title=""> </a>
                                            
                                        </div>
                                    </div>
                                    <div class="portlet-body">
									                                         
				<?php
				$datum_od=date('Y-m-d', strtotime(str_replace('.', '-', $_GET['datum_od'])));
				$datum_do=date('Y-m-d', strtotime(str_replace('.', '-', $_GET['datum_do'])));
				//$datum_od=$_GET['datum_od'];
				//$datum_do=$_GET['datum_do'];
$query_export="SELECT * FROM oprava_modulov_zaznamy WHERE datum>='".$datum_od."' AND DATE(datum)<='".$datum_do."'";
$apply_export=mysqli_query($connect,$query_export);
$csv_text="id;cislo_modulu;vp;seriove_cislo;chyba; datum;autor
";

while($result_export=mysqli_fetch_array($apply_export)){
	$query_autor="SELECT * FROM user WHERE id=".$result_export['autor'];
	$apply_autor=mysqli_query($connect,$query_autor);
	$result_autor=mysqli_fetch_array($apply_autor);
	$autor=$result_autor['fullname'];
	$csv_text.=	$result_export['id'].";".$result_export['cislo_modulu'].";".$result_export['vp'].";".$result_export['seriove_cislo'].";".$result_export['chyba'].";".$result_export['datum'].";".$autor."
	";

}




$datum=date('Ymd');
$file = 'export/ex_'.$datum."-".$_SESSION['user_id']."_".rand(0,5000).'.csv';
$file_generate=file_put_contents($file, $csv_text);
if($file_generate){
	echo "<center><div class='alert-success'>CSV súbor bol vygenerovaný. Stiahnuť si ho môžete <a href='".$file."'>kliknutím tu.</a></div></center>";
}
else{
	echo "<center><div class='alert-error'>CSV Súbor sa nepodarilo vygenerovať.</div></center>";
}
?>
						
                                       
									
                                    </div>
                                </div>
						
 </div>
 
 