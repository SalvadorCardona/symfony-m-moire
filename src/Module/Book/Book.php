<?php

declare(strict_types=1);

namespace App\Module\Book;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ApiResource]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('book:read')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('book:read')]
    public ?string $name;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'books')]
    public ?Author $author;

    public function getId(): ?int
    {
        return $this->id;
    }
}
