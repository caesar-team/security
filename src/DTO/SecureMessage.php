<?php

declare(strict_types=1);

namespace Caesar\SecurityMessageBundle\DTO;

use Ramsey\Uuid\Uuid;
use Symfony\Component\Serializer\Annotation\Groups;

class SecureMessage
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $message;

    /**
     * @var int
     *
     * @Groups({"write"})
     */
    private $millisecondsLimit;

    /**
     * @var int
     */
    private $requestsLimit;

    public function __construct()
    {
        $this->id = Uuid::uuid4()->toString();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getRequestsLimit(): ?int
    {
        return $this->requestsLimit;
    }

    public function setRequestsLimit(int $requestsLimit): void
    {
        $this->requestsLimit = $requestsLimit;
    }

    public function getMillisecondsLimit(): ?int
    {
        return $this->millisecondsLimit;
    }

    public function setMillisecondsLimit(int $millisecondsLimit): void
    {
        $this->millisecondsLimit = $millisecondsLimit;
    }
}
