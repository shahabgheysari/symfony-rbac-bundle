<?php

namespace PhpRbacBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\String\Slugger\AsciiSlugger;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\ORM\Mapping\Index;

/**
 * @ORM\MappedSuperclass()
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="unique_code", columns={"code", "parent_id"})},
 *     indexes={@Index(name="permission_idx", columns={"code", "tree_left", "tree_right"})})
 *
 */
abstract class Node implements NodeInterface
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    protected ?string $code;

    /**
     * @ORM\Column(type="string",length=255)
     */
    protected ?string $description;

    /**
     * @ORM\Column(type="integer",name="tree_left")
     */
    protected ?int $left;

    /**
     * @ORM\Column(type="integer",name="tree_right")
     */
    protected ?int $right;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getLeft(): int
    {
        return $this->left;
    }

    public function setLeft(int $left): static
    {
        $this->left = $left;

        return $this;
    }

    public function getRight(): int
    {
        return $this->right;
    }

    public function setRight(int $right): static
    {
        $this->right = $right;

        return $this;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $slugger = new AsciiSlugger();
        $this->code = strtolower($slugger->slug($code));

        return $this;
    }

    public function __toString(): string
    {
        return $this->getCode();
    }
}
