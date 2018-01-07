<?php
/**
 * Cim - A simple invoice manager
 *
 * @author      Sem Schilder <sem@tropical.email>
 * @copyright   (c) Sem Schilder
 * @link        https://github.com/xvilo/customer-invoice-manager
 */

/**
 * Class Cim_Frontend_Service
 */
class Cim_Frontend_Service extends Cim_Frontend
{
    private $returnArray = [
        'success' => true,
        'reason' => '',
        'element' => '',
        'data' => [],
        'errors' => [],
    ];

    /**
     * Cim_Frontend_Service constructor.
     *
     * @param $requestData
     */
    public function __construct($requestData)
    {
        // Get data from main
        parent::__construct($requestData);

        try {
            $pageData = $this->pageData();
            $this->returnArray['data'] = $pageData;
        } catch (UserException $e) {
            $this->returnArray['success'] = false;
            $this->returnArray['reason'] = $e->getMessage();
        }

        die(json_encode($this->returnArray));
    }
}
