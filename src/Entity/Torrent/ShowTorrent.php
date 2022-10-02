<?php

namespace App\Entity\Torrent;

use App\Entity\BaseMedia;
use App\Entity\File;
use App\Entity\Show;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class ShowTorrent extends BaseTorrent
{
    public function __construct()
    {
        parent::__construct();
        $this->files = new ArrayCollection();
    }

    /**
     * @var Show
     * @ORM\ManyToOne(targetEntity="App\Entity\Show", inversedBy="torrents")
     * @ORM\JoinColumn(name="media_id")
     */
    protected $show;
    public function getShow(): Show { return $this->show; }
    public function setShow(Show $show): self { $this->show = $show; return $this; }

    public function getMedia(): BaseMedia { return $this->show;}

    /**
     * @var File[]|ArrayCollection
     * @ORM\OneToMany(targetEntity="App\Entity\File", mappedBy="torrent",
     *     cascade={"persist", "remove"}, orphanRemoval=true)
     */
    protected $files;
    public function getFiles() { return $this->files; }

    public function setFiles(array $files) {
        /** @var File[] $files */
        $existFiles = [];
        foreach ($files as $n => $file) {
            foreach ($this->files as $exist) {
                if ($exist->equals($file)) {
                    $existFiles[] = $exist;
                    unset($files[$n]);
                }
            }
        }
        foreach ($this->files as $file) {
            if (!in_array($file, $existFiles)) {
                $this->files->removeElement($file);
            }
        }
        foreach ($files as $file) {
            $file->setTorrent($this);
            $this->files->add($file);
        }

        $size = 0;
        foreach ($this->files as $file) {
            $size+=$file->getSize();
        }
        $this->setSize($size);

        return $this;
    }
}
