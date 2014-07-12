<?php namespace Barrel\Database;

use Way\Database\Model as WayModel;

class Model Extends WayModel {

    protected static $messages = [];

    public function validate()
    {
        // if the key's value is greater than 0, then its an existing model
        // so we will replace the placeholder (:id) with the id value
        // otherwise we will just replace it with an empty string
        $replace = ($this->getKey() > 0) ? $this->getKey() : '';
        foreach (static::$rules as $key => $rule)
        {
            static::$rules[$key] = str_replace(':id', $replace, $rule);
        }

        $validator = $this->validator->make($this->attributes, static::$rules, static::$messages);

        if ($validator->passes()) return true;

        $this->setErrors($validator->messages());

        return false;
    }

}