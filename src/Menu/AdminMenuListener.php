<?php

namespace Scaleflex\SyliusFilerobotPlugin\Menu;

use Knp\Menu\ItemInterface;
use Scaleflex\SyliusFilerobotPlugin\Model\Filerobot;
use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Doctrine\Persistence\ManagerRegistry;

final class AdminMenuListener
{
    /**
     * @var \Doctrine\Persistence\ObjectRepository
     */
    protected $filerobotRepository;

    /**
     * @var \Doctrine\Persistence\ObjectManager
     */
    protected $entityManager;

    /**
     * @param ManagerRegistry $doctrine
     */
    public function __construct(
        ManagerRegistry $doctrine
    ) {
        $this->entityManager = $doctrine->getManager();
        $this->filerobotRepository = $this->entityManager->getRepository(Filerobot::class);
    }

    /**
     * @param MenuBuilderEvent $event
     */
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();

        $catalog = $menu->getChild('configuration');

        if ($catalog) {
            $this->addChild($catalog);
        } else {
            $this->addChild($menu->getFirstChild());
        }
    }

    /**
     * @param ItemInterface $item
     * @return void
     */
    private function addChild(ItemInterface $item): void
    {
        $this->checkConfigExist();
        $item
            ->addChild('brands', [
                'route'             => 'scaleflex_sylius_filerobot_admin_filerobot_update',
                'routeParameters'   => ['id' => $this->checkConfigExist()]
            ])
            ->setLabel('scaleflex_sylius_filerobot.ui.title')
            ->setLabelAttribute('icon', 'building');
    }

    /**
     * Get last item, if does not exist - create one
     * @return int
     */
    private function checkConfigExist()
    {
        $config = $this->filerobotRepository->findOneBy([]);
        if (!$config) {
            $config = new Filerobot();
            $this->entityManager->persist($config);
            $this->entityManager->flush();
        }
        return $config->getId();
    }
}
