<?php


namespace App\Middlewares;

class ProcessMessages{


    public function next(){

        # check if there no any messages to be displayed
        if(! isset($_SESSION['messages'])) return true;
    
        $messages_count = count($_SESSION['messages']);

        # include sweet alert library to display the message
        echo '';

        # display the messages
        for($i = 0; $i <= $messages_count -1; $i++){

            # display the message
            echo $_SESSION['messages'][$i]['body'];
        }
        
        # delete the message
        unset($_SESSION['messages']);

        return true;
    }

}

?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9">
        
        Swal.fire();
        
        
        </script>