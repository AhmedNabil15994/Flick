<?php

namespace Modules\DeviceToken\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Modules\DeviceToken\Traits\FCMTrait;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\DeviceToken\Entities\DeviceToken;

class GeneralNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use FCMTrait;

    public $message = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($message)
    {
        $this->message = $message;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach (["IOS", "ANDROID"] as  $platform) {
            foreach (config('translatable.locales') as $lang) {
                DeviceToken::where("platform", $platform)->where('lang', $lang)->chunkById(1000, function ($tokens) use ($platform, $lang) {
                    $tokens = $tokens->pluck('device_token')->unique()->toArray();
                    if(count($tokens) > 0){
                        $this->{"Push{$platform}"}($this->message, array_values($tokens), $lang);
                    }
                });
            }
        }
    }
}
