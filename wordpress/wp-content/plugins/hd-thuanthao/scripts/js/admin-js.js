var qhObject = {
    qhAttrCount: 0
};
jQuery(document).ready(function () {
    if (jQuery('.cstm_asdfg').length) {
        var count = jQuery('.cstm_asdfg').length;
        qhObject.qhAttrCount = count;
    }
    jQuery('.qhshop-box-menu a').click(function (event) {
        event.preventDefault();
        var nameContent = jQuery(this).attr('href');
        var currentObj = jQuery('#qhshop-content-' + nameContent.replace('#', ''));
        jQuery('.qhshop-option').hide();
        currentObj.show();
    });

    jQuery('#qhAddAttr').click(function (event) {
        event.preventDefault();
        var content = '<div class="qhshop-content-form-group">';
        content += ' <input name="product[pricelist][' + qhObject.qhAttrCount + '][name]" type="text" value="" class="small-text" placeholder="Tên thuộc tính">';
        content += ' <input name="product[pricelist][' + qhObject.qhAttrCount + '][value]" type="text" value="" class="small-text" placeholder="Giá trị">';
        content += '</div>';
        jQuery('#qhshop-content-attribute-form-group').append(content);
        qhObject.qhAttrCount++;
    });
    jQuery('#addPost').click(function (event) {
        event.preventDefault();
        var content = '<div class="qhshop-content-form-group display-table">';
        content += "<label>Title Post : </label>";
        content += ' <input type="text" name="doctor[title_post][' + qhObject.qhAttrCount + ']" value="" class="small-text" placeholder="Title">';
        content += '</div>';
        content += '<div class="qhshop-content-form-group display-table">';
        content += "<label>Content Post : </label>";
        content += ' <textarea name="doctor[content_post][' + qhObject.qhAttrCount + ']" value="" class="small-text" rows="8" placeholder="Content"></textarea>';
        content += '</div>';
        jQuery('#qhshop-content-attribute-form-group').append(content);
        qhObject.qhAttrCount++;
    });

    jQuery('.qhDeleteIcon').click(function (event) {
        event.preventDefault();
        jQuery(this).parent().remove();
    });
	jQuery('.del_video').click(function (event) {
		var $this = jQuery(this);
        var format = $this.parents(".select-video").find(".cstm-btn-select").attr("data-format");
		$this.parents(".select-video").find(".cstm_videourl-"+format).removeAttr("value");
		$this.parents(".select-video").find(".filename_video-"+format).text("");
        jQuery(this).hide();
    });
	

    jQuery(".cstm-btn-select").click(function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        var format = $this.data('format');
        var uploader = wp.media({
            title: "Select video",
            button: {
                text: 'Select video'
            },
            multiple: false

        }).on('select', function () {
            var selection = uploader.state().get('selection');
            var attachment = selection.first().toJSON();
            var URL_HOME = jQuery("#hidden_domain").val();
            $this.parents(".qhshop-content-form-group").find("input.cstm_videourl-"+format).val(attachment.url.replace(URL_HOME, ""));
            $this.parents(".qhshop-content-form-group").find(".filename_video-"+format).text(attachment.filename);
            //jQuery(".description-upload img").attr("src", attachment.url);
        }).open();
    });



});