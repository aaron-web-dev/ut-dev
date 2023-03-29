<?php
    include 'classes/backend.php';
    include 'classes/presentation.php';

    $cBackend = new Review\Backend();
    $cPresentation = new Review\Presentation();

    $aData = $cBackend->GetData();

    $sContent = $cPresentation->AddContent( $aData );

    $html = $cPresentation->RenderPage( $sContent );

    echo $html;

?>