<?php

/*
 * This file is part of the GoogleAnalyticsBundle package.
 *
 * (c) Leblanc Simon <https://www.leblanc-simon.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LeblancSimon\GoogleAnalyticsBundle\Injector;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class GoogleAnalyticsTemplate
{
    /**
     * @var TwigEngine
     */
    private $templating;

    /**
     * @var string
     */
    private $template_name;

    /**
     * @var string
     */
    private $id;

    /**
     * GoogleAnalyticsTemplate constructor.
     *
     * @param TwigEngine $templating
     * @param string $template_name
     * @param string $id
     */
    public function __construct(TwigEngine $templating, $template_name, $id)
    {
        $this->templating = $templating;
        $this->template_name = $template_name;
        $this->id = $id;
    }

    /**
     * Inject in the response the google analytics template
     *
     * @param Response $response
     * @param Request $request
     */
    public function inject(Response $response, Request $request)
    {
        if ($this->checkIfMustBeInjected($response, $request) === false) {
            return;
        }

        $render_template = $this->templating->render($this->template_name, [
            'id' => $this->id,
        ]);

        $content = $response->getContent();
        $position = mb_strripos($content, '</head>');
        if (false !== $position) {
            $content = mb_substr($content, 0, $position).$render_template.mb_substr($content, $position);
            $response->setContent($content);
        }
    }

    /**
     * Check if we must inject the google analytics template
     *
     * @param Response $response
     * @param Request $request
     * @return bool
     */
    private function checkIfMustBeInjected(Response $response, Request $request)
    {
        if (true === empty($this->id)) {
            return false;
        }

        if (false === strpos($response->headers->get('Content-Type'), 'text/html')) {
            return false;
        }

        return true;
    }
}
