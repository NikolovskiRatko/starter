<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\TaxonomiesDALInterface;


/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 */
class FormatBLL implements FormatBLLInterface
{


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
    }

    public function getAllFormats(){
        return $this->taxonomiesDAL->getAllFormats()->toJson();
    }

    public function orderFormats($request){
        $ordered_collection = $request->all();
        foreach ($ordered_collection as $key => $taxonomy) {
            $data_array = ['order' => $key];
            $this->taxonomiesDAL->updateTaxonomyById('format', $taxonomy['id'], $data_array);
        }
        return ['message' => 'Formats reordered'];
    }

    public function editFormat($request, $id){
        $data_array = $this->getFormatDataArray($request);
        return $this->taxonomiesDAL->updateTaxonomyById('format', $id, $data_array);
    }

    public function newFormat($request){
        $data_array = $this->getFormatDataArray($request);
        $taxonomy = $this->taxonomiesDAL->newTaxonomy('format', $data_array);
        return $taxonomy->id;
    }

    private function getFormatDataArray($request){
        $data_array['name'] = $request->input('name');
        $data_array['parts'] = $request->input('parts');
        $data_array['format_coefficient'] = $request->input('format_coefficient');
        $data_array['gluing_coefficient'] = $request->input('gluing_coefficient');
        return $data_array;
    }
}
