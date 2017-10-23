<?php

namespace S7design\FileUploadVirusValidation\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class VirusCheckConstraint extends Constraint
{

    public $message = 'File contains a virus';

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}