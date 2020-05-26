<?php
namespace App\Libraries;
class Make_bread
{
    private $_include_home = 'Dashboard';
    private $_breadcrumb = array();
    private $_divider = '&nbsp;/&nbsp;';
    private $_container_open = '<div id="breadcrumb">';
    private $_container_close = '</div>';
    private $_crumb_open = '';
    private $_crumb_close = '';

    public function __construct()
    {
        if(isset($this->_include_home))
        {
            // we will trim the last '/' just to make sure we are consistent with all servers
            $this->_breadcrumb[] = array('title'=>$this->_include_home, 'href'=>rtrim(base_url(),'/'));
        }
    }

    public function add($title = NULL, $href = '', $segment = FALSE)
    {
        // if the method won't receive the $title parameter, it won't do anything to the $_breadcrumb
        if (is_null($title)) return;
        // first let's find out if we have a $href
        if(isset($href) && strlen($href)>0) {
            // if $segment is not FALSE we will build the URL from the previous crumb
            if ($segment) {
                $previous = $this->_breadcrumb[sizeof($this->_breadcrumb) - 1]['href'];
                $href = $previous . '/' . $href;
            }
            // else if the $href is not an absolute path we compose the URL from our site's URL
            elseif (!filter_var($href, FILTER_VALIDATE_URL))
            {
                $href = site_url($href);
            }
        }
        // add crumb to the end of the breadcrumb
        $this->_breadcrumb[] = array('title' => $title, 'href' => $href);
    }

    public function output()
    {
        // we open the container's tag
        $output = $this->_container_open;
        if(sizeof($this->_breadcrumb) > 0)
        {
            foreach($this->_breadcrumb as $key=>$crumb)
            {
                $output .= $this->_crumb_open;
                if(strlen($crumb['href'])>0)
                {
                    $output .= anchor($crumb['href'],$crumb['title']);
                }
                else
                {
                    $output .= $crumb['title'];
                }
                $output .= $this->_crumb_close;
                // we end the crumb with the divider if is not the last crumb
                if($key < (sizeof($this->_breadcrumb)-1))
                {
                    $output .= $this->_divider;
                }
            }
        }
        // we close the container's tag
        $output .= $this->_container_close;
        return $output;
    }
}