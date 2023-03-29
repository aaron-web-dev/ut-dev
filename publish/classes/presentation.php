<?php
    namespace Publish;

    class Presentation
    {
        /**
         * Builds the content string for page presentation
         */
        public function AddContent( $aData )
        {
            $sContent = '';

            //Adds the form content
            $sContent = $sContent . file_get_contents( 'templates/submit-form.html' );

            //Adds the submission table if data is present
            if(!empty( $aData[ 'form' ] ) )
            {
                $sTable = $this->BuildTable( $aData );

                $sContent = $sContent . $sTable;
            }

            return $sContent;
        }

        /**
         * Creates html page and fills body
         *
         * @return string the page html
         */
        public function RenderPage( $sContent )
        {
            $html = file_get_contents( 'templates/page.html' );
            $html = str_replace( '_:_CONTENT_:_', $sContent, $html );

            return $html;
        }

        /**
         * Builds the table
         *
         * @return string the html table
         */
        protected function BuildTable( $aData )
        {
            $sTable = file_get_contents('templates/submission-table.html');
            $sRows = file_get_contents('templates/submission-table-row.html');

            $aRows = array(
                '_:_SUBMISSION-NUM_:_' => '',
                '_:_TITLE_:_' => $aData[ 'form' ][ 'title' ],
                '_:_FILE_:_' => $aData[ 'files' ][ 'formFile' ][ 'name' ],
                '_:_LAST-UPDATE_:_' => $aData[ 'form' ][ 'last-update' ],
                '_:_STATUS_:_' => 'Open',
            );

            $sRows = str_replace( array_keys( $aRows ), array_values( $aRows ), $sRows );

            $sTable = str_replace( '_:_ROWS_:_', $sRows, $sTable );

            return $sTable;
        }
    }
?>