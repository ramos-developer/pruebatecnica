<?php

namespace App\Http\Controllers;

use Bloonde\ProjectGenerator\AbstractClasses\AbstractController;
use Bloonde\ProjectGenerator\Helpers\CodesHelper;
use Illuminate\Support\Facades\DB;

use App\Services\CustomerhobbieService;
use App\Http\Requests\Customerhobbie\StoreFormRequest;

class CustomerhobbieController extends AbstractController
{

    protected $service;
    protected $configuration;

    public function __construct()
    {
        $this->service = CustomerhobbieService::getInstance();
    }

    public function store(StoreFormRequest $formRequest){
        DB::beginTransaction();
        $response = $this->getModelService()->update($formRequest);
        DB::commit();
        return response(json_encode($response), CodesHelper::OK_CREATION_CODE);
    }
    public function update(StoreFormRequest $formRequest, $id){
        DB::beginTransaction();
        $response = $this->getModelService()->update($formRequest, $id);
        DB::commit();
        return response(json_encode($response), CodesHelper::OK_CODE);
    }
    public function delete($id){
        DB::beginTransaction();
        $response = $this->getModelService()->delete($id);
        DB::commit();
        return response(json_encode($response), CodesHelper::OK_NO_CONTENT);
    }

    protected function getModelService(){
        return $this->service;
    }
}

?>