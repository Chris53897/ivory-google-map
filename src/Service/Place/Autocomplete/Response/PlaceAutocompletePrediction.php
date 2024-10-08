<?php

/*
 * This file is part of the Ivory Google Map package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Ivory\GoogleMap\Service\Place\Autocomplete\Response;

use Symfony\Component\Serializer\Annotation\SerializedName;

/**
 * @author GeLo <geloen.eric@gmail.com>
 */
class PlaceAutocompletePrediction
{
    #[SerializedName('place_id')]
    private ?string $placeId = null;

    #[SerializedName('description')]
    private ?string $description = null;

    /** @var string[] */
    #[SerializedName('types')]
    private array $types = [];

    /** @var PlaceAutocompleteTerm[] */
    #[SerializedName('terms')]
    private array $terms = [];

    /** @var PlaceAutocompleteMatch[] */
    #[SerializedName('matched_substrings')]
    private array $matches = [];

    public function hasPlaceId(): bool
    {
        return null !== $this->placeId;
    }

    public function getPlaceId(): ?string
    {
        return $this->placeId;
    }

    public function setPlaceId(?string $placeId): void
    {
        $this->placeId = $placeId;
    }

    public function hasDescription(): bool
    {
        return null !== $this->description;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function hasTypes(): bool
    {
        return !empty($this->types);
    }

    /** @return string[] */
    public function getTypes(): array
    {
        return $this->types;
    }

    /** @param string[] $types */
    public function setTypes(array $types): void
    {
        $this->types = [];
        $this->addTypes($types);
    }

    /** @param string[] $types */
    public function addTypes(array $types): void
    {
        foreach ($types as $type) {
            $this->addType($type);
        }
    }

    public function hasType(string $type): bool
    {
        return in_array($type, $this->types, true);
    }

    public function addType(string $type): void
    {
        if (!$this->hasType($type)) {
            $this->types[] = $type;
        }
    }

    public function removeType(string $type): void
    {
        unset($this->types[array_search($type, $this->types, true)]);
        $this->types = empty($this->types) ? [] : array_values($this->types);
    }

    public function hasTerms(): bool
    {
        return !empty($this->terms);
    }

    /** @return PlaceAutocompleteTerm[] */
    public function getTerms(): array
    {
        return $this->terms;
    }

    /** @param PlaceAutocompleteTerm[] $terms */
    public function setTerms(array $terms): void
    {
        $this->terms = [];
        $this->addTerms($terms);
    }

    /** @param PlaceAutocompleteTerm[] $terms */
    public function addTerms(array $terms): void
    {
        foreach ($terms as $term) {
            $this->addTerm($term);
        }
    }

    public function hasTerm(PlaceAutocompleteTerm $term): bool
    {
        return in_array($term, $this->terms, true);
    }

    public function addTerm(PlaceAutocompleteTerm $term): void
    {
        if (!$this->hasTerm($term)) {
            $this->terms[] = $term;
        }
    }

    public function removeTerm(PlaceAutocompleteTerm $term): void
    {
        unset($this->terms[array_search($term, $this->terms, true)]);
        $this->terms = empty($this->terms) ? [] : array_values($this->terms);
    }

    public function hasMatches(): bool
    {
        return !empty($this->matches);
    }

    /** @return PlaceAutocompleteMatch[] */
    public function getMatches(): array
    {
        return $this->matches;
    }

    /** @param PlaceAutocompleteMatch[] $matches */
    public function setMatches(array $matches): void
    {
        $this->matches = [];
        $this->addMatches($matches);
    }

    /** @param PlaceAutocompleteMatch[] $matches */
    public function addMatches(array $matches): void
    {
        foreach ($matches as $match) {
            $this->addMatch($match);
        }
    }

    public function hasMatch(PlaceAutocompleteMatch $match): bool
    {
        return in_array($match, $this->matches, true);
    }

    public function addMatch(PlaceAutocompleteMatch $match): void
    {
        if (!$this->hasMatch($match)) {
            $this->matches[] = $match;
        }
    }

    public function removeMatch(PlaceAutocompleteMatch $match): void
    {
        unset($this->matches[array_search($match, $this->matches, true)]);
        $this->matches = empty($this->matches) ? [] : array_values($this->matches);
    }
}
