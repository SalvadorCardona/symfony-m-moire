<?php

declare(strict_types=1);

namespace App\Module\Book;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
#[ApiResource(
    denormalizationContext: ['groups' => ['book:read']],
    normalizationContext: ['groups' => ['book:read']]
)]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups('book:read')]
    private ?int $id;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    #[Groups('book:read')]
    public ?string $name;

    /** @var Collection<int, Book>  */
    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Book::class, cascade: ['persist'])]
    #[Groups('book:read')]
    public Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }
}
