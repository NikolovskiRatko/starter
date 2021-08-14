<?php

namespace App\Applications\Common\DAL;

use App\Http\Requests\ApiFormRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\Models\Media;

/**
 * Interface MediaDALInterface
 * @package App\Applications\Common
 */

interface MediaDALInterface
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
     * @param Request $request
     * @param HasMedia $media
     * @param string $collection
     * @param string $property_name
     * @return Media|string
     */
    public function save($request, $media, $collection, $property_name = 'uploaded_file');

    /**
     * @param Request $request
     * @param HasMedia $media_parent
     * @param Media $media
     * @param string $collection
     * @param string $property_name
     * @return Media
     */
    public function edit($request, $media_parent, $media, $collection, $property_name = 'uploaded_file');

    /**
     * @param HasMedia $media_parent
     * @param Object $media
     * @param string $collection
     * @param string $operator
     * @return Builder
     */
    public function getOrdered($media_parent, $media, $collection, $operator);

    /**
     * @param HasMedia $media_parent
     * @param string $collection
     * @param integer $id
     * @return Media
     */
    public function upOrder($media_parent, $collection, $id);

    /**
     * @param HasMedia $media_parent
     * @param string $collection
     * @param integer $id
     * @return Media
     */
    public function downOrder($media_parent, $collection, $id);

}