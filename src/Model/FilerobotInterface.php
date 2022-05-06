<?php

namespace Scaleflex\SyliusFilerobotPlugin\Model;

use Sylius\Component\Resource\Model\ResourceInterface;

interface FilerobotInterface extends ResourceInterface
{

    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return bool|null
     */
    public function isStatus(): ?bool;

    /**
     * @param bool|null $status
     */
    public function setStatus(?bool $status): void;

    /**
     * @return string|null
     */
    public function getToken(): ?string;

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void;

    /**
     * @return string|null
     */
    public function getTemplateId(): ?string;

    /**
     * @param string|null $templateId
     */
    public function setTemplateId(?string $templateId): void;

    /**
     * @return string|null
     */
    public function getUploadDir(): ?string;

    /**
     * @param string|null $uploadDir
     */
    public function setUploadDir(?string $uploadDir): void;
}