<?php

namespace S7design\FileUploadVirusValidation\Constraints;


use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class VirusCheckConstraint extends Constraint
{

    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}