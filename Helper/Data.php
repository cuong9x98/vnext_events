<?php
namespace AHT\CustomerChecker\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;
use Magento\Sales\Model\OrderFactory;
use Magento\Sales\Model\ResourceModel\Order\Invoice\CollectionFactory;


class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    protected $_customerSession;
    protected $_type;
    protected $_fullModuleList;
    protected $_session;
    protected $_orderFactory;
    protected $_customer;

    protected $resourceConnection;

    public function __construct(
       

        \Magento\Framework\App\ResourceConnection $resourceConnection
    ) {
       

        $this->resourceConnection = $resourceConnection;
    }
    
    public function runSqlQuery($name)
    {
        $connection = $this->resourceConnection->getConnection();
        // $table is table name
        $table = $connection->getTableName($name);
        //For Select query
        $query = "Select COUNT(*) FROM " . $table;
        
        $result = $connection->fetchAll($query);
        
        return $result[0]['COUNT(*)'];
    }

}