<?php

namespace App\Locations\Countries\Application\CommandHandlers;

class UpdateCountryCommand {

    /** @var int */
    private $id;
    /** @var string | null */
    private $name;
    /** @var string | null*/
    private $code;
    /** @var string | null*/
    private $prefix;

    /**
     * @param int $id
     * @param string|null $name
     * @param string|null $code
     * @param string|null $prefix
     */
    public function __construct(
        int $id,
        ?string $name,
        ?string $code,
        ?string $prefix
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
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string {
        return $this->code;
    }

    /**
     * @return string|null
     */
    public function getPrefix(): ?string {
        return $this->prefix;
    }
}
