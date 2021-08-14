<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\TaxonomiesDALInterface;

/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 */
class LaminationBLL implements LaminationBLLInterface
{


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
    }

    public function getAllLaminations(){
        return $this->taxonomiesDAL->getAllLaminations()->toJson();
    }

    public function orderLaminations($request){
        $ordered_collection = $request->all();
        foreach ($ordered_collection as $key => $taxonomy) {
            $data_array = ['order' => $key];
            $this->taxonomiesDAL->updateTaxonomyById('lamination', $taxonomy['id'], $data_array);
        }
        return ['message' => 'Laminations reordered'];
    }

    public function editLamination($request, $id){
        $data_array = $this->getLaminationDataArray($request);
        return $this->taxonomiesDAL->updateTaxonomyById('lamination', $id, $data_array);
    }

    public function newLamination($request){
        $data_array = $this->getLaminationDataArray($request);
        $taxonomy = $this->taxonomiesDAL->newTaxonomy('lamination', $data_array);
        return $taxonomy->id;
    }

    private function getLaminationDataArray($request){
        $data_array['name'] = $request->input('name');
        $data_array['display_name'] = $request->input('display_name');
        $data_array['price'] = $request->input('price');
        return $data_array;
    }
}
