<?phpnamespace soft\grid;use Yii;use soft\web\View;use soft\widget\button\BulkButtons;use soft\widget\button\Button;use soft\widget\MultiLinkPager;use soft\helpers\ArrayHelper;use kartik\grid\GridView as KartikGridView;use soft\helpers\Url;use soft\extra\TemplateRender;/** * @author Shukurullo Odilov * @property View $view */class GridView extends KartikGridView{    use SoftGridViewTrait;    public $dataColumnClass = 'soft\grid\DataColumn';    public $pjax = true;    public $striped = true;    public $condensed = true;    public $responsive = true;    public $bordered = true;    public $cols = [];    public $serialColumn = true;    public $toolbarTemplate = -1;    public $toolbarButtons = [];    public $bulkButtons = [];    public $bulkButtonsTemplate = false;    public $pagerDropDown = false;    public $responsiveWrap = false;    public $filterPosition = self::FILTER_POS_HEADER;    public $summary = <<<HTML        {begin}-{end}/Jami: {totalCount} taHTML;    public $layout = <<<HTML            {items}    <div class="row">        <div class="col-md-3">           <b> {summary}</b>        </div>        <div class="col-md-9" >               <div class="float-right">                     {pager}            </div>        </div>    </div>HTML;    public $panelFooterTemplate = <<< HTML     <div class="float-left">            <i class="text-muted">{summary}</i>        </div>        <div class="float-right">             <div class="kv-panel-pager">            {pager}        </div>    </div>    {footer}    <div class="clearfix"></div>HTML;    /**     * @var bool Whether register break-words css styles     * @see registerBreakWordsStyles()     */    public $breakWords = false;    public function init()    {        $this->panel = ArrayHelper::merge([            'heading' => false,            'panel' => false,            'options' => [                'class' => 'card card-primary card-outline border-default',            ],            'after' => '{bulk-buttons}',        ], $this->panel);        $this->initDefaultColumns();        parent::init();        $this->renderToolbarContent();        $this->renderBulkButtons();        $this->registerBreakWordsStyles();        $this->pager = array_merge([            'class' => MultiLinkPager::class,            'maxButtonCount' => 10,            'prevPageCssClass' => 'prev hidden-xs',            'nextPageCssClass' => 'next hidden-xs',            'activePageAsLink' => false        ], $this->pager);    }    public function renderFilters()    {        return parent::renderFilters(); // TODO: Change the autogenerated stub    }    //<editor-fold desc="Columns">    /**     * @return array     */    public function defaultColumns()    {        return [            'image' => [                'filter' => false,                'attribute' => 'image',                'format' => ['image', ['height' => '100px']],            ],            'status' => [                'attribute' => 'status',                'format' => 'status',                'vAlign' => 'middle',                'filter' => [0 => Yii::t('site', 'Deleted'), 10 => Yii::t('site', 'Active'), 9 => Yii::t('site', 'In Active')],            ],            'updated_at' => [                'attribute' => 'updated_at',                'format' => 'dateTimeUz',                'filter' => false,            ],            'created_at' => [                'attribute' => 'created_at',                'format' => 'dateTimeUz',                'filter' => false,            ],            'serialColumn' => [                'class' => 'kartik\grid\SerialColumn',                'width' => '50px',            ],            'checkboxColumn' => [                'class' => 'kartik\grid\CheckboxColumn',                'width' => '20px',            ],            'radioColumn' => [                'class' => 'kartik\grid\RadioColumn',                'width' => '20px',            ],            'actionColumn' => [                'class' => 'soft\grid\ActionColumn',                'width' => '100px',            ],        ];    }    public function initDefaultColumns()    {        $result = [];        $defaultColumns = $this->defaultColumns();        if ($this->serialColumn && !in_array("serialColumn", $result)) {            array_unshift($result, $defaultColumns['serialColumn']);        }        if ($this->hasBulkButtons() && !in_array("checkboxColumn", $result)) {            array_unshift($result, $defaultColumns['checkboxColumn']);        }        foreach ($this->cols as $key => $value) {            if (is_string($value)) {                if (ArrayHelper::keyExists($value, $defaultColumns)) {                    $result[] = ArrayHelper::getValue($defaultColumns, $value);                } else {                    $result[] = $value;                }            } else {                if (ArrayHelper::keyExists($key, $defaultColumns)) {                    $column = ArrayHelper::merge(ArrayHelper::getValue($defaultColumns, $key), $value);                } else {                    $column = $value;                }                $result[] = $column;            }        }        $this->columns = $result;    }    //</editor-fold>    //<editor-fold desc="Toolbar">    public function defaultToolbarButtons()    {        return [            'create' => [                'pjax' => false,                'modal' => true,//                'content' => Yii::t('site', 'Create a new'),                'url' => Url::to(['create']),                'cssClass' => 'btn btn-primary btn-flat mr-1 ml-2',                'icon' => 'plus',                'title' => Yii::t('site', 'Create a new'),            ],//             'refresh' => [//                 'url' => Url::current(),//                 'icon' => 'sync,fas',////                 'content' => Yii::t('site', 'Refresh'),//                 'cssClass' => 'btn btn-outline-info btn-flat',//                 'title' => Yii::t('site', 'Refresh'),//             ],        ];    }    public function renderToolbarContent()    {        if ($this->toolbar == false) {            return '';        }        $content = $this->renderToolbarButtons();        if ($this->pagerDropDown) {            $content .= $this->renderPagerDropdown();        }        $this->toolbar = [//            [            'content' => $content,//            ]        ];    }    public function renderToolbarButtons()    {        if (!is_array($this->toolbarButtons)) {            return $this->toolbarButtons;        }        $buttons = [];        $this->toolbarButtons = ArrayHelper::merge($this->defaultToolbarButtons(), $this->toolbarButtons);        foreach ($this->toolbarButtons as $buttonName => $buttonConfig) {            $buttons[$buttonName] = Button::widget($buttonConfig);        }        return TemplateRender::widget([            'template' => $this->toolbarTemplate,            'items' => $buttons,        ]);    }    //</editor-fold>    //<editor-fold desc="Bulk buttons">    public function renderBulkButtons()    {        if (!$this->hasBulkButtons()) {            return false;        }        if (!is_array($this->bulkButtons)) {            $content = $this->bulkButtons;        } else {            $this->bulkButtons = ArrayHelper::merge($this->defaultBulkButtons(), $this->bulkButtons);            $content = BulkButtons::widget([                'template' => $this->bulkButtonsTemplate,                'buttons' => $this->bulkButtons,            ]);        }        $this->panel['after'] = $content;        $this->view->registerAjaxCrudAssets();    }    public function defaultBulkButtons()    {        return [            'delete' => [                "confirmMessage" => Yii::t('site', 'Are you sure to delete all selected items?'),                'content' => Yii::t('site', "Delete"),                'url' => Url::to(['bulkdelete']),                'icon' => 'trash',                'cssClass' => 'btn btn-danger',                'title' => Yii::t('site', 'Delete selected items'),            ],        ];    }    /**     * @return bool     */    public function hasBulkButtons()    {        if (!isset($this->panel['after'])) {            return false;        }        if ($this->bulkButtons === false || $this->bulkButtonsTemplate === false) {            if ($this->panel['after'] == "{bulk-buttons}") {                $this->panel['after'] = false;            }            return false;        }        if ($this->panel['after'] != "{bulk-buttons}") {            return false;        }        return true;    }    //</editor-fold>    public function registerBreakWordsStyles()    {        if ($this->breakWords) {            $css = "            #{$this->getId()} table td {                word-break: break-word;                white-space: normal;                }            ";            $this->view->registerCss($css);        }    }}?>