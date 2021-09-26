<?php 


function validate($input,$flag,$length = 6){
$status = true;

 switch ($flag) {
     case 1:
         # code...
         if(empty($input)){
           $status = false;
         }
         break;

    case 2: 
        if(!preg_match('/^[a-zA-Z\s]*$/',$input)){
            $status = false;
        }
       break;

    case 3: 
        # code 
        if(!filter_var($input,FILTER_VALIDATE_EMAIL)){
            $status = false;
        } 
        break; 


    case 4: 
        $allowedExt = ['pdf'];
        $extArray = explode('/',$input);
        if(!in_array($extArray[1],$allowedExt)){
            $status = false;
        }
      break;

    case 5: 
        if(strlen($input) < $length){
            $status = false;
        }  
        break;


    case 6: 
            # code 
        if(!filter_var($input,FILTER_VALIDATE_INT)){
                $status = false;
        } 
        break;    

   }
  
    return $status;

}





function CleanInputs($input){
  
    $input = trim($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);

     return $input;
}



function sanitize($input,$flag){
    
    switch ($flag) {
        case 1:
            # code...
            $input = filter_var($input,FILTER_SANITIZE_NUMBER_INT);     
            break;
        
    }

    return $input;
}






?>