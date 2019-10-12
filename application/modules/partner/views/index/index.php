<h1><?=$this->getTrans('menuPartnerAdd') ?></h1>
<form method="POST" class="form-horizontal">
    <?=$this->getTokenField() ?>
    <div class="form-group <?=$this->validation()->hasError('name') ? 'has-error' : '' ?>">
        <label for="name" class="col-lg-2 control-label">
            <?=$this->getTrans('name') ?>:
        </label>
        <div class="col-lg-8">
            <input type="text"
                   class="form-control"
                   id="name"
                   name="name"
                   placeholder="Name"
                   value="<?=($this->originalInput('name') != '' ? $this->escape($this->originalInput('name')) : '') ?>" />
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('link') ? 'has-error' : '' ?>">
        <label for="link" class="col-lg-2 control-label">
            <?=$this->getTrans('link') ?>:
        </label>
        <div class="col-lg-8">
            <input type="text"
                   class="form-control"
                   id="link"
                   name="link"
                   placeholder="http://"
                   value="<?=($this->originalInput('link') != '' ? $this->escape($this->originalInput('link')) : '') ?>" />
        </div>
    </div>
    <div class="form-group <?=$this->validation()->hasError('banner') ? 'has-error' : '' ?>">
        <label for="banner" class="col-lg-2 control-label">
            <?=$this->getTrans('banner') ?>:
        </label>
        <div class="col-lg-8">
            <input type="text"
                   class="form-control"
                   id="banner"
                   name="banner"
                   placeholder="http://"
                   value="<?=($this->originalInput('banner') != '' ? $this->escape($this->originalInput('banner')) : '') ?>" />
        </div>
    </div>
    <?php if ($this->get('captchaNeeded')) : ?>
        <div class="form-group <?=$this->validation()->hasError('captcha') ? 'has-error' : '' ?>">
            <label class="col-lg-2 control-label">
                <?=$this->getTrans('captcha') ?>:
            </label>
            <div class="col-lg-8">
                <?=$this->getCaptchaField() ?>
            </div>
        </div>
        <div class="form-group <?=$this->validation()->hasError('captcha') ? 'has-error' : '' ?>">
            <div class="col-lg-offset-2 col-lg-8 input-group captcha">
                <input type="text"
                       class="form-control"
                       id="captcha-form"
                       name="captcha"
                       autocomplete="off"
                       placeholder="<?=$this->getTrans('captcha') ?>" />
                <span class="input-group-addon">
                    <a href="javascript:void(0)" onclick="
                        document.getElementById('captcha').src='<?=$this->getUrl() ?>/application/libraries/Captcha/Captcha.php?'+Math.random();
                        document.getElementById('captcha-form').focus();"
                        id="change-image">
                        <i class="fa fa-refresh"></i>
                    </a>
                </span>
            </div>
        </div>
    <?php endif; ?>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-8">
            <?=$this->getSaveBar('addButton', 'Partner') ?>
        </div>
    </div>
</form>
