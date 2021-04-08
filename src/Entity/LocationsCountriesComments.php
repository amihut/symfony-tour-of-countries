<?php

namespace App\Entity;

use App\Repository\LocationsCountriesCommentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LocationsCountriesCommentsRepository::class)
 */
class LocationsCountriesComments {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=LocationsCountries::class, inversedBy="locationsCountriesComments")
     * @ORM\JoinColumn(nullable=false)
     */
    private $LocationsCountries;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $comment;

    public function getId(): ?int {
        return $this->id;
    }

    public function getLocationsCountries(): ?LocationsCountries {
        return $this->LocationsCountries;
    }

    public function setLocationsCountries(?LocationsCountries $LocationsCountries): self {
        $this->LocationsCountries = $LocationsCountries;

        return $this;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }
}
