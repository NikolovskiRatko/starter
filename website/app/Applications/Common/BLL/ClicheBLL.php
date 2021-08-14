<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\MediaDALInterface;
use App\Applications\Common\DAL\TaxonomiesDALInterface;
use Illuminate\Http\Request;


/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 * @property MediaDALInterface $mediaDAL
 */
class ClicheBLL implements ClicheBLLInterface
{


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL,
        MediaDALInterface $mediaDAL
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
        $this->mediaDAL = $mediaDAL;
    }

    public function getAllCliches(){
        return $this->taxonomiesDAL->getAllCliches()->toJson();
    }

    public function orderCliches($request){
        $ordered_collection = $request->all();
        foreach ($ordered_collection as $key => $taxonomy) {
            $data_array = ['order' => $key];
            $this->taxonomiesDAL->updateTaxonomyById('cliche', $taxonomy['id'], $data_array);
        }
        return ['message' => 'Cliches reordered'];
    }

    public function editCliche($request, $id){
        // We need all data from the request so we can generate this automatically (since everything needs to be editable)
        // If a column should not be editable it needs to be removed manually
        $data_array = $request->all();//$this->getFormatDataArray($request);
        unset($data_array['order']);
        unset($data_array['created_at']);
        unset($data_array['updated_at']);
        unset($data_array['deleted_at']);
        unset($data_array['id']);
        $taxonomy = $this->taxonomiesDAL->getTaxonomy('cliche', $id);
        $this->mediaDAL->save($request, $taxonomy, 'images', 'image');
        return $this->taxonomiesDAL->updateTaxonomyById('cliche', $id, $data_array);
    }

    public function newCliche($request){
        $data_array = $this->getClicheDataArray($request);
        $taxonomy = $this->taxonomiesDAL->newTaxonomy('cliche', $data_array);
        $this->mediaDAL->save($request, $taxonomy, 'images', 'image');
        return $taxonomy->id;
    }

    private function getClicheDataArray($request){
//        $data_array['name'] = $request->input('name');
        $data_array = $request->all();
        return $data_array;
    }
}
