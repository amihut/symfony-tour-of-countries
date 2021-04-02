<?php

namespace App\Locations\Countries\Domain\Model\Entities;

class Country {

    /** @var int */
    private $id;
    /** @var string */
    private $name;
    /** @var string */
    private $code;
    /** @var string */
    private $prefix;

    /**
     * @param int $id
     * @param string $name
     * @param string $code
     * @param string $prefix
     */
    public function __construct(
        int $id,
        string $name,
        string $code,
        string $prefix
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->prefix = $prefix;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCode(): string {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getPrefix(): string {
        return $this->prefix;
    }

    /**
     * @return array
     */
    public function toPrimitives(): array {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'code' => $this->getCode(),
            'prefix' => $this->getPrefix()
        ];
    }
}
