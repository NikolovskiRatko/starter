
const TINY_API_KEY = 'w97mwl29y26b7ngaf1r6p2bkgzew5wrqaanngl2humv1n78s';

const tinyConfig = {
    
        height: 500,
        menubar: false,
        plugins: [
                'advlist autolink lists link image anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table paste code'
        ],
        toolbar: 'undo redo | link image |  formatselect fontselect fontsizeselect | bold italic underline strikethrough subscript superscript forecolor backcolor | alignleft aligncenter alignright alignjustify |\
                bullist numlist outdent indent | pastetext removeformat code| table',
        block_formats: 'Paragraph=p; Heading 1=h1; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6; Preformatted=pre',
        font_formats: 'Roboto="Roboto Regular", Helvetica, Arial, sans-serif; Arial=arial,helvetica,sans-serif; Comic Sans MS="Comic Sans MS", cursive, sans-serif; \
                        Courier New=courier new,courier,monospace; Georgia=Georgia; Lucida Sans Unicode=Lucida Sans Unicode;Tahoma=Tahoma;\
                        Times New Roman="Times New Roman", Times, serif;Verdana=Verdana; Trebuchet MS=Trebuchet MS',
        fontsize_formats: '8px 9px 10px 11px 12px 14px 16px 18px 20px 22px 24px 28px 36px 48px 72px',
        relative_urls : false,
        convert_urls: false,
        color_cols: "6",
        color_map: [
                "1ABC9C", "Strong Cyan",
                "2ECC71", "Smaragdgrün",
                "3498DB", "Bright Blue",
                "9B59B6", "Amethystblau",
                "4E5F70", "Graublau",
                "F1C40F", "Vivid Yellow",
                "16A085", "Dunkelcyan",
                "27AE60", "Dunkelsmaragdgrün",
                "2980B9", "Strong Blue",
                "8E44AD", "Dunkelviolett",
                "2C3E50", "Entsättigtes blau",
                "F39C12", "Orange",
                "E67E22", "Möhrenfarben",
                "E74C3C", "Blassrot",
                "ECF0F1", "Glänzendes Silber",
                "95A5A6", "Helles Graublau",
                "DDDDDD", "Hellgrau",
                "FFFFFF", "Weiß",
                "D35400", "Kürbisfarben",
                "C0392B", "Strong Red",
                "BDC3C7", "Silber",
                "7F8C8D", "Graucyan",
                "999999", "Dunkelgrau",
                "000000", "Schwarz",
        ],
        /* without images_upload_url set, Upload tab won't show up*/
        images_upload_url: '/api/guest/common/rte',

        /* we override default upload handler to simulate successful upload*/
        // images_upload_handler: function (blobInfo, success, failure) {
        //         setTimeout(function () {
        //                 /* no matter what you upload, we will turn it into TinyMCE logo :)*/
        //                 success('http://moxiecode.cachefly.net/tinymce/v9/images/logo.png');
        //         }, 2000);
        // }
}

export { tinyConfig, TINY_API_KEY };
