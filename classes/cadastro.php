<?php
require_once 'funcoes.php';
protegerArquivo(basename(__FILE__));
include_once 'Horario.php';
if (isAdmin()):
    if (isset($_POST['cadastrar'])):

        //variaveis recebidas do post
        $nome = (isset($_POST['nome'])) ? $_POST['nome'] : " ";
        $sobrenome = (isset($_POST['sobrenome'])) ? $_POST['sobrenome'] : " ";
        $telefone = (isset($_POST['telefone'])) ? $_POST['telefone'] : " ";
        $ramal = (isset($_POST['ramal'])) ? $_POST['ramal'] : " ";
        $ra = (isset($_POST['ra'])) ? $_POST['ra'] : " ";
        $curso = (isset($_POST['curso'])) ? $_POST['curso'] : " ";
        $bolsa = (isset($_POST['bolsa'])) ? $_POST['bolsa'] : " ";
        $setor = (isset($_POST['setor'])) ? $_POST['setor'] : " ";
        $email = (isset($_POST['email'])) ? $_POST['email'] : " ";
        $senha = (isset($_POST['senha'])) ? $_POST['senha'] : " ";
        $horario1 = (isset($_POST['horario1'])) ? $_POST['horario1'] : "";
        $horario2 = (isset($_POST['horario2'])) ? $_POST['horario2'] : "";
        // array de funcionaio do banco
        $horageral = null;
        switch ($bolsa):
            case $bolsa == 'AI':
                $horageral = '840';
                break;
            case $bolsa == 'AP1':
                $horageral = '700';
                break;
            case $bolsa == 'AP2':
                $horageral = '600';
                break;
            case $bolsa == 'AP3':
                $horageral = '500';
                break;
            case $bolsa == 'AP4':
                $horageral = '300';
                break;
            case $bolsa == 'AP5':
                $horageral = '100';
                break;
        endswitch;

        $user = new funcionario(array(
            'nome' => $nome,
            'sobrenome' => $sobrenome,
            'telefone' => $telefone,
            'ra' => $ra,
            'curso' => $curso,
            'bolsa' => $bolsa,
            'setor' => $setor,
            'ramal' => $ramal,
            'email' => $email,
            'senha' => codificasenha($senha),
        ));
        $hora = new Horario(array(
            'r_a' => $ra,
            'hora1' => $horario1,
            'hora2' => $horario2,
            'horaGeral' => $horageral
        ));

        $duplicado = null;
        if ($user->existeRegistro('ra', $_POST['ra'])):
            exibirMensagem('</br>Este ra já esta cadastrado.</br>', 'alerta');
            $duplicado = TRUE;
        endif;

        if ($user->existeRegistro('email', $_POST['email'])):
            exibirMensagem('Este email já esta cadastrado.</br>', 'alerta');
            $duplicado = TRUE;
        endif;


        // grava no banco de dados

        if ($duplicado != TRUE):
            $user->inserir($user);

            $hora->inserir($hora);

            if ($user->linhasAfetadas == 1):
                exibirMensagem('Cadastro realizado com sucesso!</br><a href="?m=usuarios&t=listar">Exibir Cadastros</a>', 'sucesso');
                unset($_POST);
            endif;
        endif;
    endif;
    ?>


    <!--Validacão do formulário!-->

    <script>
        $(document).ready(function() {

            $('#formulario_cadastro').validate({
                rules: {// condições 
                    nome: {required: true, minlength: 3, },
                    sobrenome: {required: true, minlength: 3, },
                    ra: {required: true, minlength: 3, number: true},
                    ramal: {required: true, minlength: 4, number: true},
                    email: {required: true, email: true},
                    senha: {required: true},
                    conf_senha: {required: true, equalTo: "#senha"},
                },
                messages: {// ações
                    nome: {required: "<label class='alertajs'>Digite o nome.</label>",
                        minlength: "<div class='alertajs'>O campo nome deve ter no mínimo 3 caracteres</div>",
                    },
                    sobrenome: {required: "<label class='alertajs'>Digite o sobrenome.</label>",
                        minlength: "<div class='alertajs'>O campo sobrenome deve conter no mínimo 3 caracteres.</div>",
                        text: "<div class='alertajs'>Digite um nome válido</div>"},
                    ra: {required: "<label class='alertajs'>Digite o ra.</label>",
                        minlength: "<div class='alertajs'>O campo ra deve conter no mínimo 4 caracteres.</div>",
                        number: "<div class='alertajs'>Digite um numero válido</div>"
                    },
                    ramal: {required: "<label class='alertajs'>Digite o ramal.</label>",
                        minlength: "<div class='alertajs'>O campo ramal deve conter no mínimo 3 caracteres.</div>",
                        number: "<div class='alertajs'>Digite um numero válido</div>"},
                    email: {
                        required: "<label class='alertajs'>O campo email é obrigatorio.</label>",
                        email: "<div class='alertajs'>O campo email deve conter um email válido.</div>",
                    },
                    senha: {
                        required: "<label class='alertajs'>Digite a senha.</label>",
                    },
                    conf_senha: {
                        required: "<div class='alertajs'>O campo confirmação de senha é obrigatorio.",
                        equalTo: "<div class'alertajs'>O campo confirmação de senha deve ser identico ao campo senha.</div>",
                    },
                    telefone: {
                        required: "<div class='alertajs'>O telefone é obrigatorio.",
                    },
                }

            });
        });
    </script>


    <!--formulario de cadastro!-->

    <form id="formulario_cadastro" accept-charset="utf-8" method="post">
        <input type="hidden" name="" value="" />
        <div class="form-all">
            <ul class="form-section">
                <li class="form-input-wide">
                    <div class="form-header-group">

                    </div>
                </li>
                <li class="form-line">
                    <label class="form-label-left" for="nome">
                        Nome
                    </label>
                    <div class="form-input">
                        <input type="text" data-type="input-textbox"  name="nome" size="20" value="" />
                    </div>
                </li>
                <li class="form-line">
                    <label class="form-label-left"  for="sobrenome">
                        Sobrenome
                    </label>
                    <div  class="form-input">
                        <input type="text"  data-type="input-textbox" name="sobrenome" size="20" value="" />
                    </div>
                </li>
                <li class="form-line">
                    <label class="form-label-left" for="telefone">
                        Telefone
                    </label>
                    <div>
                        <input class="form-number-input  form-textbox validate[required]" type="number" name="phone" size="8">
                    </div>
                </li>
                <li class="form-line">
                    <label class="form-label-left"  for="curso"> Curso </label>

                    <select class="form-dropdown" style="width:150px"  name="curso">
                        <option value="">  </option>
                        <option value="Administração"> Administração </option>
                        <option value="Arquitetura e Urbanismo"> Arquitetura e Urbanismo </option>
                        <option value="Ciências Contábeis"> Ciências Contábeis </option>
                        <option value="Direito"> Direito </option>
                        <option value="Engenharia Civil"> Engenharia Civil </option>
                        <option value="História"> História </option>
                        <option value="Jornalismo"> Jornalismo </option>
                        <option value="Letras"> Letras </option>
                        <option value="Pedagogia"> Pedagogia </option>
                        <option value="Publicidade e propaganda"> Publicidade e propaganda </option>
                        <option value="Rádio &amp; TV"> Rádio &amp; TV </option>
                        <option value="Sistemas para Internet"> Sistemas para Internet </option>
                        <option value="Tradutor &amp; Intérprete "> Tradutor &amp; Intérprete </option>
                    </select>

                </li>
                <li class="form-line form-line-column">
                    <label class="form-label-top"for="ra">
                        RA
                    </label>

                    <input type="number" class="form-number-input  form-textbox validate[required]" name="ra" style="width:60px" size="5" value="" data-type="input-number" data-numbermin="5" />

                </li>
                <li class="form-line form-line-column" >
                    <label class="form-label-top"  for="ramal">
                        RAMAL
                    </label>

                    <input type="number" class="form-number-input  form-textbox validate[required]" id="input_40" name="ramal" style="width:60px" size="5" value="<?php ?>" data-type="input-number" data-numbermin="5" />

                </li>
                <li class="form-line form-line-column">
                    <label class="form-label-top"  for=""> Bolsa </label>

                    <select class="form-dropdown" style="width:150px" id="input_42" name="bolsa">
                        <option value="">  </option>
                        <option value="AI"> AI </option>
                        <option value="AP1"> AP1 </option>
                        <option value="AP2"> AP2 </option>
                        <option value="AP3"> AP3 </option>
                        <option value="AP4"> AP4 </option>
                        <option value="AP5"> AP5 </option>
                    </select>

                </li>
                <li class="form-line form-line-column">
                    <label class="form-label-top"  for="">
                        Setor<span class="form-required">*</span>
                    </label>

                    <select class="" style="width:100px" id="input_43" name="setor">
                        <option value="">  </option>
                        <option value="Restaurante"> Restaurante </option>
                        <option value="Padaria"> Padaria </option>
                        <option value="Cozinha"> Cozinha </option>
                    </select>

                    <label class="form-label-top"  for="">
                        Horário<span class="form-required">*</span>
                    </label>

                    <select class="" style="width:40px" id="input_43" name="horario1">
                        <option value="8">8</option> 
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>                     
                    </select>
                    ás
                    <select class="" style="width:45px" id="input_43" name="horario2">
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>                     
                    </select> 

                </li>


                <li class="form-line">
                    <label class="form-label-left" for="">
                        E-mail:<span class="form-required">*</span>
                    </label>
                    <input type="text" class="" data-type="input-textbox"  name="email" size="20" value="" />
                </li>

                <li class="form-line">
                    <label class="form-label-left" for="">
                        Senha:<span class="form-required">*</span>
                    </label>
                    <input type="password" class=" " data-type="input-textbox" id="input_35" name="senha" size="20" value="" />
                </li>


                <li>
                    <div class="form-input-wide">
                        <div style="margin-left:156px" class="form-buttons-wrapper">
                            <button  type="button" class="form-submit-button" name="sair" onclick="location.href = '?m=usuarios&t=alunos'" value="Sair">
                                Sair
                            </button>
                            <button  type="submit" class="form-submit-button" name="cadastrar">
                                Cadastrar
                            </button>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </form> 
    <?php
else:

    exibirMensagem('</br>Voce nao tem permissão de acessar essa página</br><a href="?m=usuarios&t=inicio">voltar</a>', 'erro');

endif;
?>