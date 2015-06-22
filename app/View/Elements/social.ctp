<?php
/**
 * Template: Social bar
 */ ?>

	<div class="social">
		<div class="container">
			<a href="https://twitter.com/<?php echo Configure::read('Site.twitter'); ?>" class="twitter-follow-button" data-show-count="false" data-size="large" data-dnt="true">Follow @C1V0</a>
	        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
	        <a class="github-button" href="https://github.com/chrisvogt" data-style="mega" data-count-href="/chrisvogt/followers" data-count-api="/users/chrisvogt#followers" data-count-aria-label="# followers on GitHub" aria-label="Follow @chrisvogt on GitHub">Follow @chrisvogt</a>
	        <script async defer id="github-bjs" src="https://buttons.github.io/buttons.js"></script>
		</div><!-- /.container -->
	</div>
