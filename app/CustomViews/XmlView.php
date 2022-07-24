<?php
namespace App\CustomViews;


use App\Core\View\Interfaces\ViewInterface;

class XmlView implements ViewInterface
{

    /**
     * @param array $data
     */
    public function generate(array $data = []) : void
    {
        $xmlData = new \SimpleXMLElement('<?xml version="1.0"?><data></data>');
        $this->arrayToXml($data, $xmlData);

        header("Content-Type: text/xml");
        echo $xmlData->asXML();
    }

    /**
     * @param array $data
     * @param \SimpleXMLElement $xmlData
     */
    protected function arrayToXml(array $data, \SimpleXMLElement &$xmlData) : void
    {
        foreach( $data as $key => $value ) {
            if( is_array($value) ) {
                if( is_numeric($key) ){
                    $key = 'item'.$key;
                }
                $subNode = $xmlData->addChild($key);
                $this->arrayToXml($value, $subNode);
            } else {
                $xmlData->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}