<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\TaxonomiesDALInterface;


/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 */
class ColorBLL implements ColorBLLInterface
{


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
    }

    public function getAllColors(){
        return $this->taxonomiesDAL->getAllColors()->toJson();
    }

    public function orderColors($request){
        $ordered_collection = $request->all();
        foreach ($ordered_collection as $key => $taxonomy) {
            $data_array = ['order' => $key];
            $this->taxonomiesDAL->updateTaxonomyById('color', $taxonomy['id'], $data_array);
        }
        return ['message' => 'Colors reordered'];
    }

    public function editColor($request, $id){
        $data_array = $this->getColorDataArray($request);
        return $this->taxonomiesDAL->updateTaxonomyById('color', $id, $data_array);
    }

    public function newColor($request){
        $data_array = $this->getColorDataArray($request);
        $taxonomy = $this->taxonomiesDAL->newTaxonomy('color', $data_array);
        return $taxonomy->id;
    }

    private function getColorDataArray($request){
        $data_array['display_name'] = $request->input('display_name');
        $data_array['name'] = $request->input('name');
        $data_array['type'] = $request->input('type');
        $data_array['hex_value'] = $request->input('hex_value');
        return $data_array;
    }
}
