<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\DAL\TaxonomiesDALInterface;
use App\Applications\Common\Model\Combination;
//use App\Applications\Common\Model\Format;
use App\Applications\Common\Model\Parameter;
use App\Applications\Common\Model\Ratio;
//use App\Applications\Common\Model\Color;
//use App\Applications\Common\Model\Handle;
//use App\Applications\Common\Model\Lamination;
//use App\Applications\Common\Model\Paper;
use Illuminate\Support\Facades\DB;
use Webpatser\Countries\Countries;
use App\Applications\Common\Model\Format;
use App\Applications\Common\Model\Cliche;
use App\Applications\Common\Model\Color;
use App\Applications\Common\Model\Handle;
use App\Applications\Common\Model\Lamination;
use App\Applications\Common\Model\Paper;
use App\Applications\Common\Model\PackageWeight;
/*INSERT NEW IMPORTS HERE*/


/**
 * @property Handle $handle
 * @property Lamination $lamination
 * @property Paper $paper
 * @property Color $color
 * @property Parameter $parameter
 * @property Ratio $ratio
 * @property Combination $combination
 * @property Format $format
 * @property Countries countries
 */
class TaxonomiesDAL implements TaxonomiesDALInterface
{

    public function __construct(
        Parameter $parameter,
        Ratio $ratio,
        Combination $combination,
        Countries $countries,
		Format $format,
		Cliche $cliche,
		Color $color,
		Handle $handle,
		Lamination $lamination,
		Paper $paper,
		PackageWeight $packageweight/*INJECT DEPENDENCY HERE*/
    ){
        $this->parameter = $parameter;
        $this->ratio = $ratio;
        $this->combination = $combination;
        $this->countries = $countries;
        $this->format = $format;
		$this->cliche = $cliche;
		$this->color = $color;
		$this->handle = $handle;
		$this->lamination = $lamination;
		$this->paper = $paper;
		$this->packageweight = $packageweight;
		/*SET DEPENDENCY HERE*/
    }

    public function getHandleTypes(){
        return $this->handle->all('id', 'name', 'display_name')->sortBy('order');
    }

    public function getLaminationTypes(){
        return $this->lamination->all('id', 'name', 'display_name')->sortBy('order');
    }

    public function getPaperTypes(){
        return $this->paper->all('id', 'name', 'display_name', 'type', 'weight')->groupBy('type');
    }

    public function getColorTypes(){
        return $this->color->where('type','Product')->get(['id', 'name', 'display_name']);
    }

    public function getHandleColorTypes(){
        return $this->color->where('type','Handle')->get(['id', 'name', 'display_name']);
    }

    public function getParameterByName($name){
        return $this->parameter
                    ->where('name', $name)
                    ->first();
    }

    public function getRatios(){
        return $this->ratio->all()->sortBy('order');
    }

    public function getCombinations(){
        return $this->combination->orderBy('order')->get();
    }

    public function getAllCombinations(){
        return $this->combination->withTrashed()->orderBy('order')->get();
    }

    public function getFormats(){
        return $this->format->all()->sortBy('order');
    }

    public function getParameters(){
        return $this->parameter->all()->sortBy('order');
    }

    public function getAllParameters(){
        return $this->parameter->withTrashed()->orderBy('order')->get();
    }


    public function getAllFormats(){
        return $this->format->withTrashed()->orderBy('order')->get();
    }


    public function getAllCliches(){
        return $this->cliche->withTrashed()->orderBy('order')->get();
    }


    public function getAllColors(){
        return $this->color->withTrashed()->orderBy('order')->get();
    }


    public function getAllHandles(){
        return $this->handle->withTrashed()->orderBy('order')->get();
    }


    public function getAllLaminations(){
        return $this->lamination->withTrashed()->orderBy('order')->get();
    }


    public function getAllPapers(){
        return $this->paper->withTrashed()->orderBy('order')->get()->makeHidden(['ratios']);
    }

    
    public function getAllPackageWeights(){
        return $this->packageweight->withTrashed()->orderBy('order')->get();
    }

    /*INSERT NEW CONFIGURATOR OPTIONS HERE*/

    public function updateTaxonomyById($type, $id, $data_array){
        return $this->{$type}
                    ->where('id', $id)
                    ->withTrashed()
                    ->update($data_array);
    }

    public function newTaxonomy($type, $data_array){
        $order = $this->{$type}->max('order')+1;
        $data_array['order'] = $order;
        return $this->{$type}
                    ->create($data_array);
    }

    public function getTaxonomy($type, $id){
        return $this->{$type}
                    ->where('id', $id)
                    ->withTrashed()
                    ->first();
    }

    public function deleteTaxonomy($type, $id){
        return $this->{$type}
                    ->where('id', $id)
                    ->delete();
    }

    public function restoreTaxonomy($type, $id){
        return $this->{$type}
                    ->where('id', $id)
                    ->restore();
    }

    public function updateCombination($data_array, $id){
        return $this->combination
            ->where('id', $id)
            ->update($data_array);
    }

    public function updateParameter($data_array, $id){
        return $this->parameter
            ->where('id', $id)
            ->update($data_array);
    }

    public function getCountries(){
        return $this->countries->getList();
    }

}
