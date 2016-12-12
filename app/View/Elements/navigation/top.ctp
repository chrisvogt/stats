<?php
/**
* Template: Masthead navigation
*/ ?>
<div class="contain-to-grid">
    <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on:[medium,large];scrolltop:false;">
        <ul class="title-area">
            <li class="name">
                <h1><strong>stats.</strong>chrisvogt.me</h1>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
        </ul>
        <section class="top-bar-section">
            <ul class="right">
                <?php foreach ($topNavigation['right'] as $item): ?>
                    <?php echo $this->Element('navigation/item', ['item' => $item]); ?>
                <?php endforeach; ?>
            </ul>
            <ul class="left">
                <?php foreach ($topNavigation['left'] as $item): ?>
                    <?php echo $this->Element('navigation/item', ['item' => $item]); ?>
                <?php endforeach; ?>
            </ul>
        </section>
    </nav>
</div>
