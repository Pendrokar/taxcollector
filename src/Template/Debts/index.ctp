<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Debt[]|\Cake\Collection\CollectionInterface $debts
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Debt'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="debts index large-9 medium-8 columns content">
    <h3><?= __('Debts') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('title') ?></th>
                <th scope="col"><?= $this->Paginator->sort('value') ?></th>
                <th scope="col"><?= $this->Paginator->sort('date') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($debts as $debt): ?>
            <tr>
                <td><?= $this->Number->format($debt->id) ?></td>
                <td><?= h($debt->title) ?></td>
                <td><?= $debt->formattedValue ?></td>
                <td><?= $debt->formattedDate ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $debt->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $debt->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $debt->id], ['confirm' => __('Are you sure you want to delete # {0}?', $debt->id)]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>
