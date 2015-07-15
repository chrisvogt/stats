<?php
/**
 * Template: Page header
 */ ?>

	<div class="page-header">
		<div class="container-fluid text-center">
			<h1 id="title"><?php echo Configure::read('Site.title'); ?></h1>
			<p class="lead">Chris Vogt's open source contributions.</p>
			<?php echo $this->element('social'); ?>
			<p>
				<a href="https://github.com/chrisvogt/stats/releases" title="View this project on GitHub">
					<img src="https://img.shields.io/github/release/chrisvogt/stats.svg?style=flat-square" alt="Release - Shields icon">
				</a>
				<a href="https://github.com/chrisvogt/stats/blob/develop/LICENSE" title="MIT License on GitHub">
					<img src="https://img.shields.io/github/license/chrisvogt/stats.svg?style=flat-square" alt="License - Shields icon">
				</a>
			</p>
		</div>
    <div class="github-fork-ribbon-wrapper right hidden-xs hidden-sm">
        <div class="github-fork-ribbon hvr-back-pulse">
            <a href="https://github.com/chrisvogt/stats" title="View the source on GitHub">Fork me on GitHub</a>
        </div>
    </div>
	</div>
