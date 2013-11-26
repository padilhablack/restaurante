<?php
    protegerArquivo(basename(__FILE__));
        @$sessao = new sessao;
        if (isAdmin() == true ):
            if (isset($_GET['ra'])):
                $ra = $_GET['ra'];
                if (isset($_POST['alterarsenha'])):
                    $user = new funcionario(array(
                        'senha' => codificasenha($_POST['senha']),
                    ));

                    $user->valorpk = $ra;
                    $user->atualizar($user);
                    if ($user->linhasAfetadas == 1):
                        exibirMensagem('</br>Senha alterada com sucesso.</br><a href="?m=usuarios&t=lista">Exibir Cadastros</a>', 'sucesso');
                        unset($_POST);
                    else:
                        exibirMensagem('</br>Nenhum dado foi alterado .</br><a href="?m=usuarios&t=lista">Exibir Cadastros</a>', 'alerta');
                    endif;

                endif;

                $ra = $_GET['ra'];
                $userbd = new funcionario();
                $userbd->extras_select = " WHERE ra=$ra";
                $userbd->seleciona($userbd);
                $resbd = $userbd->retornaDados();

            else:
                exibirMensagem('</br>Usuario nao definido!<a href="m=usuarios&t=pesquisa">Escolha um usuario para alterar</a>', 'erro');
            endif;
            ?>  
            <script>
                $(document).ready(function() {
                    $('#formCadastro').validate({
                        rules: {// condições 

                            senha: {required: true},
                            confirmasenha: {required: true, equalTo: "#senha"},
                            termos: "required"
                        },
                        messages: {// ações

                            senha: {
                                required: "<div class='alertajs'>O campo senha é obrigatorio.</div"
                            },
                            confirmasenha: {
                                required: "<div class='alertajs'>O campo confirmação de senha é obrigatorio.</div>",
                                equalTo: "<div class='alertajs'>O campo confirmação de senha deve ser identico ao campo senha.</div>"
                            },
                        }

                    });
                });
            </script>
            <form id="formCadastro"action="" name="" method="post" >
                <fieldset>
                    <legend></legend>
                    <ul>
                        <li><label for="nome">Nome:</label></li>                  
                        <li><input disabled="disabled" id="nome" type="text" name="nome" size="25" value="<?php if ($resbd) echo $resbd->nome ?>" /></li>
                        <label for="sobrenome">Sobrenome: </label>
                        <li><input disabled="disabled"id="sobreme"  type="text" name="sobrenome" size="25" value=" <?php if ($resbd) echo $resbd->sobrenome ?> "/></li>
                        <li><label for="ra">RA:</label></li>
                        <li><input disabled="disabled"type="text" name="ra"size="25" value=" <?php if ($resbd) echo $resbd->ra ?>"/></li>
                        <li><label for="telefone">Telefone:</label></li>
                        <li><input disabled="disabled"id="telefone"type="text" name="telefone"size="25" value=" <?php if ($resbd) echo $resbd->telefone ?>"/></li>
                        <li><label for="ramal">Ramal:</label></li>
                        <li><input disabled="disabled"id="ramal"type="text" name="ramal" size="25"value=" <?php if ($resbd) echo $resbd->ramal ?> "/></li>
                        <li><label for="curso">Curso:</label></li>
                        <li><input disabled="disabled"id="curso"type="text" name="curso" size="25"value="  <?php if ($resbd) echo $resbd->curso ?>"/></li>
                        <li><label for="email">Email:</label></li>
                        <li><input disabled="disabled"disabled=""id="email"type="text" name="email" size="25"value=" <?php if ($resbd) echo $resbd->email ?>"/></li>
                        <li><label for="email">Senha:</label></li>
                        <li><input id="senha"type="password" name="senha" id="senha"  value="" /></li>
                        <li><label for="email">Confirme a senha:</label></li>
                        <li><input id="confirmasenha"type="password" name="confirmasenha" value="" /></li>
                        <li class="center"><input type="button" onclick="location.href = '?m=usuarios&t=alunos'" value="Sair"/>
                            <input type="submit" name="alterarsenha" value="Salvar alterações"</li>
                    </ul>
                </fieldset>
            </form>
            <?php
        else:
            exibirMensagem('</br>Voce não tem permissão para acessar a pagina</br><a href="#" onclick="history.back()">Voltar</a>', 'erro');
        endif;