<?php

namespace App\Applications\Common\BLL;

use Illuminate\Http\Request;

/**
 * Interface TaxonomiesBLLInterface
 * @package App\Applications\Common
 */

interface TaxonomiesBLLInterface
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
     * @param Request $request
     *
     * @return array
     */
    public function orderCombinations($request);

    /**
     * @param string $type
     *
     * @return array
     */
    public function newTaxonomy($type);

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
     * @param Request $request
     * @param integer $id
     *
     * @return integer
     */
    public function editCombination($request, $id);

    /**
     * @param Request $request
     *
     * @return integer
     */
    public function newCombination($request);

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
    public function getCountries();

}
