<?php  if (isset($data) && count($data) > 0) : ?>
  <div class="error">
  	<?php foreach ($data as $error) : ?>
  	  <p><?php echo $error ?></p>
  	<?php endforeach ?>
  </div>
<?php  endif ?>