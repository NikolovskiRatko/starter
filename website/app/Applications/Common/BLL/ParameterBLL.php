<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\TaxonomiesDALInterface;

/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 */
class ParameterBLL implements ParameterBLLInterface
{


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
    }

    public function getAllParameters(){
        return $this->taxonomiesDAL->getAllParameters()->toJson();
    }

    public function orderParameters($request){
        $ordered_collection = $request->all();
        foreach ($ordered_collection as $key => $taxonomy) {
            $data_array = ['order' => $key];
            $this->taxonomiesDAL->updateTaxonomyById('parameter', $taxonomy['id'], $data_array);
        }
        return ['message' => 'Parameters reordered'];
    }

    public function editParameter($request, $id){
        $data_array = $this->getParameterDataArray($request);
        return $this->taxonomiesDAL->updateTaxonomyById('parameter', $id, $data_array);
    }

    public function newParameter($request){
        $data_array = $this->getParameterDataArray($request);
        $taxonomy = $this->taxonomiesDAL->newTaxonomy('parameter', $data_array);
        return $taxonomy->id;
    }

    private function getParameterDataArray($request){
        $data_array['display_name'] = $request->input('display_name');
        $data_array['value'] = $request->input('value');
        return $data_array;
    }
}
