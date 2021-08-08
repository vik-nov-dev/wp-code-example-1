  	<footer <?php live_edit('logo_footer, shop_footer_menu, email_footer, email_text_footer, phone_footer, right_column_content_footer, follow_menu, left_column_copy, right_column_copy', 'options'); ?>>
  		<div class="container">
  			<div class="row justify-content-between">
  				<div class="col col-md-6 address">
  					<div class="row">
              <?php $logo_footer = get_field('logo_footer', 'options'); if (!empty($logo_footer)) { ?>
  						<div class="col col-md-12 logo">
  							<img src="<?= $logo_footer['url']; ?>" alt="<?= $logo_footer['alt']; ?>">
  						</div>
              <?php } ?>
              <div class="col d-flex flex-column justify-content-between">
                <div>
                  <?php $email = get_field('email_footer', 'options'); if (!empty($email)) { ?>
                  <div class="mail"><span><a href="" class="fa fa-instagram"></a> <a href="mailto:<?= $email; ?>" class="fa fa-pinterest-p"></a></span> <i class="fa fa-send"></i> <a href="mailto:<?= $email; ?>"><?php the_field('email_text_footer', 'options'); ?></a> </div>
                  <?php } ?>
                  <?php $phone = get_field('phone_footer', 'options'); if (!empty($phone)) { ?>
                  <div class="mail"><i class="fa fa-phone"></i> <a href="tel:<?= $phone; ?>"><?= $phone; ?></a></div>
                  <?php } ?>
                </div>
                <a class="btn btn-submit mw-180" href="/">Interior design site <i class="fa fa-angle-right"></i></a>
              </div>
  						<div class="col">
                <?php $footer_menu = get_field('shop_footer_menu', 'options'); if (!empty($footer_menu)) { ?>
  							<ul>
                  <?php foreach ($footer_menu as $key => $value) { ?>
                  <li><a href="<?= $value['menu_item']['url']; ?>"><?= $value['menu_item']['title']; ?></a></li>
                  <?php } ?>
  							</ul>
                <?php } ?>
  						</div>
              
  					</div>
  				</div>
  				<div class="col col-md-5 col-lg-4 d-flex flex-column justify-content-between">
            <div>
              <?php the_field('right_column_content_footer', 'options'); ?>
              <?php $follow_menu = get_field('follow_menu', 'options'); if (!empty($follow_menu)) { ?>
            </div>
            <div class="follow right">
             <?php foreach ($follow_menu as $key => $value) { ?>
              <a href="<?= $value['link']; ?>" class="<?= $value['fontawesome_class']; ?>"></a> 
             <?php } ?>
            </div>
            <?php } ?>
  				</div>
  			</div>
        <div class="copy">
    			<div class="row">
    				<div class="col-9">
              <?php the_field('left_column_copy', 'options', false); ?>
    				</div>
    				<div class="col-3">
              <?php the_field('right_column_copy', 'options', false); ?>
    				</div>
    			</div>
        </div>
  		</div>
  	</footer>

    <?php wp_footer(); ?>
    <?php the_field('footer_code', 'options'); ?>
    

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/css/iziModal.min.css" integrity="sha256-IyR33qBiUXj7Clf/BpIUivtGnpIpLIL0XOCEGSQPZxg=" crossorigin="anonymous" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/izimodal/1.5.1/js/iziModal.min.js" integrity="sha256-vVnwgKyq3pIb4XdL91l1EC8j7URqDRK8BAWvSnKX0U8=" crossorigin="anonymous"></script>
	<style>#modal-alert a { color:white; }</style>
	<script>
	if (document.cookie.indexOf("covid19=true")<0) {
		jQuery("#modal-alert").iziModal({
			title: '<?= trim(the_field('alert_content', 'options', false)); ?>',
			headerColor: '#595348',
			width: 600,
			timeout: 3000,
			timeoutProgressbar: true,
			transitionIn: 'fadeInUp',
			transitionOut: 'fadeOutDown',
			bottom: 0,
			loop: true,
			pauseOnHover: true,
			overlay:false,
			borderBottom:false,
			onOpened: function(){ jQuery('body,html').css('overflow', 'auto'); },
		});
		jQuery("#modal-alert").iziModal('open');
		
		var d=new Date();
		d.setTime(d.getTime()+(1*24*60*60*1000));
		document.cookie = "covid19=true; expires="+d.toGMTString()+"; path=/";
	}
	</script>

  </body>
</html>