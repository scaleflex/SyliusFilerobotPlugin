<?php

namespace Scaleflex\SyliusFilerobotPlugin\Twig;

use Doctrine\Persistence\ManagerRegistry;
use Scaleflex\SyliusFilerobotPlugin\Model\Filerobot;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class FilerobotExtension extends AbstractExtension
{
    const FILEROBOT_PATH = 'filerobot';


    protected $params;

    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    protected $filerobotRepository;

    /**
     * @var \Doctrine\Persistence\ObjectManager
     */
    protected $entityManager;

    public function __construct(
        ManagerRegistry $doctrine,
        ParameterBagInterface $params
    ) {
        $this->params = $params;
        $this->entityManager = $doctrine->getManager();
        $this->filerobotRepository = $this->entityManager->getRepository(Filerobot::class);
    }

    /**
     * @return TwigFilter[]
     */
    public function getFilters()
    {
        return [
            new TwigFilter('filerobot', [$this, 'filterImage'])
        ];
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('filerobot_status', [$this, 'checkFilerobotStatus']),
            new TwigFunction('is_filerobot', [$this, 'checkIsFilerobot'])
        ];
    }

    /**
     * @param string $imgSrc
     * @return string
     */
    public function filterImage(string $imgSrc, string $filterName): string
    {
        if ($dimension = $this->getFilter($filterName)) {
            return $imgSrc . '&width=' . $dimension['width'] . '&height=' . $dimension['height'];
        }
        return $imgSrc;
    }


    /**
     * @param string $filterName
     * @return array|null
     */
    public function getFilter(string $filterName): ?array
    {
        $filterLists = $this->params->get('scaleflex_sylius_filerobot_plugin.filters');

        if(array_key_exists($filterName, $filterLists)) {
            return $filterLists[$filterName];
        }

        return null;
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

    /**
     * @return bool
     */
    public function checkIsFilerobot(string $pathName): bool
    {
        if (str_contains($pathName, self::FILEROBOT_PATH)) {
            return true;
        }
        return false;
    }
}