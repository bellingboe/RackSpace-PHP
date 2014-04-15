<?php

abstract class RS_CloudFilesService extends RS_Service {
    
    public function __construct() {
        parent::__construct();
        
        $service = $this->client->objectStoreService('cloudFiles');
        $this->_setService($service);
    }
    
}