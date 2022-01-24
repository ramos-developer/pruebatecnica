<?php

namespace App\Configurations;

use Bloonde\ProjectGenerator\FrameworkClasses\IFrameworkConfiguration;

class CustomerConfigurationImpl implements IFrameworkConfiguration
{

    /**
     *  Debe retornar un string con el nombre de la clase Model del recurso
     */
    public function getModelName(){
        /**
         * return 'User';
         */
        return 'App\Models\Customer';
    }

    /**
     * Debe retornar un string con el nombre de la tabla del recurso en la base de datos
     */
    public function getTableName(){
        /**
         * return 'users';
         */
        return 'customers';
    }
    /**
     * Debe retornar un array (clave, valor), en el que la clave sea el atributo a validar y el valor un string
     * o un array de reglas para dicho atributo
     */
    public function getRules(){
        /**
         * return [
         *      'name'  => 'required|string
         *      'email'  => 'required|unique|mail
         * ]
         */
        return [
            'name' => 'required',
            'surname' => 'required',
        ];

    }

    /**
     * Debe retornar un array con los atributos que serán guardados automáticamente (tal y como vienen en el $request)
     * en las operaciones de creación y de actualización.
     */
    public function getAutoSaveFields(){
        /**
         * return ['name', 'email']
         */
        return [
            'user_id',
            'surname',
        ];
    }

    /**
     * Debe retornar un array con los campos que se pueden filtrar en la consulta de listado y de detalles por defecto.
     * Cada elemento del array puede ser o bien un string (indicando el campo), para el cual se utilizará la operación
     * where en el filtro, obien un array clave valor en el que el valor de la clave 'field' es el nombre del campo,
     * y el valor de la clave 'operator' es la operación a realizar en el filtro. En ocasiones puede ser conveniente añadir
     * delante del atributo el nombre de la tablas (en vez de poner name, poner users.name) para que no haya conflicto con otros
     * atributos de tablas con las que se realice un join
     */
    public function getFilters(){
        /**
         * return ['name', 'filter', ['field' => 'status', 'operator' => 'in']
         */
        return ['profile_id', 'status_id'];
    }

    /**
     * Debe retornar un array con los campos sobre los que se puede hacer una búsqueda
     */
    public function getSearchFilters(){
        /**
         * return ['name', 'filter']
         */
        return ['name', 'surname', 'email'];
    }

    /**
     * Debe retornar un array con los campos sobre los que podremos realizar ordenación
     */
    public function getOrders(){
        /**
         * return ['id', 'name', 'filter']
         */
        return ['name', 'surname', 'email'];
    }

    /**
     * Debe retornar un array de campos sobre los que se va a hacer la selección en las operaciones de listado
     */
    public function getListSelect(){
        /**
         * return ['users.*']
         */
        return ['customers.*', 'users.name as name', 'users.email as email'];
    }

    /**
     * Debe retornar un array de campos sobre los que se va a hacer la selección en las operaciones de detalles
     */
    public function getDetailsSelect(){
        /**
         * return ['users.*']
         */
        return ['customers.*', 'users.name as name', 'users.email as email'];
    }

    /**
     * Debe retornar un array de campos sobre los que se va a hacer la selección en las operaciones de listado para un selector
     */
    public function getSelectorSelect(){
        /**
         * return ['users.id as id',
         *          'users.name as name']
         */
        return [];

    }

    public function getTransformSearchFilters(){
        /**
         * return ['id' => 'users.id']
         */
        return [];
    }
    public function getTransformOrders(){
        /**
         * return ['id' => 'users.id']
         */
        return [];
    }
}
