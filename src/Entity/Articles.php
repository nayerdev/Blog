<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticlesRepository::class)
 */
class Articles
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $contenu;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime")
     */
    private $update_at;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\OneToMany(targetEntity=Comment::class, mappedBy="articles", orphanRemoval=true)
     */
    private $Comment;

    /**
     * @ORM\ManyToMany(targetEntity=Categorie::class, inversedBy="articles")
     */
    private $Categorie;

    /**
     * @ORM\ManyToMany(targetEntity=MotCle::class, inversedBy="articles")
     */
    private $MotCle;

    public function __construct()
    {
        $this->Comment = new ArrayCollection();
        $this->Categorie = new ArrayCollection();
        $this->MotCle = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->contenu;
    }

    public function setContenu(string $contenu): self
    {
        $this->contenu = $contenu;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->update_at;
    }

    public function setUpdateAt(\DateTimeInterface $update_at): self
    {
        $this->update_at = $update_at;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->User;
    }

    public function setUser(?User $User): self
    {
        $this->User = $User;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComment(): Collection
    {
        return $this->Comment;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->Comment->contains($comment)) {
            $this->Comment[] = $comment;
            $comment->setArticles($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->Comment->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getArticles() === $this) {
                $comment->setArticles(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Categorie[]
     */
    public function getCategorie(): Collection
    {
        return $this->Categorie;
    }

    public function addCategorie(Categorie $categorie): self
    {
        if (!$this->Categorie->contains($categorie)) {
            $this->Categorie[] = $categorie;
        }

        return $this;
    }

    public function removeCategorie(Categorie $categorie): self
    {
        $this->Categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection|MotCle[]
     */
    public function getMotCle(): Collection
    {
        return $this->MotCle;
    }

    public function addMotCle(MotCle $motCle): self
    {
        if (!$this->MotCle->contains($motCle)) {
            $this->MotCle[] = $motCle;
        }

        return $this;
    }

    public function removeMotCle(MotCle $motCle): self
    {
        $this->MotCle->removeElement($motCle);

        return $this;
    }
}
