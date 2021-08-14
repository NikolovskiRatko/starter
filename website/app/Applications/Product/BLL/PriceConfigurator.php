<?php

namespace App\Applications\Product\BLL;

use App\Applications\Common\DAL\TaxonomiesDALInterface;
use App\Applications\Common\Model\PackageWeight;
use App\Applications\Product\Model\Product;
use Illuminate\Database\Eloquent\Builder;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;


/**
 * @property TaxonomiesDALInterface $taxonomiesDAL
 * @property PackageWeight packageWeight
 */
class PriceConfigurator implements PriceConfiguratorInterface
{

    private $punch_coefficient;
    private $price_of_plate;
    private $price_of_print_preparation;
    private $price_per_sheet;
    private $price_of_punch;
    private $price_of_punch_preparation;
    private $price_of_channel_plate;
    private $price_of_punch_hit;
    private $links_length;
    private $cardboard_bottom;
    private $cardboard_fold;
    private $cardboard;
    private $price_of_hot_stamp;
    private $price_of_embossing_stamp;


    public function __construct(
        TaxonomiesDALInterface $taxonomiesDAL,
        PackageWeight $packageWeight
    ){
        $this->taxonomiesDAL = $taxonomiesDAL;
        $this->packageWeight = $packageWeight;
    }

