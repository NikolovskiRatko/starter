<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\MediaDALInterface;
use App\Applications\Common\DAL\TaxonomiesDALInterface;
use Illuminate\Http\Request;


/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 * @property MediaDALInterface $mediaDAL
 */
class CombinationBLL implements CombinationBLLInterface
{


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL,
        MediaDALInterface $mediaDAL
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
        $this->mediaDAL = $mediaDAL;
    }

    public function getAllCombinations(){
        return $this->taxonomiesDAL->getAllCombinations()->toJson();
    }

    public function orderCombinations($request){
        $ordered_collection = $request->all();
        foreach ($ordered_collection as $key => $taxonomy) {
            $data_array = ['order' => $key];
            $this->taxonomiesDAL->updateTaxonomyById('combination', $taxonomy['id'], $data_array);
        }
        return ['message' => 'Combinations reordered'];
    }

    public function editCombination($request, $id){
        $data_array = $this->getCombinationDataArray($request);
        $taxonomy = $this->taxonomiesDAL->getTaxonomy('combination', $id);
        $this->mediaDAL->save($request, $taxonomy, 'bag_sizes', 'image');
        return $this->taxonomiesDAL->updateCombination($data_array, $id);
    }

    public function newCombination($request){
        $data_array = $this->getCombinationDataArray($request);
        $taxonomy = $this->taxonomiesDAL->newTaxonomy('combination', $data_array);
        $this->mediaDAL->save($request, $taxonomy, 'bag_sizes', 'image');
        return $taxonomy->id;
    }

    private function getCombinationDataArray($request){
        $data_array['name'] = $request->input('name');
        $data_array['width'] = $request->input('width');
        $data_array['length'] = $request->input('length');
        $data_array['height'] = $request->input('height');
        return $data_array;
    }
}
