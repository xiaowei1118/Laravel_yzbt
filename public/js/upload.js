var uploader = Qiniu.uploader({
        runtimes: 'html5,flash,html4',
        browse_button: 'pickfiles',
        uptoken_url : "http://yzbtkids.com:8080/qiniu/get_upload_token",
        get_new_uptoken: false,
        unique_names: true,
        domain: "http://o7fnmn25g.bkt.clouddn.com/",
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

              var key=up.settings.multipart_params.key;
              $.ajax({
                  type:'GET',
                  url:'http://yzbtkids.com:8080/qiniu/get_upload_token',
                  async:false,
                  data:{
                      key:key,
                  },
                  success:function (data) {
                      up.settings.multipart_params.token=data.uptoken;
                  },
                  error:function (error) {

                  }
              })
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
            var key = new Date().toDateString()+file.name;
            return key;
          }
        }
      });
      $('#upload').click(function () {
        uploader.start();
      });