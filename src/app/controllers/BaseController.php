<?php

namespace Nero\App\Controllers;


/*******************************************************
 * Base controller implements validation logic for now
 ******************************************************/
class BaseController
{
    
    /**
     * Validate input data against specified rules, work in progress
     *
     * @param array $data 
     * @param array $rules 
     * @return bool
     */
    protected function validate($data, $rules = [])
    {
        foreach($data as $key => $value){
            $relevantRules = $rules[$key];

            foreach(explode('|', $relevantRules) as $singleRule){
                if(!$this->processRule($value, $singleRule))
                    return false;

            }
        }

        return true;
    }


    /**
     * Process single rule against data
     *
     * @param mixed $data 
     * @param string $rule 
     * @return bool
     */
    private function processRule($data, $rule)
    {
        switch($rule){
            case 'required':
                if(!empty($data))
                    return true;

                return false;
                break;

                //here we will add other validation options
        }
    }

}
