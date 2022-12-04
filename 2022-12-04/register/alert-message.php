<?php 
    // Your message code
    if(isset($_SESSION['message']))
    {
        echo '<h6 class="alert alert-warning">'.$_SESSION['message'].'</h6>';
        unset($_SESSION['message']);
    } // Your message code

    // GET message code
    if (isset($_GET['verify'])) {
        echo '<h6 class="alert alert-warning">'.$_GET['verify'].'</h6>';
        unset($_GET['verify']);
    }
?>