<?php


namespace Saturio\OpcacheManagerBundle\EventListener;


use Saturio\OpcacheManagerBundle\Controller\BaseController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\UriSigner;

class OPCacheListener implements EventSubscriberInterface
{
    private UriSigner $signer;

    public function __construct(UriSigner $signer)
    {
        $this->signer = $signer;
    }

    public function onKernelController(ControllerEvent $event)
    {
        $controller = $event->getController();

        if (is_array($controller)) {
            $controller = $controller[0];
        }

        if (!($controller instanceof BaseController)) {
            return;
        }

        $this->checkRequest($event->getRequest());
        return;
    }


    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::CONTROLLER => 'onKernelController',
        ];
    }

    private function checkRequest(Request $request)
    {
        if (method_exists($this->signer, 'checkRequest')) {
            $signValidation = $this->signer->checkRequest($request);
        } else {
            $qs = ($qs = $request->server->get('QUERY_STRING')) ? '?'.$qs : '';
            $signValidation = $this->signer->check($request->getSchemeAndHttpHost().$request->getBaseUrl().$request->getPathInfo().$qs);
        }

        if ($signValidation) {
            return;
        }

        throw new AccessDeniedHttpException();
    }
}