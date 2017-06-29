<?php

namespace PutYourZikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;


/**
 * Playlist
 *
 * @ORM\Table(name="playlist")
 * @ORM\Entity(repositoryClass="PutYourZikBundle\Repository\PlaylistRepository")
 */
class Playlist
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
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="Duration", type="string", length=255)
     */
    private $duration;

    /**
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="playlists")
     * @JoinTable(name="playlist_tag")
     */

    private $tags;

    /**
     * @ORM\OneToMany(targetEntity="Music", mappedBy="playlist")
     */

    private $musics;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="playlists")
     */

    private $user;


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
     * Set name
     *
     * @param string $name
     *
     * @return Playlist
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set duration
     *
     * @param \DateTime $duration
     *
     * @return Playlist
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return \DateTime
     */
    public function getDuration()
    {
        return $this->duration;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tags = new \Doctrine\Common\Collections\ArrayCollection();
        $this->musics = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add tag
     *
     * @param \PutYourZikBundle\Entity\Tag $tag
     *
     * @return Playlist
     */
    public function addTag(\PutYourZikBundle\Entity\Tag $tag)
    {
        $this->tags[] = $tag;

        return $this;
    }

    /**
     * Remove tag
     *
     * @param \PutYourZikBundle\Entity\Tag $tag
     */
    public function removeTag(\PutYourZikBundle\Entity\Tag $tag)
    {
        $this->tags->removeElement($tag);
    }

    /**
     * Get tags
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTags()
    {
        return $this->tags;
    }

    /**
     * Add music
     *
     * @param \PutYourZikBundle\Entity\Music $music
     *
     * @return Playlist
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
     * Set user
     *
     * @param \PutYourZikBundle\Entity\User $user
     *
     * @return Playlist
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
}
