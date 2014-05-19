<?php
require_once('operator.php');
class PlaceholderManager extends Operator
{
    public function placeholder_lists($content, $page_name, $depth)
    {
        $config = new Config();

        # Order of placeholders is crucial. Eg: By placing body-content at the end of the array,
        # placeholders defined within body-content won't be substituted with their appropriate replacements
        # thus leaving the placeholder as is.

        $all_placeholders = array(
            'templata:app-name' => $config->app_name,
            'template:res' => $depth.'templates/'.$config->active_template,
            'template:css' => $this->unpack_css_files(),
            'page_title' => $page_name,
            'templata:right-click' => $this->right_click_switch($config->right_click),
            'body-content' => $content,
            'base-url' => '<base href="'.get_base_url().'"/>',
            'relative' => $depth,
            'favicon' => $depth.'templates/'.$config->active_template.'/images/favicon/favicon.ico',
            'templata:libs' => $depth.$config->templata_libraries,
            'templata:images' => $depth.$config->templata_images_directory,
            'template:images' => $depth.'templates/'.$config->active_template.'/'.'images',
            'templata:jquery' => $this->get_jquery($depth),
            'validation:contact-form' => $depth.'tools/validation/contact-form.php',
            'navi:desktop' => $this->navigation_menu($depth),
            'navi:mobile' => $this->navigation_menu($depth)
        );

        # Template placeholders
        preg_match_all("/{(template-res:.*?)}/", $content, $template_matches);
        $template_pl = $template_matches[0];
        $template_placeholders = array();

        foreach($template_pl as $placeholder)
        {
            $placeholder = str_replace('{template-res:', '', $placeholder);
            $placeholder = str_replace('}', '', $placeholder);

            $path = $placeholder;
            $path = str_replace(':', '/', $path);

            $template_placeholders[$placeholder] = $path;
        }

        $placeholder_box['all'] = $all_placeholders;
        $placeholder_box['template_res'] = $template_placeholders;

        return $placeholder_box;
    }

    public function templata_placeholders($content, $page_name, $depth)
    {
        $placeholders = $this->placeholder_lists($content, $page_name, $depth);

        //var_dump($placeholders);

        $general_placeholders = $placeholders['all'];
        $template_placeholders = $placeholders['template_res'];

        # Replacing general placeholders
        foreach($general_placeholders as $placeholder=>$replacement)
        {
            $content = str_replace('{'.$placeholder.'}', $replacement, $content);
        }

        # Replacing template placeholders
        foreach($template_placeholders as $placeholder=>$replacement)
        {
            $content = str_replace('{template-res:'.$placeholder.'}', $replacement, $content);
        }

        return $content;
    }

}