    public function getOffers($product){
        $formats = $this->taxonomiesDAL->getFormats();
        $ratios = $this->taxonomiesDAL->getRatios();
        $this->populateConstants();
        $results_array = [];
        $valid_offers = [];
        $valid_ratios = [];
        $ratio7050 = [];
        $valid_formats = [];
        foreach ($formats as $format) {
            $ratio_array = [];
            foreach ($ratios as $ratio) {
                $availability = $this->checkAvailability($product, $format, $ratio);
                $ratio_availability = $this->checkRatioAvailability($product, $ratio);
                $print_preparation = $this->calculatePrintPreparationPrice($product, $format->format_coefficient, $ratio->print_coefficient);
                $print = $this->calculatePrintPrice($product, $format->format_coefficient, $ratio->print_coefficient);
                $print_total = $print_preparation + $print;
                $paper = $this->calculatePaperPrice($product, $ratio->length, $ratio->width, $format->format_coefficient);
                $punching_preparation = $this->calculatePunchPreparationPrice($product, $format->parts);
                $punch = $this->calculatePunchPrice($product, $format->format_coefficient, $format->parts, $ratio->punch_coefficient);
                $gluing = $this->calculateGluingPrice($product, $format->gluing_coefficient);
                $handles_and_tying = $this->calculateTyingPrice($product);
                $bottom_and_fold = $this->calculateBottomAndFoldPrice($product);
                $lamination = $this->calculateLaminationPrice($product, $ratio->length, $ratio->width, $format->format_coefficient);
                $varnish_preparation = $this->calculateVarnishPreparationPrice($product, $format->format_coefficient, $ratio->varnish_preparation_price);
                $varnish = $this->calculateVarnishPrice($product, $format->format_coefficient, $ratio->varnish_price);
                $hot_foil_preparation = $this->calculateHotFoilClichesPreparationPrice($product, $format->format_coefficient, $ratio->hot_foil_first_price, $ratio->hot_foil_additional_price);
                $hot_foil = $this->calculateHotFoilClichesPrice($product, $format->format_coefficient, $ratio->hot_foil_under_1000_price, $ratio->hot_foil_per_meter_price);
                $embossing_preparation = $this->calculateEmbossingClichesPreparationPrice($product, $format->format_coefficient, $ratio->embossing_first_price, $ratio->embossing_additional_price);
                $embossing = $this->calculateEmbossingClichesPrice($product, $format->format_coefficient, $ratio->embossing_under_1000_price);
                if ($product->quantity > 1000) {
                    $hot_foil = $this->calculateHotFoilClichesPrice($product, $format->format_coefficient, $ratio->hot_foil_over_1000_price, $ratio->hot_foil_per_meter_price);
                    $embossing = $this->calculateEmbossingClichesPrice($product, $format->format_coefficient, $ratio->embossing_over_1000_price);
                }
                $total = $print_total + $paper + $punching_preparation * $this->punch_coefficient
                    + $punch + $gluing + $handles_and_tying + $bottom_and_fold
                    + $lamination + $varnish_preparation + $varnish + $hot_foil_preparation
                    + $hot_foil + $embossing_preparation + $embossing;

                if ($availability && $ratio_availability && $total) {
                    $valid_offers[] = $total;
                    $valid_ratios[] = $ratio->name;
                    $ratio7050[] = $ratio->id<=4;
                    $valid_formats[] = $format->name;
                }
                $ratio_array[$ratio->name] = [
                    'ratio_id' => $ratio->id,
                    'ratio_name' => $ratio->name,
                    'format_availability' => $availability,
                    'ratio_availability' => $ratio_availability,
                    'print_preparation' => $print_preparation,
                    'print' => $print,
                    'print_total' => $print_total,
                    'paper' => round($paper, 3),
                    'punching_preparation' => $punching_preparation,
                    'punch' =>  round($punch, 3),
                    'gluing' => $gluing,
                    'handles_and_tying' => $handles_and_tying,
                    'bottom_and_fold' => round($bottom_and_fold, 3),
                    'lamination' => round($lamination, 3),
                    'varnish_preparation' => $varnish_preparation,
                    'varnish' => round($varnish, 3),
                    'hot_foil_preparation' => $hot_foil_preparation,
                    'hot_foil' => $hot_foil,
                    'embossing_preparation' => $embossing_preparation,
                    'embossing' => $embossing,
                    'total' => round($total, 3)
                ];
            }
            $results_array[$format->name] = $ratio_array;
        }
        $min_offer = min($valid_offers);
        $min_offer_ratio = $valid_ratios[array_search($min_offer,$valid_offers)];
        $min_offer_format = $valid_formats[array_search($min_offer,$valid_offers)];

        $data['min_offer'] = round($min_offer,0,PHP_ROUND_HALF_UP);
        $data['optimal_offer']['optimal_price'] = round($min_offer,0,PHP_ROUND_HALF_UP);
        $data['optimal_offer']['price_per_bag'] = $data['optimal_offer']['optimal_price']/$product->quantity;
        $data['optimal_offer']['price_per_bag_eur'] = $data['optimal_offer']['price_per_bag']/1.95583;
        $data['optimal_offer']['optimal_format'] = $min_offer_ratio;
        $data['optimal_offer']['ratio'] = $min_offer_format;

        $min7050_offer = $this->min7050($valid_offers, $ratio7050);
        $min7050_offer_ratio = $valid_ratios[array_search($min7050_offer,$valid_offers)];
        $min7050_offer_format = $valid_formats[array_search($min7050_offer,$valid_offers)];
        $data['optimal7050_offer']['optimal_price'] = round($min7050_offer,0,PHP_ROUND_HALF_UP);
        $data['optimal7050_offer']['price_per_bag'] = $data['optimal7050_offer']['optimal_price']/$product->quantity;
        $data['optimal7050_offer']['price_per_bag_eur'] = $data['optimal7050_offer']['price_per_bag']/1.95583;
        $data['optimal7050_offer']['optimal_format'] = $min7050_offer_ratio;
        $data['optimal7050_offer']['ratio'] = $min7050_offer_format;


        $data['results_array'] = $results_array;

        return $data;
    }

    private function min7050($valid_offers, $ratio7050){
        $min = max($valid_offers);
        foreach($valid_offers as $key => $value){
            if($ratio7050[$key] && $value < $min)
                $min = $value;
        }
        return $min;
    }

    private function populateConstants(){
        $this->price_of_plate = $this->taxonomiesDAL->getParameterByName('plate')->value;
        $this->price_per_sheet = $this->taxonomiesDAL->getParameterByName('print_sheet')->value;
        $this->price_of_print_preparation = $this->taxonomiesDAL->getParameterByName('print_preparation')->value;
        $this->punch_coefficient = $this->taxonomiesDAL->getParameterByName('punch_coefficient')->value;
        $this->price_of_punch = $this->taxonomiesDAL->getParameterByName('punch_price')->value;
        $this->price_of_punch_preparation = $this->taxonomiesDAL->getParameterByName('punch_preparation')->value;
        $this->price_of_channel_plate = $this->taxonomiesDAL->getParameterByName('channel_plate')->value;
        $this->price_of_punch_hit = $this->taxonomiesDAL->getParameterByName('punch_hit')->value;
        $this->links_length = $this->taxonomiesDAL->getParameterByName('links_length')->value;
        $this->cardboard_bottom = $this->taxonomiesDAL->getParameterByName('cardboard_bottom')->value;
        $this->cardboard_fold = $this->taxonomiesDAL->getParameterByName('cardboard_fold')->value;
        $this->cardboard = $this->taxonomiesDAL->getParameterByName('cardboard')->value;
        $this->price_of_hot_stamp = $this->taxonomiesDAL->getParameterByName('hot_stamping_cliche')->value;
        $this->price_of_embossing_stamp = $this->taxonomiesDAL->getParameterByName('dry_cliche')->value;
    }

