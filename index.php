<?php


require_once 'Import.php';




$BASE_PATH =  preg_replace("/" . ".*htdocs\\" . DIRECTORY_SEPARATOR . "/", '', getcwd());


Session::Start();


Template::Default('View/Model/Base', ['css' => "http://localhost/{$BASE_PATH}/Style/style.css"]);



Route::Get('/', function(Request $Request, Response $Response){

    return $Response -> Redirect("/sign");

});



Route::Get('/sign', function(Request $Request, Response $Response){

    return $Response -> HTML('View/User.Sign', ['title' => 'Sign', 'theme' => "style-theme-color-dark style-theme-font-mono", 'error' => '']);

});




Route::Post('/sign', function(Request $Request, Response $Response) {


    ["name" => $name, "password" => $password, "confirmpassword" => $confirmpassword] = (array) $Request -> Body();


    if($password !== $confirmpassword)

        return $Response -> HTML('View/User.Sign', ['title' => 'Sign', 'theme' => "style-theme-color-dark style-theme-font-mono", 'error' => file_get_contents('View/Error.User.Dif.html')]);



    if(Session::ExistKey($name))

        return $Response -> HTML('View/User.Sign', ['title' => 'Sign', 'theme' => "style-theme-color-dark style-theme-font-mono", 'error' => file_get_contents('View/Error.User.Exist.html')]);




    Session::Add(["name" => $name, "password" => $password], $name);


    return $Response -> Redirect('/login');


});



Route::Get('/login', function(Request $Request, Response $Response){

    return $Response -> HTML("View/User.Login", ['title' => 'Login', 'theme' => 'style-theme-color-light style-theme-font-mono ', 'error' => '']);

});



Route::Post('/login', function(Request $Request, Response $Response){

    ["name" => $name, "password" => $password] = (array) $Request -> Body();


    if(!Session::ExistKey($name))

        return $Response -> HTML("View/User.Login", ['title' => 'Login', 'theme' => 'style-theme-color-light style-theme-font-mono', 'error' => file_get_contents('View/Error.User.Name.html')]);


    if(!(Session::Get($name)['password'] === $password))

        return $Response -> HTML("View/User.Login", ['title' => 'Login', 'theme' => 'style-theme-color-light style-theme-font-mono', 'error' => file_get_contents('View/Error.User.Password.html')]);


    return $Response -> Redirect('/welcome');


});


Route::Get('/welcome', function(Request $Request, Response $Response){

    return $Response -> HTML("View/Welcome", ['title' => 'Welcome', 'theme' => 'style-theme-color-darkUm style-theme-font-mono']);

});


Route::Get('/reset', function(Request $Request, Response $Response){

    Session::Reset();

    return $Response -> Redirect("/");

});


Server::Run();
