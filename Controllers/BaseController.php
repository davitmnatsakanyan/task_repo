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
                $exp = explode(':', $rule);
                $rule = $exp[0];
                $values = $exp[1];

                $_key = str_replace('_', ' ', $key);
                switch ($rule){
                    case 'required':
                        if(!isset($request[$key]) || !$request[$key]){
                            $message = $_key.' field is required';

                            array_push($errors, $message);
                        }
                        break;
                    case 'email':
                        if (!filter_var($request[$key], FILTER_VALIDATE_EMAIL)) {
                            $message = $_key.' field is not a valid email address';

                            array_push($errors, $message);
                        }
                        break;
                    case 'in':
                        $array_values = explode(',', $values);
                        if(!in_array($request[$key], $array_values)){
                            $message = $_key.' can contain only values: '.$values;

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