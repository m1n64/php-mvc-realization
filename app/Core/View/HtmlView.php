<?php
namespace App\Core\View;


use App\Core\View\Interfaces\ViewInterface;

class HtmlView implements ViewInterface
{
    protected const VIEWS_PATH = 'app/Views/';

    /**
     * @param string $contentView
     * @param array|null $data
     * @param string $templateView
     */
    public function generate(string $contentView, array $data = null, string $templateView = "template_view") : void
    {
        if (!is_null($data)) {
            extract($data);
        }

        $contentView = str_replace(".", "/", $contentView);

        include self::VIEWS_PATH.$templateView.".php";
    }
}