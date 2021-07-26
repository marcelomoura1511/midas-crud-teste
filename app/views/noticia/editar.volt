{% extends 'layouts/index.volt' %}

{% block content %}
<div id="cadastro_ticket" class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <i class="glyphicon glyphicon-plus"></i>
                &nbsp;Editar Noticia
            </div>
            {{ form('noticias/salvar', 'method': 'post', 'enctype' : 'multipart/form-data', 'name':'cadastrar') }}

            <div class="panel-body">
                <div class="col-md-12" id="conteudo">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <p><strong>Data de Criação:</strong> {{noticia.data_cadastro}}</p>
                                    <p><strong>Data da Última Atualização:</strong> {{noticia.data_ultima_atualizacao}}
                                    </p>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="{{noticia.id}}" width='100%' class="form-control">
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Titulo">Título <span class="error">(*)<span></label>
                                    <input type="text" name="titulo" value="{{noticia.titulo}}" width='100%'
                                        class="form-control" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <label for="Texto">Texto</label>
                                    <textarea name="texto" class="form-control">{{noticia.texto}}</textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-sm-12">
                                    <div class="col-sm-9">
                                        <label>Categoria: </label>
                                        <select name="categoria[]" class="selectpicker col-sm-10" multiple
                                            data-live-search="true">
                                            {% for categoria in categorias %}
                                            <option value="{{categoria.id}}" {% if categoria.id in categorias_selected %}
                                                selected {% endif %}>{{categoria.descricao}}</option>
                                            {% endfor %}
                                        </select>
                                    </div>
                                    <div class="col-sm-3">
                                        <input class="form-check-input" type="checkbox" value="1" id="publicado" {% if noticia.publicado==1 %} checked {% endif %} name="publicado">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Publicado
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="data-publicacao-row" {% if noticia.publicado==0 %} style="display:none" {% endif %} >
                                <div class="form-group col-sm-12">
                                    <div class="col-sm-3 col-md-2">
                                        <label>Data da publicação: </label>
                                    </div>
                                    
                                    <div class="input-group date col-sm-2" data-provide="datepicker">
                                        <input value="{{noticia.data_publicacao}}"type="text" name="data_publicacao" id="hasDatepicker" class="form-control fromDate large hasDatepicker2" maxlength="10" placeholder="dd-mm-yyyy" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>{#/.panel-body#}
                    </div>{#/.panel#}
                    <div class="row" style="text-align:right;">
                        <div id="buttons-cadastro" class="col-md-12">
                            <a href="{{ url(['for':'noticia.lista']) }}" class="btn btn-default">Cancelar</a>
                            {{ submit_button('Gravar', "class": 'btn btn-primary') }}
                        </div>
                    </div>
                </div>{#/.conteudo#}
            </div>{#/.panel-body#}
            {{ end_form() }}
        </div>{#/.panel#}
    </div>{#/.col-md-12#}
</div><!-- row -->

{% endblock %}

{% block extrafooter %}

<script>
    $(document).ready(function () {


    });
</script>
{% endblock %}