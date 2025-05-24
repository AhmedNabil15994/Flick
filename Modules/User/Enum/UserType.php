<?php
namespace Modules\User\Enum;

class UserType extends \SplEnum
{
    const USER             = "user";
    const ADMIN            = "admin";
    const INFLUENCER_WORKER="influencer_worker";
    const COMPANY_WORKER="company_worker";



    public static function getWorkerType()
    {
        return [self::INFLUENCER_WORKER=>self::INFLUENCER_WORKER, self::COMPANY_WORKER=>self::COMPANY_WORKER];
    }

    public static function getWorkerTypeOptions()
    {
        return [
            self::INFLUENCER_WORKER=>__("user::dashboard.workers.form.types.".self::INFLUENCER_WORKER) , 
            self::COMPANY_WORKER=>__("user::dashboard.workers.form.types.".self::COMPANY_WORKER)

        ];
    }
}
