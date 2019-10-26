# Magento2 module to Create Admin Grid and rabbitMQ, Web Api Integration
Magento2 module to Create Admin Grid and rabbitMQ, Web Api Integration
## Manually Installation
Download and copy to directory app/code 
## Install with Composer
    
composer require cl/magento2-create-admin-grid-rabbitmq-webapi
    
## Run following command via terminal from magento root directory 
  
     $ php bin/magento setup:upgrade
     $ php bin/magento setup:di:compile
     $ php bin/magento setup:static-content:deploy
     $ php bin/magento cache:flush

Flush the cache.

now module is properly installed