    private function checkAvailability($product, $format, $ratio){
        $height = $product->height + $product->length / 2 + 2 + $product->handle->fold;
        $width_1_part = ($product->width + $product->length) * 2 + 2;
        $width_2_parts = ($width_1_part - 2) / 2 + 2;
        $bag_area = $height * $width_1_part;
        $paper_area = $ratio->length * $ratio->width;
        switch ($format->id) {
            case 1:
                // 4 in 1 P
                return ($bag_area * 4 < $paper_area) && (2 * $width_1_part <= $ratio->length) && (2 * $height <= $ratio->width);
            case 2:
                // 4 in 1 L
                return ($bag_area * 4 < $paper_area) && (2 * $width_1_part <= $ratio->width) && (2 * $height <= $ratio->length);
            case 3:
                // 3 in 1 P
                return ($bag_area * 3 < $paper_area) && (3 * $width_1_part <= $ratio->length) && ($height <= $ratio->width);
            case 4:
                // 3 in 1 L
                return ($bag_area * 3 < $paper_area) && ($width_1_part <= $ratio->width) && (3 * $height <= $ratio->length);
            case 5:
                // 2 in 1 P
                return (($bag_area * 2 < $paper_area) && ($width_1_part <= $ratio->length) && (2 * $height <= $ratio->width))
                    || (($bag_area * 2 < $paper_area) && (2 * $width_1_part <= $ratio->length) && ($height <= $ratio->width));
            case 6:
                // 2 in 1 L
                return (($bag_area * 2 < $paper_area) && ($width_1_part <= $ratio->width) && (2 * $height <= $ratio->length))
                    || (($bag_area * 2 < $paper_area) && (2 * $width_1_part <= $ratio->width) && ($height <= $ratio->length));
            case 7:
                // 1 in 1 P
                return ($bag_area < $paper_area) && ($width_1_part <= $ratio->length) && ($height <= $ratio->width);
            case 8:
                // 1 in 1 L
                return ($bag_area < $paper_area) && ($width_1_part <= $ratio->width) && ($height <= $ratio->length);
            case 9:
                // 2x1/2 in 1 P
                return (($bag_area < $paper_area) && (2 * $width_2_parts <= $ratio->width) && ($height <= $ratio->length))
                    || (($bag_area < $paper_area) && ($width_2_parts <= $ratio->width) && (2 * $height <= $ratio->length));
            case 10:
                // 2x1/2 in 1 L
                return (($bag_area < $paper_area) && (2 * $width_2_parts <= $ratio->length) && ($height <= $ratio->width))
                    || (($bag_area < $paper_area) && ($width_2_parts <= $ratio->length) && (2 * $height <= $ratio->width));
            case 11:
                // 1/2 in 1 P
                return ($bag_area / 2 < $paper_area) && ($width_2_parts <= $ratio->length) && ($height <= $ratio->width);
            case 12:
                // 1/2 in 1 L
                return ($bag_area / 2 < $paper_area) && ($width_2_parts <= $ratio->width) && ($height <= $ratio->length);
            default:
                return false;
        }
    }

    private function checkRatioAvailability($product, $ratio){
        $boolean = false;
        foreach ($product->paper->ratios as $current_ratio) {
            if ($current_ratio->id == $ratio->id) $boolean = true;
        }
        return $boolean;
    }

    public function calculatePrintPreparationPrice($product, $format_coefficient, $size_coefficient){
        $number_of_colors = $this->getNumberOfColors($product);
        $format_coefficient = ceil($format_coefficient);

        return ($number_of_colors * $this->price_of_plate + $this->price_of_print_preparation)
               * $format_coefficient * $size_coefficient;
    }

    public function calculatePrintPrice($product, $format_coefficient, $size_coefficient){
        return ($product->quantity + 200) * $this->price_per_sheet
               * $format_coefficient * $size_coefficient;
    }

