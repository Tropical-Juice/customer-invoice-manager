<?php
/**
 * Cim - A simple invoice manager
 *
 * @author      Sem Schilder <sem@tropical.email>
 * @copyright   (c) Sem Schilder
 * @link        https://github.com/xvilo/customer-invoice-manager
 */

/**
 * Class Cim_Frontend_Page
 */
class Cim_Frontend_Page extends Cim_Frontend
{
    protected $templatePath   = null;
    private $templateFile   = null;
    private $templateDir;

    /**
     * Cim_Frontend_Page constructor.
     *
     * @param $requestData
     */
    public function __construct($requestData)
    {
        parent::__construct($requestData);

        //die(var_dump(debug_backtrace()));

        $this->templateFile = $this->getTemplateFile();
        $this->templateDir = Settings::get('application-dir').'/private/templates/';
        $this->loadTemplate($requestData);
    }

    /**
     * Get's correct template file
     *
     * @return string
     */
    final private function getTemplateFile()
    {
        if ($this->templatePath === null) {
            $className = get_class($this);
            $twigPath = str_replace("Cim_", "", $className);
            $twigPath = str_replace("_", "/", $twigPath);
            $templateFile = $twigPath . ".html.twig";
        } else {
            $templateFile = $this->templatePath . ".html.twig";
        }

        return $templateFile;
    }

    /**
     * Loads template
     *
     * @param $requestData
     */
    final private function loadTemplate($requestData)
    {
        $twigSettings = array();

        $activeTemplate = Settings::get('active-template');
        $loader = new Twig_Loader_Filesystem($this->templateDir.$activeTemplate);

        if (Settings::get('use-cache', true) === true) {
            array_push($twigSettings, ['cache' => Settings::get('application-dir').'/var/cache']);
        }

        $twig = new Twig_Environment($loader, $twigSettings);

        // TODO: Protect this function. Can be accessed and thus exploited by everyone.
        if (Settings::get('development', false) and isset($_GET['context'])) {
            // Context parameter is set. Dump all context data for Twig render and exit.
            echo '<pre>';
            print_r($this->getTwigData($requestData, $this->pageData()));
            echo '<pre>';
            die('<!-- END OF CONTEXT -->');
        }
        echo $twig->render($this->templateFile, $this->getTwigData($requestData, $this->pageData()));
    }

    final private function getTwigData($requestData = [], $pageData = [])
    {
        return [
            'requestData' => $requestData,
            'pageData' => $pageData
        ];
    }
}
