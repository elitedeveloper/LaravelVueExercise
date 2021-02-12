<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostalCode\StorePostalCode;
use App\PostalCode;
use App\Repositories\Repository;
use Illuminate\Http\Request;

class PostalCodeController extends Controller
{
   protected $model;

   public function __construct(PostalCode $postalCode)
   {
       // set the model
       $this->model = new Repository($postalCode);
   }

   public function index()
   {
       return $this->model->all();
   }

   public function store(StorePostalCode $request)
   {
       // create record and pass in only fields that are fillable
        $results = $this->model->create($request->only($this->model->getModel()->fillable));
        return $results->id;
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
