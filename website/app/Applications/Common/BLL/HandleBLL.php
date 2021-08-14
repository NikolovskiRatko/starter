<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\MediaDALInterface;
use App\Applications\Common\DAL\TaxonomiesDALInterface;
use Illuminate\Http\Request;


/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 * @property MediaDALInterface $mediaDAL
 */
class HandleBLL implements HandleBLLInterface
{


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL,
        MediaDALInterface $mediaDAL
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
        $this->mediaDAL = $mediaDAL;
    }

    public function getAllHandles(){
        return $this->taxonomiesDAL->getAllHandles()->toJson();
    }

    public function orderHandles($request){
        $ordered_collection = $request->all();
        foreach ($ordered_collection as $key => $taxonomy) {
            $data_array = ['order' => $key];
            $this->taxonomiesDAL->updateTaxonomyById('handle', $taxonomy['id'], $data_array);
        }
        return ['message' => 'Handles reordered'];
    }

    public function editHandle($request, $id){
        $data_array = $this->getHandleDataArray($request);
        $taxonomy = $this->taxonomiesDAL->getTaxonomy('handle', $id);
        $taxonomy->colors()->sync($request->input('colors'));
        $this->mediaDAL->save($request, $taxonomy, 'images', 'image');
        return $this->taxonomiesDAL->updateTaxonomyById('handle', $id, $data_array);
    }

    public function newHandle($request){
        $data_array = $this->getHandleDataArray($request);
        $taxonomy = $this->taxonomiesDAL->newTaxonomy('handle', $data_array);
        $this->mediaDAL->save($request, $taxonomy, 'images', 'image');
        return $taxonomy->id;
    }

    private function getHandleDataArray($request){
        $data_array['display_name'] = $request->input('display_name');
        $data_array['fold'] = $request->input('fold');
        $data_array['price'] = $request->input('price');
        $data_array['tying'] = $request->input('tying');
        $data_array['height'] = $request->input('height');
        $data_array['width'] = $request->input('width');
        return $data_array;
    }
}
