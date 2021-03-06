<?php
$awardsMapper = $this->get('awardsMapper');
$awards = $this->get('awards');

if ($awards != '') {
    $getDate = new \Ilch\Date($awards->getDate());
    $date = $getDate->format('d.m.Y', true);
}
?>

<link href="<?=$this->getModuleUrl('static/css/awards.css') ?>" rel="stylesheet">
<link href="<?=$this->getStaticUrl('js/datetimepicker/css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">

<h1><?=($awards != '') ? $this->getTrans('edit') : $this->getTrans('add') ?></h1>
<form class="form-horizontal" method="POST" action="<?=$this->getUrl(['action' => $this->getRequest()->getActionName(), 'id' => $this->getRequest()->getParam('id')]) ?>">
    <?=$this->getTokenField() ?>
    <div class="form-group <?=$this->validation()->hasError('date') ? 'has-error' : '' ?>">
        <label for="date" class="col-lg-2 control-label">
            <?=$this->getTrans('date') ?>:
        </label>
        <div class="col-lg-2 input-group ilch-date date form_datetime">
            <input type="text"
                   class="form-control"
                   name="date"
                   id="date"
                   value="<?=($this->get('awards') != '') ? $this->escape($date) : $this->escape($this->originalInput('date')) ?>"
                   readonly>
            <span class="input-group-addon">
                <span class="fa fa-calendar"></span>
            </span>
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('rank') ? 'has-error' : '' ?>">
        <label for="rank" class="col-lg-2 control-label">
            <?=$this->getTrans('rank') ?>:
        </label>
        <div class="col-lg-1">
            <input type="number"
                   class="form-control"
                   id="rank"
                   name="rank"
                   min="1"
                   placeholder="1"
                   value="<?=($this->get('awards') != '') ? $this->escape($this->get('awards')->getRank()) : $this->escape($this->originalInput('rank')) ?>" />
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('image') ? 'has-error' : '' ?>">
        <label for="selectedImage" class="col-lg-2 control-label">
            <?=$this->getTrans('image') ?>:
        </label>
        <div class="col-lg-4">
            <div class="input-group">
                <input type="text"
                       class="form-control"
                       id="selectedImage"
                       name="image"
                       placeholder="<?=$this->getTrans('httpOrMedia') ?>"
                       value="<?=($this->get('awards') != '') ? $this->escape($this->get('awards')->getImage()) : $this->escape($this->originalInput('image')) ?>" />
                <span class="input-group-addon">
                    <span class="fa fa-times"></span>
                </span>
                <span class="input-group-addon">
                    <a id="media" href="javascript:media()"><i class="fa fa-picture-o"></i></a>
                </span>
            </div>
        </div>
    </div>
    <div class="form-group <?=($this->validation()->hasError('typ') or $this->validation()->hasError('utId')) ? 'has-error' : '' ?>">
        <label for="user" class="col-lg-2 control-label">
            <?=$this->getTrans('userTeam') ?>:
        </label>
        <div class="col-lg-2">
            <select class="form-control" id="user" name="utId">
                <optgroup label="<?=$this->getTrans('user') ?>">
                    <?php foreach ($this->get('users') as $user) {
                            $selected = '';
                            if (($this->get('awards') != '' && $this->get('awards')->getUTId() == $user->getId() && $this->get('awards')->getTyp() == 1) || $this->originalInput('utId') == '1_'.$user->getId()) {
                                $selected = 'selected="selected"';
                            }
                            echo '<option '.$selected.' value="1_'.$user->getId().'">'.$this->escape($user->getName()).'</option>';
                        }
                    ?>
                </optgroup>
                <?php if ($awardsMapper->existsTable('teams') == true && $this->get('teams') != ''): ?>
                    <optgroup label="<?=$this->getTrans('team') ?>">
                        <?php foreach ($this->get('teams') as $team) {
                            $selected = '';
                            if (($this->get('awards') != '' && $this->get('awards')->getUTId() == $team->getId() && $this->get('awards')->getTyp() == 2) || $this->originalInput('utId') == '2_'.$team->getId()) {
                                $selected = 'selected="selected"';
                            }
                            echo '<option '.$selected.' value="2_'.$team->getId().'">'.$this->escape($team->getName()).'</option>';
                        }
                        ?>
                    </optgroup>
                <?php endif; ?>
            </select>
        </div>
    </div>
    <div class="form-group <?=($this->validation()->hasError('event')) ? 'has-error' : '' ?>">
        <label for="event" class="col-lg-2 control-label">
            <?=$this->getTrans('event') ?>:
        </label>
        <div class="col-lg-4">
            <input type="text"
                   class="form-control"
                   id="event"
                   name="event"
                   value="<?=($this->get('awards') != '') ? $this->escape($this->get('awards')->getEvent()) : $this->escape($this->originalInput('event')) ?>" />
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('page') ? 'has-error' : '' ?>">
        <label for="page" class="col-lg-2 control-label">
            <?=$this->getTrans('page') ?>:
        </label>
        <div class="col-lg-4">
            <input type="text"
                   class="form-control"
                   name="page"
                   id="page"
                   placeholder="http://"
                   value="<?=($this->get('awards') != '') ? $this->escape($this->get('awards')->getURL()) : $this->escape($this->originalInput('page')) ?>" />
        </div>
    </div>
    <?php if ($this->get('awards') != ''): ?>
        <?=$this->getSaveBar('updateButton') ?>
    <?php else: ?>
        <?=$this->getSaveBar('addButton') ?>
    <?php endif; ?>
</form>

<?=$this->getDialog('mediaModal', $this->getTrans('media'), '<iframe frameborder="0"></iframe>') ?>
<script src="<?=$this->getStaticUrl('js/datetimepicker/js/bootstrap-datetimepicker.min.js') ?>" charset="UTF-8"></script>
<?php if (strncmp($this->getTranslator()->getLocale(), 'en', 2) !== 0): ?>
    <script src="<?=$this->getStaticUrl('js/datetimepicker/js/locales/bootstrap-datetimepicker.'.substr($this->getTranslator()->getLocale(), 0, 2).'.js') ?>" charset="UTF-8"></script>
<?php endif; ?>
<script>
$(document).ready(function() {
    $(".form_datetime").datetimepicker({
        format: "dd.mm.yyyy",
        autoclose: true,
        language: '<?=substr($this->getTranslator()->getLocale(), 0, 2) ?>',
        minView: 2,
        todayHighlight: true
    });
});

<?=$this->getMedia()
    ->addMediaButton($this->getUrl('admin/media/iframe/index/type/single/'))
    ->addUploadController($this->getUrl('admin/media/index/upload'))
?>
</script>
