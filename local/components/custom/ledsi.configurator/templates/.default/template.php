<?php
declare(strict_types=1);

if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

/** @var array<string, mixed> $arResult */
$containerClass = trim('ledsi-configurator ' . (string)$arResult['CSS_CLASS']);
$defaultPitch = (float)$arResult['DEFAULT_PITCH'];
$defaultCabinetWidth = (float)$arResult['DEFAULT_CABINET_WIDTH'];
$defaultCabinetHeight = (float)$arResult['DEFAULT_CABINET_HEIGHT'];
?>
<section class="<?= htmlspecialcharsbx($containerClass) ?>" data-ledsi-configurator>
    <div class="ledsi-configurator__header">
        <?php if ($arResult['TITLE'] !== ''): ?>
            <h2 class="ledsi-configurator__title"><?= htmlspecialcharsbx((string)$arResult['TITLE']) ?></h2>
        <?php endif; ?>

        <?php if ($arResult['DESCRIPTION'] !== ''): ?>
            <p class="ledsi-configurator__description"><?= htmlspecialcharsbx((string)$arResult['DESCRIPTION']) ?></p>
        <?php endif; ?>
    </div>

    <div class="ledsi-configurator__grid">
        <form class="ledsi-configurator__form" data-ledsi-form>
            <div class="ledsi-configurator__fieldset">
                <label class="ledsi-configurator__field">
                    <span class="ledsi-configurator__label">Ширина экрана, м</span>
                    <input class="ledsi-configurator__input" type="number" name="width" min="0.1" max="100" step="0.1" value="<?= htmlspecialcharsbx((string)$arResult['DEFAULT_WIDTH']) ?>" data-ledsi-input>
                </label>

                <label class="ledsi-configurator__field">
                    <span class="ledsi-configurator__label">Высота экрана, м</span>
                    <input class="ledsi-configurator__input" type="number" name="height" min="0.1" max="100" step="0.1" value="<?= htmlspecialcharsbx((string)$arResult['DEFAULT_HEIGHT']) ?>" data-ledsi-input>
                </label>

                <label class="ledsi-configurator__field">
                    <span class="ledsi-configurator__label">Шаг пикселя</span>
                    <select class="ledsi-configurator__input" name="pitch" data-ledsi-input>
                        <?php foreach ($arResult['PITCH_OPTIONS'] as $pitch): ?>
                            <?php $pitchValue = (float)$pitch; ?>
                            <option value="<?= htmlspecialcharsbx((string)$pitchValue) ?>" <?= abs($pitchValue - $defaultPitch) < 0.001 ? 'selected' : '' ?>>P<?= htmlspecialcharsbx((string)$pitchValue) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="ledsi-configurator__field">
                    <span class="ledsi-configurator__label">Размер кабинета</span>
                    <select class="ledsi-configurator__input" name="cabinet" data-ledsi-input>
                        <?php foreach ($arResult['CABINET_OPTIONS'] as $cabinet): ?>
                            <?php
                            $cabinetWidth = (float)$cabinet['WIDTH'];
                            $cabinetHeight = (float)$cabinet['HEIGHT'];
                            $selected = abs($cabinetWidth - $defaultCabinetWidth) < 0.001 && abs($cabinetHeight - $defaultCabinetHeight) < 0.001;
                            ?>
                            <option value="<?= (int)$cabinetWidth ?>x<?= (int)$cabinetHeight ?>" <?= $selected ? 'selected' : '' ?>><?= htmlspecialcharsbx((string)$cabinet['NAME']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </label>

                <label class="ledsi-configurator__field ledsi-configurator__field--wide">
                    <span class="ledsi-configurator__label">Среднее потребление, Вт/м²</span>
                    <input class="ledsi-configurator__input" type="number" name="power" min="1" max="2000" step="10" value="<?= htmlspecialcharsbx((string)$arResult['DEFAULT_POWER']) ?>" data-ledsi-input>
                </label>
            </div>
        </form>

        <div class="ledsi-configurator__result" aria-live="polite">
            <h3 class="ledsi-configurator__result-title">Расчёт</h3>
            <dl class="ledsi-configurator__result-list">
                <div><dt>Фактический размер</dt><dd data-ledsi-result="realSize">—</dd></div>
                <div><dt>Площадь</dt><dd data-ledsi-result="area">—</dd></div>
                <div><dt>Разрешение</dt><dd data-ledsi-result="resolution">—</dd></div>
                <div><dt>Кабинеты</dt><dd data-ledsi-result="cabinets">—</dd></div>
                <div><dt>Соотношение сторон</dt><dd data-ledsi-result="ratio">—</dd></div>
                <div><dt>Среднее потребление</dt><dd data-ledsi-result="power">—</dd></div>
            </dl>

            <?php if ($arResult['SHOW_LEAD_FORM']): ?>
                <button class="ledsi-configurator__button" type="button" data-ledsi-copy>
                    <?= htmlspecialcharsbx((string)$arResult['LEAD_BUTTON_TEXT']) ?>
                </button>
                <p class="ledsi-configurator__note" data-ledsi-message hidden>Расчёт скопирован. Его можно вставить в форму заявки или письмо менеджеру.</p>
            <?php endif; ?>
        </div>
    </div>
</section>
