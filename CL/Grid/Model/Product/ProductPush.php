<?php

namespace CL\Grid\Model\Product;

use CL\Grid\Logger\Logger;
use Magento\Framework\MessageQueue\Bulk\ExchangeRepository;
use Magento\Framework\MessageQueue\EnvelopeFactory;
use Magento\Framework\MessageQueue\MessageEncoder;
use Magento\Framework\MessageQueue\MessageIdGeneratorInterface;
use Magento\Framework\MessageQueue\MessageValidator;
use Magento\Framework\MessageQueue\Publisher\ConfigInterface as PublisherConfig;
use Magento\Framework\MessageQueue\PublisherInterface;

/**
 * Class ProductPush
 * @package CL\Grid\Model\Product
 */
class ProductPush
{
    const TOPIC_NAME = 'customcatalog.push';

    protected $products;
    /**
     * @var Logger
     */
    private $logger;
    /**
     * @var EnvelopeFactory
     */
    private $envelopeFactory;
    /**
     * @var MessageEncoder
     */
    private $messageEncoder;
    /**
     * @var MessageValidator
     */
    private $messageValidator;
    /**
     * @var PublisherConfig
     */
    private $publisherConfig;
    /**
     * @var MessageIdGeneratorInterface
     */
    private $messageIdGenerator;
    /**
     * @var ExchangeRepository
     */
    private $exchangeRepository;
    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * ProductPush constructor.
     * @param PublisherInterface $publisher
     * @param ExchangeRepository $exchangeRepository
     * @param EnvelopeFactory $envelopeFactory
     * @param MessageEncoder $messageEncoder
     * @param MessageValidator $messageValidator
     * @param PublisherConfig $publisherConfig
     * @param MessageIdGeneratorInterface $messageIdGenerator
     * @param Logger $logger
     */
    public function __construct(
        \Magento\Framework\MessageQueue\PublisherInterface $publisher,
        ExchangeRepository $exchangeRepository,
        EnvelopeFactory $envelopeFactory,
        MessageEncoder $messageEncoder,
        MessageValidator $messageValidator,
        PublisherConfig $publisherConfig,
        MessageIdGeneratorInterface $messageIdGenerator,
        Logger $logger
    ) {
        $this->publisher = $publisher;
        $this->logger = $logger;
        $this->envelopeFactory = $envelopeFactory;
        $this->messageEncoder = $messageEncoder;
        $this->messageValidator = $messageValidator;
        $this->publisherConfig = $publisherConfig;
        $this->messageIdGenerator = $messageIdGenerator;
        $this->exchangeRepository = $exchangeRepository;
    }

    /**
     * @param $product
     */
    public function enqueueProduct($product)
    {
        try {
            $productPush = $this->getProductDataBundle($product);

            $this->messageValidator->validate(self::TOPIC_NAME, $productPush);
            $message = $this->messageEncoder->encode(self::TOPIC_NAME, $productPush);
            $envelopes[] = $this->envelopeFactory->create(
                [
                    'body' => $message,
                    'properties' => [
                        'delivery_mode' => 2,
                        'message_id' => $this->messageIdGenerator->generate(self::TOPIC_NAME),
                    ]
                ]
            );
            $publisher = $this->publisherConfig->getPublisher(self::TOPIC_NAME);
            $connectionName = $publisher->getConnection()->getName();
            $exchange = $this->exchangeRepository->getByConnectionName($connectionName);
            $exchange->enqueue(self::TOPIC_NAME, $envelopes);
        } catch (\Exception $e) {
            $this->getLogger()->error($e->getMessage());
        }
    }

    /**
     * @param $product
     * @return string
     */
    public function getProductDataBundle($product)
    {
        $dataBundle = [
            'product' => $product
        ];
        return "[" . json_encode($dataBundle) . "]";
    }

    /**
     * @return Logger
     */
    public function getLogger()
    {
        return $this->logger;
    }
}
