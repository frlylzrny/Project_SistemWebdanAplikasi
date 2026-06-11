<?php

namespace App\Contracts;



/**
 * Contract Novel Data
 */
interface NovelContract
{
    public function id(): string;

    public function title(): string;

    public function author(): string;

    public function cover(): string;

    public function description(): ?string;

    public function category(): ?string;

    public function publisher(): ?string;

    public function publishedDate(): ?string;
}