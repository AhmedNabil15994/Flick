<?php

namespace Modules\Core\Packages\Influencer\IQData;

use Illuminate\Support\Facades\Http;
use Modules\Core\Packages\Influencer\Exceptions\ThirdPartyCallingException;

class IQDataApi
{
    public function getHeaders()
    {
        return [
            "X-Api-Key" => config("statistic.iq_data.api_token")
        ];
    }

    public function getBaseUrl()
    {
        return  config("statistic.iq_data.base_url");
    }

    public function getReportById($reportId, $parameters =[])
    {
        $response = Http::withHeaders($this->getHeaders())
                            ->get($this->getBaseUrl(). "/reports/$reportId", $parameters);
        $this->checkCallError($response);

        return $response->json();
    }


    public function createNewReport($parameters)
    {
        $response = Http::withHeaders($this->getHeaders())
        ->post($this->getBaseUrl(). "/reports/new/", $parameters);
        $this->checkCallError($response);
        return $response->json();
    }

    public function checkCallError($response)
    {
       
        if ($response->failed()) {
           throw ThirdPartyCallingException::couldNotCallingThirdParty(get_class($this), $response->getBody()->getContents());
        }
    }
}
