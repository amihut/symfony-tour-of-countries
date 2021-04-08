<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationsCountriesRepository::class)
 */
class LocationsCountries {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prefix;

    /**
     * @ORM\OneToMany(targetEntity=LocationsCountriesComments::class, mappedBy="LocationsCountries")
     */
    private $locationsCountriesComments;

    public function __construct() {
        $this->locationsCountriesComments = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string {
        return $this->name;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getCode(): ?string {
        return $this->code;
    }

    /**
     * @param string|null $code
     * @return $this
     */
    public function setCode(?string $code): self {
        $this->code = $code;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getPrefix(): ?string {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return $this
     */
    public function setPrefix(string $prefix): self {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * @return Collection|LocationsCountriesComments[]
     */
    public function getLocationsCountriesComments(): Collection {
        return $this->locationsCountriesComments;
    }

    /**
     * @param LocationsCountriesComments $locationsCountriesComment
     * @return $this
     */
    public function addLocationsCountriesComment(LocationsCountriesComments $locationsCountriesComment): self {
        if (!$this->locationsCountriesComments->contains($locationsCountriesComment)) {
            $this->locationsCountriesComments[] = $locationsCountriesComment;
            $locationsCountriesComment->setLocationsCountries($this);
        }

        return $this;
    }

    /**
     * @param LocationsCountriesComments $locationsCountriesComment
     * @return $this
     */
    public function removeLocationsCountriesComment(LocationsCountriesComments $locationsCountriesComment): self {
        // set the owning side to null (unless already changed)
        if ($this->locationsCountriesComments->removeElement($locationsCountriesComment) && $locationsCountriesComment->getLocationsCountries() === $this) {
            $locationsCountriesComment->setLocationsCountries(null);
        }

        return $this;
    }
}
