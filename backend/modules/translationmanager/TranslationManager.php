<?phpnamespace backend\modules\translationmanager;use Yii;/** * Translation module definition class * @property-read array $gridColumns */class TranslationManager extends \yii\base\Module{    /**     * @var array Array of languages     */    public $languages = ['uz', 'ru'];    public $grid_column = [];    /**     * @inheritdoc     */    public $controllerNamespace = 'backend\modules\translationmanager\controllers';    /**     * @inheritdoc     */    public function init()    {        parent::init();        if (isset(Yii::$app->params['languages'])) {            $langs = Yii::$app->params['languages'];            if (is_array($langs)) {                $this->languages = array_keys($langs);            }        }        $this->grid_column = $this->getGridColumns();    }    /**     * @return array Return array of column for gridViewWidget     */    public function getGridColumns()    {        $columns = [            [                'attribute' => 'message',                'headerOptions' => ['style' => 'max-width: 100px;'],                'contentOptions' => ['style' => 'max-width: 100px;vertical-align:middle;word-wrap:anywhere;white-space:break-spaces'],            ]        ];        foreach ($this->languages as $one) {            $value = $_GET['SourceMessageSearch']['languages'][$one] ?? '';            $columns[] = [                'label' => Yii::$app->params['languages'][$one],                'value' => 'languages.' . $one,                'format' => 'raw',                'headerOptions' => ['style' => 'max-width: 100px;'],                'contentOptions' => ['style' => 'max-width: 100px;vertical-align:middle;word-wrap:anywhere;white-space:break-spaces'],                'filter' => '<input type="text" value="' . $value . '" class="form-control" name="SourceMessageSearch[languages][' . $one . ']">',            ];        }//        $columns[] = 'created_at:datetime';        $columns[] = [            'class' => 'soft\grid\ActionColumn',            'width' => "150px",            'urls' => [                'delete' => function ($action, $model, $key, $index, $widget) {                    return ['delete',  'id' => $model->id, 'page' => Yii::$app->request->get('page', 1)];                },                'update' => function ($action, $model, $key, $index, $widget) {                    return ['update',  'id' => $model->id, 'page' => Yii::$app->request->get('page', 1)];                },            ],            'dropdown' => false,            'viewOptions' => [                'class' => 'btn btn-sm btn-outline-info',                'role' => 'modal-remote',                'label' => null,            ],            'updateOptions' => [                'class' => 'btn btn-sm btn-outline-success',                'role' => 'modal-remote',                'label' => null,            ],            'deleteOptions' => [                'class' => 'btn btn-sm btn-outline-danger',                'role' => 'modal-remote',                'label' => null,            ],        ];        return $columns;    }}