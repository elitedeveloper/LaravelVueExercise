<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Street\StoreStreet;
use App\Repositories\Repository;
use App\Street;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StreetsController extends Controller
{
    protected $model;

    public function __construct(Street $street)
    {
        // set the model
        $this->model = new Repository($street);
    }

    public function index()
    {
        return $this->model->all();
    }

    public function store(StoreStreet $request)
    {
        // create record and pass in only fields that are fillable
        $street = $this->model->create($request->only($this->model->getModel()->fillable));
        return $street->id;
    }

    public function show($id)
    {
        return $this->model->show($id);
    }

    public function update(Request $request, $id)
    {
        // update model and only pass in the fillable fields
        $this->model->update($request->only($this->model->getModel()->fillable), $id);

        return $this->model->find($id);
    }

    public function destroy($id)
    {
        return $this->model->delete($id);
    }

    public function datatable()
    {
        $query = $this->model->getModel()->query();
        return DataTables::of($query)
                ->editColumn('latitude', function ($street) {
                    if(!$street->latitude){
                        return $street->postalCode->latitude;
                    }
                    else{
                        return $street->latitude;
                    }
                })
                ->editColumn('longitude', function ($street) {
                    if(!$street->longitude){
                        return $street->postalCode->longitude;
                    }
                    else{
                        return $street->longitude;
                    }
                })
                ->editColumn('country', function ($street) {
                    return @$street->postalCode->country;
                })
                ->editColumn('locality', function ($street) {
                    return @$street->postalCode->locality;
                })
                ->make(true);
    }
}
