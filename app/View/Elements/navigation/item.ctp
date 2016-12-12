<?php
/**
* Template: Navigation item
*/ ?>
<li <?php if ($item['text'] === 'Stats'): ?>class="active"<?php endif; ?>>
    <?php $linkText = (!empty($item['icon'])) ? '<i class="fa fa-' . $item['icon'] . '" aria-hidden="true"></i>&nbsp;' . $item['text'] : $item['text']; ?>
    <?php echo $this->Html->link(
        $linkText,
        $item['href'],
        ['title' => $item['title'], 'escape' => false]
    ); ?>
</li>
