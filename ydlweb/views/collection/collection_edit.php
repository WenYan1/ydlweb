
<title>退税管理</title>
<script>
    $(".collection").css("border-left","6px solid #4E99B8");
    $(".collection").css("background","#222222");
</script>
<meta name="csrf-token" content="<?= Yii::$app->request->csrfToken ?>"/>
<link rel="stylesheet" type="text/css" href="../css/privider_manage/privider_about.css">
<link rel="stylesheet" type="text/css" href="../css/public/jquery.datetimepicker.css"/ >
<?php
$img_source = "/uploads/";
if($this->context->_popSuccessMessage()) {
	?>
	<div class="hint-dialog_success" style="width:120px;">
		<p class="hint-info_success"><?php echo $this->context->_popSuccessMessage(); ?></p>
	</div>
	<?php
} else {
	$msg = $this->context->_popErrorMessage();
	if($msg != null){
		?>
		<div class="hint-dialog_fail" style="width:120px;">
			<p class="hint-info_fail"><?php echo $this->context->_popErrorMessage(); ?></p>
		</div>
		<?php
	}
}
?>
<script type="text/javascript" src="../js/collection/collection-add.js"></script>
<div style="border-bottom:1px solid #d8d8d8;">
	<a href='<?php echo Yii::$app->urlManager->createUrl(['collection']);?>' class="spacing-left privider-sapce-top">
		<p class="font-title-size">退税管理</p>
	</a>
	<p class="font-title-size privider-sapce-top"> - 编辑单据</p>

</div>
<div class="divider-padding2">
	<div class="divider"></div>
