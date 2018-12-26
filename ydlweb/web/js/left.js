$(function(){
    $('.capital').click(function(){
        $('.capital-detail').show();
    });
    // setTimeout("hint()",3000);
})

function hint(){
	$(".hint-dialog_success").remove();
}

function get_file_ext(file_name) {
    var ext = file_name.substr(file_name.lastIndexOf(".") + 1).toLowerCase();
    var _ext = '';
    if ($.inArray(ext, ['doc', 'docx']) !== -1) {
        _ext = '/images/file_extension/doc.png';
    } else if ($.inArray(ext, ['pdf']) !== -1) {
        _ext = '/images/file_extension/pdf.png';
    } else if ($.inArray(ext, ['zip']) !== -1) {
        _ext = '/images/file_extension/zip.png';
    } else if ($.inArray(ext, ['rar']) !== -1) {
        _ext = '/images/file_extension/rar.png';
    } else if ($.inArray(ext, ['xls', 'xlsx']) !== -1) {
        _ext = '/images/file_extension/xlsx.png';
    } else if ($.inArray(ext, ['ppt', 'ppts']) !== -1) {
        _ext = '/images/file_extension/xlsx.png';
    } else if ($.inArray(ext, ['jpg', 'jpeg', 'png', 'gif']) !== -1) {
        _ext = '';
    } else {
        _ext = '/images/file_extension/all.png';
    }

    return _ext;
}