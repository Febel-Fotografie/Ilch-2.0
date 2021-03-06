<?php
/**
 * @copyright Ilch 2.0
 */

namespace Ilch\Validation\Validators;

/**
 * Required validation class.
 */
class Required extends Base
{
    /**
     * Default error key for this validator.
     *
     * @var string
     */
    protected $errorKey = 'validation.errors.required.fieldIsRequired';

    /**
     * Runs the validation.
     *
     * @return self
     */
    public function run()
    {
        $value = $this->getValue();
        $value = is_string($value) ? trim($value) : $value;

        $this->setIsValid(!($value === null || $value === [] || $value === ''));

        return $this;
    }
}
