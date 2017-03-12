<?php

/*
 * This file is part of the GoogleAnalyticsBundle package.
 *
 * (c) Leblanc Simon <https://www.leblanc-simon.fr/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LeblancSimon\GoogleAnalyticsBundle\EventSubscriber;

use LeblancSimon\GoogleAnalyticsBundle\Injector\GoogleAnalyticsTemplate;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\KernelEvents;

class GoogleAnalyticsSubscriber implements EventSubscriberInterface
{
    /**
     * @var GoogleAnalyticsTemplate
     */
    private $injector;

    /**
     * GoogleAnalyticsBundleSubscriber constructor.
     *
     * @param GoogleAnalyticsTemplate $template_injector
     */
    public function __construct(GoogleAnalyticsTemplate $template_injector)
    {
        $this->injector = $template_injector;
    }

    /**
     * {@inheritdoc}
     */
    static public function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => ['onKernelResponse', -128],
        ];
    }

    /**
     * Inject the google analytics script
     *
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        if (HttpKernelInterface::MASTER_REQUEST !== $event->getRequestType()) {
            return;
        }

        $this->injector->inject($event->getResponse(), $event->getRequest());
    }
}
