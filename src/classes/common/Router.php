<?php

namespace common;

class Router
{
    private $presenters;
    private $actions;

    public function setPresenters($presenters)
    {
        $this->presenters = $presenters;
        return $this;
    }

    public function setActions($actions)
    {
        $this->actions = $actions;
        return $this;
    }

    public function start()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'POST':
                if (!empty($_REQUEST['action'])) {
                    $request = $_REQUEST['action'];
                    foreach ($this->actions as $a) {
                        if ($this->parseAction($a, $request)) {
                            return;
                        }
                    }
                }
                \utils\HTTP::pageNotFound();
                break;

            case 'GET':
                $request = \utils\HTTP::getRequest();
                foreach ($this->presenters as $p) {
                    if ($this->parsePresenter($p, $request)) {
                        return;
                    }
                }
                \utils\HTTP::pageNotFound();
                break;

            default:
                \utils\HTTP::status(405);
        }
    }

    private function parseAction(Action &$action, $request)
    {
        if ($action->getName() == $request) {
            $action->init();
            $action->execute();
            return true;
        } else {
            return false;
        }
    }

    private function parsePresenter(Presenter &$presenter, $request)
    {
        if (preg_match($presenter->getPattern(), $request, $matches)) {
            $presenter->setParams($matches);
            $presenter->init();
            return true;
        } else {
            return false;
        }
    }
}
