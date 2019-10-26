<?php

namespace CL\Grid\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{
    /**
     * @var int
     */
    public $loggerType = Logger::INFO;

    /**
     * Log File name
     * @var string
     */
    public $fileName = '/var/log/custom_catalog.log';
}
