(function () {
    'use strict';

    var configurators = document.querySelectorAll('[data-ledsi-configurator]');

    function toNumber(value, fallback) {
        var parsed = Number(String(value).replace(',', '.'));
        return Number.isFinite(parsed) && parsed > 0 ? parsed : fallback;
    }

    function gcd(a, b) {
        while (b) {
            var temp = b;
            b = a % b;
            a = temp;
        }

        return a || 1;
    }

    function formatNumber(value, digits) {
        return value.toLocaleString('ru-RU', {
            maximumFractionDigits: digits
        });
    }

    function getCabinetSize(value) {
        var parts = String(value).split('x');
        return {
            width: toNumber(parts[0], 500),
            height: toNumber(parts[1], 500)
        };
    }

    function calculate(form) {
        var width = toNumber(form.elements.width.value, 3);
        var height = toNumber(form.elements.height.value, 2);
        var pitch = toNumber(form.elements.pitch.value, 2.5);
        var power = toNumber(form.elements.power.value, 350);
        var cabinet = getCabinetSize(form.elements.cabinet.value);
        var cabinetsWide = Math.ceil((width * 1000) / cabinet.width);
        var cabinetsHigh = Math.ceil((height * 1000) / cabinet.height);
        var realWidth = (cabinetsWide * cabinet.width) / 1000;
        var realHeight = (cabinetsHigh * cabinet.height) / 1000;
        var area = realWidth * realHeight;
        var resolutionWidth = Math.round((realWidth * 1000) / pitch);
        var resolutionHeight = Math.round((realHeight * 1000) / pitch);
        var ratioDivider = gcd(resolutionWidth, resolutionHeight);
        var averagePower = (area * power) / 1000;

        return {
            realSize: formatNumber(realWidth, 2) + ' × ' + formatNumber(realHeight, 2) + ' м',
            area: formatNumber(area, 2) + ' м²',
            resolution: resolutionWidth.toLocaleString('ru-RU') + ' × ' + resolutionHeight.toLocaleString('ru-RU') + ' px',
            cabinets: cabinetsWide + ' × ' + cabinetsHigh + ' = ' + (cabinetsWide * cabinetsHigh) + ' шт.',
            ratio: Math.round(resolutionWidth / ratioDivider) + ':' + Math.round(resolutionHeight / ratioDivider),
            power: formatNumber(averagePower, 2) + ' кВт',
            summary: [
                'LED-экран: ' + formatNumber(realWidth, 2) + ' × ' + formatNumber(realHeight, 2) + ' м',
                'Площадь: ' + formatNumber(area, 2) + ' м²',
                'Шаг пикселя: P' + formatNumber(pitch, 2),
                'Разрешение: ' + resolutionWidth.toLocaleString('ru-RU') + ' × ' + resolutionHeight.toLocaleString('ru-RU') + ' px',
                'Кабинеты: ' + cabinetsWide + ' × ' + cabinetsHigh + ' = ' + (cabinetsWide * cabinetsHigh) + ' шт.',
                'Среднее потребление: ' + formatNumber(averagePower, 2) + ' кВт'
            ].join('\n')
        };
    }

    function setResult(root, key, value) {
        var node = root.querySelector('[data-ledsi-result="' + key + '"]');
        if (node) {
            node.textContent = value;
        }
    }

    function init(root) {
        var form = root.querySelector('[data-ledsi-form]');
        var copyButton = root.querySelector('[data-ledsi-copy]');
        var message = root.querySelector('[data-ledsi-message]');
        var latestSummary = '';

        if (!form) {
            return;
        }

        function update() {
            var result = calculate(form);
            latestSummary = result.summary;
            setResult(root, 'realSize', result.realSize);
            setResult(root, 'area', result.area);
            setResult(root, 'resolution', result.resolution);
            setResult(root, 'cabinets', result.cabinets);
            setResult(root, 'ratio', result.ratio);
            setResult(root, 'power', result.power);
        }

        form.addEventListener('input', update);
        form.addEventListener('change', update);

        if (copyButton && navigator.clipboard) {
            copyButton.addEventListener('click', function () {
                navigator.clipboard.writeText(latestSummary).then(function () {
                    if (message) {
                        message.hidden = false;
                    }
                });
            });
        }

        update();
    }

    configurators.forEach(init);
}());
