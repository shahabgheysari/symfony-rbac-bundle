<?php

namespace PhpRbacBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PhpRbacBundle\Entity\RoleInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use PhpRbacBundle\Repository\UserRoleRepository;
use Doctrine\ORM\Mapping\JoinColumn;

/**
 * @ORM\Entity(repositoryClass=UserRoleRepository::class)
 */
trait UserRoleTrait
{

    /**
     * @ORM\ManyToMany(targetEntity=RoleInterface::class,cascade={"persist", "remove", "refresh"})
     * @ORM\JoinTable(name="user_role",
     *     joinColumns={@JoinColumn(name="user_id",referencedColumnName="id",onDelete="CASCADE")},
     *    inverseJoinColumns={@JoinColumn(name= "role_id", referencedColumnName= "id", onDelete= "cascade")}
     * )
     */
    private Collection $rbacRoles;

    public function __construct()
    {
        $this->rbacRoles = new ArrayCollection();
    }

    /**
     * @return Collection<int, RoleInterface>
     */
    public function getRbacRoles(): Collection
    {
        return $this->rbacRoles;
    }

    public function addRbacRole(RoleInterface $role): void
    {
        if (!$this->rbacRoles->contains($role)) {
            $this->rbacRoles[] = $role;
        }
    }

    public function removeRbacRole(RoleInterface $role): void
    {
        $this->rbacRoles->removeElement($role);
    }
}
