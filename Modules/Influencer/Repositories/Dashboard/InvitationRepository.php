<?php

namespace Modules\Influencer\Repositories\Dashboard;

;

use Modules\Influencer\Entities\Campaign;
use Modules\Influencer\Enum\InvitationStatus;
use Modules\Influencer\Entities\Invitation as Model;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class InvitationRepository extends CrudRepository
{
    /**
    * Status attribute in model
    * @var array
    */
    protected $fileAttribute = [
        "video" => "video"

    ];

    /**
     * Status attribute in model
     * @var array
     */
    protected array $statusAttribute = [
    ];


    public function __construct()
    {
        parent::__construct(Model::class);
    }




    /**
     * Append custom filter
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function appendSearch(&$query, $request): \Illuminate\Database\Eloquent\Builder
    {
        if(isset($request['search']['value']) && !empty($request['search']['value'])){

            $query->whereHas('influencer',function($influencerQuery) use ($request) {

                $influencerQuery->where('contact_number','LIKE','%'.$request['search']['value'].'%');
                foreach (config('laravellocalization.supportedLocales') as $code => $lang){
                    $influencerQuery->orWhere("name->{$code}",'like',"%{$request->input('search.value')}%");
                }


                $influencerQuery->orWhereHas('instagrams',function($instagramQuery) use ($request){

                    $instagramQuery->where('user_name','LIKE','%'.$request['search']['value'].'%');

                })->orWhereHas('youtubes',function($instagramQuery) use ($request){

                    $instagramQuery->where('user_name','LIKE','%'.$request['search']['value'].'%');

                })->orWhereHas('tiktoks',function($instagramQuery) use ($request){

                    $instagramQuery->where('user_name','LIKE','%'.$request['search']['value'].'%');

                })->orWhereHas('twitches',function($instagramQuery) use ($request){

                    $instagramQuery->where('user_name','LIKE','%'.$request['search']['value'].'%');

                });
            });
        }

        return $query;
    }


      /**
     * Append custom Code datatable
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function inDataTableSearch(&$query, $request)
    {
        if ($request->event_id) {
            $query->where("event_id", $request->event_id);
        }

        if ($request->status) {
            $query->where("status", $request->status);
        }

        return $query->with(["influencer"=>fn ($q) =>$q->with(["instagrams", "youtubes", "tiktoks"])]);
    }

    public function updateStatus($input){
        return $this->model->whereIn('id',$input['ids'])->update(['status'=>$input['status']]);
    }
}
