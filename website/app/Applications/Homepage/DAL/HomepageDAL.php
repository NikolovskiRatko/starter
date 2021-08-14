<?php

namespace App\Applications\Homepage\DAL;

use App\Applications\Homepage\Model\Slide;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


/**
 * @property Slide|Model $slide
 */
class HomepageDAL implements HomepageDALInterface
{
    public function __construct(
        Slide $slide
    ){
        $this->slide = $slide;
    }

    public function getTopSliderItems() {
        return $this->slide->get();
    }

    public function getDataTablesReady($data){
        $query = DB::table('sliders')
            ->select(
                DB::raw('sliders.id'),
                DB::raw('sliders.title'),
                DB::raw('sliders.subtitle'),
                DB::raw('sliders.description'),
                DB::raw('sliders.type')
            );


        $search = $data['search'];
        if($search){
            $query->where(function($subquery) use ($search) {
                $subquery->where('sliders.id', 'like', '%'.$search.'%');
                $subquery->orWhere('sliders.title', 'like', '%'.$search.'%');
                $subquery->orWhere('sliders.subtitle', 'like', '%'.$search.'%');
            });
        }

        $query->groupBy('sliders.id');
        $query->orderBy($data['columns'][$data['column']], $data['dir']);
//        $query->whereNull('products.deleted_at');

        $items = $query->paginate($data['length']);
        return ['data' => $items, 'draw' => $data['draw']];
    }

    public function deleteSlide($id){
        return $this->slide
            ->where('id', $id)
            ->delete();
    }

    public function getSlide($id){
        return $this->slide->find($id);
    }

    public function storeSlide($request){
        return $this->slide->create($request->request->all());
    }

    public function updateSlide($request, $id){
        $slide = $this->slide->find($id)->fill($request->request->all());
        if($slide->learn_more_link_custom)
        {
            $http = preg_match('/(http:)|(https:)/', $slide->learn_more_link);
            if($http == 0){
                $slide->learn_more_link = 'http:'.$slide->learn_more_link;
            }
        }
        if($slide->get_started_link_custom)
        {
            $http = preg_match('/(http:)|(https:)/', $slide->get_started_link);
            if($http == 0){
                $slide->get_started_link = 'http:'.$slide->get_started_link;
            }
        }
        $slide->save();
        return $slide;
    }
}
