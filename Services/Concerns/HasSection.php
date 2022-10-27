<?php

namespace Modules\Base\Services\Concerns;

trait HasSection
{
    /**
     * @var ?string
     * @example 'groupId'
     */
    public ?string $section = null;
    public ?string $sectionLabel = null;

    /**
     * @param string $section
     * @param ?string $sectionLabel
     * @return $this
     */
    public function section(string $section, ?string $sectionLabel): static
    {
        $this->section = $section;
        $this->sectionLabel = $sectionLabel;
        return $this;
    }
}
