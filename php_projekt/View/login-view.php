<?php
session_start();
include('../Templates/header-subcat.php');
echo
'   
<div class="loginbox">
    <h3>scrabble</h3>
   
    <form action="../Controller/loginRequest.php" method="post">  
    <input type="text" name="username" placeholder="Email address" required> 
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit" name="submit">Log in</button>
    <a href="../Controller/register.php">New member? Register</a> <br>
    </form>
</div>
</body>';

?>