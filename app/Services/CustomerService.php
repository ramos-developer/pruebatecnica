<?php

namespace App\Services;


use Bloonde\ProjectGenerator\AbstractClasses\AbstractService;
use Bloonde\ProjectGenerator\Helpers\CodesHelper;
use Illuminate\Support\Facades\Lang;

use App\Configurations\CustomerConfigurationImpl;
use App\Helpers\ProfileHelper;
use App\Repositories\CustomerRepository;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerResourceCollection;
use App\Models\CustomerHobbie;
use Bloonde\UsersAndPrivileges\Services\UserService;
use Bloonde\UsersAndPrivileges\User;
use Mockery\Undefined;
use phpDocumentor\Reflection\Types\Null_;

class CustomerService extends AbstractService
{

    protected $repository;

    private static $__instance = null;

    public $configuration_impl;
    public $model;
    protected $userService;



    public function __construct()
    {

        $this->configuration_impl = new CustomerConfigurationImpl();

        $this->model = $this->configuration_impl->getModelName();
        $this->repository = CustomerRepository::getInstance();
        $this->userService = UserService::getInstance();
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
        $user = User::where('email', $request->get('email'))->first();
        $user_id = null;
        if(!is_null($user)) {
            $user_id = $user->id;
        }
        $user = $this->userService->update($request, $user_id, [ProfileHelper::CUSTOMER_PROFILE]);
        $request->merge(['user_id' => $user->id]);
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

    private function setCustomerHobbiesPropio($request, $customer)
    {
        $hobbies = $request->get('hobbies');
        // Extraigo las claves de aquellos ya guardados
        $guarded_hobbies = array();
        foreach ($customer->hobbies as $hobbie) {
            array_push($guarded_hobbies, $hobbie->id);
        }
        //Creo un array para el método sync con los timestamp de cada caso
        $hobbies_withPivot = array();
        foreach ($hobbies as $hobbie ) {
            if (in_array($hobbie, $guarded_hobbies)) {
                $hobbies_withPivot[$hobbie] = [
                    'updated_at' => now()];
            } else {
                $hobbies_withPivot[$hobbie] = [
                    'created_at' => now(),
                    'updated_at' => now()];
            }
        }
        $customer->hobbies()->sync($hobbies_withPivot);
    }

    private function setCustomerHobbies($request, $customer)
    {
        $hobbies = $request->get('hobbies');
        $ids = [];
        foreach ($hobbies as $hobbie_id ) {
            $customer_hobbie = CustomerHobbie::firstOrCreate(['customer_id' => $customer->id, 'hobbie_id' => $hobbie_id]);
            array_push($ids, $customer_hobbie->id);
        }
        CustomerHobbie::where('customer_id', $customer->id)->whereNotIn('id', $ids)->delete();
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