    public function calculatePaperPrice($product,  $length, $width,  $format_coefficient){
        $paper_area =  $length * $width;
        $number_of_colors = $this->getNumberOfColors($product);
        $price = $product->paper->weight * $product->paper->price * $paper_area / 10000000000;

        return $number_of_colors * 40 * $price * ceil($format_coefficient) + $product->quantity * $format_coefficient * $price * 1.02;
    }

    public function calculatePunchPreparationPrice($product, $parts = 1){
        // TODO: elements parameter is the same for all combinations, check what the logic is and if we should keep it in the algorithm
        $elements = 1;
        // TODO: use the parts parameter to decide which variable to use in the algorithm (this depends on the combination)
        $length = (int) $this->calculatePunchLength($product, $parts) ;

        return $elements * $length * $this->price_of_punch / 100;
    }

    public function calculatePunchPrice($product, $format_coefficient, $parts, $size_coefficient){
        $length = (int) $this->calculatePunchLength($product, $parts) ;

        return $this->price_of_punch_preparation + $this->price_of_channel_plate * $length / 100 + $product->quantity * $format_coefficient * $this->price_of_punch_hit * $size_coefficient;
    }

    public function calculatePunchLength($product, $parts){
        $height = $product->height + $product->length / 2 + 2 + $product->handle->fold;
        $width_1_part = ($product->width + $product->length) * 2 + 2;
        $width_2_parts = ($width_1_part - 2) / 2 + 2;
        $length = $product->length / 2;
        $length = $length * $length;
        $length = 2 * $length;

        $length_1_part = 7 * $height + 3 * $width_1_part + 9 * sqrt($length);
        $length_2_parts = 3 * $height + 3 * $width_2_parts + 5 * sqrt($length);

        if ($parts === 1) {
            return $length_1_part;
        } else {
            return $length_2_parts;
        }
    }

    public function calculateGluingPrice($product, $format_coefficient){
        $parameter_name =  'gluing_1_part_chrome';
        if (strpos($product->paper->name, 'kraft') !== false) {
            $parameter_name =  'gluing_1_part_kraft';
        }
        if ($format_coefficient === 2) {
            $parameter_name =  'gluing_2_parts_chrome';
            if (strpos($product->paper->name, 'kraft') !== false) {
                $parameter_name =  'gluing_2_parts_kraft';
            }
        }

        $price_of_gluing = $this->taxonomiesDAL->getParameterByName($parameter_name)->value;

        return $product->quantity * $price_of_gluing;
    }

    public function calculateTyingPrice($product){
        return $product->quantity * ($product->handle->price * $this->links_length + $product->handle->tying);
    }

    public function calculateBottomAndFoldPrice($product){
        $fold =  1;
        if (strpos($product->handle->name, 'paper') !== false) {
            $fold =  0;
        }
        // TODO: Check if this logic can be simplified with the commented code below
//        if (!$product->handle->fold) {
//            $fold =  0;
//        }

        $bottom_price = $product->width * $product->length * $this->cardboard_bottom * $this->cardboard *  $product->bottom;
        $fold_price = $product->width * 2 * $product->handle->fold * $this->cardboard_fold * $this->cardboard * $fold;
        $printed_bottom_price = $bottom_price * 0.5 * $product->printed_bottom;

        return ($bottom_price + $fold_price + $printed_bottom_price) / 10000000000 * $product->quantity
                + 50 * $product->printed_bottom;
    }

    public function calculateLaminationPrice($product, $length, $width, $format_coefficient){
        $area = $length * $width;

        return $area * $format_coefficient * $product->quantity * $product->lamination->price / 10000;
    }

    public function calculateVarnishPreparationPrice($product, $format_coefficient = 1, $price = 100){
        $format_coefficient = ceil($format_coefficient);
        $calculated_price = $format_coefficient * $price;
        if ($product->front_back) {
            $calculated_price = $price * $product->spot_uv;
        }
        return $calculated_price * $product->spot_uv;
    }

    public function calculateVarnishPrice($product, $format_coefficient = 1, $price = 0.15){
        return $price * $product->quantity * 1.05 * $format_coefficient * $product->spot_uv;
    }

