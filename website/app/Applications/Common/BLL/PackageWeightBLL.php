<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\MediaDALInterface;
use App\Applications\Common\DAL\TaxonomiesDALInterface;
use Illuminate\Http\Request;


/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 * @property MediaDALInterface $mediaDAL
 */
class PackageWeightBLL implements PackageWeightBLLInterface
{


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL,
        MediaDALInterface $mediaDAL
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
        $this->mediaDAL = $mediaDAL;
    }

    public function getAllPackageWeights(){
        return $this->taxonomiesDAL->getAllPackageWeights()->toJson();
    }

    public function orderPackageWeights($request){
        $ordered_collection = $request->all();
        foreach ($ordered_collection as $key => $taxonomy) {
            $data_array = ['order' => $key];
            $this->taxonomiesDAL->updateTaxonomyById('packageweight', $taxonomy['id'], $data_array);
        }
        return ['message' => 'PackageWeights reordered'];
    }

    public function editPackageWeight($request, $id){
        $data_array = $this->getPackageWeightDataArray($request);
        $taxonomy = $this->taxonomiesDAL->getTaxonomy('packageweight', $id);
        $this->mediaDAL->save($request, $taxonomy, 'images', 'image');
        return $this->taxonomiesDAL->updateTaxonomyById('packageweight', $id, $data_array);
    }

    public function newPackageWeight($request){
        $data_array = $this->getPackageWeightDataArray($request);
        $taxonomy = $this->taxonomiesDAL->newTaxonomy('packageweight', $data_array);
        $this->mediaDAL->save($request, $taxonomy, 'images', 'image');
        return $taxonomy->id;
    }

    private function getPackageWeightDataArray($request){
        $data_array['weight'] = $request->input('weight');
        $data_array['country_id'] = $request->input('country_id');
        return $data_array;
    }
}
