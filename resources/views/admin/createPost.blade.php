@extends('adminlte::page')

@section('title', 'Criar Post')

@section('content_header')
    <h1>Criar Post</h1>
@stop

@section('content')

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="row text-center">
            <div class="col-xs-10 col-xs-offset-1">

                <div class="card">
                    <form id="createPost" action="{{route('submit')}}" method="post" >
                        <div class="form-group">
                            <div class="col">
                                <label for="title">Insira o título do Post</label>
                                <input class="form-control" v-model="titulo" id="title" name="title" max="45">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="img">Insira a imagem do Post</label>
                                <br>

                                <update-imagem ref="modal" v-on:submit="setImagem" :url="'/api/register/imagem'" :legenda="'Imagem'" :cla="'fa fa-file-image-o'" :size="'50'"></update-imagem>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col">
                                <label for="descricao">Insira a descrição</label>
                                <input class="form-control" id="descricao" name="descricao" max="40">
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="conteudo" class="form-control my-editor" id="input" rows="10"></textarea>
                        </div>
{{--                        <div class="form-group">
                            <div class="col">
                                <label for="categoria">Selecione a categoria:</label>
                                <select class="form-control" id="categoria" name="categoria">
                                    <option>
                                        [{'text':'Fashion', value:'1'}, {'text':'Viagens', value:'2'},{text:'Estilo de vida', value:'3'},{text:'Finanças', value:'4'},{text:'Comidinhas', value:'5'}]
                                    </option>
                                </select>
                            </div>
                        </div>--}}
                            {{csrf_field()}}
                            <button class="form-control" type="submit">Enviar</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')

    <script src="{{asset('vendor/tinymce/js/tinymce/tinymce.min.js')}}"></script>
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: "textarea.my-editor",
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table contextmenu directionality",
                "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                if (type == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.open({
                    file : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no"
                });
            }
        };

        tinymce.init(editor_config);
    </script>
    <script src="{{asset('js/createPost.js')}}"></script>
@stop