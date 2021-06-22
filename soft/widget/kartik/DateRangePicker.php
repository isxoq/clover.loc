<?php


namespace soft\widget\kartik;

use soft\helpers\Html;
use Yii;
use soft\helpers\ArrayHelper;

class DateRangePicker extends \kartik\daterange\DateRangePicker
{

    public $timePicker = false;

    public $convertFormat = true;

    public $useWithAddon = true;

    public $separator = '   -   ';

    public $format = 'd-m-Y';

    public $timeFormat = 'd-m-Y H:i';

    public $addon = <<< HTML
    <div class="input-group-prepend">
        <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
    </div>
HTML;

    public function run()
    {

        $defaultPluginOptions = [
            'locale' => [
                'cancelLabel' => Yii::t('site', 'Cancel'),
                'applyLabel' => Yii::t('site', 'Confirm'),
                'format' => $this->format,
                'separator' => $this->separator,
            ],
            "drops" => "up",

        ];

        if ($this->timePicker) {

            $defaultPluginOptions['timePicker'] = true;
            $defaultPluginOptions['timePicker24Hour'] = true;
            $defaultPluginOptions['timePickerIncrement'] = 5;
            $defaultPluginOptions['locale']['format'] = $this->timeFormat;

        }
        $this->pluginOptions = ArrayHelper::merge($defaultPluginOptions, $this->pluginOptions);

        $this->normalizeValues();
        $this->initSettings();
        $input = $this->renderInput();
        echo Html::tag('div',  $this->addon . $input, ['class' => 'input-group']);

    }

    private function normalizeValues()
    {

        $locale = ArrayHelper::getValue($this->pluginOptions, 'locale', []);
        $format = ArrayHelper::getValue($locale, 'format', $this->format);
        $separator =  ArrayHelper::getValue($locale, 'separator', $this->separator);

        if ($this->hasModel()) {

            if (empty($this->value)){

                if (!empty($this->startAttribute) && !empty($this->endAttribute) ){

                    $beginValue = $this->model->{$this->startAttribute};
                    $endValue = $this->model->{$this->endAttribute};

                    if (!empty($beginValue) && is_integer($beginValue) && !empty($endValue) && is_integer($endValue)  )
                    {


//                        $this->model->{$this->attribute} = date($format, $beginValue) . $separator . date($format, $endValue);
                        $this->value = date($format, $beginValue) . $separator . date($format, $endValue);
                    }


                }

            }

        }

    }

}