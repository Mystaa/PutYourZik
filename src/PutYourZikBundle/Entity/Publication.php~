<?php

namespace PutYourZikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Publication
 *
 * @ORM\Table(name="publication")
 * @ORM\Entity(repositoryClass="PutYourZikBundle\Repository\PublicationRepository")
 */
class Publication
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="string", length=255)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="publications")
     */

    private $user;

    /**
     * @ORM\OneToMany(targetEntity="Music", mappedBy="publication")
     */

    private $musics;

    /**
     * @ORM\OneToMany(targetEntity="Comments", mappedBy="publication")
     */

    private $comments;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Publication
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Publication
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->musics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set user
     *
     * @param \PutYourZikBundle\Entity\User $user
     *
     * @return Publication
     */
    public function setUser(\PutYourZikBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \PutYourZikBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add music
     *
     * @param \PutYourZikBundle\Entity\Music $music
     *
     * @return Publication
     */
    public function addMusic(\PutYourZikBundle\Entity\Music $music)
    {
        $this->musics[] = $music;

        return $this;
    }

    /**
     * Remove music
     *
     * @param \PutYourZikBundle\Entity\Music $music
     */
    public function removeMusic(\PutYourZikBundle\Entity\Music $music)
    {
        $this->musics->removeElement($music);
    }

    /**
     * Get musics
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMusics()
    {
        return $this->musics;
    }

    /**
     * Add comment
     *
     * @param \PutYourZikBundle\Entity\Comments $comment
     *
     * @return Publication
     */
    public function addComment(\PutYourZikBundle\Entity\Comments $comment)
    {
        $this->comments[] = $comment;

        return $this;
    }

    /**
     * Remove comment
     *
     * @param \PutYourZikBundle\Entity\Comments $comment
     */
    public function removeComment(\PutYourZikBundle\Entity\Comments $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComments()
    {
        return $this->comments;
    }
}
