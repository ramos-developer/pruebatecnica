<?php

namespace App\Services;


use Bloonde\ProjectGenerator\AbstractClasses\AbstractService;
use Bloonde\ProjectGenerator\Helpers\CodesHelper;
use Illuminate\Support\Facades\Lang;

use App\Configurations\PostConfigurationImpl;
use App\Repositories\PostRepository;
use App\Http\Resources\PostResource;
use App\Http\Resources\PostResourceCollection;

class PostService extends AbstractService
{

    protected $repository;

    private static $__instance = null;

    public $configuration_impl;
    public $model;



    public function __construct()
    {
        
        $this->configuration_impl = new PostConfigurationImpl();
        $this->model = $this->configuration_impl->getModelName();
        $this->repository = PostRepository::getInstance();
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
        $result = new PostResource($model);
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
        $response = new PostResourceCollection($response);
        return $response;
    }

    public function getSelectorList($input){
        $response = $this->repository->getSelectorList($input);
        return $response;
    }

    public function update($request, $id = null){
        $model = $this->model::firstOrNew(['id' => $id]);
        $this->set($request, $model);
        return $this->get($model->id);
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
            self::$__instance = new PostService();
        }
        return self::$__instance;
    }
}
