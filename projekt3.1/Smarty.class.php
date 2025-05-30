<?php
class Smarty {
    public $template_dir = 'templates/';
    public $compile_dir  = 'templates_c/';
    public $cache_dir    = 'cache/';
    public $config_dir   = 'configs/';
    private $vars = array();
    public function assign($tpl_var, $value) {
        $this->vars[$tpl_var] = $value;
    }
    protected function compile($content) {
        $content = preg_replace('/\{\$(\w+)\|default:\'(.*?)\'\}/', '<?php echo isset($$1)?$$1:\'$2\'; ?>', $content);
        $content = preg_replace('/\{\$(\w+)\|default:"(.*?)"\}/', '<?php echo isset($$1)?$$1:"$2"; ?>', $content);
        $content = preg_replace('/\{\$(\w+)\}/', '<?php echo $$1; ?>', $content);
        $content = preg_replace('/\{if\s+(.*?)\}/', '<?php if($1): ?>', $content);
        $content = preg_replace('/\{\/if\}/', '<?php endif; ?>', $content);
        $content = preg_replace('/\{foreach\s+from=\$(\w+)\s+item=(\w+)\}/', '<?php foreach($$1 as $$2): ?>', $content);
        $content = preg_replace('/\{\/foreach\}/', '<?php endforeach; ?>', $content);
        return $content;
    }
    public function display($template) {
        $template_path = $this->template_dir . $template;
        if (!file_exists($template_path)) {
            die("Template file not found: " . $template_path);
        }
        extract($this->vars);
        $content = file_get_contents($template_path);
        $compiled = $this->compile($content);
        eval('?>' . $compiled);
    }
    public function fetch($template) {
        $template_path = $this->template_dir . $template;
        if (!file_exists($template_path)) {
            die("Template file not found: " . $template_path);
        }
        extract($this->vars);
        $content = file_get_contents($template_path);
        $compiled = $this->compile($content);
        ob_start();
        eval('?>' . $compiled);
        return ob_get_clean();
    }
}
?>
