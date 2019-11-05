<div class="form-group">
    <label for="languageInput" class="col-lg-3 control-label">
        <?=$this->getTrans('chooseLanguage') ?>:
    </label>
    <div class="col-lg-4">
        <select class="form-control" id="languageInput" name="language">
            <?php foreach ($this->get('languages') as $key => $value): ?>
                <?php $selected = ''; ?>

                <?php if ($this->getTranslator()->getLocale() == $key): ?>
                    <?php $selected = 'selected="selected"'; ?>
                <?php endif; ?>

                <option <?=$selected ?> value="<?=$key ?>"><?=$this->escape($value) ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="form-group">
    <label for="timezone" class="col-lg-3 control-label">
        <?=$this->getTrans('timezone') ?>:
    </label>
    <div class="col-lg-4">
        <select class="form-control" id="timezone" name="timezone">
            <?php $timezones = $this->get('timezones'); ?>

            <?php for ($i = 0, $iMax = count($timezones); $i < $iMax; $i++): ?>
                <?php $sel = ''; ?>
                <?php if ($this->get('timezone') == $timezones[$i]): ?>
                    <?php $sel = 'selected="selected"'; ?>
                <?php endif; ?>

                <option <?=$sel ?> value="<?=$this->escape($timezones[$i]) ?>"><?=$this->escape($timezones[$i]) ?></option>
            <?php endfor; ?>
        </select>
    </div>
</div>

<script>
$('#languageInput').change (
    this,
    function () {
        top.location.href = '<?=$this->getUrl(['action' => 'index']) ?>/language/'+$(this).val();
    }
);
</script>