    public function calculateHotFoilClichesPreparationPrice($product, $format_coefficient = 1, $price_first = 60, $price_additional = 15){
        $total_area = 0;
        $number_of_cliches = 3;
        foreach ($product->hot_foil_cliches as $cliche) {
            $total_area = $total_area + ((int) $cliche->width + 1) * ((int) $cliche->height + 1);
            if (!((int)$cliche->width)||!((int)$cliche->height)) $number_of_cliches--;
        }
        $price = $this->price_of_hot_stamp * $total_area;

        if ($number_of_cliches) {
            $price_additional = ($number_of_cliches - 1) * $price_additional;
        } else {
            $price_additional = 0;
        }
        if ($product->front_back) {
            $calculated_price = $price + $price_first + $price_additional;
        } else {
            $calculated_price = $price + ($price_first + $price_additional) * ceil($format_coefficient);
        }
        return $calculated_price;
    }

    public function calculateHotFoilClichesPrice($product, $format_coefficient = 1, $punch_price = 60, $price_per_meter = 1.4){
        $total_area = 0;
        foreach ($product->hot_foil_cliches as $cliche) {
            $total_area = $total_area + ((int) $cliche->width + 1) * ((int) $cliche->height + 1);
        }
        return ($price_per_meter * $total_area / 10000 + $punch_price) * ($product->quantity * 1.05) * $format_coefficient;
    }

    public function calculateEmbossingClichesPreparationPrice($product, $format_coefficient = 1, $price_first = 60, $price_additional = 15){
        $total_area = 0;
        $number_of_cliches = 3;
        foreach ($product->embossing_cliches as $cliche) {
            $total_area = $total_area + ((int) $cliche->width + 1) * ((int) $cliche->height + 1);
            if (!((int)$cliche->width)||!((int)$cliche->height)) $number_of_cliches--;
        }
        $price = $this->price_of_embossing_stamp * $total_area;
        if ($number_of_cliches) {
            $price_additional = ($number_of_cliches - 1) * $price_additional;
        } else {
            $price_additional = 0;
        }
        if ($product->front_back) {
            $calculated_price = $price + $price_first + $price_additional;
        } else {
            $calculated_price = $price + ($price_first + $price_additional) * ceil($format_coefficient);
        }
        return $calculated_price;
    }

    public function calculateEmbossingClichesPrice($product, $format_coefficient = 1, $punch_price = 0.05){
        // TODO: Check this business logic, as it seems like it is static
        return $punch_price * ($product->quantity * 1.05) * $format_coefficient;
    }

    public function getNumberOfColors($product){
        // TODO: implement calculation of number of colors including inside colors
        return count($product->outside_colors) + (int) $product->outside_spot_colors;
    }

