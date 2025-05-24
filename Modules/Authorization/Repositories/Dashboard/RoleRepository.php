<?php

namespace Modules\Authorization\Repositories\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Authorization\Entities\Role;
use Modules\Authorization\Enum\RoleType;
use Modules\Core\Repositories\Dashboard\CrudRepository;

class RoleRepository extends CrudRepository
{

    public function __construct()
    {
        parent::__construct(Role::class);
    }

    public function getAllAdminsRoles($order = 'id', $sort = 'desc')
    {
        $roles = $this->model->where("type", RoleType::ADMIN)
        // ->whereHas('permissions', function($query){
        //             $query->where('name','dashboard_access');
        //          })
        ->orderBy($order, $sort)->get();
        return $roles;
    }

    public function getSelectedToOptions($request, $order = 'id', $sort = 'desc', $select="display_name")
    {
        $record =
            $this->model->select("id", "$select")
        ;
        if($request->input("type")){
            $record->where("type", $request->type);
        }
        if($request->input('search')) {
            $record->where($select, 'like', '%'. $request->input('search') .'%');
        }
        $record = $record->orderBy($order, $sort)->get();
        return $record;
    }


    public function getAllCompanyOwnersRoles($order = 'id', $sort = 'desc')
    {
        $roles = $this->model->whereHas('perms', function($query){
                    $query->where('name','company_dashboard_access');
                 })->orderBy($order, $sort)->get();
        return $roles;
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {

            $role = $this->model->create($request->except('permission'));
            $role->permissions()->attach($request->permission);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function update(Request $request,$id)
    {
        DB::beginTransaction();

        try {

            $role = $this->findById($id);

            // $role->update([
            //   'name'                => $request->name,
            //   "type"                => $request->type,
            // ]);

            $role->update($request->except('permission'));
            $role->permissions()->sync($request->permission);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }
}
