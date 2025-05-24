<?php

namespace Modules\Influencer\Enum;

class InvitationStatus extends \SplEnum
{
    public const WAITING  = "waiting";
    public const ACCEPT   = "accepted";
    public const REFUSED  = "refused";
    public const ATTENDED  = "attended";
}