    /**
     * @param $product
     * @return array|int
     */
    public function calculatePackaging($product){
        $paper_weight = $product->paper->weight;
        $thickness_base = ceil($paper_weight/30);
        $thickness_handle = $product->handle->width;
        $additional_height = $product->handle->height;
        $package = new stdClass();
        $package->width = $product->width;
        $package->length = $thickness_base + $thickness_handle;
        $package->height = $product->height + $additional_height;
        $original = [
            [60,40,23],
            [60,40,30],
            [60,40,40],
            [60,40,50],
            [60,40,60],
            [34,26,27]
        ];
        $dimensions = [];
        foreach ($original as $rn => $row)
            foreach ($row as $cn => $value)
                $dimensions[$rn][$cn] = $value - 2;
        $max_weights = [15];
        $compression_coefficient = 0.85;
        $rows_N = [];
        $rows_P = [];
        $qty_S = [];
        $space = [];
        $rows_L = [];
        $qty_L = [];
        $total_row = [];
        $total_A = [];
        foreach($dimensions as $row => $dimension){
            $rows_N [$row] = floor($dimension[2]/$package->width);
            $rows_P [$row] = floor($dimension[1]/$package->height);
            $qty_S [$row] = floor($dimension[0]/($package->length/4)/$compression_coefficient)/4;
            $space [$row] = $dimension[1] - $rows_P [$row] * $package->height;
            $rows_L [$row] = floor($space[$row]/($package->length/4)/$compression_coefficient)/4;
            $qty_L [$row] = floor($dimension[0]/$package->height);
            $total_row [$row] = ($rows_P[$row] * $qty_S[$row] + $rows_L[$row] * $qty_L[$row]) * 20;
            $total_A [$row] = $rows_N [$row] * $total_row [$row];
        }

        $rows_N = [];
        $rows_P = [];
        $qty_S = [];
        $space = [];
        $rows_L = [];
        $qty_L = [];
        $total_row = [];
        $total_B = [];
        $MAX = [];
        foreach($dimensions as $row => $dimension){
            $rows_N [$row] = floor($dimension[2]/$package->width);
            $rows_L [$row] = floor($dimension[0]/$package->height);
            $qty_L [$row] = floor($dimension[1]/($package->length/4)/$compression_coefficient)/4;
            $space [$row] = $dimension[0] - $rows_L [$row] * $package->height;
            $rows_P [$row] = floor($space[$row]/($package->length/4)/$compression_coefficient)/4;
            $qty_S [$row] = floor($dimension[1]/$package->height);
            $total_row [$row] = ($rows_L[$row] * $qty_L[$row] + $rows_P[$row] * $qty_S[$row]) * 20;
            $total_B [$row] = $rows_N [$row] * $total_row [$row];
            $MAX[$row] = $total_A[$row]>$total_B[$row]?$total_A[$row]:$total_B[$row];
        }

        $rem_H = [];
        $rows_N = [];
        $rem_R = [];
        $rows_P = [];
        $qty_S = [];
        $space = [];
        $rows_L = [];
        $qty_L = [];
        $total_row = [];
        $total_AR = [];
        foreach($dimensions as $row => $dimension){
            $rows_N [$row] = floor($dimension[2]/$package->width);
            $rem_H [$row] = $dimension[2] - $rows_N [$row]*$package->width;
            $rem_R [$row] = floor($rem_H[$row]/($package->length/4)/$compression_coefficient)/4;
            $rows_P [$row] = floor($dimension[1]/$package->height);
            $qty_S [$row] = floor($dimension[0]/$package->width);
            $space [$row] = $dimension[1] - $rows_P [$row] * $package->height;
            $rows_L [$row] = floor($space[$row]/$package->width/$compression_coefficient);
            $qty_L [$row] = floor($dimension[0]/$package->height);
            $total_row [$row] = ($rows_P[$row] * $qty_S[$row] + $rows_L[$row] * $qty_L[$row]) * 20;
            $total_AR [$row] = $rem_R [$row] * $total_row [$row];
        }

        $rem_H = [];
        $rows_N = [];
        $rem_R = [];
        $rows_P = [];
        $qty_S = [];
        $space = [];
        $rows_L = [];
        $qty_L = [];
        $total_row = [];
        $total_BR = [];
        $MAX_R = [];
        $MAX_BAGS = [];
        //TODO This needs to also be calculated. It uses the laminate price (This will need to be stored in the database next to the minimum price).
        $bag_front = ($product->width + $product->length) * 2 + 2;
        $bag_side = $product->height + $product->length/2 + 2 + $product->handle->fold;
        $w_factor = $bag_front * $bag_side/10000;
        //TODO THERE IS AN ERROR IN THE WEIGHT CALCULATION
        $u1 = $product->paper->weight;
        $v1 = ($product->lamination->name != "no_lamination" ? 25 : 0);
        $x1 = ($product->handle->name != "no_handle" ? 6 : 0);
        $y1 = $product->bottom * $product->width * $product->length * 450/10000;
        $z1 = $product->handle->fold * 2 * $product->width/10000*550;
        $weight = ceil(
            ($u1 + $v1) * $w_factor +
            $x1 +
            $y1 +
            $z1
        );
//        $weight = 182;
        $MAX_KG = [];
        foreach($dimensions as $row => $dimension){
            $rows_N [$row] = floor($dimension[2]/$package->width);
            $rem_H [$row] = $dimension[2] - $rows_N [$row]*$package->width;
            $rem_R [$row] = floor($rem_H[$row]/($package->length/4)/$compression_coefficient)/4;
            $rows_L [$row] = floor($dimension[0]/$package->height);
            $qty_L [$row] = floor($dimension[1]/$package->width);
            $space [$row] = $dimension[0] - $rows_L [$row] * $package->height;
            $rows_P [$row] = floor($space[$row]/$package->width);
            $qty_S [$row] = floor($dimension[0]/$package->height);
            $total_row [$row] = ($rows_L[$row] * $qty_L[$row] + $rows_P[$row] * $qty_S[$row]) * 20;
            $total_BR [$row] = $rem_R [$row] * $total_row [$row];
            $MAX_R[$row] = $total_AR[$row]>$total_BR[$row]?$total_AR[$row]:$total_BR[$row];
            $MAX_BAGS[$row] = $MAX[$row]+$MAX_R[$row];
            $MAX_KG[$row] = $MAX_BAGS[$row] > 0 ? $MAX_BAGS[$row] * $weight/1000 + 1 : 0;
        }

        $optimal_num = [];
        $qty_per_box = [];
        $real_kg = [];
        $volume = [];
        foreach($dimensions as $row => $dimension){
            $optimal_num[$row] = $MAX_BAGS[$row] > 0 ? ceil($product->quantity/$MAX_BAGS[$row]) : -1;
            $qty_per_box[$row] = $MAX_KG[$row] > 0 ? ceil($product->quantity/$optimal_num[$row]) : -1;
            $real_kg[$row] = $MAX_KG[$row] > 0 ? $qty_per_box[$row] * $weight/1000 + 1: -1;
            $volume[$row] = $MAX_KG[$row] > 0 ? $optimal_num[$row] * ($dimension[0] + 2) * ($dimension[1] + 2) * ($dimension[2] + 2)/1000000: -1;
        }
        $box = [];
        $box_volume = [];
        $box_qty = [];
        $box_weight = [];

        foreach($max_weights as $max_weight) {
            foreach ($dimensions as $row => $dimension) {
                $box[$max_weight][$row] = $MAX_BAGS[$row] > 0 ? max($optimal_num[$row],ceil($product->quantity/(($max_weight-1)/$weight*1000))): null;
                $box_qty[$max_weight][$row] = $MAX_BAGS[$row] > 0 ? ceil($product->quantity/$box[$max_weight][$row]): null;
                $box_weight[$max_weight][$row] = $MAX_BAGS[$row] > 0 ? $box_qty[$max_weight][$row]*$weight/1000+1: null;
                $box_volume[$max_weight][$row] = $box[$max_weight][$row] != null ? $box[$max_weight][$row]*($dimension[0] + 2) * ($dimension[1] + 2) * ($dimension[2] + 2)/1000000: null;
            }
        }
        foreach($max_weights as $max_weight) {
            $min = $packaging[$max_weight]['num_cartons'] = $this->min_ignore_null($box[$max_weight]);

            $min_index = array_search($min, $box[$max_weight]);
            $packaging[$max_weight]['dimension'] = implode('/',$original[$min_index]);
            $packaging[$max_weight]['volume'] = $box_volume[$max_weight][$min_index];
            $packaging[$max_weight]['bags_per_carton'] = $box_qty[$max_weight][$min_index];
            $packaging[$max_weight]['carton_weight'] = $box_weight[$max_weight][$min_index];
            $packaging[$max_weight]['total_weight'] = $packaging[$max_weight]['carton_weight'] * $packaging[$max_weight]['num_cartons'];
        }
        $base_price = 50;
        $shipping_price = 0;
        $price_kg = 5;
        $min_price = 80;
        $max_palete_weight = 300;

        $country = config('app.country');
        $max_package_weight = $this->packageWeight->whereHas('country', function (Builder $query)  use ($country) {
            $query->where('iso_3166_2', $country);
        })->first()->weight;

//        $max_package_weight = $product->max_package_weight;

        $ratio = ($packaging[$max_package_weight]['carton_weight']*$packaging[$max_package_weight]['num_cartons'])/$packaging[$max_package_weight]['volume'];
        if($ratio < $max_palete_weight)
            // TODO I am not sure which is the correct calculation:
            $shipping_price = $base_price + $packaging[$max_package_weight]['volume'] * $max_palete_weight * $price_kg;
            // $weight_price = $base_price + $packaging[$max_package_weight]['volume'] * $packaging[$max_package_weight]['carton_weight'] * $price_kg;
        else
            $shipping_price = $base_price + $packaging[$max_package_weight]['carton_weight']*$packaging[$max_package_weight]['num_cartons'] * $price_kg;
        if($shipping_price < $min_price)
            $shipping_price = $min_price;
        $packaging['shipping_price'] = $shipping_price;
        return $packaging;
    }

    private function min_ignore_null($array){
        $min = null;
        foreach ($array as $key => $val){
            if($min == null)
                $min = $val;
            else{
                if($val != null)
                {
                    if($min > $val)
                        $min = $val;
                }
            }
        }
        return $min;
    }
}
