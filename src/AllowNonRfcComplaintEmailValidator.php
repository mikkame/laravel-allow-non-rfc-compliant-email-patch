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
        if (substr_count($email, '@') < 1) {
            return false;
        }
        list($account, $domain) = explode('@', $email);
        if (strlen($account) > 0 && strlen($domain) > 0) {
            return true;
        }
        return false;
    }
}
