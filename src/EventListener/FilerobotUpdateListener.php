<?php

namespace Scaleflex\SyliusFilerobotPlugin\EventListener;

use GuzzleHttp\Exception\ClientException;
use Scaleflex\SyliusFilerobotPlugin\Model\Filerobot;
use Sylius\Bundle\ResourceBundle\Event\ResourceControllerEvent;
use GuzzleHttp\Client;
use Symfony\Contracts\Translation\TranslatorInterface;

final class FilerobotUpdateListener
{
    public function __construct(
        private Client $httpClient,
        private TranslatorInterface $translator
    ) {}

    public function onFilerobotUpdate(ResourceControllerEvent $event)
    {
        /** @var Filerobot $filerobotConfig */
        $filerobotConfig = $event->getSubject();

        if (!empty($filerobotConfig->getToken()) &&
            !empty($filerobotConfig->getTemplateId())) {
            try {
                $this->httpClient->request(
                    'GET',
                    'https://api.filerobot.com/' . $filerobotConfig->getToken() . '/key/' . $filerobotConfig->getTemplateId()
                );
            } catch (ClientException $exception) {
                $filerobotConfig->setStatus(false);
                $event->stop($this->translator->trans('scaleflex_sylius_filerobot.event.wrong_credential'));
            }
        }
        return $filerobotConfig;
    }
}
