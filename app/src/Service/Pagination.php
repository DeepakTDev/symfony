<?php

namespace App\Service;

class Pagination
{
    private int $perPageRecords;

    private int $totalRecords;

    private int $currentPage;

    public function __construct()
    {
        $this->currentPage = $this->totalRecords = 0;
        $this->perPageRecords = 25;
    }

    public function getTotalRecords(): int
    {
        return $this->totalRecords;
    }

    public function setTotalRecords(int $totalRecords): void
    {
        $this->totalRecords = $totalRecords;
    }

    public function getPerPageRecords(): int
    {
        return $this->perPageRecords;
    }

    public function setPerPageRecords(int $perPageRecords): void
    {
        $this->perPageRecords = $perPageRecords > 0 ? $perPageRecords : 25;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function setCurrentPage(int $currentPage): void
    {
        $this->currentPage = $currentPage > 0 ? --$currentPage : 0;
    }

    public function getOffsetRecords(): int
    {
        return is_int($this->getPerPageRecords() * $this->getCurrentPage()) ? $this->getPerPageRecords() * $this->getCurrentPage() : 0;
    }

    public function getTotalPages(): int
    {
        return $this->getTotalRecords() ? ceil($this->getTotalRecords() / $this->getPerPageRecords()) : 0;
    }
}
