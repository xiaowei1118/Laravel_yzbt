var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',
        browse_button: 'pickfiles',
        uptoken : $('#token').val(),
        get_new_uptoken: false,
        unique_names: true,
        domain: $('#domain').val(),
        container: 'container',
        max_file_size: '100mb',
        flash_swf_url: 'js/Moxie.swf',
        max_retries: 3,
        dragdrop: true,
        drop_element: 'container',
        chunk_size: '4mb',
        auto_start: false,
        init: {
          'FilesAdded': function(up, files) {
            var html='';
            plupload.each(files, function(file) {
              html+=file.name+"(大小:"+plupload.formatSize(file.size)+")<br>";
            });
            $('#filelist').html('要上传的文件：'+html);
          },
          'BeforeUpload': function(up, file) {
            
          },
          'UploadProgress': function(up, file) {
            $('#result').html('当前上传进度：'+file.percent+'%');
          },
          'FileUploaded': function(up, file, info) {
            var domain = up.getOption('domain'),
              res = $.parseJSON(info),
              sourceLink = domain + res.key;
            $('input[name="image_url"]').val(sourceLink);
          },
          'Error': function(up, err, errTip) {
            
          },
          'UploadComplete': function() {
            
          },
          'Key': function(up, file) {
            var key = "";
            return key;
          }
        }
      });
      $('#upload').click(function () {
        uploader.start();
      });