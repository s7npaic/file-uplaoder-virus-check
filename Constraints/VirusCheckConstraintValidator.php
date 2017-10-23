<?php
namespace S7design\FileUploadVirusValidation\Constraints;


use S7design\FileUploadVirusValidation\Antivirus\Types\IAntivirusFactory;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class VirusCheckConstraintValidator extends ConstraintValidator
{
    private $antivirusFactory;

    public function __construct(IAntivirusFactory $antivirusFactory)
    {
        $this->antivirusFactory = $antivirusFactory;
    }

    /**
     * Checks if the passed value is valid.
     *
     * @param mixed $value The value that should be validated
     * @param Constraint $constraint The constraint for the validation
     */
    public function validate($value, Constraint $constraint)
    {

        if($this->getAntivirusService()->checkIsSingleFileContaminated($value)){
            $this->context->buildViolation($constraint->message)
                ->addViolation();
        }
    }

    private function getAntivirusService(){
        return $this->antivirusFactory->getProvider();
    }
}