<?php 

class UserValidator
{
    private $data;
    private $errors = [];
    private static $fields = ['name', 'email', 'review'];

    public function __construct($post_data)
    {
        $this->data = $post_data;
    }

    public function validateForm()
    {
        foreach(self::$fields as $field) {
            if (!array_key_exists($field, $this->data)) {
                trigger_error("$field isn't present in data");
                return;
            }
        }

        $this->validateName();
        $this->validateEmail();
        $this->validateReview();

        return $this->errors;
    }

    public function validateName()
    {
        $val = trim($this->data['name']);

        if(empty($val)) {
            $this->addError('name', "name can't be empty");
        } else {
            if(!preg_match('/^[a-zA-Z0-9]+$/', $val)) {
                $this->addError('name', 'name must be 6-12 chars & alphanumeric');
            }
        }
    }

    private function validateEmail()
    {
        $val = trim($this->data['email']);

        if(empty($val)) {
            $this->addError('email', "email can't be empty");
        } else {
            if(!filter_var($val, FILTER_VALIDATE_EMAIL)) {
                $this->addError('email', 'email must be a valid email');
            }
        }
    }

    private function validateReview()
    {
        $val = trim($this->data['review']);

        if(empty($val)) {
            $this->addError('review', "review can't be empty");
        } else {
            if (!preg_match('/^[a-zA-Z0-9\s.,:!\'\"\p{Cyrillic}]+/u', $val)) {
                $this->addError('review', 'Review must have letter, digits and spaces only');
            }
        }
    }

    private function addError($key, $value)
    {
        $this->errors[$key] = $value;
    }
}

?>