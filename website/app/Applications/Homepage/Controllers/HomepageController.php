<?php

namespace App\Applications\Homepage\Controllers;

use App\Applications\Homepage\Requests\SlideRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Applications\Homepage\BLL\HomepageBLLInterface;

/**
 * @property HomepageBLLInterface homepageBLL
 */
class HomepageController extends Controller
{
    /**
     * HomepageController constructor.
     * @param HomepageBLLInterface $homepageBLL
     */
    public function __construct(
        HomepageBLLInterface $homepageBLL
    ){
        $this->homepageBLL = $homepageBLL;
    }

    /**
     * Get a JSON with all the users
     *
     * @return String
     */
    //TODO fetch from database
    public function getTopSliderItems(){
        return $this->homepageBLL->getTopSliderItems()->toJson();
    }

    public function drawSlides(Request $request){
        return $this->homepageBLL->getDataTablesReady($request);
    }

    /**
     * Delete slide
     *
     * @return string
     */
    public function deleteSlide($id){
        return $this->homepageBLL->deleteSlide($id);
    }

    /**
     * Get slide by id
     *
     * @param  integer  $id
     * @return string
     */
    public function getSlide($id){
        return $this->homepageBLL->getSlide($id)->toJson();
    }

    /**
     * Store slide and get JSON with a user response
     *
     * @param  SlideRequest  $request
     * @return void
     */
    public function storeSlide(SlideRequest $request){
        $this->homepageBLL->storeSlide($request)->toJson();
    }

    /**
     * Update user
     *
     * @param  SlideRequest  $request
     * @param  integer  $id
     * @return void
     */
    public function updateSlide(SlideRequest $request, $id){
        $this->homepageBLL->updateSlide($request, $id)->toJson();
    }
}
