<?php

namespace App\Applications\Common\DAL;

use Spatie\MediaLibrary\Models\Media;

/**
 */
class MediaDAL implements MediaDALInterface
{
    /** @var Media */
    protected $media;

    public function __construct(
        Media $media
    ){
        $this->media = $media;
    }

    /**
     *
     * @return object or end with 404 termination
     *
     */
    public function getById($id){
        return $this->media->findOrFail($id); // can rework with NotFoundAPIException and find
    }

    public function delete($id){
        return $this->media->where('id', $id)->delete();
    }

    public function save($request, $media, $collection, $property_name = 'uploaded_file'){
        if ($request->hasFile($property_name)) {
            if(is_array($request->{$property_name})){
                foreach ($request->{$property_name} as $uploaded_file) {
                    //$uploaded_file = $request->file($property_name);
                    $properties = [];
                    if ($request->has('comment')) $properties['comment'] = $request->get('comment');
                    $new_media = $media->addMedia($uploaded_file)
                        ->withCustomProperties($properties)
                        ->toMediaCollection($collection);
                    if ($request->has('order_column')) $new_media->order_column = $request->get('order_column');
                    $new_media->save();
                }
            }else{
                 $uploaded_file = $request->file($property_name);
                 $properties = [];
                 if ($request->has('comment')) $properties['comment'] = $request->get('comment');
                 $new_media = $media->addMedia($uploaded_file)
                     ->withCustomProperties($properties)
                     ->toMediaCollection($collection);
                 if ($request->has('order_column')) $new_media->order_column = $request->get('order_column');
                 $new_media->save();
            }
            return $new_media;
        }
        return 'error';
    }

    public function editComment($id, $comment){
        $media = $this->getById($id);
        $media->setCustomProperty('comment', $comment);
        $media->save();
        return $media;
    }

    public function edit($request, $media_parent, $media, $collection, $property_name = 'uploaded_file'){
        if ($request->hasFile($property_name)) {
            $media->delete();
            return $this->save($request, $media_parent, $collection, $property_name);
        } else {
            if ($request->has('comment')) $media->setCustomProperty('comment', $request->get('comment'));
            if ($request->has('order_column')) $media->order_column = $request->get('order_column');
            $media->save();
            return $media;
        }
    }


    public function getOrdered($media_parent, $media, $collection, $operator){
        echo $media->order_column;
        $query = $media_parent->{$collection}()
            ->where('id', '!=', $media->id)
            ->where('order_column', $operator, $media->order_column)
            ->orderBy('order_column', 'desc');
        return $query;
    }

    // TODO: This can be re-used for all cases with parameter (column_name)
    public function upOrder($media_parent, $collection, $id){
        $media = $this->getById($id);
        $query = $this->getOrdered($media_parent, $media, $collection, '<=');
        /** @var Collection<Media> */
        $medias = $query->get();
        if ($medias->count()) {
            $order = $medias->last()->order_column;
            $media->order_column = $order;
            $media->save();
            foreach ($medias as $prd) {
                if ($prd->order_column == $order) {
                    $prd->increment('order_column');
                }
            }
        }
        return $media;
    }

    public function downOrder($media_parent, $collection, $id){
        $media = $this->getById($id);
        $query = $this->getOrdered($media_parent, $media, $collection, '>=');
        /** @var Collection<Media> */
        $medias = $query->get();
        if ($medias->count()) {
            $order = $medias->first()->order_column;
            $media->order_column = $order;
            $media->save();
            foreach ($medias as $prd) {
                if ($prd->order_column == $order && $order == 0) {
                    $media->increment('order_column');
                }
                if ($prd->order_column == $order && $order != 0) {
                    $prd->decrement('order_column');
                }
            }
        }
        return $media;
    }

    public function deleteFile($media){
        $this->media->delete();
    }
}
