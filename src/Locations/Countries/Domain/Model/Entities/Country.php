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
    /** @var array */
    private $comments;

    /**
     * @param int $id
     * @param string $name
     * @param string $code
     * @param string $prefix
     * @param array $comments
     */
    public function __construct(
        int $id,
        string $name,
        string $code,
        string $prefix,
        array $comments = []
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->prefix = $prefix;
        $this->comments = $comments;
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
    public function getComments(): array {
        return $this->comments;
    }

    /**
     * @return int
     */
    public function countComments(): int {
        return count($this->comments);
    }

    /**
     * @return array
     */
    public function toPrimitives(): array {
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'code' => $this->getCode(),
            'prefix' => $this->getPrefix(),
            'comments' => $this->getComments()
        ];
    }
}
