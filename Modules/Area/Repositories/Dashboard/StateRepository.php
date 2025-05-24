<?php

namespace Modules\Area\Repositories\Dashboard;

use Modules\Core\Repositories\Dashboard\CrudRepository;

class StateRepository extends CrudRepository
{
    public function getSelectedToOptions($request, $order = 'id', $sort = 'desc', $select="title")
    {
        $record = $this->globalScope(
            $this->model->query(),
            "getSelectedToOptions"
        )->active();

        if ($request->input('search')) {
            $record->where($select, 'like', '%'. $request->input('search') .'%');
        }
        if($request->city_id){
            $record->where("city_id", $request->city_id);
        }
        $record = $record->orderBy($order, $sort)->simplePaginate();

        return $record;
    }
}
