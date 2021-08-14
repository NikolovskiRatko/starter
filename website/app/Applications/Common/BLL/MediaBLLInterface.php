<?php

namespace App\Applications\Common\BLL;

use App\Applications\Common\Model\UserSession;
use App\Http\Requests\ApiFormRequest;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Database\Eloquent\Model;

/**
 * Interface MediaBLLInterface
 * @package App\Applications\Common
 */

interface MediaBLLInterface
{
    /**
     * @param integer $id
     * @return Media
     */
    public function getById($id);

    /**
     * @param integer $id
     * @return bool|null
     */
    public function delete($id);

    /**
     * @param integer $id
     * @param string $comment
     * @return Media
     */
    public function editComment($id, $comment);

    /**
     * @param ApiFormRequest $request
     *
     * @return Media|boolean
     */
    public function savePhoto($request);

    /**
     * @param ApiFormRequest $request
     *
     * @return Media|boolean
     */
    public function saveTemporaryPhoto($request);

    /**
     * @param string $id
     *
     * @return Media
     */
    public function getEntrySessionPhotos($id);

    /**
     * @param ApiFormRequest $request
     *
     * @return Media|boolean
     */
    public function getMedia($request);

    /**
     * @param ApiFormRequest $request
     * @param HasMedia $media
     *
     * @return Media|boolean
     */
    public function saveHeaderVideo($media, $request);

    /**
     * @param ApiFormRequest $request
     * @param HasMedia $media
     *
     * @return Media|boolean
     */
    public function saveVr360Thumbnail($media, $request);

     /**
     * @param ApiFormRequest $request
     * @param HasMedia $media
     *
     * @return Media|boolean
     */
    public function saveHomepageHeaderVideo($media, $request);

     /**
     * @param ApiFormRequest $request
     * @param HasMedia $media
     *
     * @return Media|boolean
     */
    public function saveHomepageHeaderImage($media, $request);

     /**
     * @param ApiFormRequest $request
     * @param HasMedia $media
     *
     * @return Media|boolean
     */
    public function saveHomepageSliderImage($media, $request);

    /**
     * @param ApiFormRequest $request
     *
     * @return Media|boolean
     */
    public function saveDocument($request);
    /**
     * @param ApiFormRequest $request
     * @param Media $media
     *
     * @return Media|boolean
     */
    public function editPhoto($media, $request);

    /**
     * @param ApiFormRequest $request
     * @param Media $media
     *
     * @return Media|boolean
     */
    public function editDocument($media, $request);

    /**
     * @param integer $id
     * @param  string  $entity
     * @param  integer  $entity_id
     * @return Media
     */
    public function upOrderPhoto($id, $entity, $entity_id);

    /**
     * @param integer $id
     * @param  string  $entity
     * @param  integer  $entity_id
     * @return Media
     */
    public function downOrderPhoto($id, $entity, $entity_id);

    /**
     * @param integer $id
     * @param  string  $entity
     * @param  integer  $entity_id
     * @return Media
     */
    public function upOrderDocument($id, $entity, $entity_id);

    /**
     * @param integer $id
     * @param  string  $entity
     * @param  integer  $entity_id
     * @return Media
     */
    public function downOrderDocument($id, $entity, $entity_id);

    /**
     * @param string $type
     * @param integer $id
     * @return Model|boolean
     */
    public function getEntityByType($type, $id);

    /**
     * @param integer $id
     * @param string $type
     * @return boolean
     */
    public function removeFile($type, $id);
}
