<section>
  <div class="container">
    <div class="alert alert-dark">
      <p>Owner's Information</p>
    </div>
    <?php
      $attributes = array('id' => 'regform', 'autocomplete' => 'off');
     ?>
     <?=form_open(base_url().'users/post', $attributes)?>
      <div class="form-group">
        <?=form_label('First Name', 'fname')?>
        <?=form_input(array('name' => 'fname', 'class'=>'form-control', 'placeholder' => 'First Name', 'value'=> set_value('fname'), 'maxlength' => 200, 'autocomplete' => 'off'))?>
        <?php if(form_error('fname')): ?>
          <?=form_error('fname'); ?>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <?=form_label('Last Name', 'lname')?>
        <?=form_input(array('name' => 'lname', 'class'=>'form-control', 'placeholder' => 'Last Name', 'value'=> set_value('lname'), 'maxlength' => 200, 'autocomplete' => 'off'))?>
        <?php if(form_error('lname')): ?>
          <?=form_error('lname'); ?>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <?=form_label('Email Address', 'email')?>
        <?=form_input(array('name' => 'email', 'class'=>'form-control', 'placeholder' => 'Email Address', 'aria-describedby' => 'emailTip', 'value'=> set_value('email'), 'maxlength' => 200, 'autocomplete' => 'off'))?>
        <small id='emailTip' class='form-text text-muted'>We'll never share your email with anyone else.</small>
        <?php if(form_error('email')): ?>
          <?=form_error('email'); ?>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <?=form_label('Mobile Number', 'mnumber')?>
        <?=form_input(array('name' => 'mnumber', 'class'=>'form-control', 'placeholder' => 'Mobile Number', 'value'=> set_value('mnumber'), 'maxlength' => 10, 'autocomplete' => 'off'))?>
        <?php if(form_error('mnumber')): ?>
          <?=form_error('mnumber'); ?>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <?=form_label('User Name', 'uname')?>
        <?=form_input(array('name' => 'uname', 'class'=>'form-control', 'placeholder' => 'User Name', 'value'=> set_value('uname'), 'maxlength' => 200, 'autocomplete' => 'off'))?>
        <?php if(form_error('uname')): ?>
          <?=form_error('uname'); ?>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <?=form_label('Password', 'pwd')?>
        <?=form_password(array('name' => 'pwd', 'class'=>'form-control', 'placeholder' => 'Password', 'maxlength' => 200, 'autocomplete' => 'off'))?>
        <?php if(form_error('pwd')): ?>
          <?=form_error('pwd'); ?>
        <?php endif; ?>
      </div>
      <div class="form-group">
        <?=form_label('Confirm Password', 'cpwd')?>
        <?=form_password(array('name' => 'cpwd', 'class'=>'form-control', 'placeholder' => 'Confirm Password', 'maxlength' => 200, 'autocomplete' => 'off'))?>
        <?php if(form_error('cpwd')): ?>
          <?=form_error('cpwd'); ?>
        <?php endif; ?>
      </div>
      <!-- Captcha -->
      <div class="form-group">
        <?=$captcha_image?>
        <div>
          <!-- <input type="text" name="captcha" value="" style="margin-top: 10px;" /> -->
          <?=form_input(array('name'=>'captcha', 'style'=>'margin-top: 10px; width: 250px;'))?>
        </div>
        <?php if(!empty($err1)): ?>
          <div class="alert alert-warning" style="margin-top: 4px;"><?=$err1?></div>
        <?php endif; ?>
      </div>
      <!-- ends -->
      <div class="form-group">
        <button type="submit" class="btn btn-dark btn-lg" style="text-transform: none; border-radius: unset;">Next</button>
      </div>
      <?=form_close()?>
  </div>
</section>
