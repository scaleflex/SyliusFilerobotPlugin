<?php

namespace Scaleflex\SyliusFilerobotPlugin\Twig;

use Doctrine\Persistence\ManagerRegistry;
use Scaleflex\SyliusFilerobotPlugin\Model\Filerobot;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FilerobotExtension extends AbstractExtension
{
    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    protected $filerobotRepository;

    /**
     * @var \Doctrine\Persistence\ObjectManager
     */
    protected $entityManager;

    public function __construct(
        ManagerRegistry $doctrine
    ) {
        $this->entityManager = $doctrine->getManager();
        $this->filerobotRepository = $this->entityManager->getRepository(Filerobot::class);
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('filerobot', [$this, 'filterImage']),
            new TwigFilter('filerobot_status', [$this, 'checkFilerobotStatus'])
        ];
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('filerobot_status', [$this, 'checkFilerobotStatus'])
        ];
    }

    /**
     * @param string $imgSrc
     * @return string
     */
    public function filterImage(string $imgSrc): string
    {
        if (!str_contains($imgSrc, 'filerobot')) {
            return $imgSrc;
        }
        return '123';
    }


    /**
     * @return bool
     */
    public function checkFilerobotStatus()
    {
        /** @var Filerobot $config */
        $config = $this->filerobotRepository->findOneBy([]);

        if ($config) {
            return $config->isStatus()
                && !empty($config->getTemplateId())
                && !empty($config->getToken())
                && !empty($config->getUploadDir());
        }

        return false;
    }
}