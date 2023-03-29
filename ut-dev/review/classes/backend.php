<?php
    namespace Review;

    class Backend
    {
        public function GetData()
        {
            $aData = array();

            //Using dummy data currently, production would require database access
            $aData[ 'cases' ] = $this->aCases;

            $aData[ 'form' ] = $this->IsFormSubmitted();

            if( !empty( $aData[ 'form'] ) )
            {
                $aData[ 'cases' ] = $this->UpdateCase( $aData[ 'cases' ], $aData[ 'form' ] );
            }

            return $aData;
        }

        protected function IsFormSubmitted()
        {
            $aFormData = array();

            if ( !empty( $_POST[ 'review' ] ) )
            {
                //In a production environment there would be validation to ensure the case number is an existing case number
                $aFormData[ 'case' ] = $_POST[ 'review' ];
                $aFormData[ 'action' ] = $_POST[ 'action' ];
            }

            return $aFormData;
        }

        /**
         * Updates the case array with selected decision
         *
         *
         */
        protected function UpdateCase( $aCases, $aFormData )
        {
            $aCase = $aFormData[ 'case' ];
            $aCases[ $aCase ][ 'status' ] = $aFormData[ 'action' ];
            $aCases[ $aCase ][ 'last-update' ] = date('Y-m-d H:i');

            return $aCases;
        }

        //The following array is 'dummy' data used for demonstration purposes
        public array $aCases = array(
            '92493' => array(
                'case-id' => '92493',
                'author' => 'dsmith',
                'title' => 'Planning and Assessing Patron Experience and Needs for an Academic Library Website',
                'user-file' => 'file.txt',
                'last-update' => '',
                'status' => 'open',
            ),
            '42682' => array(
                'case-id' => '42682',
                'author' => 'hjackson',
                'title' => 'Changes in reading behaviour of periodicals on mobile devices',
                'user-file' => 'file.txt',
                'last-update' => '',
                'status' => 'open',
            ),
            '73467' => array(
                'case-id' => '73467',
                'author' => 'aprice',
                'title' => 'Assessment of an Academic Library\'s Late-Night Service to Patrons',
                'user-file' => 'file.txt',
                'last-update' => '',
                'status' => 'open',
            ),
            '61764' => array(
                'case-id' => '61764',
                'author' => 'mmcentire',
                'title' => 'Accessibility of academic library web sites in North America',
                'user-file' => 'file.txt',
                'last-update' => '',
                'status' => 'open',
            ),
        );
    }
?>