</div>
<form actoin=<?php echo Yii::$app->urlManager->createUrl(['add']); ?> enctype="multipart/form-data" method="post">

	<div class="container-fluid add-privider-form">

		<div class="row-fluid col-md-12 input-height">
			<div class="col-md-3 col-md-offset-2">
				<p>订单号 :</p>
			</div>
			<div class="col-md-7">
				<input class="input-padding" type="text" id="order_number" name="order_number" value="<?php echo $collection['order_number']?>"/>
			</div>
		</div>
		<div class="row-fluid col-md-12 input-height">
			<div class="col-md-3 col-md-offset-2">
				<p>预计退税款 :</p>
			</div>
			<div class="col-md-7">
				<input class="input-padding" type="text" id="anticipated_tax_refund" name="anticipated_tax_refund" value="<?php echo $collection['anticipated_tax_refund']?>"/>
			</div>
		</div>
		<div class="row-fluid col-md-12">
			<div class="col-md-3 col-md-offset-2">
				<p>是否认证 :</p>
			</div>
			<div class="export-right">
				<p><label><input  name="is_identification" type="radio" value="1" <?php echo $collection['is_identification'] == 1 ? 'checked' : ''?> />&nbsp&nbsp是&nbsp&nbsp</label>
					<label><input name="is_identification" type="radio" value="2" <?php echo $collection['is_identification'] == 2 ? 'checked' : ''?>/>&nbsp&nbsp否</label></p>
			</div>
		</div>
		<div class="row-fluid col-md-12">
			<div class="col-md-3 col-md-offset-2">
				<p>是否收齐 :</p>
			</div>
			<div class="export-right">
				<p><label><input  name="is_end" type="radio" value="1" <?php echo $collection['is_end'] == 1 ? 'checked' : ''?>/>&nbsp&nbsp是&nbsp&nbsp</label>
					<label><input name="is_end" type="radio" value="2" <?php echo $collection['is_end'] == 2 ? 'checked' : ''?>/>&nbsp&nbsp否</label></p>
			</div>
		</div>

	</div>
    <div class="container-fluid submit-img" style="background-color: #FAFAFA;">
        <div class="row-fluid col-md-12">
            <div class="col-md-4" >
                <p style="display:block;float:right;">上传报关单退税联 :</p>
            </div>
            <div class="col-md-7" data-category="1">
                <div style="width: 120px;float: left;margin-right: 8px">
                    <div>
                        <img src="../images/up.png" data-action="upload" style="height: 120px;width: 120px;"/>
                    </div>
                </div>
                <?php if (!empty($collectionFiles[1])){
                    foreach ($collectionFiles[1] as $key => $item){ ?>
                        <div style="width: 120px;float: left;margin-right: 8px" data-key="<?=$key?>" data-box="true">
                            <div class="thumbnail">
                                <img src="<?=Upload::get_file_thumbnail($img_source.$item['service_path'])?>" data-action="upload" style="height: 120px;width: 120px;"/>
                                <div class="caption">
                                    <p><?=$item['client_name']?></p>
                                    <p style="display: none" data-action="operation">
                                        <a href="javascript:;" class="btn btn-primary" data-action="delete" style="color: #ffffff">删除</a>
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" data-field-name="category" name="files[1][<?=$key?>][category]" value="<?=$item['category']?>">
                            <input type="hidden" data-field-name="client_name" name="files[1][<?=$key?>][client_name]" value="<?=$item['client_name']?>">
                            <input type="hidden" data-field-name="extension" name="files[1][<?=$key?>][extension]" value="<?=$item['extension']?>">
                            <input type="hidden" data-field-name="file_size" name="files[1][<?=$key?>][file_size]" value="<?=$item['file_size']?>">
                            <input type="hidden" data-field-name="service_path" name="files[1][<?=$key?>][service_path]" value="<?=$item['service_path']?>">
                        </div>

                <?php } }  ?>
            </div>
            <div class="space"></div>
            <div class="col-md-4" >
                <p style="display:block;float:right;">上传供货合同 :</p>
            </div>
            <div class="col-md-7" data-category="2">
                <div style="width: 120px;float: left;margin-right: 8px">
                    <div>
                        <img src="../images/up.png" data-action="upload" style="height: 120px;width: 120px;"/>
                    </div>
                </div>
	            <?php if (!empty($collectionFiles[2])){
		            foreach ($collectionFiles[2] as $key => $item){ ?>
                        <div style="width: 120px;float: left;margin-right: 8px" data-key="<?=$key?>" data-box="true">
                            <div class="thumbnail">
                                <img src="<?=Upload::get_file_thumbnail($img_source.$item['service_path'])?>" data-action="upload" style="height: 120px;width: 120px;"/>
                                <div class="caption">
                                    <p><?=$item['client_name']?></p>
                                    <p style="display: none" data-action="operation">
                                        <a href="javascript:;" class="btn btn-primary" data-action="delete" style="color: #ffffff">删除</a>
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" data-field-name="category" name="files[1][<?=$key?>][category]" value="<?=$item['category']?>">
                            <input type="hidden" data-field-name="client_name" name="files[1][<?=$key?>][client_name]" value="<?=$item['client_name']?>">
                            <input type="hidden" data-field-name="extension" name="files[1][<?=$key?>][extension]" value="<?=$item['extension']?>">
                            <input type="hidden" data-field-name="file_size" name="files[1][<?=$key?>][file_size]" value="<?=$item['file_size']?>">
                            <input type="hidden" data-field-name="service_path" name="files[1][<?=$key?>][service_path]" value="<?=$item['service_path']?>">
                        </div>

		            <?php } }  ?>
            </div>
            <div class="space"></div>
            <div class="col-md-4" >
                <p style="display:block;float:right;">上传增值税发票 :</p>
            </div>
            <div class="col-md-7" data-category="3">
                <div style="width: 120px;float: left;margin-right: 8px">
                    <div>
                        <img src="../images/up.png" data-action="upload" style="height: 120px;width: 120px;"/>
                    </div>
                </div>
	            <?php if (!empty($collectionFiles[3])){
		            foreach ($collectionFiles[3] as $key => $item){ ?>
                        <div style="width: 120px;float: left;margin-right: 8px" data-key="<?=$key?>" data-box="true">
                            <div class="thumbnail">
                                <img src="<?=Upload::get_file_thumbnail($img_source.$item['service_path'])?>" data-action="upload" style="height: 120px;width: 120px;"/>
                                <div class="caption">
                                    <p><?=$item['client_name']?></p>
                                    <p style="display: none" data-action="operation">
                                        <a href="javascript:;" class="btn btn-primary" data-action="delete" style="color: #ffffff">删除</a>
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" data-field-name="category" name="files[1][<?=$key?>][category]" value="<?=$item['category']?>">
                            <input type="hidden" data-field-name="client_name" name="files[1][<?=$key?>][client_name]" value="<?=$item['client_name']?>">
                            <input type="hidden" data-field-name="extension" name="files[1][<?=$key?>][extension]" value="<?=$item['extension']?>">
                            <input type="hidden" data-field-name="file_size" name="files[1][<?=$key?>][file_size]" value="<?=$item['file_size']?>">
                            <input type="hidden" data-field-name="service_path" name="files[1][<?=$key?>][service_path]" value="<?=$item['service_path']?>">
                        </div>

		            <?php } }  ?>
            </div>
            <div class="space"></div>
            <div class="col-md-4" >
                <p style="display:block;float:right;">上传提单 :</p>
            </div>
            <div class="col-md-7" data-category="4">
                <div style="width: 120px;float: left;margin-right: 8px">
                    <div>
                        <img src="../images/up.png" data-action="upload" style="height: 120px;width: 120px;"/>
                    </div>
                </div>
	            <?php if (!empty($collectionFiles[4])){
		            foreach ($collectionFiles[4] as $key => $item){ ?>
                        <div style="width: 120px;float: left;margin-right: 8px" data-key="<?=$key?>" data-box="true">
                            <div class="thumbnail">
                                <img src="<?=Upload::get_file_thumbnail($img_source.$item['service_path'])?>" data-action="upload" style="height: 120px;width: 120px;"/>
                                <div class="caption">
                                    <p><?=$item['client_name']?></p>
                                    <p style="display: none" data-action="operation">
                                        <a href="javascript:;" class="btn btn-primary" data-action="delete" style="color: #ffffff">删除</a>
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" data-field-name="category" name="files[1][<?=$key?>][category]" value="<?=$item['category']?>">
                            <input type="hidden" data-field-name="client_name" name="files[1][<?=$key?>][client_name]" value="<?=$item['client_name']?>">
                            <input type="hidden" data-field-name="extension" name="files[1][<?=$key?>][extension]" value="<?=$item['extension']?>">
                            <input type="hidden" data-field-name="file_size" name="files[1][<?=$key?>][file_size]" value="<?=$item['file_size']?>">
                            <input type="hidden" data-field-name="service_path" name="files[1][<?=$key?>][service_path]" value="<?=$item['service_path']?>">
                        </div>

		            <?php } }  ?>
            </div>
        </div>
        <div class="row-fluid col-md-12">

        </div>
    </div>
    <input id="select_file" type="file" name="file" style="display:none;"/>
	<input name="c_id" type="hidden" id="c_id" value="<?php echo $collection['id'];?>">
	<input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
	<input style="display:none;" id="sumbit-real" type="submit" value="Submit">
