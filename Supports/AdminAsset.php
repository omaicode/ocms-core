<?php
namespace Modules\Core\Supports;

use Illuminate\Support\Str;

class AdminAsset
{
    protected $scripts = [];
    protected $custom_scripts = [];
    protected $styles = [];
    protected $pushs = [];

    /**
     * Add scripts
     * 
     * @param string $name 
     * @param string $url 
     * @return $this 
     */
    public function addScript(string $name, string $url)
    {
        $this->scripts[] = ['name' => $name, 'url' => $url];

        return $this;
    }

    /**
     * Remove script
     * 
     * @param string $name 
     * @return $this 
     */
    public function removeScript(string $name)
    {
        if(isset($this->scripts[$name])) {
            unset($this->scripts[$name]);
        }

        return $this;
    }

    /**
     * Add style
     * 
     * @param string $name 
     * @param string $url 
     * @return $this 
     */
    public function addStyle(string $name, string $url)
    {
        $this->styles[] = ['name' => $name, 'url' => $url];

        return $this;
    }

    /**
     * Remove style
     * 
     * @param string $name 
     * @return $this 
     */
    public function removeStyle(string $name)
    {
        if(isset($this->styles[$name])) {
            unset($this->styles[$name]);
        }

        return $this;
    }

    /**
     * Render scripts
     * 
     * @return string 
     */
    public function renderScripts()
    {   
        $html  = '';
        foreach($this->scripts as $script) {
            $html .= <<<SCRIPT
            <script src="{$script['url']}"></script>
            SCRIPT;
        }

        return $html;
    }
    /**
     * Render custom scripts
     * 
     * @return string 
     */
    public function renderCustomScripts()
    {   
        $html  = '';
        foreach($this->custom_scripts as $script) {
            $html .= <<<SCRIPT
            <script>{$script}</script>
            SCRIPT;
        }

        return $html;
    }

    /**
     * Render styles
     * 
     * @return string 
     */
    public function renderStyles()
    {   
        $html  = '';
        foreach($this->styles as $style) {
            $html .= <<<STYLE
            <link rel='stylesheet' type='text/css' href='{$style['url']}'/>
            STYLE;
        }

        return $html;
    }

    /**
     * Add assets by groups
     * 
     * @param array $groups 
     * @return $this 
     */
    public function addByGroups(array $groups)
    {
        if(array_key_exists('js', $groups)) {
            foreach($groups['js'] as $key => $path) {
                $this->addScript(
                    is_numeric($key) ? substr((string)Str::uuid(), 0, 8) : $key,
                    asset($path)
                );
            }
        }

        if(array_key_exists('css', $groups)) {
            foreach($groups['css'] as $key => $path) {
                $this->addStyle(
                    is_numeric($key) ? substr((string)Str::uuid(), 0, 8) : $key,
                    asset($path)
                );
            }
        }

        return $this;
    }

    /**
     * Add custom script
     * @param string $script 
     * @return void 
     */
    public function addCustomScript(string $script)
    {
        if(blank($script)) {
            return;
        }

        $this->custom_scripts[] = $script;

        return $this;
    }

    public function push($name, $content)
    {
        $this->pushs[$name] = $content;

        return $this;
    }

    public function getPushs()
    {
        return $this->pushs;
    }
}