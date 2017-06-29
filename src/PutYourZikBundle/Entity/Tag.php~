<?php

namespace PutYourZikBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;


/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity(repositoryClass="PutYourZikBundle\Repository\TagRepository")
 */
class Tag
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
     * @ORM\ManyToMany(targetEntity="Music", mappedBy="tags")
     */
    private $musics;

    /**
     * @ORM\ManyToMany(targetEntity="Playlist", mappedBy="tags")
     */

    private $playlists;


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
     * @return Tag
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
     * Constructor
     */
    public function __construct()
    {
        $this->musics = new \Doctrine\Common\Collections\ArrayCollection();
        $this->playlists = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add music
     *
     * @param \PutYourZikBundle\Entity\Music $music
     *
     * @return Tag
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
     * Add playlist
     *
     * @param \PutYourZikBundle\Entity\Playlist $playlist
     *
     * @return Tag
     */
    public function addPlaylist(\PutYourZikBundle\Entity\Playlist $playlist)
    {
        $this->playlists[] = $playlist;

        return $this;
    }

    /**
     * Remove playlist
     *
     * @param \PutYourZikBundle\Entity\Playlist $playlist
     */
    public function removePlaylist(\PutYourZikBundle\Entity\Playlist $playlist)
    {
        $this->playlists->removeElement($playlist);
    }

    /**
     * Get playlists
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlaylists()
    {
        return $this->playlists;
    }
}
