<?php

namespace App\Locations\Countries\Application\QueryHandlers;

class CountriesQueryCriteria {

    /** @var array */
    private $filters;
    /** @var string|null */
    private $orderBy;
    /** @var string|null */
    private $orderType;
    /** @var int|null */
    private $offset;
    /** @var int|null */
    private $limit;

    /**
     * @param array $filters
     * @param int|null $offset
     * @param int|null $limit
     * @param string|null $orderBy
     * @param string|null $orderType
     */
    public function __construct(
        array $filters,
        ?int $offset = null,
        ?int $limit = null,
        ?string $orderBy = null,
        ?string $orderType = null
    ) {
        $this->filters = $filters;
        $this->offset = $offset;
        $this->limit = $limit;
        $this->orderBy = $orderBy;
        $this->orderType = $orderType;
    }

    /**
     * @return bool
     */
    public function hasFilters(): bool {
        return count($this->filters) > 0;
    }

    /**
     * @return array
     */
    public function getFilters(): array {
        return $this->filters;
    }

    /**
     * @return int|null
     */
    public function getOffset(): ?int {
        return $this->offset;
    }

    /**
     * @return int|null
     */
    public function getLimit(): ?int {
        return $this->limit;
    }

    /**
     * @return string[]|null
     */
    public function getOrder(): ?array {
        if (!$this->hasOrder()) {
            return null;
        }

        return [
            $this->getOrderBy() => $this->getOrderType(),
        ];
    }

    /**
     * @return bool
     */
    public function hasOrder(): bool {
        return $this->orderBy && $this->orderType;
    }

    /**
     * @return string
     */
    public function getOrderBy(): ?string {
        return $this->orderBy;
    }

    /**
     * @return string
     */
    public function getOrderType(): ?string {
        return $this->orderType;
    }
}
