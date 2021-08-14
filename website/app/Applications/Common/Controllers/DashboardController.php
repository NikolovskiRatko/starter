<?php

namespace App\Applications\Common\Controllers;

use Exception;
use App\Http\Controllers\Controller;
use App\Applications\Common\BLL\DashboardBLLInterface;
use Illuminate\Http\Request;

use App\Applications\Common\Requests\ContactFormRequest;

/**
 * @property DashboardBLLInterface $dashboardBLL
 */
class DashboardController extends Controller
{
    public function __construct(
        DashboardBLLInterface $dashboardBLL
    ){
        $this->dashboardBLL = $dashboardBLL;
    }

    /**
     * Get a JSON with a dashboard info
     *
     * @return array|Exception
     */
    public function getDashboardInformation(){
        try{
            return $this->dashboardBLL->getDashboardInformation();
        }
        catch(Exception $e){
            return $e;
        }
    }

    public function contact(ContactFormRequest $request){
        return $this->dashboardBLL->contact($request);
    }
}
