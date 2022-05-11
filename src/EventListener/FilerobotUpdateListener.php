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

        $currentStatus = $filerobotConfig->isStatus();
        $filerobotConfig->setStatus(false);

        if (!empty($filerobotConfig->getToken()) &&
            !empty($filerobotConfig->getTemplateId())) {
            try {
                $response = $this->httpClient->request(
                    'GET',
                    'https://api.filerobot.com/' . $filerobotConfig->getToken() . '/key/' . $filerobotConfig->getTemplateId()
                );

                if ($response->getStatusCode() === 200) {
                   $filerobotConfig->setStatus($currentStatus);
                }
            } catch (ClientException $exception) {
                $event->stop($this->translator->trans('scaleflex_sylius_filerobot.event.wrong_credential'));
            }
        }
        return $filerobotConfig;
    }
}
