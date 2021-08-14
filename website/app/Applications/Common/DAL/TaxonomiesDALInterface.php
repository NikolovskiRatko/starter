<?php

namespace App\Applications\Common\DAL;

use App\Applications\Common\Model\Parameter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface TaxonomiesDALInterface
 * @package App\Applications\Common
 */

interface TaxonomiesDALInterface
{
    /**
     * @return array
     */
    public function getHandleTypes();

    /**
     * @return array
     */
    public function getLaminationTypes();

    /**
     * @return array
     */
    public function getPaperTypes();

    /**
     * @return array
     */
    public function getColorTypes();

    /**
     * @return array
     */
    public function getHandleColorTypes();

    /**
     * @param string $name
     * @return Parameter
     */
    public function getParameterByName($name);

    /**
     * @param string $type
     * @param int $id
     * @param int $order
     *
     * @return boolean
     */
    public function updateTaxonomyById($type, $id, $data_array);

    /**
     * @return array
     */
    public function getRatios();

    /**
     * @return array
     */
    public function getCombinations();

    /**
     * @return array
     */
    public function getAllCombinations();

    /**
     * @param array $data_array
     * @param string $type
     *
     * @return Model
     */
    public function newTaxonomy($type, $data_array);

    /**
     * @param string $type
     * @param integer $id
     *
     * @return Model
     */
    public function getTaxonomy($type, $id);

    /**
     * @param string $type
     * @param integer $id
     *
     * @return integer
     */
    public function deleteTaxonomy($type, $id);

    /**
     * @param string $type
     * @param integer $id
     *
     * @return integer
     */
    public function restoreTaxonomy($type, $id);

    /**
     * @param array $data_array
     * @param integer $id
     *
     * @return integer
     */
    public function updateCombination($data_array, $id);

    /**
     * @param array $data_array
     * @param integer $id
     *
     * @return integer
     */
    public function updateParameter($data_array, $id);

    /**
     * @return array
     */
    public function getFormats();

    /**
     * @return array
     */
    public function getParameters();

    /**
     * @return array
     */
    public function getAllParameters();

    /**
     * @return array
     */
    public function getCountries();

}
