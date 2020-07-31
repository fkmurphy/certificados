<?php
namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use kartik\mpdf\Pdf;

class Certificado extends Model
{
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
        ];
    }

    /**
     * Exportar certificado
     *
     * @return bool if password was reset.
     */
    public function export()
    {
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
        $content = Yii::$app->controller->renderPartial('_export',[
            'title' => 'Este certificado fue emitido',
            'nombre' => "Pedro Aznar",
            'nameSignerOne' => 'Leandro',
            'nameSignerTwo' => 'Julian',
            'messageDescription' => 'Por participar del curso de',
            'courseName' => 'Corte y confección',
        ]);
        $pdf->WriteHTML($content);
        $pdf->Output();
    }
}
