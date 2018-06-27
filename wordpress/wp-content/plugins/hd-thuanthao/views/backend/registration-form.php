<?php
wp_nonce_field($post->ID, 'hdthuanthao_security');
$fileName = explode('/', $data['registration_form_file_url'][0]);
?>
<div class="container-fluid">
    <div class="row">
        <div class="form-group col-lg-6">
            <label class="mr-5">Choose File</label>
            <button name="registration_button"
                    id="registration_button" class="btn btn-primary">Choose File
            </button>
            <input type="hidden" name="registrationform[registration_form_file_url]"
                   value="<?php $data['registration_form_file_url'][0] ?>">
        </div>
        <div class="form-group col-lg-6">
            <label class="label_form"><?php echo (!empty($fileName)) ? end($fileName) : "No file chosen!" ?></label>
        </div>
    </div>
</div>