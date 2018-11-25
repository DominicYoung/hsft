/**
 * Created by zhoufan on 2016/1/5.
 */
require('/static/lib/plupload/plupload.js');
var $=require('jquery');
var uploader = new plupload.Uploader({
    browse_button: 'upload-pic', // this can be an id of a DOM element or the DOM element itself
    url: '/admin/upload',
    max_file_size : '5mb',
    chunk_size : '1mb',
    unique_names : true,
    dragdrop : true,
    multiple_queues : false,
    multi_selection : false,
    max_file_count : 1,
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    init : {
        FilesAdded: function(up, files) {
                up.start();

        },
        FileUploaded:function(up, file, info){
            var response = JSON.parse(info.response);
            $('#titlepic').val(response.result);
        }
    }
});

uploader.init();