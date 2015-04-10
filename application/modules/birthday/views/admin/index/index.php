<link href="<?=$this->getModuleUrl('static/css/birthday.css') ?>" rel="stylesheet">
<legend><?=$this->getTrans('settings') ?></legend>
<form class="form-horizontal" method="POST" action="<?=$this->getUrl(array('action' => $this->getRequest()->getActionName())) ?>">
    <?=$this->getTokenField() ?>
    <div class="form-group">
        <label for="shoutboxSettings" class="col-lg-2 control-label">
            <?=$this->getTrans('numberOfBirthsdayShow') ?>:
        </label>
        <div class="col-lg-2">
            <div class="container">
                <div class="input-group spinner">
                    <input type="text" class="form-control" id="entrySettings" name="entrySettings" value="<?=$this->get('setShow') ?>">
                    <div class="input-group-btn-vertical">
                        <button class="btn btn-default"><i class="fa fa-caret-up"></i></button>
                        <button class="btn btn-default"><i class="fa fa-caret-down"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?=$this->getSaveBar() ?>
</form>
<script language="JavaScript" type="text/javascript">
(function ($) {
  $('.spinner .btn:first-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) + 1);
  });
  $('.spinner .btn:last-of-type').on('click', function() {
    $('.spinner input').val( parseInt($('.spinner input').val(), 10) - 1);
  });
})(jQuery);
</script>