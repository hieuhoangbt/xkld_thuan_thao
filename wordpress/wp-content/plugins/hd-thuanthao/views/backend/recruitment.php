<?php
wp_nonce_field($post->ID, 'hdthuanthao_security');
?>
<div class="container">
    <div class="row">
        <div class="form-group col-lg-6">
            <label class="font-weight-bold">Company Name: </label>
            <input type="text" name="recruitment[company_name]" value="<?php echo esc_attr($data["company_name"]); ?>" class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label class="font-weight-bold">Office Address : </label>
            <input type="text" name="recruitment[office_address]" value="<?php echo esc_attr($data["office_address"]); ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Date Interview : </label>
            <input type="text" name="recruitment[date_interview]" id="recruitment_date_interview" value="<?php echo esc_attr($data["date_interview"]); ?>" class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label>Gender : </label>
            <select type="text" name="recruitment[gender]" value="" class="form-control">
                <option value="male" <?php echo ($data["gender"] == 'male') ? "selected='selected'" : ''; ?>>Male</option>
                <option value="female" <?php echo ($data["gender"] == 'female') ? "selected='selected'" : ''; ?>>Female</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Specific work: </label>
            <textarea name="recruitment[specific_work]" class="form-control" rows="5" cols="8">
                <?php echo esc_attr($data["specific_work"]) ?>
            </textarea>
        </div>
        <div class="form-group col-lg-6">
            <label>Life of contract : </label>
            <input type="text" name="recruitment[life_of_contract]" value="<?php echo esc_attr($data["life_of_contract"]); ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Place: </label>
            <input type="text" name="recruitment[place]" value="<?php echo esc_attr($data["place"]); ?>" class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label>Country: </label>
            <input type="text" name="recruitment[country]" value="<?php echo esc_attr($data["country"]); ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Time to work : </label>
            <input type="text" name="recruitment[time_to_work]" value="<?php echo esc_attr($data["time_to_work"]); ?>" class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label>Basic salary: </label>
            <input type="text" name="recruitment[basic_salary]" value="<?php echo esc_attr($data["basic_salary"]); ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Require : </label>
            <input type="text" name="recruitment[require]" value="<?php echo esc_attr($data["require"]); ?>" class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label>Total : </label>
            <input type="text" name="recruitment[total]" value="<?php echo esc_attr($data["total"]); ?>" class="form-control">
        </div>
    </div>
    <div class="row">
        <div class="form-group col-lg-6">
            <label>Day off: </label>
            <input type="text" name="recruitment[day_off]" value="<?php echo esc_attr($data["day_off"]); ?>" class="form-control">
        </div>
        <div class="form-group col-lg-6">
            <label>Benefits : </label>
            <input type="text" name="recruitment[benefit]" value="<?php echo esc_attr($data["benefit"]); ?>" class="form-control">
        </div>
    </div>
</div>