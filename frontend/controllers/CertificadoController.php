<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use frontend\models\PasswordResetRequestForm;
use kartik\mpdf\Pdf;

/**
 * Certificado controller
 */
class CertificadoController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionGenerate()
    {
        if (Yii::$app->request->post()){//&& $model->login()) {
            $defaultConfig = (new \Mpdf\Config\ConfigVariables())->getDefaults();
            $fontDirs = $defaultConfig['fontDir'];
            $defaultFontConfig = (new \Mpdf\Config\FontVariables())->getDefaults();
            $fontData = $defaultFontConfig['fontdata'];
            $pdf = new \Mpdf\Mpdf([
                'utf-8',
                'A4',
                'tempDir' => '/tmp/',
                'fontDir' => array_merge($fontDirs,['fonts']),
                'fontdata' => array_merge($fontData,[
                    'italianno' => [
                        'R' => 'Italianno-Regular.ttf'
                    ]
                ]),
            ]);
            $pdf->SetDisplayMode('fullpage');
            $stylesheet = file_get_contents('css/estilo-pdf.css');
            $pdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
            $pdf->AddPage('L','','','','',25,25,25,25,5,5);
            $content = $this->renderPartial('_export',[
                'title' => 'Este certificado fue emitido',
                'nombre' => "Pedro Aznar"
            ]);
            $pdf->WriteHTML($content);
            $pdf->Output();
        } else {
            return $this->render('generate');
        }
    }
}
