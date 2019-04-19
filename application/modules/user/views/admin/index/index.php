<h1><?=$this->getTrans('manage') ?></h1>
<form class="form-horizontal" method="POST">
    <?=$this->getTokenField() ?>
    <ul class="nav nav-tabs">
        <li <?php if (!$this->getRequest()->getParam('showsetfree') && !$this->getRequest()->getParam('showlocked')) { echo 'class="active"'; } ?>>
            <a href="<?=$this->getUrl(['controller' => 'index', 'action' => 'index']) ?>">
                <?=$this->getTrans('users') ?>
            </a>
        </li>
        <?php if ($this->get('badge') > 0): ?>
            <li <?php if ($this->getRequest()->getParam('showsetfree')) { echo 'class="active"'; } ?>>
                <a href="<?=$this->getUrl(['controller' => 'index', 'action' => 'index', 'showsetfree' => 1]) ?>">
                    <?=$this->getTrans('setfree'); ?> <span class="badge"><?=$this->get('badge') ?></span>
                </a>
            </li>
        <?php endif; ?>
        <?php if ($this->get('badgeLocked') > 0): ?>
            <li <?php if ($this->getRequest()->getParam('showlocked')) { echo 'class="active"'; } ?>>
                <a href="<?=$this->getUrl(['controller' => 'index', 'action' => 'index', 'showlocked' => 1]) ?>">
                    <?=$this->getTrans('unlock'); ?> <span class="badge"><?=$this->get('badgeLocked') ?></span>
                </a>
            </li>
        <?php endif; ?>
    </ul>
    <br />
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <colgroup>
                <col class="icon_width">
                <col class="icon_width">
                <col class="icon_width">
                <col class="col-lg-2">
                <col class="col-lg-2">
                <col class="col-lg-2">
                <col class="col-lg-2">
                <col>
            </colgroup>
            <thead>
                <tr>
                    <th><?=$this->getCheckAllCheckbox('check_users') ?></th>
                    <th></th>
                    <th></th>
                    <th><?=$this->getTrans('userName') ?></th>
                    <th><?=$this->getTrans('userEmail') ?></th>
                    <th><?=$this->getTrans('userDateCreated') ?></th>
                    <th><?=$this->getTrans('userDateLastActivity') ?></th>
                    <th><?=$this->getTrans('userGroups') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($this->get('userList') != ''):
                    foreach ($this->get('userList') as $user):
                        $groups = '';

                        foreach ($user->getGroups() as $group) {
                            if ($groups != '') {
                                $groups .= ', ';
                            }

                            $groups .= $group->getName();
                        }

                        if ($groups === '') {
                            $groups = $this->getTrans('noGroupsAssigned');
                        }

                        $dateConfirmed = $user->getDateConfirmed();

                        if ($dateConfirmed == '') {
                            $dateConfirmed = $this->getTrans('notConfirmedYet');
                        }

                        $dateLastActivity = $user->getDateLastActivity();

                        if ($dateLastActivity !== null && $dateLastActivity->getTimestamp() == 0) {
                            $dateLastActivity = $this->getTrans('neverLoggedIn');
                        }
                        ?>
                        <tr>
                            <td><?=$this->getDeleteCheckbox('check_users', $user->getId()) ?></td>
                            <td>
                            <?php if ($this->getRequest()->getParam('showsetfree')): ?>
                                <a href="<?=$this->getUrl(['action' => 'setfree', 'id' => $user->getId()], null, true) ?>" title="<?=$this->getTrans('setfree') ?>"><i class="fa fa-check text-success"></i></a>
                            <?php elseif ($this->getRequest()->getParam('showlocked')): ?>
                                <a href="<?=$this->getUrl(['action' => 'unlock', 'id' => $user->getId()], null, true) ?>" title="<?=$this->getTrans('unlock') ?>"><i class="fa fa-check text-success"></i></a>
                            <?php else: ?>
                                <?=$this->getEditIcon(['action' => 'treat', 'id' => $user->getId()]) ?>
                            <?php endif; ?>
                            </td>
                            <td><?=$this->getDeleteIcon(['action' => 'delete', 'id' => $user->getId()]) ?></td>
                            <td><?=$this->escape($user->getName()) ?></td>
                            <td><?=$this->escape($user->getEmail()) ?></td>
                            <td><?=$this->escape($user->getDateCreated()) ?></td>
                            <td><?=$this->escape($user->getDateLastActivity()) ?></td>
                            <td><?=$this->escape($groups) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7"><?=$this->getTrans('noUsersExist') ?></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?=$this->getListBar(['delete' => 'delete']) ?>
</form>
<?php if ($this->getRequest()->getParam('showsetfree')): ?>
<?=$this->get('pagination')->getHtml($this, ['action' => 'index', 'showsetfree' => 1]) ?>
<?php elseif ($this->getRequest()->getParam('showlocked')): ?>
<?=$this->get('pagination')->getHtml($this, ['action' => 'index', 'showlocked' => 1]) ?>
<?php else: ?>
<?=$this->get('pagination')->getHtml($this, ['action' => 'index']) ?>
<?php endif; ?>
