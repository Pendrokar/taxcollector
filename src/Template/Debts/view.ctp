<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Debt $debt
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Debt'), ['action' => 'edit', $debt->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Debt'), ['action' => 'delete', $debt->id], ['confirm' => __('Are you sure you want to delete # {0}?', $debt->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Debts'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Debt'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="debts view large-9 medium-8 columns content">
    <h3><?= h($debt->title) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Title') ?></th>
            <td><?= h($debt->title) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Id') ?></th>
            <td><?= $this->Number->format($debt->id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Value') ?></th>
            <td><?= $this->Number->format($debt->value) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Date') ?></th>
            <td><?= h($debt->date) ?></td>
        </tr>
    </table>
</div>
