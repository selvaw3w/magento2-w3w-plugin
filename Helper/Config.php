<?php
/**
 * What3Words_What3Words
 *
 * @category    WorkInProgress
 * @copyright   Copyright (c) 2020 What3Words
 * @author      Vlad Patru <vlad@wearewip.com>
 * @link        http://www.what3words.com
 */
namespace What3Words\What3Words\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Framework\App\Helper\Context;
use \Magento\Framework\Encryption\EncryptorInterface;

/**
 * Class Config
 * Helper to return admin settings values
 */
class Config extends AbstractHelper
{
    const PREFIX = 'what3words/';

    /** @var EncryptorInterface */
    protected $encryptor;

    /**
     * Config constructor.
     * @param Context $context
     * @param EncryptorInterface $encryptor
     */
    public function __construct(
        Context $context,
        EncryptorInterface $encryptor
    ) {
        parent::__construct($context);
        $this->encryptor = $encryptor;
    }

    /**
     * @param $area
     * @return mixed
     */
    public function getConfig($area)
    {
        return $this->scopeConfig->getValue(self::PREFIX . $area);
    }

    /**
     * @return bool
     */
    public function getIsEnabled()
    {
        return $this->getConfig('general/enabled');
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        $key = $this->getConfig('general/api_key');
        return $this->encryptor->decrypt($key);
    }

    /**
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->getConfig('frontend/placeholder');
    }

    /**
     * @return string
     */
    public function getIconColor()
    {
        return $this->getConfig('frontend/icon_color');
    }
}
