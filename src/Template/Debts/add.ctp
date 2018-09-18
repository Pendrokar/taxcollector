<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Debt $debt
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Debts'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="debts form large-9 medium-8 columns content">
    <?= $this->Form->create($debt) ?>
    <fieldset>
        <legend><?= __('Add Debt') ?></legend>
        <?php
            echo $this->Form->control('title');
            echo $this->Form->control('value');
            echo $this->Form->control('date');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
