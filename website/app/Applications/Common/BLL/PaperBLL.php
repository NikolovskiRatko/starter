<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\TaxonomiesDALInterface;

/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 */
class PaperBLL implements PaperBLLInterface
{


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
    }

    public function getAllPapers(){
        return $this->taxonomiesDAL->getAllPapers()->toJson();
    }

    public function orderPapers($request){
        $ordered_collection = $request->all();
        foreach ($ordered_collection as $key => $taxonomy) {
            $data_array = ['order' => $key];
            $this->taxonomiesDAL->updateTaxonomyById('paper', $taxonomy['id'], $data_array);
        }
        return ['message' => 'Papers reordered'];
    }

    public function editPaper($request, $id){
        $data_array = $this->getPaperDataArray($request);
        return $this->taxonomiesDAL->updateTaxonomyById('paper', $id, $data_array);
    }

    public function newPaper($request){
        $data_array = $this->getPaperDataArray($request);
        $taxonomy = $this->taxonomiesDAL->newTaxonomy('paper', $data_array);
        return $taxonomy->id;
    }

    private function getPaperDataArray($request){
        $data_array['name'] = $request->input('name');
        $data_array['display_name'] = $request->input('display_name');
        $data_array['weight'] = $request->input('weight');
        $data_array['type'] = $request->input('type');
        $data_array['price'] = $request->input('price');
        $data_array['margin'] = $request->input('margin');
        return $data_array;
    }
}
