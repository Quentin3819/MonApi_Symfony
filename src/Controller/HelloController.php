<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController{
  
  /** 
 * @Route ("/hello")
 */
    public function hello(){
      //  echo" HELLO MOMO";
        return new Response("HELLO WORLD");
    }

    /** 
 * @Route ("/hello/{name}")
*/

    public function helloName($name): Response {
      return new Response ("Hello"." ".$name);
    }
}

?>