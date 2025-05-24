<?php
namespace Modules\Core\Packages\Influencer\Exceptions;

use Exception;

class ThirdPartyCallingException extends Exception {

    public static function couldNotCallingThirdParty($class,$error): self
    {
        return new static("${class} could't calling third party because this error  : $error ");
    }
}