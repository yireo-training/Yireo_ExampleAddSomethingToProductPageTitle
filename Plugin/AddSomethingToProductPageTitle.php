<?php declare(strict_types=1);

namespace Yireo\ExampleAddSomethingToProductPageTitle\Plugin;

use Magento\Catalog\Controller\Product\View as ProductViewController;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\View\Page\Config;

class AddSomethingToProductPageTitle
{
    /**
     * @var LayoutInterface
     */
    private $layout;
    /**
     * @var Config
     */
    private $pageConfig;

    /**
     * AddSomethingToProductPageTitle constructor.
     * @param LayoutInterface $layout
     * @param Config $pageConfig
     */
    public function __construct(
        LayoutInterface $layout,
        Config $pageConfig
    ) {
        $this->layout = $layout;
        $this->pageConfig = $pageConfig;
    }

    /**
     * @param ProductViewController $productViewController
     * @param ResultInterface $result
     * @return ResultInterface
     */
    public function afterExecute(ProductViewController $productViewController, ResultInterface $result): ResultInterface
    {
        $prefix = $this->getPrefix();
        $pageTitle = $this->pageConfig->getTitle();
        $pageTitle->set($prefix . $pageTitle->get());

        $headerBlock = $this->layout->getBlock('page.main.title');
        if ($headerBlock) {
            $headerBlock->setPageTitle($prefix . $headerBlock->getPageTitle());
        }

        return $result;
    }

    /**
     * @return string
     */
    private function getPrefix(): string
    {
        return 'Foobar - ';
    }
}
