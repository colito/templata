<?php
require_once('operator.php');
class PlaceholderManager extends Operator
{
    public function templata_placeholders($content)
    {
        $templata_placeholders = array(
            'css' => 'libs/css',
            'images' => 'images',
            'app-name' => 'Templata',
            'right-click' => 'RIGHT CLICK',
            'jquery' => 'the jquery path',
            'relative' => 'the relative path',
            'libs' => 'templata_libs',
            'res' => 'resource'
        );

        $general_placeholders = array(
            'body-content' => 'BODY_CONTENT',
            'base-url' => 'BASE_URL',
            'page-title' => 'PAGE_TITLE',
            'relative' => 'RELATIVE',
            'favicon' => 'FAVICON',
            'validation:contact-form' => 'VALIDATION_FORM',
            'navi:desktop' => 'DESKTOP_NAVIGATION',
            'navi:desktop' => 'MOBI_NAVIGATION'
        );

        # Template placeholders
        preg_match_all("/{(template:.*?)}/", $content, $template_matches);
        $template_pl = $template_matches[0];
        $template_placeholders = array();

        foreach($template_pl as $placeholder)
        {
            $placeholder = str_replace('{template:', '', $placeholder);
            $placeholder = str_replace('}', '', $placeholder);

            $path = $placeholder;
            $path = str_replace(':', '/', $path);

            $template_placeholders[$placeholder] = $path;
        }

        # Replacing templata placeholders
        foreach($templata_placeholders as $placeholder=>$replacement)
        {
            $content = str_replace('{templata:'.$placeholder.'}', $replacement, $content);
        }

        # Replacing general placeholders
        foreach($general_placeholders as $placeholder=>$replacement)
        {
            $content = str_replace('{'.$placeholder.'}', $replacement, $content);
        }

        # Replacing template placeholders
        foreach($template_placeholders as $placeholder=>$replacement)
        {
            $content = str_replace('{template:'.$placeholder.'}', $replacement, $content);
        }

        return $content;
    }

}
