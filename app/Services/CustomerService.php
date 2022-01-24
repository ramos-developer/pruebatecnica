<?php

namespace App\Services;


use Bloonde\ProjectGenerator\AbstractClasses\AbstractService;
use Bloonde\ProjectGenerator\Helpers\CodesHelper;
use Illuminate\Support\Facades\Lang;

use App\Configurations\CustomerConfigurationImpl;
use App\Repositories\CustomerRepository;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerResourceCollection;

class CustomerService extends AbstractService
{

    protected $repository;

    private static $__instance = null;

    public $configuration_impl;
    public $model;



    public function __construct()
    {
        
        $this->configuration_impl = new CustomerConfigurationImpl();
        $this->model = $this->configuration_impl->getModelName();
        $this->repository = CustomerRepository::getInstance();
    }

    /** This function receive an id and return the venue with the id
     * @param $id
     * @return mixed
     */
    public function get($id, $withResponse = false){
        $model = $this->repository->get($id);
        if(is_null($model)){
            return response(Lang::get('httpResponses')[CodesHelper::NOT_FOUND], CodesHelper::NOT_FOUND);
        }
        $result = new CustomerResource($model);
        if($withResponse){
            return response(json_encode($result), CodesHelper::OK_CODE);
        }
        return $result;
    }

    /** This function receive an input array and return a venue array
     * @param $input - This parameter contains query params in order to filter and order the db query
     * @return mixed
     */
    public function list($input){
        $paginate = isset($input['page']); //When the list is for a select, the params page isn't send
        $response = $this->repository->getList($input, $paginate);
        $response = new CustomerResourceCollection($response);
        return $response;
    }

    public function getSelectorList($input){
        $response = $this->repository->getSelectorList($input);
        return $response;
    }

    public function update($request, $id = null){
        // TODO Aquí hay que crear o actualizar el usuario customer. Una vez hecho, se actualizan los datos de la tabla customer
        $model = $this->model::firstOrNew(['id' => $id]);
        $customer = $this->set($request, $model);
        // TODO setear customer hobbies.
        $this->setCustomerHobbies($request, $customer);
        return $this->get($model->id);
    }

    public function extraSet($request, $model, $extra, $prefix)
    {
        // TODO Esto sería para hacer algún tratamiento especial con algún campo.
        return parent::extraSet($request, $model, $extra, $prefix);
    }

    private function setCustomerHobbies($request, $customer)
    {
        $hobbies = $request->get('hobbies');
        $customer->hobbies()->syncWithPivotValues($hobbies, ['created_at' => now(), 'updated_at' => now()]);
    }

    public function delete($id){
        $this->model::where('id', '=', $id)->delete();
        return null;
    }

    public function getFields()
    {
        return $this->configuration_impl->getAutoSaveFields();
    }

    public static function getInstance(){
        if(self::$__instance === null){
            self::$__instance = new CustomerService();
        }
        return self::$__instance;
    }
}
