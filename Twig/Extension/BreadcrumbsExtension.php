<?php

namespace WhiteOctober\BreadcrumbsBundle\Twig\Extension;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Templating\Helper\Helper;

/**
 * Provides an extension for Twig to output breadcrumbs
 *
 */
class BreadcrumbsExtension extends \Twig_Extension
{
    protected $container;
    protected $breadcrumbs;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->breadcrumbs = $container->get("white_october_breadcrumbs");
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return array(
            "wo_breadcrumbs"  => new \Twig_Function_Method($this, "getBreadcrumbs", array("is_safe" => array("html"))),
            "wo_render_breadcrumbs" => new \Twig_Function_Method($this, "renderBreadcrumbs", array("is_safe" => array("html"))),
        );
    }

    /**
     * Returns the breadcrumbs object
     * 
     * @return \WhiteOctober\BreadcrumbsBundle\Model\Breadcrumbs
     */
    public function getBreadcrumbs()
    {
        return $this->breadcrumbs;
    }

    /**
     * Renders the breadcrumbs in a list
     *
     * @return string
     */
    public function renderBreadcrumbs()
    {
        return $this->container->get("white_october_breadcrumbs.helper")->breadcrumbs();
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return "breadcrumbs";
    }
}
