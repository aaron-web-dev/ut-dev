<?php
    include 'classes/backend.php';
    include 'classes/presentation.php';

    $cBackend = new Publish\Backend();
    $cPresentation = new Publish\Presentation();

    $aData = $cBackend->GetData();

    $sContent = $cPresentation->AddContent( $aData );

    $html = $cPresentation->RenderPage( $sContent );

    echo $html;
?>