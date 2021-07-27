<!DOCTYPE html>
<html lang="pt-BR">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta charset="utf-8">
		<title>Sistema de Notícias :: Infoideías</title>
		<meta name="generator" content="Bootply" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<link href="<?= $this->url->getStatic('css/bootstrap.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/redmond/jquery-ui.css">
		<!--[if lt IE 9]>
			<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<link href="<?= $this->url->getStatic('css/styles.css') ?>" rel="stylesheet">
        <link href="<?= $this->url->getStatic('css/fileinput.min.css') ?>" rel="stylesheet">

        <link href="<?= $this->url->getStatic('css/bootstrap-datetimepicker.min.css') ?>" rel="stylesheet">

        <link href="<?= $this->url->getStatic('css/font-awesome.min.css') ?>" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />

        
        

	</head>
	<body>
        <div id="carregando">
            <img src="<?= $this->url->getStatic('img/loading.gif') ?>" alt="Carregando">
        </div>
        <header class="header">
            <div class="navbar navbar-default" id="subnav">
                <div class="col-md-12">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-6" id="logo">
                        <a id="link-logo" class="navbar-brand" href="<?= $this->url->get(['for' => 'noticia.lista']) ?>">
                            <img src="<?= $this->url->getStatic('img/logoTopo.png') ?>"  alt="Logo Infoidéias">
                        </a>
                    </div>
                    <div class="col-lg-3 hidden-md hidden-sm hidden-xs" id="logo">
                        <h1>Sistema de Noticias</h1>
                    </div>
                    <div class="navbar-header col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="navbar-collapse2">
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active">
                                <a href="<?= $this->url->get(['for' => 'noticia.lista']) ?>">
                                    <i class="glyphicon glyphicon-home"></i>
                                   Página Inicial
                                </a>
                            </li>
                            <li class="active">
                                <a href="<?= $this->url->get(['for' => 'noticia.cadastrar']) ?>">
                                    <i class="glyphicon glyphicon-bullhorn"></i>
                                    Nova Noticia
                                </a>
                            </li>
                            
                            <li role="presentation" class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Seja bem vindo(a), <?= $usuario->getNome() ?>
                                    <span class="caret"></span>

                                </a>
                                <ul class="dropdown-menu">
                                    
                                    <li><?= $this->tag->linkto([['for' => 'usuario.editar'], 'Alterar Senha']) ?></li>
                                    <li><?= $this->tag->linkto([['for' => 'logout'], 'Sair']) ?></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!--main-->
        <div class="container-fluid" id="main">

            <?= $this->flash->output(true) ?>

            
<div id="cadastro_ticket" class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-plus"></i>
                &nbsp;Editar Noticia
            </div>
            <?= $this->tag->form(['noticias/salvar', 'method' => 'post', 'enctype' => 'multipart/form-data', 'name' => 'cadastrar']) ?>

            <div class="panel-body">
                <div class="col-md-12" id="conteudo">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <p><strong>Data de Criação:</strong> <?= $noticia->data_cadastro ?></p>
                                    <p><strong>Data da Última Atualização:</strong> <?= $noticia->data_ultima_atualizacao ?>
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?= $noticia->id ?>" width='100%' class="form-control">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Titulo">Título <span class="error">(*)<span></label>
                                    <input type="text" name="titulo" value="<?= $noticia->titulo ?>" width='100%'
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Texto">Texto</label>
                                    <textarea name="texto" class="form-control"><?= $noticia->texto ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <div class="col-sm-9">
                                        <label  class="col-sm-3">Categoria: </label>
                                        <select name="categoria[]" class="selectpicker col-sm-5" multiple
                                            data-live-search="true" id="categorias">
                                            <?php foreach ($categorias as $categoria) { ?>
                                            <option value="<?= $categoria->id ?>" <?php if ($this->isIncluded($categoria->id, $categorias_selected)) { ?>
                                                selected <?php } ?>><?= $categoria->descricao ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="1" id="publicado" <?php if ($noticia->publicado == 1) { ?> checked <?php } ?> name="publicado">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Publicado
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="data-publicacao-row" <?php if ($noticia->publicado == 0) { ?> style="display:none" <?php } ?> >
                                <div class="form-group col-sm-9">
                                    <label class="col-sm-3">Data da publicação: </label>
                                    <div class="input-group date" data-provide="datepicker">
                                        <input type="text" value="<?= $noticia->data_publicacao ?>" name="data_publicacao" id="hasDatepicker" class="form-control fromDate large hasDatepicker2" maxlength="10" placeholder="dd-mm-yyyy" autocomplete="off" style="margin-left: 22px;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="text-align:right;">
                        <div id="buttons-cadastro" class="col-md-12">
                            <a href="<?= $this->url->get(['for' => 'noticia.lista']) ?>" class="btn btn-default">Cancelar</a>
                            <?= $this->tag->submitButton(['Gravar', 'class' => 'btn btn-primary']) ?>
                        </div>
                    </div>
                </div>
            </div>
            <?= $this->tag->endForm() ?>
        </div>
    </div>
</div><!-- row -->



            <div class="col-md-12 text-center">
                <p>Copyright 2015 - Todos os Direitos reservados. <a href="http://www.siteparaimobiliaria.imb.br/" target="_blank">Site para imobiliária Midas</a></p>
            </div>
        </div><!-- main -->
    	<!-- script references -->
		
        <script src="<?= $this->url->getStatic('js/jquery-2.2.0.min.js') ?>"></script>
        <script src="http://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
		<script src="<?= $this->url->getStatic('js/bootstrap.min.js') ?>"></script>
		<script src="<?= $this->url->getStatic('js/scripts.js') ?>"></script>
        
        <script src="<?= $this->url->getStatic('js/jquery.maskedinput.min.js') ?>"></script>
        
        <script src="<?= $this->url->getStatic('js/jquery.validate.min.js') ?>"></script>
        <script src="<?= $this->url->getStatic('js/langs/messages_pt_PT.min.js') ?>"></script>
        
        
        <script src="<?= $this->url->getStatic('js/bootstrap-datetimepicker.min.js') ?>"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.js"></script>
        <script src="<?= $this->url->getStatic('js/noticia-form.js') ?>"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <script>
            $(document).ready(function(){
                $("span.fechar").click(function(){
                    $(this).parent('div').slideUp();
                });
            });

        </script>
		

<script>
    $(document).ready(function () {

    });
</script>


	</body>
</html>