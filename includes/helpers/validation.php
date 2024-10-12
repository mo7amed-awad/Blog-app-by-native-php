<?php


if (!function_exists('validation')) {
    function validation(array $attributes, array $trans = null, $http_header = 'redirect', $back = null)
    {

        $validations = [];
        $values = [];
        foreach ($attributes as $attribute => $rules) {
            $value = request($attribute);
            $values[$attribute] = $value;
            $attribute_validate = [];
            $final_attr = isset($trans[$attribute]) ? $trans[$attribute] : $attribute;
            foreach (explode('|', $rules) as $rule) {
                if ($rule == 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans("validation.email"));
                } elseif ($rule == 'required' && (is_null($value) || empty($value) || (isset($value['tmp_name']) && empty($value['tmp_name'])))) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans("validation.required"));
                } elseif ($rule == 'integer' && !filter_var((int)$value, FILTER_VALIDATE_INT)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans("validation.integer"));
                } elseif ($rule == 'string' && (empty($value) || !is_string($value))) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans("validation.string"));
                } elseif ($rule == 'numbric' && !is_numeric($value)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans("validation.numbric"));
                } elseif ($rule == 'image' && (!empty($value['tmp_name']) && getimagesize($value['tmp_name']) === false)) {
                    $attribute_validate[] = str_replace(':attribute', $final_attr, trans("validation.image"));
                }elseif(preg_match('/^in:/i',$rule)){
                    $ex_rule = explode(':',$rule);
                    if(isset($ex_rule[1])){
                        $ex_in=explode(',',$ex_rule[1]);
                        if(!empty($ex_in) && is_array($ex_in) && !in_array($value,$ex_in)){
                            $attribute_validate[] = str_replace(':attribute', $final_attr, trans("validation.in"));
                        }
                    }
                }
                elseif (preg_match('/^unique:/i',$rule)){
                    $ex_rule = explode(':',$rule);
                    if(count($ex_rule)>1 && isset($ex_rule[1])){
                        $get_unique_info= explode(',',$ex_rule[1]);

                        $table = $get_unique_info[0];
                        $column=isset($get_unique_info[1])?$column=$get_unique_info[1]:$attribute;

                        if(isset($get_unique_info[2])){
                            $sql="where ".$column."='".$value."' and id!='".$get_unique_info[2]."'";
                        }else{
                            $sql="where ".$column."='".$value."'";
                        }

                        $check_unique_db= db_first($table,$sql);

                        if(!empty($check_unique_db)){
                            $attribute_validate[] = str_replace(':attribute', $final_attr, trans("validation.unique"));
                        }
                    } 
                }
            }
            if (!empty($attribute_validate) && is_array($attribute_validate) && count($attribute_validate) > 0) {
                $validations[$attribute] = $attribute_validate;
            }
        }
        var_dump($validations);
        if (count($validations) > 0) {
            if ($http_header == 'redirect') {
                session('old', json_encode($values));
                session('errors', json_encode($validations));
                if (!is_null($back)) {
                    redirect($back);
                } else {
                    back();
                }
            } elseif ($http_header == 'api') {
                return json_encode($validations, JSON_PRETTY_PRINT);
            }
        } else {
            return $values;
        }
    }
}

if (!function_exists('any_errors')) {
    function any_errors($offset = null)
    {
        $array = json_decode(session('errors'), true);
        if (isset($array[$offset])) {
            $text = $array[$offset];
            //unset($array[$offset]);

            return is_array($text) ? $text : [];
        } elseif (!empty($array) && count($array) > 0) {
            return null;
        } {
            return [];
        }
        //return !is_null($offset) && isset($GLOBALS['validations'][$offset]) ? ($GLOBALS['validations'][$offset]) :$GLOBALS['validations'];
    }
}


if (!function_exists('all_errors')) {
    function all_errors()
    {
        $all_errors = json_decode(session('errors'), true);
        if (is_array($all_errors)) {
            foreach ($all_errors as $errors) {
                foreach ($errors as $error) {
                    $all_error[] = $error;
                }
            }

            return $all_error;
        }
    }
}

if (!function_exists('get_errors')) {
    function get_errors($offset)
    {

        if (is_array(any_errors($offset))) {
            $errors = '<ul>';
            foreach (any_errors($offset) as $error) {
                if (is_string($error)) {
                    $errors .= '<li>' . $error . '</li>';
                }
            }
            $errors .= '</ul>';

            return any_errors($offset);
        }
    }
}


if (!function_exists('end_errors')) {
    function end_errors()
    {
        session_flash('errors');
    }
}
if (!function_exists('old')) {
    function old($request)
    {
        $old_values = json_decode(session('old'), true);
        if (is_array($old_values) && !empty($old_values) && in_array($request, array_keys($old_values))) {
            return $old_values[$request];
        } else {
            return '';
        }
    }
}
