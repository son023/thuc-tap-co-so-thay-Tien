<?php 

Class Controller
{
	protected function view($view,$data = [])
	{
        
		if(file_exists(_DIR_ROOT. "/views/". $view .".php"))
 		{
 			include _DIR_ROOT.  "/views/". $view .".php";
 		}
        else{
 			include  _DIR_ROOT. "/views/404.php";
 		}
	}
	
   

	


}