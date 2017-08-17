<?php
namespace base;
Class View{
    protected $template, $vars;
    
    public function __construct($template, $vars=[]) {
        $this->template = $template;
        $this->vars = $vars;
    }
    
    public function render(){
        try {

            if (file_exists($this->template)) {
                extract($this->vars);
                ob_start();
                include $this->template;
                $rendered = ob_get_contents();
                @ob_end_clean();
                return $rendered;
            }
            
        } catch (Exception $err) {
            echo $err->getTraceAsString();
        }
    }
}
