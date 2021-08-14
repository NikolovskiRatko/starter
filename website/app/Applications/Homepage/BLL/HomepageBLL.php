<?php

namespace App\Applications\Homepage\BLL;

use App\Applications\Common\DAL\MediaDALInterface;
use App\Applications\Homepage\DAL\HomepageDALInterface;

/**
 * @property HomepageDALInterface homepageDAL
 * @property MediaDALInterface mediaDAL
 */
class HomepageBLL implements HomepageBLLInterface
{
    public function __construct(
        HomepageDALInterface $homepageDAL,
        MediaDALInterface $mediaDAL
    ){
        $this->homepageDAL = $homepageDAL;
        $this->mediaDAL = $mediaDAL;
    }

    public function getTopSliderItems(){
        return $this->homepageDAL->getTopSliderItems();
    }

    public function getDataTablesReady($request){
        $data['columns'] = Array('id', 'title', 'subtitle', 'description', 'type');
        $data['length'] = $request->input('length');
        $data['column'] = $request->input('column'); //Index
        $data['dir'] = $request->input('dir');
        // TODO: Improve this segment
        // this logic is required so that sorting can be done alphabetically
//        if ($data['column'] == 6) {
//            if ($data['dir'] == 'asc') {
//                $data['dir'] = 'desc';
//            } else {
//                $data['dir'] = 'asc';
//            }
//        }
        $data['search'] = $request->input('search');
        $data['draw'] = $request->input('draw');
        $data['lang'] = $request->input('lang');

        return $this->homepageDAL->getDataTablesReady($data);
    }

    public function deleteSlide($id){
        return $this->homepageDAL->deleteSlide($id);
    }

    public function getSlide($id){
        return $this->homepageDAL->getSlide($id);
    }

    public function storeSlide($request){
        $slide = $this->homepageDAL->storeSlide($request);
        $this->mediaDAL->save($request, $slide, 'slider_images');
        return $slide;
    }

    public function updateSlide($request, $id){
        $slide = $this->homepageDAL->updateSlide($request, $id);
        $this->mediaDAL->save($request, $slide, 'slider_images');
        return $slide;
    }
}



