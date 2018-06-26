<?php
wp_nonce_field($post->ID, 'vuonxa_security');
?>
<div class="container-fluid">
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Fullname: </label>
            <input type="text" name="register-information[full_name]"
                   value="<?php echo esc_attr($data["full_name"][0]); ?>"
                   class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label>Address : </label>
            <input type="text" name="register-information[address]" value="<?php echo esc_attr($data["address"][0]); ?>"
                   class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Phone Number: </label>
            <input type="text" name="register-information[phone_number]"
                   value="<?php echo esc_attr($data["phone_number"][0]); ?>"
                   class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label>Email : </label>
            <input type="text" name="register-information[email]" value="<?php echo esc_attr($data["email"][0]); ?>"
                   class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Introduce: </label>
            <textarea name="register-information[introduce]" class="form-control" rows="5" cols="8">
                <?php echo esc_attr($data["introduce"][0]) ?>
            </textarea>
        </div>
    </div>
</div>