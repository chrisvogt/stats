<?php
/**
* Template: Page navbar
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
                <li <?php if ($item['text'] === 'Stats'): ?>class="active"<?php endif; ?>>
                    <?php $linkText = (!empty($item['icon'])) ? '<i class="fa fa-' . $item['icon'] . '" aria-hidden="true"></i>&nbsp;' . $item['text'] : $item['text']; ?>
                    <?php echo $this->Html->link(
                        $linkText,
                        $item['href'],
                        ['title' => $item['title'], 'escape' => false]
                    ); ?>
                </li>
                <?php endforeach; ?>
            </ul>
            <ul class="left">
                <?php foreach ($topNavigation['left'] as $item): ?>
                <li>
                    <?php $linkText = (!empty($item['icon'])) ? '<i class="fa fa-' . $item['icon'] . '" aria-hidden="true"></i>&nbsp;' . $item['text'] : $item['text']; ?>
                    <?php echo $this->Html->link(
                        $linkText,
                        $item['href'],
                        ['title' => $item['title'], 'escape' => false]
                    ); ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </nav>
</div>
