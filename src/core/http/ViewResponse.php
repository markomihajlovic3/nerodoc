<?php

namespace Nero\Core\Http;

/********************************************************************
 * ViewResponse implements the needed functionality for displaying
 * views to the users. It implements the abstract send method for
 * rendering views to the browser.
 ********************************************************************/
class ViewResponse extends Response
{
    private $views = [];


    /**
     * Add a view to the response for rendering
     *
     * @param string $viewName 
     * @param array $data 
     * @return Nero\Core\Http\Response
     */
    public function add($viewName,array $data = [])
    {
        //store the view names and their data for rendering
        $this->views[] = ['name' => $viewName, 'data' => $data];

        //lets return the response object so methods can be chained
        return $this;
    }


    /**
     * Send the response back to the user
     *
     */
    public function send()
    {
        //lets process the views if any are queued for rendering
        if(!empty($this->views)){
            foreach($this->views as $view){
                $this->renderView($view['name'], $view['data']);
            }
        }
    }


    /**
     * Render a view to the page
     *
     * @param string $view 
     * @param array $data
     * @return void
     */
    private function renderView($view, $data = [])
    {
        //lets extract the array keys into variables which can be used in the view
        extract($data);

        //include the view
        require_once("../src/app/views/". $view . ".php");
    }
}
