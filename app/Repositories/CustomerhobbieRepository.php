<?php

namespace App\Repositories;


use Bloonde\ProjectGenerator\AbstractClasses\AbstractRepository;
use App\Configurations\CustomerhobbieConfigurationImpl;

class CustomerhobbieRepository extends AbstractRepository
{

    public $configuration_impl;
    public $table_name;

    function __construct()
    {
        
        $this->configuration_impl = new CustomerhobbieConfigurationImpl();
        $this->table_name = $this->configuration_impl->getTableName();
    }

    private static $__instance = null;

    public function extendedBasicQuery(){
        return parent::basicQuery();
    }

    public function get($id){
        $query = $this->extendedBasicQuery()
            ->where($this->getTable() . '.id', '=', $id);
        $query = $this->detailsSelect($query);
        return $query->first(); // We use get because we expect severals result because the query has a join with 1 to n relationship
    }
    public function getList($input, $paginate = null){
        $input = $this->transformInputFilters($input);
        $input = $this->transformInputOrders($input);
        $query = $this->basicQuery($input);
        $query = $this->filter($query, $input);
        $query = $this->order($query, $input);
        $query = $this->listSelect($query);
        if($paginate != null && $paginate){
            $query = $this->pagination($query, $input);
            return $query; // return an array with 2 elements. The first the result of the query, the seconds the totals elements
        }else{
            $query = $query->get();
            return ['elements' => $query, 'total' => count($query)];
        }
    }
    public function getSelectorList($input){
        $query = $this->basicQuery($input);
        $query = $this->filter($query, $input);
        $query = $this->order($query, $input);
        $query = $this->selectorSelect($query);
        $query = $query->get();
        return $query;

    }
    protected function getFilters(){
        return $this->configuration_impl->getFilters();
    }
    protected function getSearchFilters(){
        return $this->configuration_impl->getSearchFilters();
    }
    protected function getOrders(){
        return $this->configuration_impl->getOrders();
    }
    protected function getTable(){
        return $this->configuration_impl->getTableName();
    }
    protected function getListSelect(){
        return $this->configuration_impl->getListSelect();
    }
    protected function getDetailsSelect(){
        return $this->configuration_impl->getDetailsSelect();
    }
    protected function getSelectorSelect(){
        return $this->configuration_impl->getSelectorSelect();
    }
    protected function getTransformSearchFilters(){
        return $this->configuration_impl->getTransformSearchFilters();
    }
    protected function getTransformOrders(){
        return $this->configuration_impl->getTransformOrders();
    }
    protected function getTransformSearchOrders(){
        return $this->configuration_impl->getTransformOrders();
    }

    public static function getInstance(){
        if(self::$__instance === null){
            self::$__instance = new CustomerhobbieRepository();
        }
        return self::$__instance;
    }
}
