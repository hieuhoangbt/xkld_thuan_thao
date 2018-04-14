<?php
wp_nonce_field($post->ID, 'vuonxa_security');
?>
<div class="container-fluid">
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Fullname: </label>
            <input type="text" name="service[full_name]" value="<?php echo esc_attr($data["full_name"]); ?>"
                   class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label>Address : </label>
            <input type="text" name="service[address]" value="<?php echo esc_attr($data["address"]); ?>"
                   class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Phone Number: </label>
            <input type="text" name="service[phone_number]" value="<?php echo esc_attr($data["phone_number"]); ?>"
                   class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label>Email : </label>
            <input type="text" name="service[email]" value="<?php echo esc_attr($data["email"]); ?>"
                   class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Introduce: </label>
            <textarea name="service[introduce]" class="form-control" rows="5" cols="8">
                <?php echo esc_attr($data["introduce"]) ?>
            </textarea>
        </div>
    </div>
</div>