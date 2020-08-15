<?php
function classLoader($className){
    $classPath = SRC."/".$className.".php";
    if(is_file($classPath)){
        require $classPath;
    }
}
spl_autoload_register("classLoader");