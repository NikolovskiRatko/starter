<?php

namespace App\Applications\Product\BLL;
use App\Applications\Product\Model\Product;
use stdClass;

/**
 * Interface PriceConfiguratorInterface
 * @package App\Applications\Product
 */
interface PriceConfiguratorInterface
{
    /**
     * @param Product|stdClass $product
     * @return array
     */
    public function getOffers($product);

    /**
     * @param Product $product
     * @param float $format_coefficient
     * @param integer $size_coefficient
     * @return float
     */
    public function calculatePrintPreparationPrice($product, $format_coefficient, $size_coefficient);

    /**
     * @param Product $product
     * @param float $format_coefficient
     * @param integer $size_coefficient
     * @return float
     */
    public function calculatePrintPrice($product, $format_coefficient, $size_coefficient);

    /**
     * @param Product $product
     * @param integer $length
     * @param integer $width
     * @param float $format_coefficient
     * @return float
     */
    public function calculatePaperPrice($product, $length, $width,  $format_coefficient);

    /**
     * @param Product $product
     * @param float $format_coefficient
     * @param integer $size_coefficient
     * @param integer $parts
     * @return float
     */
    public function calculatePunchPrice($product, $format_coefficient, $parts, $size_coefficient);

    /**
     * @param Product $product
     * @param integer $parts
     * @return float
     */
    public function calculatePunchPreparationPrice($product, $parts);

    /**
     * @param Product $product
     * @param integer $parts
     * @return float
     */
    public function calculatePunchLength($product, $parts);

    /**
     * @param Product $product
     * @param integer $format_coefficient
     * @return float
     */
    public function calculateGluingPrice($product, $format_coefficient);

    /**
     * @param Product $product
     * @return float
     */
    public function calculateTyingPrice($product);

    /**
     * @param Product $product
     * @return float
     */
    public function calculateBottomAndFoldPrice($product);

    /**
     * @param Product $product
     * @param integer $length
     * @param integer $width
     * @param float $format_coefficient
     * @return float
     */
    public function calculateLaminationPrice($product, $length, $width, $format_coefficient);

    /**
     * @param Product $product
     * @param float $format_coefficient
     * @param integer $price
     * @return float
     */
    public function calculateVarnishPreparationPrice($product, $format_coefficient, $price);

    /**
     * @param Product $product
     * @param float $format_coefficient
     * @param integer $price
     * @return float
     */
    public function calculateVarnishPrice($product, $format_coefficient, $price);

    /**
     * @param Product $product
     * @param float $format_coefficient
     * @param integer $price_first
     * @param integer $price_additional
     *
     * @return float
     */
    public function calculateHotFoilClichesPreparationPrice($product, $format_coefficient, $price_first, $price_additional);

    /**
     * @param Product $product
     * @param float $format_coefficient
     * @param integer $punch_price
     * @param float $price_per_meter
     *
     * @return float
     */
    public function calculateHotFoilClichesPrice($product, $format_coefficient, $punch_price, $price_per_meter);

    /**
     * @param Product $product
     * @param float $format_coefficient
     * @param integer $price_first
     * @param integer $price_additional
     *
     * @return float
     */
    public function calculateEmbossingClichesPreparationPrice($product, $format_coefficient, $price_first, $price_additional);

    /**
     * @param Product $product
     * @param float $format_coefficient
     * @param integer $punch_price
     *
     * @return float
     */
    public function calculateEmbossingClichesPrice($product, $format_coefficient, $punch_price);

    /**
     * @param Product $product
     * @return integer
     */
    public function getNumberOfColors($product);

    /**
     * @param $product
     * @return integer
     */
    public function calculatePackaging($product);

}
