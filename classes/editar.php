<?php
@$sessao = new sessao;
if (isAdmin() == true || $sessao->getVar('ra') == $_GET['ra']):
    if (isset($_GET['ra'])):
        $ra = $_GET['ra'];
        if (isset($_POST['editar'])):
            $admin = (isset($_POST['admin'])) ? $_POST['admin'] : "";
            $ativo = (isset($_POST['ativo'])) ? $_POST['ativo'] : "";

            $user = new funcionario(array(
                'nome' => $_POST['nome'],
                'sobrenome' => $_POST['sobrenome'],
                'telefone' => $_POST['telefone'],
                'ra' => $_POST['ra'],
                'ramal' => $_POST['ramal'],
                'curso' => $_POST['curso'],
                'bolsa' => $_POST['bolsa'], 
                'setor' => $_POST['setor'],
                'email' => $_POST['email'],
                'ativo' => ($ativo == 'on') ? 's' : 'n',
                'admin' => ($admin == 'on') ? 's' : 'n'
            ));
            $duplicado = null;
            $user->valorpk = $ra;
            $user->extras_select = "WHERE ra=$ra";
            $user->seleciona($user);
            $res = $user->retornaDados();

            if ($res->email != $_POST['email']):
                if ($user->existeRegistro('email', $_POST['email'])):
                    exibirMensagem('Este email ja existe, escolha outro endereço', 'erro');
                    $duplicado = true;
                endif;
            endif;

            if ($duplicado != true):
                $user->atualizar($user);
                if ($user->linhasAfetadas == 1):
                    exibirMensagem('</br>Dados alterados com sucesso.</br><a href="?m=usuarios&t=pesquisar">Exibir Cadastros</a>','sucesso');
                    unset($_POST);
                else:
                    exibirMensagem('</br>Nenhum dado alterado.</br><a href="?m=usuarios&t=listar">Exibir Cadastros</a>', 'alerta');

                endif;

            endif;

        endif;

        $ra = $_GET['ra'];
        $userbd = new funcionario();
        $userbd->extras_select = " WHERE ra=$ra";
        $userbd->seleciona($userbd);
        $resbd = $userbd->retornaDados();

    else:
        exibirMensagem('Usuario indefinido.<a href="?m=usuarios&t=listar">Escolha um usuario para alterar</a>', 'erro');
    endif;
    ?>
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
               
                telefone: {
                    required: "<div class='alertajs'>O telefone é obrigatorio.",
                },
            }

        });
    });


    </script>
 
    <form id="formulario_cadastro" accept-charset="utf-8" method="post">
    <input type="hidden" name="" value="" />
    <div class="form-all">
        <ul class="form-section">
            <li class="form-input-wide">
                <div class="form-header-group">

                </div>
            </li>
            </br> </br>
            <li class="form-line">
                <label class="form-label-left" for="nome">
                    Nome
                </label>
                <div class="form-input">
                    <input type="text" data-type="input-textbox"  name="nome" size="20" value="<?php if ($resbd) echo $resbd->nome; ?>" />
                </div>
            </li>
            <li class="form-line">
                <label class="form-label-left"  for="sobrenome">
                    Sobrenome
                </label>
                <div  class="form-input">
                    <input type="text"  data-type="input-textbox" name="sobrenome" size="20" value="<?php if ($resbd) echo $resbd->sobrenome; ?>" />
                </div>
            </li>
            <li class="form-line">
                <label class="form-label-left" for="telefone">
                    Telefone
                </label>
                <div>
                    <input class="form-number-input  form-textbox validate[required]" type="number" name="telefone" size="8" value="<?php if ($resbd) echo $resbd->telefone; ?>">
                </div>
            </li>
            <li class="form-line">
                <label class="form-label-left"  for="curso"> Curso </label>

                <select class="form-dropdown" style="width:150px"  name="curso" value="">
                    <option value="<?php if ($resbd) echo $resbd->curso; ?>">  </option>
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

                <input type="number" class="form-number-input  form-textbox validate[required]" name="ra" style="width:60px" size="5" value="<?php if ($resbd) echo $resbd->ra; ?>" data-type="input-number" data-numbermin="5" />

            </li>
            <li class="form-line form-line-column" >
                <label class="form-label-top"  for="ramal">
                    RAMAL
                </label>

                <input type="number" class="form-number-input  form-textbox validate[required]" id="input_40" name="ramal" style="width:60px" size="5" value="<?php if ($resbd) echo $resbd->ramal; ?>" data-type="input-number" data-numbermin="5" />

            </li>
            <li class="form-line form-line-column">
                <label class="form-label-top"  for=""> Bolsa </label>

                <select class="form-dropdown" style="width:150px"  name="bolsa">
                    <option value="<?php if ($resbd) echo $resbd->bolsa; ?>">  </option>
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

                <select class="" style="width:150px" id="input_43" name="setor">
                    <option value="<?php if ($resbd) echo $resbd->setor; ?>">  </option>
                    <option value="Restaurante"> Restaurante </option>
                    <option value="Padaria"> Padaria </option>
                    <option value="Cozinha"> Cozinha </option>
                </select>
            </li>
            <li class="form-line">
                <label class="form-label-left" for="">
                    E-mail:<span class="form-required">*</span>
                </label>
                <input type="text" class="" data-type="input-textbox"  name="email" size="20" value="<?php if ($resbd) echo $resbd->email; ?>" />
            </li>
            
             <li class="form-line">
                <label class="form-label-left" for="">
                    Administrador:<span class="form-required">*</span>
                </label>
                 <input type="checkbox" class=" " data-type="input-textbox" name="admin" <?php if (!isAdmin()) echo 'disabled="disabled"'; if ($resbd->admin == 's') echo 'checked="checked"'; ?> value="<?php if($resbd) echo $resbd->admin ?>" />
            <label class="form-label-left" for="">
                    Ativo:<span class="form-required">*</span>
                </label>
                 <input type="checkbox" class=" " data-type="input-textbox" name="ativo" <?php if (!isAdmin()) echo 'disabled="disabled"'; if ($resbd->ativo == 's') echo 'checked="checked"'; ?> value="<?php if($resbd) echo $resbd->admin ?>" />
             </li>
            
            <li>
                <div class="form-input-wide">
                    <div style="margin-left:156px" class="form-buttons-wrapper">
                        <input  type="button" class="form-submit-button" name="sair" onclick="location.href = '?m=usuarios&t=alunos'" value="Sair">
                          
                        <input  type="submit" class="form-submit-button" name="editar" value="Salvar dados">
                     
                    </div>
                </div>
            </li>
        </ul>
    </div>
</form>      
    
    
    
    
    
    
    
    <?php
else:
    exibirMensagem('</br>Você não tem permissão para acessar a pagina.</br><a href="#" onclick="history.back()">Voltar</a>','erro');
endif;

    
    
    
    
