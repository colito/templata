<?php
require_once('operator.php');
class PlaceholderManager extends Operator
{
    # Finds placeholders within the specified source
    public function seek_placeholders($template, $reference, $depth)
    {
        @$template_name = $template['name'];
        @$source = $template['source_code'];

        if(strpos($reference, 'template') !== false)
            $preceding_path = $depth.'templates/'.$template_name.'/';
        else if(strpos($reference, 'templata') !== false)
            $preceding_path = $depth;
        else
            return false;

        preg_match_all("/{(".$reference.".*?)}/", $source, $reference_matches);
        $referenced_placeholders = $reference_matches[0];

        $placeholders_found = array();

        foreach($referenced_placeholders as $placeholder)
        {
            if(!empty($placeholder))
            {
                $placeholder = str_replace('{'.$reference, '', $placeholder);
                $placeholder = str_replace('}', '', $placeholder);

                $path = $placeholder;
                $path = str_replace(':', '/', $path);

                $placeholders_found[$placeholder] = $preceding_path.$path;
            }
        }

        return $placeholders_found;
    }

    public function placeholder_lists($template, $content, $page_name, $header_files, $depth)
    {
        $config = TConfig();
        $template_name = $template['name'];

        # Order of placeholders is crucial. Eg: By placing body-content at the end of the array,
        # placeholders defined within body-content won't be substituted with their appropriate replacements
        # thus leaving the placeholder as is.

        $all_placeholders = array(
            'templata:app-name' => $config->app_name,
            'app-name' => $config->app_name,
            'template:res' => $depth.'templates/'.$template_name,
            'template-fs' => $depth.'templates/'.$template_name,
            'template:css' => $this->unpack_css_files(),
            'page-title' => $page_name,
            'header-files' => $this->unpack_header_resources($header_files),
            'templata:right-click' => $this->right_click_switch($config->right_click),
            'body-content' => $content,
            'base-url' => '<base href="'.get_base_url().'"/>',
            'relative' => $depth,
            'favicon' => $depth.'templates/'.$template['name'].'/images/favicon/favicon.ico',
            'template-favicon' => $depth.'templates/'.$template['name'].'/images/favicon/favicon.ico',
            'templata:libs' => $depth.$config->templata_libraries,
            'libs' => $depth.$config->templata_libraries,
            'templata:images' => $depth.$config->templata_images_directory,
            'template:images' => $depth.'templates/'.$template_name.'/'.'images',
            'templata:jquery' => $this->get_jquery($depth),
            'validation:contact-form' => $depth.'tools/validation/contact-form.php',
            'navi:desktop' => $this->navigation_menu($depth),
            'navi:mobile' => $this->navigation_menu($depth)
        );

        $template_placeholders = array();

        # Template placeholders
        $template_placeholders[] = $this->seek_placeholders($template, 'template-res:', $depth);
        $template_placeholders[] = $this->seek_placeholders($content, 'template-res:', $depth);

        # Templata placeholders
        $templata_placeholders[] = $this->seek_placeholders($template['source_code'], 'templata-res:', $depth);
        $templata_placeholders[] = $this->seek_placeholders($content, 'templata-res:', $depth);

        # Boxing all placeholders within a single array
        $placeholder_box['all'] = $all_placeholders;
        $placeholder_box['templata_res'] = $templata_placeholders;
        $placeholder_box['template_res'] = $template_placeholders;

        return $placeholder_box;
    }

    public function replace_placeholders($template, $content, $page_name, $header_files, $depth)
    {
        $placeholders = $this->placeholder_lists($template, $content, $page_name, $header_files, $depth);

        $general_placeholders = $placeholders['all'];
        $templata_placeholders = $placeholders['templata_res'];
        $template_placeholders = $placeholders['template_res'];

        $page_result = $template['source_code'];

        # Replacing general placeholders
        foreach($general_placeholders as $placeholder=>$replacement)
        {
            $page_result = str_replace('{'.$placeholder.'}', $replacement, $page_result);
        }

        # Replacing template and content path placeholders
        foreach($template_placeholders as $one)
        {
            foreach($one as $placeholder=>$replacement)
            {
                $page_result = str_replace('{template-res:'.$placeholder.'}', $replacement, $page_result);
            }
        }

        # Replacing templata placeholders
        foreach($templata_placeholders as $one)
        {
            foreach($one as $placeholder=>$replacement)
            {
                $page_result = str_replace('{templata-res:'.$placeholder.'}', $replacement, $page_result);
            }
        }

        return $page_result;
    }
}