</form>
<div class="container-fluid" style="margin-top:50px;">
	<div class="row-fluid col-md-12">
		<p class="submit-btn">提交</p>
	</div>
</div>

<script type="text/javascript">
    var ZJJ = {
        category: 1,
        dir: '<?=$img_source?>',
        doFileSerialize: function (box) {
            var view = this;

            var lists = $('[data-category="' + box + '"]').find('[data-box="true"]');

            lists.each(function (i) {
                var item = $(this);
                var inputs = item.find("input");

                item.attr('data-key', i);

                inputs.each(function () {
                    var input = $(this);
                    var field_name = input.attr('data-field-name');

                    input.attr('name', 'files[' + box + '][' + i + '][' + field_name + ']');
                });
            });
        },
        getFileTemplate: function (file) {
            var view = this;
            var src = get_file_ext(view.dir + file.service_path);
            src = src === '' ? view.dir + file.service_path : src;
            return '<div style="width: 120px;float: left;margin-right: 8px" data-box="true">\n' +
                '<div class="thumbnail">\n' +
                '<img src="' + src + '" data-action="upload" style="height: 120px;width: 120px;"/>\n' +
                '<div class="caption">\n' +
                '<p>' + file.client_name + '</p>\n' +
                '<p style="display: none" data-action="operation">\n' +
                '<a href="javascript:;" class="btn btn-primary" data-action="delete" style="color: #ffffff">删除</a>\n' +
                '</p>\n' +
                '</div>\n' +
                '</div>\n' +
                '<input type="hidden" data-field-name="category" value="'+file.category+'"> ' +
                '<input type="hidden" data-field-name="client_name" value="'+file.client_name+'"> ' +
                '<input type="hidden" data-field-name="extension" value="'+file.extension+'"> ' +
                '<input type="hidden" data-field-name="file_size" value="'+file.file_size+'"> ' +
                '<input type="hidden" data-field-name="service_path" value="'+file.service_path+'"> ' +
                '</div>';
        },
        doUpload: function () {
            var view = this;
            var formData = new FormData;
            var img_file = document.getElementById("select_file");
            var fileObj = img_file.files[0];
            var _csrf = $("#_csrf").val();
            formData.append("file", fileObj);
            formData.append("category", view.category);
            formData.append("_csrf", _csrf);
            showFailHint('上传中...');

            setTimeout(function () {
                $.ajax({
                    url: "/collection/do-upload",
                    type: 'POST',
                    data: formData,
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    async: false,
                    success: function (result) {
                        hideFailHint();
                        if (result.state == 1) {
                            var html = view.getFileTemplate(result.file);

                            var box = result.file.category;

                            $("[data-category='" + box + "']").append(html);

                            view.doFileSerialize(box);
                        }
                    }
                });

                $("#select_file").val("");
            },200);
        },
        initHover: function () {
            var view = this;

            $(document).on("mouseenter", '[data-box="true"]', function () {
                var that = $(this);
                var operation = that.find('[data-action="operation"]');
                operation.show();
            });

            $(document).on("mouseleave", '[data-box="true"]', function () {
                var that = $(this);
                var operation = that.find('[data-action="operation"]');
                operation.hide();
            });
        },
        initChangeFile: function () {
            var view = this;
            $("#select_file").change(function () {
                view.doUpload();
            });
        },
        initUploadBtn: function () {
            var view = this;

            $(document).on("click", '[data-action="upload"]', function () {
                var that = $(this);

                $("#select_file").trigger('click');

                view.category = that.parents().eq(2).attr('data-category');
                //view.category = view.category === undefined ? that.parents().eq(4).attr('data-category') : view.category;
            });
        },
        initDeleteBtn: function () {
            var view = this;

            $(document).on("click", '[data-action="delete"]', function () {
                var that = $(this);

                var item = that.parents().eq(3);

                item.slideUp(600,function () {
                    $(this).remove();
                })
            });
        },
        init: function () {
            var view = this;

            view.initUploadBtn();
            view.initChangeFile();
            view.initHover();
            view.initDeleteBtn();
        }
    };

    ZJJ.init();
</script>

