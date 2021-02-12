<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Street\StoreStreet;
use App\Repositories\Repository;
use App\Street;
use Illuminate\Http\Request;

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
        return $this->model->create($request->only($this->model->getModel()->fillable));
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
}
