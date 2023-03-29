<?php
    namespace Publish;

    class Backend
    {
        /**
         * Data for site
         */
        public array $aData = array();

        /**
         * Returns data for presentaion
         *
         */
        public function GetData()
        {
            $aData[ 'form' ] = $this->IsFormSubmitted();

            if( !empty( $_FILES ) )
            {
                $aData[ 'files' ] = $_FILES;
            }

            return $aData;
        }

        /**
         * Checks to see if the form has been submitted and adds page content as necessary
         *
         *
         */
        public function IsFormSubmitted()
        {
            $aFormData = array();

            if ( !empty( $_POST[ 'submission' ] ) && $_POST[ 'submission' ] == 1 )
            {
                $aFormData[ 'filename' ] = $_FILES[ 'formFile' ][ 'name' ];
                $aFormData[ 'title' ] = $_POST[ 'title' ];
                $aFormData[ 'last-update' ] = date('Y-m-d H:i'); // Currently defaults to GMT, local time will need to be set elsewhere
            }

            return $aFormData;
        }
    }
?>