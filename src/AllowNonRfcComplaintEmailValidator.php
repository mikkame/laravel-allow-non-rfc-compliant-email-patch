<?php

namespace Tecpresso\AllowNonRfcComplaintEmailPatch;

class AllowNonRfcComplaintEmailValidator extends \Egulias\EmailValidator\EmailValidator
{
    /**
     * 最低限、@が含まれていて、ドメインとアカウント名が含まれているメールアドレスは許可します
     * @param  [type]                                         $email
     * @param  EguliasEmailValidatorValidationEmailValidation $emailValidation
     * @return boolean
     */
    public function isValid($email, \Egulias\EmailValidator\Validation\EmailValidation $emailValidation)
    {
        return (bool)preg_match('/^.+@.+$/', $email);
    }
}
