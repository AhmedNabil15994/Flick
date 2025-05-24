<?php

namespace Modules\User\Repositories\Dashboard;

use DB;
use Hash;
use Modules\User\Entities\User;
use Modules\User\Enum\UserType;
use Modules\Package\Entities\Package;
use Modules\Core\Traits\Attachment\Attachment;

class WorkerRepository
{
    public function __construct(User $user)
    {
        $this->user      = $user;
    }

    
    public function getAll()
    {
        return $this->user->worker()->orderBy('id', 'DESC')->get();
    }

    public function getAllActive()
    {
        return $this->user->worker()->select("id", "name")->orderBy('id', 'DESC')->get();
    }

    public function getSelectedToOptions($request, $order = 'id', $sort = 'desc', $select="name")
    {
        $record =
            $this->user->select("id", "$select as text")
        ;
        if($request->type){
            $record->baseType($request->type);
        }
        if($request->input('search')) {
            $record->where($select, 'like', '%'. $request->input('search') .'%');
        }
        $record = $record->orderBy($order, $sort)->paginate();
        return $record;
    }

    public function userCreatedStatistics()
    {
        $data["userDate"] = $this->user
                            ->worker()
                            ->select(\DB::raw("DATE_FORMAT(created_at,'%Y-%m') as date"))
                            ->groupBy('date')
                            ->pluck('date');

        $userCounter = $this->user
                        ->worker()
                        ->select(\DB::raw("count(id) as countDate"))
                        ->groupBy(\DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
                        ->get();

        $data["countDate"] = json_encode(array_pluck($userCounter, 'countDate'));

        return $data;
    }

    public function countUsers($order = 'id', $sort = 'desc')
    {
        $users = $this->user->worker()->count();

        return $users;
    }

    /*
    * Get All Normal Users Without Roles
    */
    public function getAllUsers($order = 'id', $sort = 'desc')
    {
        $users = $this->user->worker()->orderBy($order, $sort)->get();
        return $users;
    }

    /*
    * Find Object By ID
    */
    public function findById($id, $with=[])
    {
        $user = $this->user->withDeleted()->with($with)->findOrFail($id);
        return $user;
    }

    /*
    * Find Object By ID
    */
    public function findByEmail($email)
    {
        $user = $this->user->where('email', $email)->first();
        return $user;
    }

    /*
    * Find Object By ID
    */
    public function findByEmailOrMobile($email, $mobile)
    {
        $user = $this->user->where(['email' => $email ,'mobile' => $mobile])->first();
        return $user;
    }

    public function updateSubscription($request, $subscription=null)
    {
        DB::beginTransaction();

        try {
            $data = $request->validated();
            $subscription->update($data);

            DB::commit();
            return $subscription;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function createSubscription($request, $user=null)
    {
        $package = Package::findOrFail($request->package_id);

        DB::beginTransaction();

        try {
            $subscription = $package->createSubscriptions($user->id, true);
            DB::commit();
            return $subscription;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Create New Object & Insert to DB
    */
    public function create($request)
    {
        DB::beginTransaction();

        try {
            $data = $request->except(["image"]);

            $data = array_merge($data, [
                "image"             => '/uploads/users/user.png',
                "admin_approved"    => $request->admin_approved ?? 0,
                "is_verified"       => $request->is_verified ?? 0,
                'password'  => Hash::make($request['password']),
            ]);

            $user = $this->user->create($data);
            $imagesUpload = [];
            if ($request->image) {
                $imagesUpload["image"] = Attachment::uploadAttach($request->image, $user->getTable(), $user);
            }

          

            if (count($imagesUpload)> 0) {
                $user->update($imagesUpload);
            }

            if ($request->parent_id) {
                $user->parents()->attach($request->parent_id);
            }

            if($request->roles){
                $user->roles()->attach($request->roles);
            }

            DB::commit();
            return $user;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }



    /*
    * Find Object By ID & Update to DB
    */
    public function update($request, $id)
    {
        DB::beginTransaction();

        $user = $this->findById($id);
        $request->trash_restore ? $this->restoreSoftDelte($user) : null;

        $data = $request->except(["image", "id_image","password"]);

        if ($request->password) {
            $data["password"]  = Hash::make($request['password']);
        }



        if ($request->image) {
            Attachment::deleteAttachment($user->image);
            $data["image"] = Attachment::uploadAttach($request->image, $user->getTable(), $user);
        }


        $data = array_merge($data, [
                "admin_approved"    => $request->admin_approved ?? 0,
                "is_verified"       => $request->is_verified ?? 0,
        ]);

        try {
            $user->update($data);
            $user->roles()->sync($request->roles ?? [] );

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function restoreSoftDelte($model)
    {
        $model->restore();
    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $model = $this->findById($id);

            if ($model->trashed()):
                Attachment::deleteFolder($model->getTable()."/".$model->id);
                $model->forceDelete();
            else:
                $model->delete();
            endif;

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Find all Objects By IDs & Delete it from DB
    */
    public function deleteSelected($request)
    {
        DB::beginTransaction();

        try {
            foreach ($request['ids'] as $id) {
                $model = $this->delete($id);
            }

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    /*
    * Generate Datatable
    */
    public function QueryTable($request)
    {
        $query = $this->user->with(["country"])
        ->where('id', '!=', auth()->id())->worker()->withDeleted()
        ;

        if ($request->input('search.value')) {
            $query->where(function ($query) use ($request) {
                $query->where('id', 'like', '%'. $request->input('search.value') .'%');
                $query->orWhere('name', 'like', '%'. $request->input('search.value') .'%');
                $query->orWhere('email', 'like', '%'. $request->input('search.value') .'%');
                $query->orWhere('mobile', 'like', '%'. $request->input('search.value') .'%');
            });
        }

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    /*
    * Generate Datatable
    */
    public function QuerySubscriptionsTable($request, $user)
    {
        $query = $user->subscriptions()
        ;

        $query = $this->filterDataTable($query, $request);

        return $query;
    }

    /*
    * Filteration for Datatable
    */
    public function filterDataTable($query, $request)
    {
        // Search Users by Created Dates
        if (isset($request['req']['from']) && $request['req']['from'] != '') {
            $query->whereDate('created_at', '>=', $request['req']['from']);
        }

        if (isset($request['req']['to']) && $request['req']['to'] != '') {
            $query->whereDate('created_at', '<=', $request['req']['to']);
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'only') {
            $query->onlyDeleted();
        }

        if ($request->has("req.admin_approved")) {
            $query->where("admin_approved", $request->input("req.admin_approved"));
        }

        if (isset($request['req']['deleted']) &&  $request['req']['deleted'] == 'with') {
            $query->withDeleted();
        }

        return $query;
    }
}
