<?php
class Validation
{

    public $patterns = array(
        'uri'           => '[A-Za-z0-9-\/_?&=]+',
        'url'           => '[A-Za-z0-9-:.\/_?&=#]+',
        'alpha'         => '[\p{L}]+',
        'words'         => '[\p{L}\s]+',
        'alphanum'      => '[\p{L}0-9]+',
        'int'           => '[0-9]+',
        'float'         => '[0-9\.,]+',
        'tel'           => '[0-9+\s()-]+',
        'text'          => '[\p{L}0-9\s-.,;:!"%&()?+\'°#\/@]+',
        'file'          => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+\.[A-Za-z0-9]{2,4}',
        'folder'        => '[\p{L}\s0-9-_!%&()=\[\]#@,.;+]+',
        'address'       => '[\p{L}0-9\s.,()°-]+',
        'date_dmy'      => '[0-9]{1,2}\-[0-9]{1,2}\-[0-9]{4}',
        'email'         => '[a-zA-Z0-9_.-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+[.]+[a-z-A-Z]'
    );


    public $errors = array();


    public function name($name)
    {
        $this->name = $name;
        return $this;
    }


    public function value($value)
    {
        $this->value = $value;
        return $this;
    }


    public function pattern($name)
    {

        $regex = '/^(' . $this->patterns[$name] . ')$/u';
        echo "value: " . $this->value . " regex: " . $regex;
        if ($this->value != '' && !preg_match($regex, $this->value)) {
            $this->errors[] = 'Format for ' . $this->name . ' is not valid';
        }
        return $this;
    }


    public function required()
    {
        if (($this->value == '' || $this->value == null)) {
            $this->errors[] = 'Field ' . $this->name . '  is required.';
        }
        return $this;
    }


    public function isValid()
    {
        if (empty($this->errors)) {
            return true;
        }
    }
}
