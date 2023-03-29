<?php
    namespace Review;

    class Presentation
    {
        /**
         * Builds the content string for page presentation
         */
        public function AddContent( $aData )
        {
            $sContent = '';

            $sCaseTable = $this->BuildCaseTable( $aData );

            $sContent = $sContent . $sCaseTable;

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
         * Builds case table using case data passed from backend
         *
         * @return string html for case table
         */
        protected function BuildCaseTable( $aData )
        {
            $sTable = '';

            if( !empty( $aData[ 'cases' ] ) )
            {
                $sTable = file_get_contents( 'templates/case-table.html');
                $sRows = $this->BuildCaseRows( $aData[ 'cases' ] );

                $sTable = str_replace( '_:_ROWS_:_', $sRows, $sTable);
            }

            return $sTable;
        }

        /**
         * Creates row per case for case table
         *
         * @return string html for rows
         */
        protected function BuildCaseRows( $aCases )
        {
            $sRows = '';
            foreach( $aCases as $aCase)
            {

                $sRow = file_get_contents( 'templates/case-table-row.html' );
                $aReplace = array(
                    '_:_CASE-NUM_:_'    => $aCase[ 'case-id' ],
                    '_:_AUTHOR_:_'      => $aCase[ 'author' ],
                    '_:_TITLE_:_'       => $aCase[ 'title' ],
                    '_:_FILE_:_'        => $aCase[ 'user-file' ],
                    '_:_LAST-UPDATE_:_' => $aCase[ 'last-update' ],
                    '_:_STATUS_:_'      => ucwords( $aCase[ 'status' ] )
                );

                $sRow = str_replace( array_keys( $aReplace ), array_values( $aReplace), $sRow );

                $sRows = $sRows . $sRow;
            }

            return $sRows;
        }
    }
?>