<?php
use Phalcon\Http\Request;
use Phalcon\Flash\Direct;

class NoticiaController extends ControllerBase
{
    private $mensagemDeErro = '';

    public function listaAction()
    {
        $noticias = Noticia::find();
        $this->view->setParamToView("noticias", $noticias);
        $this->view->pick("noticia/listar");
    }

    public function cadastrarAction()
    {
        $categorias = Categoria::find();
        $this->view->setParamToView("categorias", $categorias);
        $this->view->pick("noticia/cadastrar");

    }

    public function editarAction($id)
    {
        $noticia = Noticia::findFirstById($id);
        $data_publicacao = new DateTime($noticia->data_publicacao);
        $noticia->data_publicacao=$data_publicacao->format('d/m/Y');
        $data_ultima_atualizacao = new DateTime($noticia->data_ultima_atualizacao);
        $noticia->data_ultima_atualizacao =  $data_ultima_atualizacao->format('d/m/Y H:i:s');
        $data_cadastro = new DateTime($noticia->data_cadastro);
        $noticia->data_cadastro =  $data_cadastro->format('d/m/Y H:i:s');

        $categorias = Categoria::find();
        $noticia_categorias = NoticiaCategoria::find(['columns' => 'categoria_id', "noticia_id=$id"]);
        $categorias_selected = [];
        foreach($noticia_categorias as $categoria){
            $categorias_selected[] = $categoria["categoria_id"]; 
        }
        $this->view->setParamToView("categorias", $categorias);
        $this->view->setParamToView("categorias_selected", $categorias_selected);
        $this->view->setParamToView("noticia", $noticia);
        $this->view->pick("noticia/editar");
    }

    public function salvarAction()
    {
        $id = $this->request->getPost('id');
        $categorias = $this->request->getPost('categoria');
        $data = new DateTime();
        $acao = "criada";
        //verificando se é edição ou inserção
        if($id){
            $noticia = Noticia::findFirstById($id);
            $noticia->data_ultima_atualizacao=$data->format('Y-m-d H:i:s');
            $acao = "atualizada";
        }else{
            $noticia = new Noticia();
            $noticia->data_ultima_atualizacao=$data->format('Y-m-d H:i:s');
            $noticia->data_cadastro = $data->format('Y-m-d H:i:s');
        }
        $noticia->titulo=$this->request->getPost('titulo', 'string');
        $noticia->texto=$this->request->getPost('texto', 'string');
        if($this->request->getPost('publicado', 'int')==1){
            $noticia->publicado = 1;
            $data_publicacao = new DateTime($this->request->getPost('data_publicacao'));
            $noticia->data_publicacao = $data_publicacao->format( 'Y-m-d' );
        } else{
            $noticia->publicado = 0;
            $noticia->data_publicacao = NULL;
        }
        if($noticia->save()){
            //deletar os anteriores
            $noticia_categorias = NoticiaCategoria::find(["noticia_id=$noticia->id"]);
            $noticia_categorias->delete();
            //inserindo as categorias da notícia
            foreach($categorias as $categoria){
                echo $categoria;
                $noticia_categoria = new NoticiaCategoria();
                $noticia_categoria->noticia_id = $noticia->id;
                $noticia_categoria->categoria_id = $categoria;
                $noticia_categoria->save();
            }
            $this->flash->success("Notícia $acao com sucesso!");
        }else{
            $acao = ($acao=="criada")?"criar":"atualizar";
            $this->flash->error("Não foi possível $acao a notícia.");
        }

        return $this->response->redirect(array('for' => 'noticia.lista'));
    }

     public function excluirAction($id)
     {
        $noticia = Noticia::findFirstById($id);
        if($noticia->delete()){
            $this->flash->success("Notícia deletada com sucesso!");
        }else{
            $this->flash->error('Não foi possível deletar a notícia.');
        }
        return $this->response->redirect(array('for' => 'noticia.lista'));
     }

}