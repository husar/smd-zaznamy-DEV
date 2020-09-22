<?php
$dateSele=date("Y-m");
$connect = mysqli_connect('localhost', 'root', '', 'user_manager');
$query = "SELECT * FROM employees ORDER BY osobne_cislo ASC";
$result = mysqli_query($connect, $query);

echo '    <tbody>
            
                   
            
            ';
while ($row = mysqli_fetch_array($result)) {
    $type=$row["type"];
    if ($type=="wedding"){
        $type="svadba";
    }
    else if ($type=="ball"){
        $type="ples";
    }
    else if ($type=="amusement"){
        $type="zábava, veselica";
    }
    else{
        $type="iné";
    }
    echo '  
                               <tr>  
                                      <td class="client" data-id1="' . $row["meno"] . '" contenteditable>' . $row["priezvisko"] . '</td>  
                     <td class="date"  data-id22"'.$row['aktivny'].'" data-id2="' . $row["ldap"] . '" contenteditable>' . $row["meno"] . '</td>  
                     <td class="type" data-id23="'.$row['priezvisko'].'" data-id3="' . $row["meno"] . '" contenteditable>' . $type . '</td>  
                     <td class="place" data-id15="'.$row['ldap'].'" data-id14="' . $row["meno"] . '" contenteditable>' . $row["priezvisko"] . '</td>  
                     <td class="price"  data-id5="' . $row["meno"] . '" contenteditable>' . $row["aktivny"] . '</td>  
                     <td class="email" data-id6="' . $row["meno"] . '" contenteditable>' . $row["email"] . '</td>  
                     <td class="status" data-id7="' . $row["meno"] . '" contenteditable>'.showStatus( $row["aktivny"],$row['ldap'],$row["meno"]).'</td>  
                     <td class="tel"  data-id8="' . $row["meno"] . '" contenteditable>' . $row["email"] . '</td>     
                     <td style="text-align:center"><button data-id10="'.$row['ldap'].'" type="button" name="delete_btn" data-id9="'. $row["meno"].'" data-id8="'.$row["priezvisko"].'" class="btn btn-xs btn-danger btn_delete">x</button></td>  
                               </tr>  
                               ';
}
echo "</table>";



function showStatus($input,$id,$band){
    if($input=="reservation"){
        return " <button type=\"button\" name=\"drop_status\" data-id12=\"$id\" data-id11=\"$band\" class=\"btn btn-xs drop_status btn-danger\">⃠</button>";
    }
    else return " <button type=\"button\" name=\"acce_sta\" data-id12=\"$id\" data-id11=\"$band\"  class=\"btn btn-xs btn-danger acce_sta btn-success\">✓</button>";

}
?>