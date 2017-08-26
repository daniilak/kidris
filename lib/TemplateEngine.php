<?php

class TemplateEngine
{
    private $templateBuffer; 
    private $templateVars = []; 
    public function __construct($templateName)
    {
        if (!is_file('tpl/' . $templateName) || !$this->templateBuffer = file_get_contents('tpl/' . $templateName)) {
            trigger_error("Не могу загрузить шаблон {$templateName}");
        }
    }
    public function connectMenu($ul)
    {
        $menuSections = [
            "starter" => [
                "status" => 0,
                "active" => "",
                "title" => "Моя страница",
                "fa_icon" => "fa-home",
                "scripts" =>'',
                "css" => '',
            ],
            "dash" => [
                "status" => 0,
                "title" => "Мои группы",
                "active" => "",
                "fa_icon" => "fa-th-large",
                "scripts" =>'<script src="../dist/js/pages/dash.js?v=12"></script>',
                "css" => '',
            ],
            "payment" => [
                "status" => 0,
                "title" => "Премиум",
                "active" => "",
                "fa_icon" => "fa-credit-card",
                "scripts" =>'',
                "css" => '',
            ],

            "accounts" => [
                "status" => 0,
                "title" => "Аккаунты",
                "active" => "",
                "fa_icon" => "fa-gear",
                "scripts" =>'',
                "css" => '',
            ],
            "ideas" => [
                "status" => 0,
                "title" => "Есть идея",
                "active" => "",
                "fa_icon" => "fa-lightbulb-o ",
                "scripts" =>'<script src="../dist/js/pages/ideas.js?v=4"></script>',
                "css" => '',
           
            ],
        ];
        $blockMenu = "";
        $models = $GLOBALS['models'];
        $version =  "3.0.0";
        foreach ($menuSections as $key => $section) {
                if ($models == $key) {
                    $section['active']  = "active";
                    $title =  $section['title'];
                    $css =  $section['css'] ;
                    $scripts =  $section['scripts'] ;
                }
                
                $section['url'] = $key;
                
                if ($key == "dash")
                {   
                    if ($models == "dash") {
                        $section['in']  = "in";
                        $section['active']  = "active open";
                    }
                        $section['ul'] = $ul;
                    $blockMenu .= $this->templateLoadInString('block_menu_with_ul.tpl', $section);
                } else
                    $blockMenu .= $this->templateLoadInString('block_menu.tpl', $section) ;
        }
        $this->templateSetVar('block_menu', $blockMenu);
        $this->templateSetVar('title', $title);
        $this->templateSetVar('scripts', $scripts);
        $this->templateSetVar('css', $css);     
        $this->templateSetVar('route', $models);
    }
    public function templateLoadInString($templateName, $vars)
    {
        if (!is_file('tpl/' . $templateName) || !$templateBuffer = file_get_contents('tpl/' . $templateName)) {
            return false;
        } else {
            foreach ($vars as $var => $content) {
                $templateBuffer = str_replace('{' . $var . '}', $content, $templateBuffer);
            }
            return $templateBuffer;
        }
    }
    public function templateLoadSub($subName, $subTag)
    {
        if (!$subBuffer = file_get_contents('tpl/' . $subName)) {
            trigger_error("Ошибка при загрузке шаблона - не могу найти файл {$subName}");
        } else {
            $this->templateBuffer = str_replace('{' . $subTag . '}', $subBuffer, $this->templateBuffer);
        }
    }
    public function templateSetVar($var, $content)
    {
        $this->templateVars[$var] = $content;
    }
   public function templateUnsetVar($var)
    {
        unset($this->templateVars[$var]);
    }
    public function templateCompile()
    {
        foreach ($this->templateVars as $var => $content) {
            $this->templateBuffer = str_replace('{' . $var . '}', $content, $this->templateBuffer);
        }
        $this->templateBuffer = preg_replace('/{(.*)}/', '', $this->templateBuffer);
    }

    public function templateDisplay()
    {
        echo $this->templateBuffer;
    }

}