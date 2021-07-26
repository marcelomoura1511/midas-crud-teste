<?php



use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class NoticiaCategoria extends Model
{
    private $id;
    public $noticia_id;
    public $categoria_id;

    public function initialize()
    {
        $this->setSource("noticia_categoria");
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    public function getNoticia_id()
    {
        return $this->noticia_id;
    }

    public function setNoticia_id($noticia_id)
    {
        $this->noticia_id = $noticia_id;
    }
    public function getCategoria_id()
    {
        return $this->categoria_id;
    }

    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }
}