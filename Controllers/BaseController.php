<?php
namespace Controllers;

class BaseController
{

    /**
     * Call the middleware by given name
     *
     * @param $name
     */
    public function middleware($name){

        $middlewares = [
            'auth' => 'Middleware\Authentication'
        ];

        $middleware = new $middlewares[$name]();
        $middleware->handle();
    }

    public function validate($request, $params, $back_url){
        $errors = [];
        foreach ($params as $key => $rules){
            $rules = explode('|', $rules);
            foreach ($rules as $rule){
                switch ($rule){
                    case 'required':
                        if(!isset($request[$key]) || !$request[$key]){
                            $_key = str_replace('_', ' ', $key);
                            $message = $_key.' field is required';

                            array_push($errors, $message);
                        }
                        break;
                    case 'email':
                        if (!filter_var($request[$key], FILTER_VALIDATE_EMAIL)) {
                            $_key = str_replace('_', ' ', $key);
                            $message = $_key.' field is not a valid email address';

                            array_push($errors, $message);
                        }
                        break;
                    default:
                        echo 'Invalid validation rule provided'; die();
                     break;
                }
            }
        }

        if($errors){
            set_flash_errors($errors);

            redirect($back_url);
        }
    }

}