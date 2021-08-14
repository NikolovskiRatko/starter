const getPhotoPath = (photo, size = 600, checkGif = true): string => {
  const photo_array = photo.split(',');
  const fileExt = _getExtension(photo_array[2]);
  const fileName = photo_array[1].replace(/ /g,"-");
  if (fileExt == 'gif' && checkGif) {
    return "storage/" + photo_array[0] + "/" + fileName + "." + fileExt;
  } else {
    return "storage/" + photo_array[0] + "/conversions/" + fileName + "-" + size + "." + fileExt;
  }

  function _getExtension(mimetype: string): string {
    let extension = mimetype.split('/')[1];
    if ((extension === 'jpeg') || (extension === 'x-canon-cr2')) {
      extension = 'jpg';
    }
    if (extension === 'x-ms-bmp') {
      extension = 'bmp';
    }
    return extension;
  }
};
export default getPhotoPath;
