<?php
class adminRole {
    
function adminRoles() {
    if(isset($_SESSION['login'])){

        if(isset($_SESSION['role'])) {
    
            if($_SESSION['login']==='ok' && $_SESSION['role']==='admin'){

                 echo '
                 <td class="aktion-buttons"> <form action="../Controller/delete-update.php" method="post"> 
                 <input type="submit" name="delete" value="delete">
                 <input type="submit" name="update"  value="update">
        
                  </form>
                 </td>
        
                 ';

            
              }
        }
    }
}


}
?>