<?php

namespace Modules\Apps\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\User\Entities\User;
use Modules\User\Enum\UserType;
use Illuminate\Routing\Controller;
use Modules\Ensaan\Entities\Circle;
use Modules\Ensaan\Entities\Course;
use Modules\Ensaan\Entities\Mosque;
use Modules\Ensaan\Entities\CircleQuiz;
use Modules\Authorization\Entities\Role;
use Modules\Ensaan\Entities\CircleAttach;
use Modules\Ensaan\Entities\CircleAttend;
use Modules\Package\Entities\Subscription;
use Modules\Company\Repositories\Dashboard\CompanyRepository;
use Modules\Influencer\Repositories\Dashboard\CampaignRepository;
use Modules\Influencer\Repositories\Dashboard\InfluencerRepository;

class DashboardController extends Controller
{
    public function __construct(InfluencerRepository $influencerRepo, CompanyRepository $companyRepo, CampaignRepository $campaignRepo)
    {
        $this->influencerRepo = $influencerRepo;
        $this->companyRepo = $companyRepo;
        $this->campaignRepo    = $campaignRepo;
    }


    public function index(Request $request)
    {
        $usersCount = $this->getCountUsers($request);

        $numberOfInfluencerInMonth = $this->influencerRepo->countInCurrentMonth();
        $countOfInfluencers = $this->influencerRepo->count();
        $monthlyInfluencers = $this->influencerRepo->createdStatistics();

        $numberOfCompanyInMonth = $this->companyRepo->countInCurrentMonth();
        $countOfCompanies = $this->companyRepo->count();
        $monthlyCompanies = $this->companyRepo->createdStatistics();


        $numberOfCampaignInMonth = $this->campaignRepo->countInCurrentMonth();
        $countOfCampaigns = $this->campaignRepo->count();
        $monthlyCampaigns = $this->campaignRepo->createdStatistics();


        extract($this->getStatisticSubscription());

        return view(
            'apps::dashboard.index',
            compact(
                "usersCount",
                "numberOfInfluencerInMonth",
                "countOfInfluencers",
                "numberOfCompanyInMonth",
                "countOfCompanies",
                "numberOfCampaignInMonth",
                "countOfCampaigns",
                "numberOfSubscriptionInMonth",
                "numberOfSubscriptionInYear",
                "monthlyInfluencers",
                "monthlyCompanies",
                "monthlyCampaigns" ,
                "monthlySubscription"
            )
        );
    }

    private function getCountUsers($request)
    {
        return $this->filter($request, ( new User())->baseType(UserType::USER))->count();
    }

    private function filter($request, $model)
    {
        return $model->where(function ($query) use ($request) {
            // Search Users by Created Dates
            if ($request->from) {
                $query->whereDate('created_at', '>=', $request->from);
            }

            if ($request->to) {
                $query->whereDate('created_at', '<=', $request->to);
            }
        });
    }

    private function getStatisticSubscription()
    {
        $now = now();
        $startDate = now()->subYear(1);
        $data["numberOfSubscriptionInMonth"] = Subscription::whereYear('created_at', $now->year)
        ->whereMonth('created_at', $now->month)
        ->count();
        $data["numberOfSubscriptionInYear"] = Subscription::whereYear('created_at', $now->year)
        ->count();
        $counter = Subscription::select(\DB::raw("count(id) as countDate"), \DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
        ->groupBy(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
        ->where("created_at", ">=", $startDate->toDateTimeString())
        ->get();

        $data["monthlySubscription"]["countDate"] = json_encode($counter->pluck("countDate")->toArray());
        $data["monthlySubscription"]["date"]      = json_encode($counter->pluck("date")->toArray());
        return $data;
    }
}
