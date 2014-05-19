<?php
require_once('operator.php');
class PlaceholderManager extends Operator
{
    # Finds placeholders within the specified source
    public function seek_placeholders($source, $reference)
    {
        preg_match_all("/{(".$reference.".*?)}/", $source, $reference_matches);
        $referenced_placeholders = $reference_matches[0];

        $placeholders_found = array();

        foreach($referenced_placeholders as $placeholder)
        {
            $placeholder = str_replace('{template-res:', '', $placeholder);
            $placeholder = str_replace('}', '', $placeholder);

            $path = $placeholder;
            $path = str_replace(':', '/', $path);

            $placeholders_found[$placeholder] = $path;
        }

        return $placeholders_found;
    }

    public function placeholder_lists($template, $content, $page_name, $depth)
    {
        $config = new Config();

        # Order of placeholders is crucial. Eg: By placing body-content at the end of the array,
        # placeholders defined within body-content won't be substituted with their appropriate replacements
        # thus leaving the placeholder as is.

        $all_placeholders = array(
            'templata:app-name' => $config->app_name,
            'template:res' => $depth.'templates/'.$config->active_template,
            'template:css' => $this->unpack_css_files(),
            'page-title' => $page_name,
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

        $template_placeholders = array();

        # Template placeholders (from template)
        preg_match_all("/{(template-res:.*?)}/", $template, $template_matches);
        $template_body = $template_matches[0];

        foreach($template_body as $placeholder)
        {
            $placeholder = str_replace('{template-res:', '', $placeholder);
            $placeholder = str_replace('}', '', $placeholder);

            $path = $placeholder;
            $path = str_replace(':', '/', $path);

            $template_placeholders[$placeholder] = $depth.'templates/'.$config->active_template.'/'.$path;
        }

        # Template placeholders (from body content)
        preg_match_all("/{(template-res:.*?)}/", $content, $template_matches);
        $body_pl = $template_matches[0];

        foreach($body_pl as $placeholder)
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

    public function replace_placeholders($template, $content, $page_name, $depth)
    {
        $placeholders = $this->placeholder_lists($template, $content, $page_name, $depth);

        $general_placeholders = $placeholders['all'];
        $template_placeholders = $placeholders['template_res'];

        $page_result = $template;

        # Replacing general placeholders
        foreach($general_placeholders as $placeholder=>$replacement)
        {
            $page_result = str_replace('{'.$placeholder.'}', $replacement, $page_result);
        }

        # Replacing template placeholders
        foreach($template_placeholders as $placeholder=>$replacement)
        {
            $page_result = str_replace('{template-res:'.$placeholder.'}', $replacement, $page_result);
        }

        return $page_result;
    }

}
