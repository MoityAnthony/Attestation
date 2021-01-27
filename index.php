<?php
require_once 'htdocs/vendor/autoload.php';


// Creating the new document...
$phpWord = new \PhpOffice\PhpWord\PhpWord();

/* 
test PHP WORD
*/

// on se met en UTF8
header('Content-Type: text/html; charset=utf-8');

//affichage des erreurs PHP
error_reporting(E_ALL);


// VARIABLES :

(string)$Date = date('d/m/Y');;
(string)$Heure = date('H:i');
(string)$DateFile = date('d-m-Y');
(string)$HeureFile = date('H-i');
(string)$newfile = 'htdocs/attestation-'.$DateFile.'-'.$HeureFile.'.docx';
(string)$newfilePDF = 'htdocs/attestation-'.$DateFile.'-'.$HeureFile.'.pdf';
(string)$newfile2 = 'htdocs/attestation2-'.$DateFile.'-'.$HeureFile.'.docx';
(string)$newfilePDF2 = 'htdocs/attestation2-'.$DateFile.'-'.$HeureFile.'.pdf';

if(isset($_POST["Valider"])){
        WordAttestation($Date,$Heure,$newfile);
        PDFAttestation($newfile,$newfilePDF);
        WordAttestation2($Date,$Heure,$newfile2);
        PDFAttestation2($newfile2,$newfilePDF2);
}

function WordAttestation($Date,$Heure,$newfile){

        $fileName = 'htdocs/attestation.docx';

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($fileName);
    
        $templateProcessor->setValue('Date', $Date);
        $templateProcessor->setValue('Heure', $Heure);
    
    
        $templateProcessor->saveAs($newfile);

        
}
function WordAttestation2($Date,$Heure,$newfile2){

    $fileName2 = 'htdocs/attestation2.docx';
    
    $templateProcessor2 = new \PhpOffice\PhpWord\TemplateProcessor($fileName2);

    $templateProcessor2->setValue('Date', $Date);
    $templateProcessor2->setValue('Heure', $Heure);


    $templateProcessor2->saveAs($newfile2);
} 

function PDFAttestation($newfile,$newfilePDF)
{

    $objReader= \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
    $contents=$objReader->load($newfile);

    $rendername= \PhpOffice\PhpWord\Settings::PDF_RENDERER_TCPDF;

    $renderLibrary="htdocs/TCPDF";
    $renderLibraryPath=''.$renderLibrary;
    if(!\PhpOffice\PhpWord\Settings::setPdfRenderer($rendername,$renderLibrary)){
        die("Provide Render Library And Path");
        echo($renderLibraryPath);
    }
    $renderLibraryPath=''.$renderLibrary;
    $objWriter= \PhpOffice\PhpWord\IOFactory::createWriter($contents,'PDF');
    $objWriter->save($newfilePDF);
    
}

function PDFAttestation2($newfile2,$newfilePDF2)
{
    $objReader= \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
    $contents=$objReader->load($newfile2);

    $rendername= \PhpOffice\PhpWord\Settings::PDF_RENDERER_TCPDF;

    $renderLibrary="htdocs/TCPDF";
    $renderLibraryPath=''.$renderLibrary;
    if(!\PhpOffice\PhpWord\Settings::setPdfRenderer($rendername,$renderLibrary)){
        die("Provide Render Library And Path");
        echo($renderLibraryPath);
    }
    $renderLibraryPath=''.$renderLibrary;
    $objWriter= \PhpOffice\PhpWord\IOFactory::createWriter($contents,'PDF');
    $objWriter->save($newfilePDF2);

}



//---------------------------------------------//
// Cr?ion du document WORD :
//---------------------------------------------//

?>
<style>
    form{
        width: 200px;
        height: 100%;
        margin: auto;
    }
    input{
        width: 100%;
        margin: 50% auto;
        background-color: cornflowerblue;
        border: none;
        height: 10%;
        font-size: 21px;
        color: white;
        font-family: Helvetica;
        font-weight: 600;
        letter-spacing: 1px;
        border: 1px solid cornflowerblue;
        border-radius: 60px;
    }
    @media (max-width: 769px){
        form{
            width: 100%;
            height: 100%;
            margin: auto;
        }
        input{
        width: 100%;
        margin: 50% auto;
        background-color: cornflowerblue;
        border: none;
        height: 10%;
        font-size: 21px;
        color: white;
        font-family: Helvetica;
        font-weight: 600;
        letter-spacing: 1px;
        border: 1px solid cornflowerblue;
        border-radius: 60px;
    }
    }

</style>

<form method="post">
    <input type="submit" value="Valider" name="Valider"></input>
</form>

