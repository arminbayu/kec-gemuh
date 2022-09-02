$(document).ready(function () {
  $('.btn_upload').click(function () {
    $('#fileupload').trigger('click');
  });

  $('.btn_upload2').click(function () {
    $('#fileupload2').trigger('click');
  });
});

$(function () {
    $('#fileupload').fileupload({
        dataType: 'json',
        done: function (e, data) {
            if(data.result.success == true){
              $('#preview').empty();
              var str1 = data.result.attachment;
              var str2 = 'gif|jpg|png|JPG|Jpeg|JPEG|jpeg|ico|bmp';
              if((str1.indexOf('gif') != -1) || (str1.indexOf('jpg') != -1) || (str1.indexOf('png') != -1) || (str1.indexOf('JPG') != -1)
                || (str1.indexOf('Jpeg') != -1) || (str1.indexOf('JPEG') != -1) || (str1.indexOf('jpeg') != -1) || (str1.indexOf('ico') != -1) || (str1.indexOf('bmp') != -1)
              ){
                $('#preview').removeClass('mailbox-attachment-icon').addClass('mailbox-attachment-icon has-img');
                var img = data.result.preview;
                var elem = document.createElement('img');
                elem.setAttribute('src', img);
                elem.setAttribute('class', 'img-responsive');
                document.getElementById('preview').appendChild(elem);
              }else {
                if (str1.indexOf('pdf') != -1) {
                  var $icon = '<i class="fa fa-file-pdf-o"></i>';
                }else if ((str1.indexOf('zip') != -1) || (str1.indexOf('rar') != -1)) {
                  var $icon = '<i class="fa fa-file-archive-o"></i>';
                }else if ((str1.indexOf('doc') != -1) || (str1.indexOf('docx') != -1)) {
                  var $icon = '<i class="fa fa-file-word-o"></i>';
                }else if (str1.indexOf('txt') != -1) {
                  var $icon = '<i class="fa fa-file-text-o"></i>';
                }else if ((str1.indexOf('xls') != -1) || (str1.indexOf('xlsx') != -1)) {
                  var $icon = '<i class="fa fa-file-excel-o"></i>';
                }else if ((str1.indexOf('ppt') != -1) || (str1.indexOf('pptx') != -1)) {
                  var $icon = '<i class="fa fa-file-powerpoint-o"></i>';
                }
                console.log($icon);
                $('#preview').removeClass('mailbox-attachment-icon has-img').addClass('mailbox-attachment-icon').append($icon);
              }
              $('#name_file').html(data.result.attachment);
              $('#mail_attachment_size').html(data.result.size);
              $('#file_upload_name').val(data.result.attachment);
            }else {
              alert(data.result.why);
            }
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    });

    $('#fileupload2').fileupload({
        dataType: 'json',
        done: function (e, data) {
            if(data.result.success == true){
              $('#preview2').empty();
              var str1 = data.result.attachment;
              var str2 = 'gif|jpg|png|JPG|Jpeg|JPEG|jpeg|ico|bmp';
              if((str1.indexOf('gif') != -1) || (str1.indexOf('jpg') != -1) || (str1.indexOf('png') != -1) || (str1.indexOf('JPG') != -1)
                || (str1.indexOf('Jpeg') != -1) || (str1.indexOf('JPEG') != -1) || (str1.indexOf('jpeg') != -1) || (str1.indexOf('ico') != -1) || (str1.indexOf('bmp') != -1)
              ){
                $('#preview2').removeClass('mailbox-attachment-icon').addClass('mailbox-attachment-icon has-img');
                var img = data.result.preview;
                var elem = document.createElement('img');
                elem.setAttribute('src', img);
                elem.setAttribute('class', 'img-responsive');
                document.getElementById('preview2').appendChild(elem);
              }else {
                if (str1.indexOf('pdf') != -1) {
                  var $icon = '<i class="fa fa-file-pdf-o"></i>';
                }else if ((str1.indexOf('zip') != -1) || (str1.indexOf('rar') != -1)) {
                  var $icon = '<i class="fa fa-file-archive-o"></i>';
                }else if ((str1.indexOf('doc') != -1) || (str1.indexOf('docx') != -1)) {
                  var $icon = '<i class="fa fa-file-word-o"></i>';
                }else if (str1.indexOf('txt') != -1) {
                  var $icon = '<i class="fa fa-file-text-o"></i>';
                }else if ((str1.indexOf('xls') != -1) || (str1.indexOf('xlsx') != -1)) {
                  var $icon = '<i class="fa fa-file-excel-o"></i>';
                }else if ((str1.indexOf('ppt') != -1) || (str1.indexOf('pptx') != -1)) {
                  var $icon = '<i class="fa fa-file-powerpoint-o"></i>';
                }
                console.log($icon);
                $('#preview2').removeClass('mailbox-attachment-icon has-img').addClass('mailbox-attachment-icon').append($icon);
              }
              $('#name_file2').html(data.result.attachment);
              $('#mail_attachment_size2').html(data.result.size);
              $('#file_upload_name2').val(data.result.attachment);
            }else {
              alert(data.result.why);
            }
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress2 .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    });
});
