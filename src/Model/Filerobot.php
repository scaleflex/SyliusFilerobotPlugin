<?php

declare(strict_types=1);

namespace Scaleflex\SyliusFilerobotPlugin\Model;

class Filerobot implements FilerobotInterface
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var bool
     */
    protected $status;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var string
     */
    protected $templateId;

    /**
     * @var string
     */
    protected $uploadDir;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return bool|null
     */
    public function isStatus(): ?bool
    {
        return $this->status;
    }

    /**
     * @param bool|null $status
     */
    public function setStatus(?bool $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }

    /**
     * @return string|null
     */
    public function getTemplateId(): ?string
    {
        return $this->templateId;
    }

    /**
     * @param string|null $templateId
     */
    public function setTemplateId(?string $templateId): void
    {
        $this->templateId = $templateId;
    }

    /**
     * @return string|null
     */
    public function getUploadDir(): ?string
    {
        return $this->uploadDir;
    }

    /**
     * @param string|null $uploadDir
     */
    public function setUploadDir(?string $uploadDir): void
    {
        $this->uploadDir = $uploadDir;
    }
}
